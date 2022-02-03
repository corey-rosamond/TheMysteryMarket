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
     * This will the page render class for the 404 page.
     */
    class NotFound extends BackEndPageBase
    {
        /**
         * Constructor method for the basic 404 page.
         */
        public function __construct()
        {
            parent::__construct();
            $this->SetTitle("404 Page Not Found")
                ->SetDescription("404 Page Not Found")
                ->SetOgTitle("404 Page Not Found")
                ->SetOgURL("https://administration.themysterymarket.com/index.php?page=NotFound")
                ->SetOgDescription("404 Page Not Found")
                ->AddStyleSheet("CSS/Back-End/404.css")
                ->SetBodyHTML('
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="error-template">
                                <h1>
                                    Oops!</h1>
                                <h2>
                                    404 Not Found</h2>
                                <div class="error-details">
                                    Sorry, an error has occurred, Requested page not found!
                                </div>
                                <div class="error-actions">
                                    <a href="index.php?page=Dashboard" class="btn btn-primary btn-lg">
                                        <span class="glyphicon glyphicon-home"></span>
                                        Take Me Home </a>
                                        <a href="mailto:support@themysterymarket.com" class="btn btn-default btn-lg">
                                            <span class="glyphicon glyphicon-envelope"></span> Contact Support 
                                        </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                ');
        }
    }
}