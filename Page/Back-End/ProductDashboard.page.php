<?php
/**
 * This is the namespace for all back end page objects.
 */
namespace TheMysteryMarket\Page\BackEnd
{
    /** Include the backend page abstract and namespace. */
    require_once("BackEndPageBase.class.php");

    /**
     * This will the page render class for the ProductDashboard.
     */
    class ProductDashboard extends BackEndPageBase
    {
        /** @var bool $loginRequired
         * This is a flag telling the page event that this page can only be rendered if the
         * user is logged into the admin panel.
         */
        const loginRequired = true;

        /**
         * Basic Constructor.
         */
        public function __construct()
        {
            parent::__construct();
            $this->SetTitle("The Mystery Market: Products")
                ->SetDescription("Administration Products")
                ->SetOgTitle("The Mystery Market: Products")
                ->SetOgURL("https://administration.themysterymarket.com/index.php?page=ProductsDashboard")
                ->SetOgDescription("The Mystery Market: Products")
                ->AddStyleSheet("CSS/Back-End/Dashboard.css")
                ->AddStyleSheet("CSS/Back-End/Table.css")
                ->SetBodyClass("home")
                ->SetBodyHTML($this->GenerateAdministrationPage(
                    "Products",
                    $this->GenerateProducts()
                ));
        }

        private function GenerateProducts(): string
        {
            $tableHeader = '
            <thead>
                <tr><th>Products Table</th></tr>
            </thead>';


            $tableFooter = '
            <tfoot>
                <tr>
                    <td colspan="6" style="text-align: center">
                        <a class="btn btn-lg btn-primary" href="index.php?page=ProductAdd">
                            <i class="fa fa-user fa-fw"></i> Add Product
                        </a>
                    </td>
                </tr>
            </tfoot>';
            return '<table class="acrylic">'.$tableHeader.$tableFooter.'</table>';
        }
    }
}