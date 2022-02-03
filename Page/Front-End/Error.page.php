<?php
/**
 * This is the namespace for all front end page objects.
 */
namespace TheMysteryMarket\Page\FrontEnd
{
    /** Include the front end base class ane namespace. */
    require_once("Page/Front-End/FrontEndBase.class.php");
    use TheMysteryMarket\Page\FrontEnd\FrontEndBase;

    /**
     * This is the 500 error page
     */
    class Error extends FrontEndBase
    {
        /**
         * Constructor method for the basic Error page.
         */
        public function __construct()
        {
            parent::__construct();
            $this->SetTitle("The Mystery Market")
                ->SetDescription("Error Page")
                ->SetOgTitle("The Mystery Market")
                ->SetOgURL("https://themysterymarket.com/error.php")
                ->SetOgDescription("Error Page")
                ->SetBodyHTML('Error Page');
        }
    }
}