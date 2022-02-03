<?php
/**
 * This is the base event namespace.
 */
namespace TheMysteryMarket\Event
{

    /** Use the Event Interface namespace. */
    use TheMysteryMarket\Interfaces\Event;
    /** Use the PDO exception namespace. */
    use TheMysteryMarket\Exception\PDODatabaseException;

    require_once("Query/InsertAddress.query.php");
    use TheMysteryMarket\Query\InsertAddress;

    require_once("Query/InsertCustomer.query.php");
    use TheMysteryMarket\Query\InsertCustomer;

    require_once("Query/InsertOrder.query.php");
    use TheMysteryMarket\Query\InsertOrder;

    use TheMysteryMarket\Controller\CartController;

    /**
     * This is the Administration login event. This will handle logging an admin in.
     */
    class CreateOrder implements Event
    {

        public function run()
        {
            $address_query = new InsertAddress();
            $customer_query = new InsertCustomer();
            $order_query = new InsertOrder();
            $order_products_query = new InsertOrderProducts();

            $address_query->Query($_POST['billing_address'],$_POST['billing_address_2'],$_POST['billing_city'],$_POST['billing_state'],$_POST['billing_zip']);
            $billing_address_id = $address_query->LastInsertID();
            $address_query->Query($_POST['shipping_address'],$_POST['shipping_address_2'],$_POST['shipping_city'],$_POST['shipping_state'],$_POST['shipping_zip']);
            $shipping_address_id = $address_query->LastInsertID();
            $customer_query->Query($_POST['first_name'],$_POST['last_name'],$_POST['email'],$_POST['phone']);
            $customer_id = $customer_query->LastInsertID();
            $order_query->Query($customer_id,$billing_address_id,$shipping_address_id);
            $order_id = $order_query->LastInsertID();


            $order_products_query->Query($order_id,CartController::GetCartArray());
        }

        private function EnforceLogin(): void
        {
            if(!array_key_exists('UserData', $_SESSION))
            {
                header('location: https://administration.themysterymarket.com/index.php?page=Login');
            }
        }
    }
}