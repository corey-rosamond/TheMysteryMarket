<?php
/**
 * This is the namespace for all back end page objects.
 */
namespace TheMysteryMarket\Page\BackEnd
{
    /** Include the backend page abstract and namespace. */
    require_once("BackEndPageBase.class.php");

    /**
     * This will the page render class for the Dashboard page.
     */
    class Dashboard extends BackEndPageBase
    {
        /** @var bool $loginRequired
         * This is a flag telling the page event that this page can only be rendered if the
         * user is logged into the admin panel.
         */
        const loginRequired = true;
        /**
         * Constructor method for the basic Order page.
         */
        public function __construct()
        {
            parent::__construct();
            $this->SetTitle("The Mystery Market: Dashboard")
                ->SetDescription("Administration Dashboard")
                ->SetOgTitle("The Mystery Market: Dashboard")
                ->SetOgURL("https://administration.themysterymarket.com/index.php?page=Dashboard")
                ->SetOgDescription("The Mystery Market: Dashboard")
                ->AddStyleSheet("CSS/Back-End/Dashboard.css")
                ->SetBodyClass("home")
                ->SetBodyHTML($this->GenerateAdministrationPage("Dashboard", "<h1>Dashboard</h1>"));
        }
    }
}