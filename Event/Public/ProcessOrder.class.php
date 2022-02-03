<?php
/**
 * This is the base event namespace.
 *
 * @noinspection PhpMultipleClassDeclarationsInspection
 */
namespace TheMysteryMarket\Event
{
    /** Cart Controller */
    require_once("Controller/CartController.class.php");
    use TheMysteryMarket\Controller\CartController;

    /** Include all the required stripe files */
    require_once("Configuration/Stripe.class.php");
    use TheMysteryMarket\Configuration\Stripe as StripeConfiguration;
    require_once("Stripe/init.php");
    use Stripe\{Stripe, Customer, Charge};

    /** Include all the query files */
    require_once("Query/CustomerAdd.query.php");
    require_once("Query/CustomerEmailExists.query.php");
    require_once("Query/CustomerGetIdWithEmail.query.php");
    require_once("Query/AddressAdd.query.php");
    require_once("Query/OrderAdd.query.php");
    require_once("Query/OrderProductAdd.query.php");
    use TheMysteryMarket\Query\{CustomerEmailExists, CustomerGetIdWithEmail, CustomerAdd, AddressAdd, OrderAdd, OrderProductAdd};
    require_once("Query/OrderGet.query.php");
    require_once("Query/CustomerGet.query.php");
    require_once("Query/AddressGet.query.php");
    require_once("Query/OrderProductsGet.query.php");
    use TheMysteryMarket\Query\{OrderGet, CustomerGet, AddressGet, OrderProductsGet};

    /** Include the email files */
    require_once("Email/OrderConfirmation.email.php");
    require_once("Email/OrderReceived.email.php");
    use TheMysteryMarket\Email\{OrderConfirmation, OrderReceived};

    require_once("Factory/EventFactory.class.php");
    use TheMysteryMarket\Factory\EventFactory;

    /** Import required namespaces. */
    use TheMysteryMarket\Interfaces\Event;
    use Exception;


    /**
     * This is the Administration login event. This will handle logging an admin in.
     */
    class ProcessOrder implements Event
    {
        private const Currency = "USD";

        private $firstname;
        private $middleName;
        private $lastName;
        private $emailAddress;
        private $phoneNumber;

        private $billingAddressOne;
        private $billingAddressTwo;
        private $billingCity;
        private $billingState;
        private $billingZip;

        private $shippingAddressOne;
        private $shippingAddressTwo;
        private $shippingCity;
        private $shippingState;
        private $shippingZip;

        private $stripeToken;
        private $stripeCustomerId;
        private $stripeChargeId;
        private $stripeResponseJson;

        private float $cartTotal = 0.00;
        private $cartTaxTotal;
        private $cartShippingTotal;
        private $cartDescription = "The Mystery Market Purchase";

        private $customerId;
        private $billingAddressId;
        private $shippingAddressId;
        private $orderId;


        public function run(): bool
        {
            if(array_key_exists('order_id', $_SESSION))
            {
                $this->orderId = $_SESSION['order_id'];
                $this->SendToThankYouPage();
            }
            if($this->DataIsValid()) {
                $this->PopulateData();
                try {
                    $this->ProcessStripePayment(
                        $this->stripeToken,
                        $this->emailAddress,
                        $this->cartTotal,
                        $this->cartDescription
                    );
                } catch (Exception $e) {
                    /** Here we need to take the error kick them back to the checkout page and display the order */
                    $this->SendBackToCheckoutPage(['stripe' => $e->getMessage()]);
                    return false;
                }

                $this->FinalizeOrder();
                $this->SendToThankYouPage();
                return true;
            }
            return false;
        }

