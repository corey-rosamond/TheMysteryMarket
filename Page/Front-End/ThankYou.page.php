<?php
/**
 * This is the namespace for all front end page objects.
 */
namespace TheMysteryMarket\Page\FrontEnd
{
    /** Include the front end base class ane namespace. */
    require_once("Page/Front-End/FrontEndBase.class.php");

    require_once("Query/OrderGet.query.php");
    require_once("Query/CustomerGet.query.php");
    require_once("Query/AddressGet.query.php");
    require_once("Query/OrderProductsGet.query.php");
    use TheMysteryMarket\Query\{OrderGet, CustomerGet, AddressGet, OrderProductsGet};

    /**
     * This is the fourth page in the funnel. This is where we thank the customer for their order and give any useful
     * details or incentives to come back.
     */
    class ThankYou extends FrontEndBase
    {
        private $firstName = "John";
        private $middleName;
        private $lastName = "Doe";

        /**
         * Constructor method for the basic ThankYou page.
         */
        public function __construct()
        {
            parent::__construct();
            $this->SetTitle("The Mystery Market")
                ->SetDescription("Thank You Page")
                ->SetOgTitle("The Mystery Market")
                ->SetOgURL("https://themysterymarket.com/checkout.php")
                ->SetOgDescription("Thank You Page")
                ->SetBodyHTML($this->GenerateHeader().'<main>'.$this->GenerateThankYouPage().'</main>'.$this->GenerateFooter());
        }

        private function GenerateThankYouPage(): string
        {
            $returnString = '';
            if(!array_key_exists('order_id', $_GET))
            {
                return 'Order Id is missing';
            }
            $order = (new OrderGet())->Query($_GET['order_id']);
            if(!$order)
            {
                return "Order does not exist";
            }
            $customer = (new CustomerGet())->Query($order['customer_id']);
            if(!$customer)
            {
                return "Customer does not exist!";
            }
            $billingAddress = (new AddressGet())->Query($customer['id'], $order['billing_address']);
            if(!$billingAddress)
            {
                return "Billing address does not exist!";
            }
            $shippingAddress = (new AddressGet())->Query($customer['id'], $order['shipping_address']);
            if(!$shippingAddress)
            {
                return "Shipping address does not exist!";
            }
            $orderProducts = (new OrderProductsGet())->Query($order['id']);
            if(!$orderProducts)
            {
                return "Order products does not exist!";
            }
            $returnString .= $this->GenerateHeroBanner();
            $returnString .= '
            <section class="thank-you-content-section section-spacer mx-auto">
				<div class="container">
					<div class="row">
						<div class="col">
							<div class="order-details mb-4">
								<h2 class="bg-blue text-white text-center mb-0">List of Purchased Products</h2>
								<div class="products">
									<table class="table table-borderless">
										<thead>
											<tr>
											    <th style="width: 30px;">Quantity</th>
												<th class="font-weight-semibold">Product</th>
												<th style="width: 50px;">Price</th>
											</tr>
										</thead>
										<tbody>';
            foreach($orderProducts as $product)
            {
                $returnString .= '
                <tr style="border-bottom: 1px solid #cccccc;">
                    <td style="text-align: center;">'.$product['quantity'].'</td>
                    <td>'.$product['name'].'</td>
                    <td>$'.number_format($product['price'], 2, '.', ',').'</td>
               </tr>';
            }
            $returnString .= '
                                            <tr style="border-bottom: 1px solid #cccccc;">
                                                <td colspan="2" style="text-align:right; font-weight: bold;">Tax:</td>
                                                <td style="text-align: right;">$'.number_format($order['tax_total'], 2, '.', ',').'</td>
                                            </tr>
                                            <tr style="border-bottom: 1px solid #cccccc;">
                                                <td colspan="2" style="text-align:right; font-weight: bold;">Shipping:</td>
                                                <td style="text-align: right;">$'.number_format($order['shipping_total'], 2, '.', ',').'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="text-align:right; font-weight: bold;">Total:</td>
                                                <td style="text-align: right;">$'.number_format(($order['product_total']+$order['tax_total']+$order['shipping_total']), 2, '.', ',').'</td>
                                            </tr>
                                        </tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<p>
                                Your order was completed successfully. Your mystery box is on the way.<br />
                                An email receipt including the details about your order has been sent to the email<br /> address you provided. 
                                Please keep it for your record. <br /><br />
                                Have Questions? Contact us at support@themysterymarket.com and we will get back to you shortly.
                            </p>
						
							<h5 class="font-weight-bold mb-0">Thank You!</h5>
							<h5 class="font-weight-bold">- '.$customer['first_name'].' '.$customer['last_name'].'</h5>
						</div>
					</div>
				</div>
			</section>';
            return $returnString;
        }

        private function GenerateHeroBanner(): string
        {
            $returnString = '
            <section class="banner-section thank-you-banner section-spacer">
				<div class="container">
					<div class="row">
						<div class="col">
							<div class="section-title mb-0">
								<h2 class="font-weight-bold"><span class="text-blue">&nbsp;</span>&nbsp;</h2>
								<h5 class="font-weight-medium line-height-1-2 mb-0 mx-auto">&nbsp;</h5>
							</div>
						</div>
					</div>
				</div>
			</section>';
			return $returnString;
        }
    }
}