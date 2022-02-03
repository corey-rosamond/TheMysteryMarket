<?php
/**
 * This is the namespace for all front end page objects.
 */
namespace TheMysteryMarket\Page\FrontEnd
{
    /** Include the front end base class ane namespace. */
    require_once("Page/Front-End/FrontEndBase.class.php");

    require_once('Controller/CartController.class.php');
    use TheMysteryMarket\Controller\CartController;


    /**
     * This is the third page in the funnel. This is the stage where we summarize the customers order
     * then process their payment.
     */
    class Checkout extends FrontEndBase
    {
        private const ShowHero = false;

        private const States = array(
            'AL'=>'Alabama',
            'AK'=>'Alaska',
            'AZ'=>'Arizona',
            'AR'=>'Arkansas',
            'CA'=>'California',
            'CO'=>'Colorado',
            'CT'=>'Connecticut',
            'DE'=>'Delaware',
            'DC'=>'District of Columbia',
            'FL'=>'Florida',
            'GA'=>'Georgia',
            'HI'=>'Hawaii',
            'ID'=>'Idaho',
            'IL'=>'Illinois',
            'IN'=>'Indiana',
            'IA'=>'Iowa',
            'KS'=>'Kansas',
            'KY'=>'Kentucky',
            'LA'=>'Louisiana',
            'ME'=>'Maine',
            'MD'=>'Maryland',
            'MA'=>'Massachusetts',
            'MI'=>'Michigan',
            'MN'=>'Minnesota',
            'MS'=>'Mississippi',
            'MO'=>'Missouri',
            'MT'=>'Montana',
            'NE'=>'Nebraska',
            'NV'=>'Nevada',
            'NH'=>'New Hampshire',
            'NJ'=>'New Jersey',
            'NM'=>'New Mexico',
            'NY'=>'New York',
            'NC'=>'North Carolina',
            'ND'=>'North Dakota',
            'OH'=>'Ohio',
            'OK'=>'Oklahoma',
            'OR'=>'Oregon',
            'PA'=>'Pennsylvania',
            'RI'=>'Rhode Island',
            'SC'=>'South Carolina',
            'SD'=>'South Dakota',
            'TN'=>'Tennessee',
            'TX'=>'Texas',
            'UT'=>'Utah',
            'VT'=>'Vermont',
            'VA'=>'Virginia',
            'WA'=>'Washington',
            'WV'=>'West Virginia',
            'WI'=>'Wisconsin',
            'WY'=>'Wyoming',
        );

        /**
         * Constructor method for the basic Checkout page.
         */
        public function __construct(array $data = [])
        {
            /** Verify that the cart exists before continuing */
            if(!CartController::CartExists())
            {
                /** The cart does not exist they should not be here send them back to the landing page. */
                header("location: index.php?page=Lander");
            }
            if(array_key_exists('order_id', $_SESSION))
            {
                header("location: index.php?page=ThankYou&order_id=".$_SESSION['order_id']);
            }
            //echo '<pre>'.print_r($data, true).'</pre>';
            $billingError = NULL;
            $shippingError = NULL;
            $personalError = NULL;
            $stripeError = NULL;
            if(array_key_exists('errors', $data))
            {
                if(array_key_exists('billing', $data['errors']))
                {
                    $billingError = $data['errors']['billing'];
                }
                if(array_key_exists('shipping', $data['errors']))
                {
                    $shippingError = $data['errors']['shipping'];
                }
                if(array_key_exists('personal', $data['errors']))
                {
                    $personalError = $data['errors']['personal'];
                }
                if(array_key_exists('stripe', $data['errors']))
                {
                    $stripeError = $data['errors']['stripe'];
                }
            }

            parent::__construct();
            $this->SetTitle("The Mystery Market")
                ->SetDescription("Checkout Page")
                ->SetOgTitle("The Mystery Market")
                ->SetOgURL("https://themysterymarket.com/checkout.php")
                ->SetOgDescription("Checkout Page")
                ->SetBodyClass("order-page")
                ->AddScript("https://js.stripe.com/v3/")
                ->AddScript("Javascript/Front-End/Checkout.js", true)
                ->SetBodyHTML(
                    $this->GenerateHeader()
                    .'<main>'.
                        $this->GenerateHeroSection().
                        $this->GenerateForm(
                            $billingError,
                            $shippingError,
                            $personalError,
                            $stripeError
                        )
                    .'</main>'.
                    $this->GenerateFooter()
                );
        }

