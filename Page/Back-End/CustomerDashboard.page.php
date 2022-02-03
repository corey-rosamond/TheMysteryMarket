<?php
/**
 * This is the namespace for all back end page objects.
 */
namespace TheMysteryMarket\Page\BackEnd
{
    /** Include the backend page abstract and namespace. */
    require_once("BackEndPageBase.class.php");

    /**
     * This will the page render class for the CustomerDashboard.
     */
    class CustomerDashboard extends BackEndPageBase
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
            $this->SetTitle("The Mystery Market: Customers")
                ->SetDescription("Administration Customers")
                ->SetOgTitle("The Mystery Market: Customers")
                ->SetOgURL("https://administration.themysterymarket.com/index.php?page=CustomerDashboard")
                ->SetOgDescription("The Mystery Market: Customers")
                ->AddStyleSheet("CSS/Back-End/Dashboard.css")
                ->AddStyleSheet("CSS/Back-End/Table.css")
                ->SetBodyClass("home")
                ->SetBodyHTML($this->GenerateAdministrationPage(
                    "Customers",
                    "Coming Soon"
                ));
        }
    }
}