        private function DataIsValid(): bool
        {
            /** START PERSONAL INFORMATION VERIFICATION */
            if(!array_key_exists('first_name', $_POST) || $_POST['first_name'] == "")
            {
                $this->SendBackToCheckoutPage(['personal'=>'First name is required!']);
                return false;
            }
            if(!array_key_exists('middle_name', $_POST))
            {
                $_POST['middle_name'] = "";
            }
            if(!array_key_exists('last_name', $_POST) || $_POST['last_name'] == "")
            {
                $this->SendBackToCheckoutPage(['personal'=>'Last name is required!']);
                return false;
            }
            if(!array_key_exists('phone_number', $_POST))
            {
                $this->SendBackToCheckoutPage(['personal'=>'Phone number is required!']);
                return false;
            }
            $_POST['phone_number'] = preg_replace("/[^0-9]/", "", $_POST['phone_number']);
            if($_POST['phone_number'] == "" ||strlen($_POST['phone_number'])!=10)
            {
                $this->SendBackToCheckoutPage(['personal'=>'Invalid phone number']);
                return false;
            }
            if(!array_key_exists('email_address', $_POST)||$_POST['email_address']=="")
            {
                $this->SendBackToCheckoutPage(['personal'=>'Email Address is required!']);
                return false;
            }
            if(!array_key_exists('email_address_verification', $_POST)||$_POST['email_address_verification']=="")
            {
                $this->SendBackToCheckoutPage(['personal'=>'Verification email address is required!']);
                return false;
            }
            $_POST['email_address'] = strtolower($_POST['email_address']);
            $_POST['email_address_verification'] = strtolower($_POST['email_address_verification']);
            if($_POST['email_address'] != $_POST['email_address_verification'])
            {
                $this->SendBackToCheckoutPage(['personal'=>'Email address and verification email address must match!']);
                return false;
            }
            /** END PERSONAL INFORMATION VERIFICATION */

            /** START BILLING ADDRESS VERIFICATION */
            if(!array_key_exists('billing_address_1', $_POST)||$_POST['billing_address_1']=="")
            {
                $this->SendBackToCheckoutPage(['billing'=>'Address is required!']);
                return false;
            }
            if(!array_key_exists('billing_address_2', $_POST))
            {
                $_POST['billing_address_2'] = "";
            }
            if(!array_key_exists('billing_city', $_POST)||$_POST['billing_city']=="")
            {
                $this->SendBackToCheckoutPage(['billing'=>'City is required!']);
                return false;
            }
            if(!array_key_exists('billing_state', $_POST)||$_POST['billing_state']=="")
            {
                $this->SendBackToCheckoutPage(['billing'=>'Please select a state!']);
                return false;
            }
            if(!array_key_exists('billing_zip', $_POST))
            {
                $this->SendBackToCheckoutPage(['billing'=>'Zip code is required!']);
                return false;
            }
            $_POST['billing_zip'] = preg_replace("/[^0-9]/", "", $_POST['billing_zip']);
            if($_POST['billing_zip']==""||strlen($_POST['billing_zip'])!=5)
            {
                $this->SendBackToCheckoutPage(['billing'=>'Invalid zip code!']);
                return false;
            }
            /** END BILLING ADDRESS VERIFICATION */

            /** Start SHIPPING ADDRESS VERIFICATION */
            if(!array_key_exists('shipping_address_1', $_POST)||$_POST['shipping_address_1']=="shipping_address_1")
            {
                $this->SendBackToCheckoutPage(['shipping'=>'Address is required!']);
                return false;
            }
            if(!array_key_exists('shipping_address_2', $_POST))
            {
                $_POST['shipping_address_2'] = "";
            }
            if(!array_key_exists('shipping_city', $_POST)||$_POST['shipping_city']=="")
            {
                $this->SendBackToCheckoutPage(['shipping'=>'City is required!']);
                return false;
            }
            if(!array_key_exists('shipping_state', $_POST)||$_POST['shipping_state']=="")
            {
                $this->SendBackToCheckoutPage(['shipping'=>'Please select a state!']);
                return false;
            }
            if(!array_key_exists('shipping_zip', $_POST))
            {
                $this->SendBackToCheckoutPage(['shipping'=>'Zip code is required']);
                return false;
            }
            $_POST['shipping_zip'] = preg_replace("/[^0-9]/", "", $_POST['shipping_zip']);
            if($_POST['shipping_zip']==""||strlen($_POST['shipping_zip'])!=5)
            {
                $this->SendBackToCheckoutPage(['shipping'=>'Invalid zip code!']);
                return false;
            }
            return true;
        }

        private function PopulateData(): void
        {
            /** Basic customer information. */
            $this->firstname            = $_POST['first_name'];
            $this->middleName           = $_POST['middle_name'];
            $this->lastName             = $_POST['last_name'];
            $this->emailAddress         = $_POST['email_address'];
            $this->phoneNumber          = $_POST['phone_number'];
            /** Billing address */
            $this->billingAddressOne    = $_POST['billing_address_1'];
            $this->billingAddressTwo    = $_POST['billing_address_2'];
            $this->billingCity          = $_POST['billing_city'];
            $this->billingState         = $_POST['billing_state'];
            $this->billingZip           = $_POST['billing_zip'];
            /** Shipping Address */
            $this->shippingAddressOne   = $_POST['shipping_address_1'];
            $this->shippingAddressTwo   = $_POST['shipping_address_2'];
            $this->shippingCity         = $_POST['shipping_city'];
            $this->shippingState        = $_POST['shipping_state'];
            $this->shippingZip          = $_POST['shipping_zip'];
            /** Stripe Token */
            $this->stripeToken          = $_POST['stripe_token'];
            /** Cart Totals */
            $this->cartTotal            = CartController::CartTotal();
            $this->cartTaxTotal         = CartController::CartTaxTotal($this->billingState);
            $this->cartShippingTotal    = CartController::CartShippingTotal();
        }

