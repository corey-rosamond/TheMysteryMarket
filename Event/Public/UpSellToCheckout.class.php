<?php

namespace TheMysteryMarket\Event
{


    use TheMysteryMarket\Interfaces\Event;

    require_once("Controller/CartController.class.php");
    use TheMysteryMarket\Controller\CartController;


    class UpSellToCheckout implements Event
    {

        public function run()
        {
            $cartController = new CartController();

            foreach($_POST as $key=>$value)
            {
                $cartController->AddToCart((int)$key);
            }

            header("location: index.php?page=Checkout");


        }

    }
}