        private function GenerateHeroSection(): string
        {
            if(self::ShowHero) {
                return '
                <section class="banner-section section-spacer order-banner">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="section-title">
                                    <h2 class="text-white text-capitalize font-weight-bold">Chiropractic <span class="text-yellow text-underline">One Time Offer</span></h2>
                                    <h5 class="text-white">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse vel aliquet nulla. </h5>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="inner-container mx-auto video-section">
                                    <video width="100%" height="auto" poster="Asset/img/home-05.png" controls>
                                        <source src="https://webdevproof.com/click-funnel-videos/video.mp4" type="video/mp4">
                                        <source src="https://webdevproof.com/click-funnel-videos/video.webm" type="video/webm">
                                    </video>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="inner-container scroll-down text-center mt-3 mt-md-5">
                                    <i class="fa fa-arrow-down text-orange"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>';
            }
            return '';
        }

        private function GenerateForm(?string $billingError = NULL, ?string $shippingError = NULL, ?string $personalError = NULL, ?string $stripeError = NULL): string
        {
            return '
            <section class="order-form-section section-spacer" id="order-form">
				<div class="container">
					<div class="row">
						<div class="col">
							<div class="section-title">
								<h2 class="font-weight-bold">Complete Your Order</h2>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<div class="inner-container order-form">
							    '.$this->GenerateCart().'
								<form action="index.php?event=ProcessOrder" method="post" id="paymentForm">
									<div class="row">
									    '.$this->GenerateBillingAddressForm($billingError).'
									</div>
									<div class="row">
									    '.$this->GenerateShippingAddressForm($shippingError).'
                                    </div>
                                    <div class="row">
									    '.$this->GeneratePersonalInformationForm($personalError).'
									    '.$this->GenerateCreditCardNumberForm($stripeError).'
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</section>';
        }

        private function GenerateCart(): string
        {
            $cartItems = CartController::GetCartArray();
            $cartTotal = 0.00;

            $returnString = '<div class="container order-details mb-4">';
                $returnString .= '<div class="row">';
                    $returnString .= '<div class="col-12 text-center font-weight-bold"><h2 class="bg-blue text-white text-center mb-0">Your Products</h2></div>';
                $returnString .= '</div>';
                $returnString .= '<div class="row border-bottom">';
                    $returnString .= '<div class="col-1 text-center font-weight-bold">Quantity</div>';
                    $returnString .= '<div class="col-9 text-left font-weight-bold">Item</div>';
                    $returnString .= '<div class="col-1 text-right font-weight-bold">Unit</div>';
                    $returnString .= '<div class="col-1 text-left font-weight-bold">Total</div>';
                $returnString .= '</div>';
                foreach($cartItems as $cartItem)
                {
                    $returnString .= '<div class="row">';
                        $returnString .= '<div class="col-1 text-center">'.$cartItem['quantity'].'</div>';
                        $returnString .= '<div class="col-9 text-left">'.$cartItem['name'].'</div>';
                        $returnString .= '<div class="col-1 text-right">$'.number_format($cartItem['price'],2, '.',',').'</div>';
                        $itemTotal = ($cartItem['price']*$cartItem['quantity']);
                        $returnString .= '<div class="col-1 text-left">$'.number_format($itemTotal, 2, '.', ',').'</div>';
                    $returnString .= '</div>';
                    $cartTotal += ($cartItem['price']*$cartItem['quantity']);
                }
                $shippingTotal = CartController::CartShippingTotal();
                $taxTotal = CartController::CartTaxTotal('CA');
                $returnString .= '<div class="row">';
                    $returnString .= '<div class="col-11 text-right font-weight-bold">Tax: </div>';
                    $returnString .= '<div class="col-1 text-left">$'.number_format($taxTotal, 2, '.', ',').'</div>';
                $returnString .= '</div>';
                $returnString .= '<div class="row">';
                    $returnString .= '<div class="col-11 text-right font-weight-bold">Shipping: </div>';
                    $returnString .= '<div class="col-1 text-left">$'.number_format($shippingTotal,2,'.',',').'</div>';
                $returnString .= '</div>';
                $returnString .= '<div class="row">';
                    $returnString .= '<div class="col-11 text-right font-weight-bold">Total: </div>';
                    $returnString .= '<div class="col-1 text-left">$'.number_format(($cartTotal+$taxTotal+$shippingTotal), 2, '.', ',').'</div>';
                $returnString .= '</div>';
            $returnString .= '</div>';
            return $returnString;
        }