        private function FinalizeOrder()
        {
            if((new CustomerEmailExists())->Query($this->emailAddress))
            {
                /** Customer Exists get the customer id */
                $this->customerId = (new CustomerGetIdWithEmail())->Query($this->emailAddress);
            }
            else {
                /** customer does not exist create it. */
                $this->customerId = (new CustomerAdd())->Query(
                    $this->firstname,
                    $this->middleName,
                    $this->lastName,
                    $this->emailAddress,
                    $this->phoneNumber
                );
            }
            $this->billingAddressId = (new AddressAdd())->Query(
                $this->customerId,
                $this->billingAddressOne,
                $this->billingAddressTwo,
                $this->billingCity,
                $this->billingState,
                (int)$this->billingZip
            );
            $this->shippingAddressId = (new AddressAdd())->Query(
              $this->customerId,
              $this->shippingAddressOne,
              $this->shippingAddressTwo,
              $this->shippingCity,
              $this->shippingState,
              (int)$this->shippingZip
            );
            $this->orderId = (new OrderAdd())->Query(
                $this->customerId,
                $this->billingAddressId,
                $this->shippingAddressId,
                $this->stripeCustomerId,
                $this->stripeChargeId,
                $this->cartTotal,
                $this->cartTaxTotal,
                $this->cartShippingTotal
            );
            $cartArray = CartController::GetCartArray();
            foreach($cartArray as $cartItem)
            {
                (new OrderProductAdd())->Query(
                    $this->orderId,
                    (int)$cartItem['id'],
                    (int)$cartItem['quantity'],
                    (float)$cartItem['price']
                );
            }
            $_SESSION['order_id'] = $this->orderId;
            $this->SendEmails();
        }

        private function ProcessStripePayment(string $stripeToken, string $emailAddress, float $amountToCharge, string $description)
        {
            Stripe::setApiKey((new StripeConfiguration())->secretKey);
            $customer = $this->CreateStripeCustomer($emailAddress, $stripeToken);
            $charge = $this->CreateStripeCharge($customer, ((int)$amountToCharge*100), $description);
            $this->stripeCustomerId = $customer->id;
            $this->stripeChargeId = $charge->id;
            $this->stripeResponseJson = $charge->jsonSerialize();
        }

        private function CreateStripeCustomer(string $emailAddress, string $stripeToken)
        {
            return Customer::create(array(
                'email' => $emailAddress,
                'source'  => $stripeToken
            ));
        }

        private function CreateStripeCharge($customer, float $amount, string $description)
        {
            return Charge::create(array(
                'customer' => $customer->id,
                'amount'   => $amount,
                'currency' => self::Currency,
                'description' => $description
            ));
        }

        private function SendEmails(): void
        {
            $orderData = (new OrderGet())->Query($this->orderId);
            $orderProducts = (new OrderProductsGet())->Query($this->orderId);
            $orderConformationEmail = new OrderConfirmation();
            $orderConformationEmail
                ->SetOrderNumber($this->orderId)
                ->SetOrderDate($orderData['order_date'])
                ->SetItems($orderProducts)
                ->SetTax($this->cartTaxTotal)
                ->SetShipping($this->cartShippingTotal)
                ->SetFirstName($this->firstname)
                ->SetLastName($this->lastName)
                ->SetAddress($this->shippingAddressOne)
                ->SetApt($this->shippingAddressTwo)
                ->SetCity($this->shippingCity)
                ->SetState($this->shippingState)
                ->SetZip($this->shippingZip)
                ->SetReceiverName($this->firstname.' '.$this->lastName)
                ->SetReceiverAddress($this->emailAddress)
                ->SetSubject('Order Received: #'.str_pad($this->orderId, 8, '0', STR_PAD_LEFT))
                ->SetBodyHTML($orderConformationEmail->Generate())
                ->SetBodyText("Order Confirmation")
                ->Send();
            $orderReceived = new OrderReceived();
            $orderReceived->Send();
        }

        private function SendToThankYouPage(): void
        {
            header("location: index.php?page=ThankYou&order_id=".$this->orderId);
        }

        private function SendBackToCheckoutPage(array $errors = []): void
        {
            $eventClass = EventFactory::Build("Public", "Render");
            $eventClass->run(['page'=> 'Checkout', 'errors' => $errors]);
        }
    }
}