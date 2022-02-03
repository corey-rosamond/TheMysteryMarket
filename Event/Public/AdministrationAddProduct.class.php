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

    require_once("Query/ProductCreate.query.php");
    use TheMysteryMarket\Query\ProductCreate;

    require_once("Query/ProductSetThumbnail.query.php");
    use TheMysteryMarket\Query\ProductSetThumbnail;

    /**
     * This is the Administration login event. This will handle logging an admin in.
     */
    class AdministrationAddProduct implements Event
    {

        public function run()
        {
            $this->EnforceLogin();


            $insertID = (new ProductCreate())->Query(
                $_POST['name'],
                $_POST['title'],
                $_POST['description'],
                $_POST['price'],
                $_POST['shipping_price'],
                $_POST['active'],
                $_POST['primary']
            );

            $thumbnailPath = "Product-Images/".sprintf("%04d", $insertID).'.'.pathinfo("")['extension'] ;

            (new ProductSetThumbnail())->Query($insertID, $thumbnailPath);
            header('location: https://administration.themysterymarket.com/index.php?page=ProductDashboard');

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