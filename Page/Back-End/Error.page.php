<?php
/**
 * This is the namespace for all back end page objects.
 */
namespace TheMysteryMarket\Page\BackEnd
{
    /** Include the backend page abstract and namespace. */
    require_once("BackEndPageBase.class.php");
    use TheMysteryMarket\Page\BackEnd\BackEndPageBase;

    /**
     * This will the page render class for the 500 page.
     */
    class Error extends BackEndPageBase
    {
        /**
         * Constructor method for the basic 500 page.
         */
        public function __construct()
        {
            parent::__construct();
            $this->SetTitle("The Mystery Market: 500")
                ->SetDescription("500 Page")
                ->SetOgTitle("The Mystery Market: 500")
                ->SetOgURL("https://administration.themysterymarket.com/500.php")
                ->SetOgDescription("500 Not Found")
                ->SetBodyHTML('500 Not Found');
        }
    }
}