<?php

namespace TheMysteryMarket\Event
{


    use TheMysteryMarket\Interfaces\Event;

    require_once("Controller/CartController.class.php");
    use TheMysteryMarket\Controller\CartController;

    require_once("Query/UpsellsExist.query.php");
    use TheMysteryMarket\Query\UpsellsExist;

    require_once("Factory/EventFactory.class.php");
    use TheMysteryMarket\Factory\EventFactory;

    class LanderToUpsell implements Event
    {

        public function run(): bool
        {

            $cartController = new CartController();
            $cartController->AddPrimaryProductToCart();
            /**
             * Check if we have upsells
             * Yes: Go to the upsell page
             * No: Go to the checkout page
             */
            if((new UpsellsExist())->Query())
            {
                return $this->SendToUpsellPage();
            }
            return $this->SendToCheckoutPage();
        }

        private function SendToUpsellPage(): bool
        {
            header("location: index.php?page=UpSell");
            return true;
        }

        private function SendToCheckoutPage(): bool
        {
            header("location: index.php?page=Checkout");
            return true;
        }
    }
}