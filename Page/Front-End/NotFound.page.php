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
     * This is the 404 page not found page
     */
    class NotFound extends FrontEndBase
    {
        /**
         * Constructor method for the basic 404 page not found.
         */
        public function __construct()
        {
            parent::__construct();
            $this->SetTitle("The Mystery Market")
                ->SetDescription("404 Page")
                ->SetOgTitle("The Mystery Market")
                ->SetOgURL("https://themysterymarket.com/NotFound.php")
                ->SetOgDescription("404 Page")
                ->SetBodyHTML('404 Page');
        }
    }
}