        private function GeneratePersonalInformationForm(?string $error = NULL): string
        {

            return '
            <div class="col-lg-6 col-md-12">
                <div class="left-container inner-container">
                    <h3 class="form-title font-weight-medium">Personal Information</h3>
                    <div id="personal_errors">'.$this->ErrorString($error).'</div>
                    <div class="row">
                        <div class="col-8">
                            <div class="form-group">
                                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name *">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <input type="text" class="form-control" id="middle_name" name="middle_name" placeholder="Middle *">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name">
                    </div>
                    <div class="form-group">
                        <input type="tel" class="form-control" id="phone_number" name="phone_number" placeholder="Phone Number *">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" id="email_address" name="email_address" placeholder="Email *">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" id="email_address_verification" name="email_address_verification" placeholder="Verify Email">
                    </div>
                </div>
            </div>';
        }

        private function GenerateBillingAddressForm(?string $error = NULL): string
        {
            return '
            <div class="col-lg-12 col-md-12">
                <div class="right-container inner-container">
                    <h3 class="form-title font-weight-medium">Billing Address</h3>
                    <div id="billing_errors">'.$this->ErrorString($error).'</div>
                    <div class="row">
                        <div class="col-9">
                            <div class="form-group">
                                <input type="text" class="form-control" id="billing_address_1" name="billing_address_1" placeholder="Address *">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <input type="text" class="form-control" id="billing_address_2" name="billing_address_2" placeholder="Apt #">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <input type="text" class="form-control" id="billing_city" name="billing_city" placeholder="City *">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <select class="form-control" id="billing_state" name="billing_state">'.$this->GenerateStateOptions().'</select>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <input type="text" class="form-control" id="billing_zip" name="billing_zip" placeholder="Zip Code *">
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
        }

        private function GenerateShippingAddressForm(?string $error = NULL): string
        {
            return '
            <div class="col-lg-12 col-md-12">
                <div class="right-container inner-container">
                    <h3 class="form-title font-weight-medium">Shipping Address</h3>
                    <div id="shipping_errors">'.$this->ErrorString($error).'</div>
                    <div class="row">
                        <div class="col-9">
                            <div class="form-group">
                                <input type="text" class="form-control" id="shipping_address_1" name="shipping_address_1" placeholder="Address *">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <input type="text" class="form-control" id="shipping_address_2" name="shipping_address_2" placeholder="Apt #">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <input type="text" class="form-control" id="shipping_city" name="shipping_city" placeholder="City *">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <select class="form-control" id="shipping_state" name="shipping_state">'.$this->GenerateStateOptions().'</select>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <input type="text" class="form-control" id="shipping_zip" name="shipping_zip" placeholder="Zip Code *">
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
        }

        private function GenerateCreditCardNumberForm(?string $error = NULL): string
        {
            return '
            <div class="col-lg-6 col-md-12">
                <div class="right-container inner-container">
                    <h3 class="form-title font-weight-medium">Credit Card</h3>
                    <div id="stripe_errors">'.$this->ErrorString($error).'</div>
                   
                    <div class="form-group">
                        <div class="form-control" id="card_number"></div>
                    </div>
                    
                    <div class="form-group">
                        <div type="text" class="form-control" id="expiration_date"></div>
                    </div>
                    
                    <div class="form-group">
                        <div type="text" class="form-control" id="cvv"></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12">'.$this->GenerateCheckoutButton().'</div>    
                    </div>
                    
                </div>  
            </div>';
        }

        private function GenerateCheckoutButton(): string
        {
            return '
            <div class="text-center">
                <button type="submit" class="btn btn-orange mx-auto mt-3">
                <span class="text-uppercase font-weight-bold title">Pay Now</span>
                </button>
                <figure class="mt-4 mb-0">
                    <img src="Asset/img/cards.png" alt="Payment Methods">
                </figure>
            </div>';
        }

        private function GenerateStateOptions(): string
        {
            $returnString = '';
            foreach(self::States as $key => $value)
            {
                $returnString .= '<option value="'.$key.'">'.$value.'</option>';
            }
            return $returnString;
        }

        private function ErrorString(?String $errorString = NULL): string
        {
            if(is_null($errorString))
            {
                return "";
            }
            return '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    '.$errorString.'
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
        }
    }
}