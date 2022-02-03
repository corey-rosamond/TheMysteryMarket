<?php
/**
 * This is the namespace for all back end page objects.
 */
namespace TheMysteryMarket\Page\BackEnd
{
    /** Include the backend page abstract and namespace. */
    require_once("BackEndPageBase.class.php");

    /**
     * This will the page render class for the AddUser.
     */
    class UserAdd extends BackEndPageBase
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
            $this->SetTitle("The Mystery Market: Add User")
                ->SetDescription("Administration Add User")
                ->SetOgTitle("The Mystery Market: Add User")
                ->SetOgURL("https://administration.themysterymarket.com/index.php?page=UserAdd")
                ->SetOgDescription("The Mystery Market: Add User")
                ->AddStyleSheet("CSS/Back-End/Dashboard.css")
                ->AddStyleSheet("CSS/Back-End/Form.css")
                ->SetBodyClass("home")
                ->SetBodyHTML($this->GenerateAdministrationPage(
                    "Users: Add",
                    $this->GenerateForm()
                ));
        }

        private function GenerateForm(): string
        {
            return '
            <div class="form-container">
                <form method="post" action="">
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom01">First name</label>
                            <input name="first_name" type="text" class="form-control" placeholder="First name">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom02">Last name</label>
                            <input name="last_name" type="text" class="form-control" placeholder="Last name">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationCustomUsername">Email Address</label>
                            <div class="input-group margin-bottom-sm">
                                <span class="input-group-addon">
                                    <i class="fa fa-envelope-o fa-fw" aria-hidden="true"></i>
                                </span>
                                <input name="email_address" class="form-control" type="text" placeholder="email@address.com">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 mb-6">
                            <label for="validationCustomUsername">Password</label>
                            <div class="input-group margin-bottom-sm">
                                <span class="input-group-addon">
                                    <i class="fa fa-key fa-fw" aria-hidden="true"></i>
                                </span>
                                <input name="password" class="form-control" type="password">
                            </div>
                        </div>
                        <div class="col-md-6 mb-6">
                            <label for="verification_password">Verify Password</label>
                            <div class="input-group margin-bottom-sm">
                                <span class="input-group-addon">
                                    <i class="fa fa-key fa-fw" aria-hidden="true"></i>
                                </span>
                                <input name="verification_password" class="form-control" type="password">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-12">
                            <button class="btn btn-primary admin-submit" type="submit">Create User</button>
                        </div>
                    </div>
                </form>
                <div style="clear:both;"></div>
            </div>';
        }
    }
}