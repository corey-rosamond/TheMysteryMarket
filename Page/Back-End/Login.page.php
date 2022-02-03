<?php
/**
 * This is the namespace for all back end page objects.
 */
namespace TheMysteryMarket\Page\BackEnd
{
    /** Include the backend page abstract and namespace. */
    require_once("BackEndPageBase.class.php");

    /**
     * This will the page render class for the Login page.
     * @todo cleanup the login page and add clearer error indicators.
     */
    class Login extends BackEndPageBase
    {
        /**
         * Constructor method for the basic login page.
         */
        public function __construct(array $data = [])
        {
            parent::__construct();
            $this->SetTitle("The Mystery Market: Login")
                ->SetDescription("This is login page for the mystery market administration panel")
                ->SetOgTitle("The Mystery Market: Login")
                ->SetOgURL("https://administration.themysterymarket.com/index.php?page=Login")
                ->SetOgDescription("This is login page for the mystery market administration panel")
                ->AddStyleSheet("CSS/Back-End/Login.css")
                ->SetBodyHTML($this->GeneratePage($data));
        }

        /**
         * This method generates the login page.
         * @param array $data
         * @return string
         */
        private function GeneratePage(array $data): string
        {
            $returnText = '<div class="container-fluid" style="padding: 0 0 0 0;">';

            if(array_key_exists('errors', $data))
            {
                $errorText = "";
                foreach($data['errors'] as $error)
                {
                    $errorText .= $error."<br/>";
                }
                $returnText .= '
                <div class="col-md-12">
                    <div class="modal-dialog" style="margin-bottom:0">
                        <div class="modal-content">
                            <div class="panel-heading">
                                <h3 class="panel-title">Errors</h3>
                            </div>
                            <div class="panel-body">
                                '.$errorText.'
                            </div>
                        </div>   
                    </div>
                </div>
                ';
            }
            $returnText .= '
            <div class="login-area">
                <div class="bg-image">
                    <div class="login-signup">
                        <div class="container">
                            <div class="login-header">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="login-logo">
                                            <img src="Image/Back-End/logo-temp.png" alt="The Mystery Market Logo" class="img-responsive">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="login-details">
                                            <ul class="nav nav-tabs navbar-right">
                                                <li class="active"><a data-toggle="tab" href="#login">Login</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
        
                            <div class="tab-content">
                                <div id="login" class="tab-pane fade in active">
                                    <div class="login-inner">
                                        <div class="title">
                                            <h1>Welcome <span>back!</span></h1>
                                        </div>
                                        <div class="login-form">
                                            <form role="form" method="post" action="index.php?event=AdministrationLogin">
                                                <div class="form-details">
                                                    <label class="user">
                                                        <input type="text" name="email" placeholder="email" id="email">
                                                        <i class="fa fa-user fa-lg"></i>
                                                    </label>
                                                    <br />
                                                    <br />
                                                    <label class="pass">
                                                        <input type="password" name="password" placeholder="Password" id="password">
                                                        <i class="fa fa-key fa-lg"></i>
                                                    </label>
                                                </div>
                                                <button type="submit" class="form-btn" >Login</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
            return $returnText;
        }
    }
}