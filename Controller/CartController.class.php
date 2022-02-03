<?php


namespace TheMysteryMarket\Controller
{

    require_once("Query/ProductGetPrimary.query.php");

    use TheMysteryMarket\Exception\NoticeException;
    use TheMysteryMarket\Query\ProductGetPrimary;

    require_once("Query/ProductGet.query.php");
    use TheMysteryMarket\Query\ProductGet;

    class CartController
    {
        private const CartPrefix = 'ShoppingCart';


        public function AddPrimaryProductToCart()
        {
            /** Get the primary product details.  */
            $productDetails = (new ProductGetPrimary())->Query();
            $this->Add($productDetails);
        }

        public function AddToCart(int $productId)
        {
            $productData = (new ProductGet())->Query($productId);
            $this->Add($productData);
        }

        private function Add(array $productData)
        {
            /**
             * Make sure to create the shopping cart array in session if it does not already exist,
             * this is to avoid undefined index exceptions.
             */
            if(!array_key_exists(self::CartPrefix, $_SESSION))
            {
                $_SESSION[self::CartPrefix] = [];
            }

            if(!$this->ExistsInCart($productData['id']))
            {
                $productData['quantity'] = 1;
                array_push($_SESSION[self::CartPrefix], $productData);
            }
        }

        private function ExistsInCart(int $id): bool
        {
            foreach($_SESSION[self::CartPrefix] as $cartItem)
            {
                if($cartItem['id'] == $id)
                {
                    return true;
                }
            }
            return false;
        }

        private function AddQuantity(int $productId, int $quantityToAdd = 1)
        {
            $index = $this->GetProductIndex($productId);
            if(!is_null($index))
            {
                $_SESSION[self::CartPrefix][$index]['quantity'] += $quantityToAdd;
                return true;
            }
            return false;
        }

        private function GetProductIndex(int $productId): ?int
        {
            foreach($_SESSION[self::CartPrefix] as $key => $cartItem)
            {
                if($cartItem['id'] == $productId)
                {
                    return $key;
                }
            }
            return NULL;
        }

        public static function GetCartArray(): array
        {
            return $_SESSION[self::CartPrefix];
        }

        public static function CartExists(): bool
        {
            if(!array_key_exists(self::CartPrefix, $_SESSION))
            {
                return false;
            }
            return true;
        }

        public static function CartTotal(): float
        {
            $cartTotal = 0.00;
            try{
                foreach ($_SESSION[self::CartPrefix] as $cartItem) {
                    $cartTotal += (float)$cartItem['price'];
                }
            }
            catch (NoticeException $exception){
                header("location: index.php?page=Lander");
            }
            return $cartTotal;
        }

        public static function CartShippingTotal(): float
        {
            $cartShippingTotal = 0.00;
            try {
                foreach ($_SESSION[self::CartPrefix] as $cartItem) {
                    if ((float)$cartItem['shipping_price'] > $cartShippingTotal) {
                        $cartShippingTotal = $cartItem['shipping_price'];
                    }
                }
            }
            catch (NoticeException $exception)
            {
                header("location: index.php?page=Lander");
            }
            return $cartShippingTotal;
        }

        public static function CartTaxTotal(string $state): float
        {
            return 0.00;
        }
    }
}