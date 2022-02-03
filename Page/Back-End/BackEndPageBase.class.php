<?php
/**
 * This is the namespace for all back end page objects.
 */
namespace TheMysteryMarket\Page\BackEnd
{
    /** Include the PageBase abstract class and namespace. */
    require_once("Page/Object/PageBase.class.php");
    use TheMysteryMarket\Page\Object\PageBase;

    /**
     * The BackendPageBase object is where we keep page functions specific to the backend system.
     */
    abstract class BackEndPageBase extends PageBase
    {
        /** @var bool loginRequired
         * This is a flag that can be set in an individual page to make sure this page can
         * not be rendered unless logged in.
         */
        const loginRequired = false;

        /**
         * Base constructor setting some default values for all the backend.
         */
        public function __construct()
        {
            /** Check if the page requires them to be logged in. */
            if($this::loginRequired)
            {
                /** Make sure they are logged in if they are not kick them back to login. */
                $this->LoginCheck();
            }
            $this
                ->AddStyleSheet("//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css")
                ->AddStyleSheet("https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css")
                ->AddScript("//code.jquery.com/jquery-1.11.1.min.js")
                ->AddScript("//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js")
                ->AddScript("Javascript/Back-End/Dashboard.js")
                ->SetAuthor('Corey Rosamond & Steve Shurtliff')
                ->SetOgType('website');
        }

        /**
         * Check if the user is Logged in and kick them back to the Login page if they are not.
         */
        private function LoginCheck(): void
        {
            if(!array_key_exists('UserData', $_SESSION))
            {
                header("location: index.php?page=Login");
            }
        }

        /**
         * This method will generate the administration page layout and append
         * the content inside the content display area.
         * @param string $title
         * @param string $content
         * @return string
         */
        protected function GenerateAdministrationPage(string $title, string $content): string
        {
            return '
            <div class="container-fluid display-table">
                <div class="row display-table-row">
                    '.$this->GenerateNavigation().
                    '<div class="col-md-10 col-sm-11 display-table-cell v-align">'.
                        $this->GenerateHeader(
                            $title,
                            $_SESSION['UserData']['first_name'],
                            $_SESSION['UserData']['last_name'],
                            $_SESSION['UserData']['email_address']
                        ).
                        $this->GenerateDisplayArea($content).
                    '</div>
                </div>
            </div>';
        }

        /**
         * @return string
         */
        private function GenerateNavigation(): string
        {
            $navigationElements = [
                ["page" => 'Dashboard',         'icon' => 'fa fa-home',     'text' => 'Dashboard'],
                ["page" => 'OrderDashboard',    'icon' => 'fa fa-truck',    'text' => 'Orders'],
                ["page" => 'CustomerDashboard', 'icon' => 'fa fa-user',     'text' => 'Customers'],
                ["page" => 'ProductDashboard',  'icon' => 'fa fa-cube',     'text' => 'Products'],
                ["page" => 'PromotionDashboard','icon' => 'fa fa-tags',     'text' => 'Promotions'],
                ["page" => 'UserDashboard',     'icon' => 'fa fa-group',    'text' => 'Users'],
                ["page" => 'SettingDashboard',  'icon' => 'fa fa-cogs',     'text' => "Settings"]
            ];
            $returnString = '<div class="col-md-2 col-sm-1 hidden-xs display-table-cell v-align box" id="navigation">';
            $returnString .= '
            <div class="logo">
                <a href="index.php?page=Dashboard">
                    <img src="Image/Back-End/logo-temp.png" style="width:100px;" alt="merkery_logo" class="hidden-xs hidden-sm">
                </a>
            </div>';
            $returnString .= '<div class="navi"><ul>';
            foreach($navigationElements as $element)
            {
                $returnString .= '<li';
                if($element['page'] == $_GET['page'])
                {
                    $returnString .= ' class="active"';
                }
                $returnString .= '><a href="index.php?page='.$element['page'].'">';
                $returnString .= '<i class="'.$element['icon'].'" aria-hidden="true"></i>';
                $returnString .= '<span class="hidden-xs hidden-sm">'.$element['text'].'</span>';
                $returnString .= '</a></li>';
            }
            $returnString .= '</ul></div>';
            return $returnString.'</div>';
        }

        /**
         * Generate the administration header.
         * @param string $title
         * @param string $firstName
         * @param string $lastName
         * @param string $emailAddress
         * @param int $totalNotifications
         * @return string
         */
        private function GenerateHeader(string $title, string $firstName, string $lastName, string $emailAddress, int $totalNotifications = 10): string
        {
            $returnString = '
                <div class="row">
                    <header>';
            $returnString .= '
                        <div class="col-md-7">
                            <h3>'.$title.'</h3>
                        </div>
                        <div class="col-md-5">
                            <div class="header-rightside">
                                <ul class="list-inline header-top pull-right">';
            /**
                                    <li>
                                        <a href="#" class="icon-info">
                                            <i class="fa fa-bell" aria-hidden="true"></i>';
            if($totalNotifications >= 1)
            {
                $returnString .= '<span class="label label-danger">'.$totalNotifications.'</span>';
            }
            $returnString .= '
                                    </a>
                                </li>';
            */
            $returnString .= '
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="Image/Back-End/user-photo.png" alt="user">
                                        <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <div class="navbar-content">
                                                <span>'.$firstName.' '.$lastName.'</span>
                                                <p class="text-muted small">
                                                    '.$emailAddress.'
                                                </p>
                                                <div class="divider"></div>
                                                <a href="index.php?event=AdministrationLogout" class="view btn-sm active">Sign Out</a>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>';
                $returnString .= '</header>;
            </div>';
            return $returnString;
        }

        /**
         * Generate the administration display area.
         * @param string $content
         * @return string
         */
        private function GenerateDisplayArea(string $content): string
        {
            return '
            <div class="user-dashboard">
                <div class="row">
                    '.$content.'
                </div>
            </div>
            ';
        }
    }
}