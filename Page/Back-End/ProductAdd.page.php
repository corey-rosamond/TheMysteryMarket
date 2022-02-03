<?php
/**
 * This is the namespace for all back end page objects.
 */
namespace TheMysteryMarket\Page\BackEnd
{
    /** Include the backend page abstract and namespace. */
    require_once("BackEndPageBase.class.php");

    /**
     * This will the page render class for the AddProduct.
     */
    class ProductAdd extends BackEndPageBase
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
            $this->SetTitle("The Mystery Market: Add Product")
                ->SetDescription("Administration Add Product")
                ->SetOgTitle("The Mystery Market: Add Product")
                ->SetOgURL("https://administration.themysterymarket.com/index.php?page=ProductAdd")
                ->SetOgDescription("The Mystery Market: Add Product")
                ->AddStyleSheet("CSS/Back-End/Dashboard.css")
                ->AddStyleSheet("CSS/Back-End/Form.css")
                ->SetBodyClass("home")
                ->SetBodyHTML($this->GenerateAdministrationPage(
                    "Product: Add",
                    $this->GenerateForm()
                ));
        }

        private function GenerateForm(): string
        {
            return '
            <div class="form-container">
                <form method="post" action="">
                
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="name">Name</label>
                            <input name="name" type="text" class="form-control" placeholder="Free Shipping Mystery Box">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="title">Title</label>
                            <input name="title" type="text" class="form-control" placeholder="Mystery Box">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="title">Title</label>
                            <input name="title" type="text" class="form-control" placeholder="Mystery Box">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="col-md-12 mb-12">
                            <button class="btn btn-primary admin-submit" type="submit">Create Product</button>
                        </div>
                    </div>
                    
                </form>
                <div style="clear:both;"></div>
            </div>';
        }
    }
}