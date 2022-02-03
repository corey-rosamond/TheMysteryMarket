<?php
/**
 * This is the namespace for all back end page objects.
 */
namespace TheMysteryMarket\Page\BackEnd
{
    /** Include the backend page abstract and namespace. */
    require_once("BackEndPageBase.class.php");
    /** Include the AdminGetUsers query object and use the namespace. */
    require_once("Query/AdminGetUsers.query.php");
    use TheMysteryMarket\Query\AdminGetUsers;
    /** Bring the PDO Exception into the namespace */
    use TheMysteryMarket\Exception\PDODatabaseException;

    /**
     * This will the page render class for the User.
     */
    class UserDashboard extends BackEndPageBase
    {
        /** @var bool $loginRequired
         * This is a flag telling the page event that this page can only be rendered if the
         * user is logged into the admin panel.
         */
        const loginRequired = true;

        /**
         * Basic Constructor
         * @throws PDODatabaseException
         */
        public function __construct()
        {
            parent::__construct();
            $this->SetTitle("The Mystery Market: Users")
                ->SetDescription("Administration Users")
                ->SetOgTitle("The Mystery Market: Users")
                ->SetOgURL("https://administration.themysterymarket.com/index.php?page=UserDashboard")
                ->SetOgDescription("The Mystery Market: Users")
                ->AddStyleSheet("CSS/Back-End/Dashboard.css")
                ->AddStyleSheet("CSS/Back-End/Table.css")
                ->SetBodyClass("home")
                ->SetBodyHTML($this->GenerateAdministrationPage(
                    "Users",
                    $this->GenerateUserTable()
                ));
        }

        /**
         * @throws PDODatabaseException
         */
        private function GenerateUserTable(): string
        {
            $tableHeader = '
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email Address</th>
                    <th style="text-align: center; width: 25px;">Edit</th>
                    <th style="text-align: center; width: 25px;">Delete</th>
                </tr>
            </thead>';
            $tableContent = "";
            $users = (new AdminGetUsers())->Query();
            foreach($users as $user)
            {
                $tableContent .= '
                <tr>
                    <td>'.$user['id'].'</td>
                    <td>'.$user['first_name'].'</td>
                    <td>'.$user['last_name'].'</td>
                    <td>'.$user['email_address'].'</td>
                    <td style="text-align: center">
                        <a class="btn btn-default btn-sm" href="#">
                            <i class="fa fa-cog" aria-hidden="true"></i>
                        </a>
                    </td>
                    <td style="text-align: center">
                        <a class="btn btn-danger" href="#">
                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                        </a>
                    </td>
                </tr>';
            }

            $tableFooter = '
            <tfoot>
                <tr>
                    <td colspan="6" style="text-align: center">
                        <a class="btn btn-lg btn-primary" href="index.php?page=UserAdd">
                            <i class="fa fa-user fa-fw"></i> Add User
                        </a>
                    </td>
                </tr>
            </tfoot>
            ';


            return '<table class="acrylic">'.$tableHeader.'<tbody>'.$tableContent.'</tbody>'.$tableFooter.'</table>';
        }
    }
}