<?php
/**
 * This is the namespace for all front end page objects.
 */
namespace TheMysteryMarket\Page\FrontEnd
{
    /** Include the front end base class ane namespace. */
    require_once("Page/Front-End/FrontEndBase.class.php");

    require_once("Query/ProductGetUpsells.query.php");
    use TheMysteryMarket\Query\ProductGetUpsells;


    /**
     * This is the second page the funnel here we try to get a customer that has already purchased
     * to buy more.
     */
    class UpSell extends FrontEndBase
    {
        /**
         * Constructor method for the basic Upsell page.
         */
        public function __construct()
        {
            parent::__construct();
            $this->SetTitle("The Mystery Market")
                ->SetDescription("Upsell Page")
                ->SetOgTitle("The Mystery Market")
                ->SetOgURL("https://themysterymarket.com/index.php?page=UpSell")
                ->SetOgDescription("Upsell Page")
                ->AddStyleSheet("CSS/Front-End/Funnel.css")
                ->AddStyleSheet("CSS/Front-End/Upsell.css")
                ->AddScript("Javascript/Front-End/Upsell.js", true)
                ->SetBodyHTML(
                    $this->GenerateHeader().
                    '<main>'.
                        $this->GenerateUpsellPage().
                    '</main>'.
                    $this->GenerateFooter()
                );
        }

        private function GenerateUpsellPage(): string
        {
            $returnString = '
            <section class="order-form-section section-spacer" id="upsell-form">
				<div class="container">
					<div class="row">
						<div class="col">
							<div class="section-title">
								<h2 class="font-weight-bold">Limited Time Offers</h2>
								All limited time offers are in addition to your Mystery box
							</div>
						</div>
					</div>
					<form method="post" action="index.php?event=UpSellToCheckout">';
            $upsellProducts = (new ProductGetUpsells())->Query();
            $first = true;
            foreach($upsellProducts as $upsellProduct)
            {
                $returnString .= '<div class="row">';
                    $returnString .= '<div class="col inner-container upsell-item">';
                        $returnString .= '<div class="row">';
                            $returnString .= '<div class="col-2 image-container">';
                                $returnString .= '<input type="checkbox" name="'.$upsellProduct['id'].'" id="'.$upsellProduct['id'].'"'.($first?' checked=checked':'').' />';
                                $returnString .= '<img src="Image/Product/'.$upsellProduct['thumbnail'].'" />';
                                $first= false;
                            $returnString .= '</div>';
                            $returnString .= '<div class="col-10 description-container">';
                                $returnString .=
                                    '<span class="price-one">Was: $'.number_format($upsellProduct['price']*1.5, 2, '.', ',').'</span>'.
                                    '<span class="price-two">Price: $'.number_format($upsellProduct['price'], 2, '.',',').'</span>'.
                                    '<span class="title">'.$upsellProduct['title'].'</span><br />'.
                                    '<span class="description">'.$upsellProduct['description'].'</span>';

                            $returnString .= '</div>';
                        $returnString .= "</div>";
                    $returnString .= '</div>';
                $returnString .= '</div>';
                $returnString .= '<div>&nbsp;</div>';
            }
            $returnString .= '<div>&nbsp;</div>';
            $returnString .= '<div class="row"><div class="col"><center>';
            $returnString .= $this->CallToActionButton(
                '<strong>Claim Your Savings Now</strong>',
                'Sign me up!'
            );
            $returnString .= '</center></div></div>';
            return $returnString.'</form></div></section>';
        }

        private function CallToActionButton(string $lineOne ='Get your mystery box today!', string $lineTwo = 'While supplies last'): string
        {
            return '
            <button type="submit" class="callToAction btn btn-lg btn"> 
                <i class="fa fa-cart-plus fa-3x pull-left"></i>
                '.$lineOne.'<br />'.$lineTwo.'
            </button>';
        }
    }
}