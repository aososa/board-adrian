<?php
class UserController extends AppController {

    /**
    * User registration action
    */
    public function add() 
    {
        $user = new User;
        $page = Param::get('page_next','add');
        
        switch($page) {
            case 'add':
                break;
            case 'login':
                $user->username = Param::get('username');
                $user->password = Param::get('password');
                $login_from_add = true;
                try {
                    $user->create();
                } catch(ValidationException $e) {
                    $page = 'add';
                }
                break;
        }
        $this->set(get_defined_vars());
        $this->render($page);
    }

    /**
    * Login existing account
    */
    public function login() 
    {
        $user = new User;
        $page = Param::get('page_next','login');

        switch($page) {
            case 'login':
                break;
            case 'home':
                $user->username = Param::get('username');
                $user->password = Param::get('password');
                try {
                    $user_account = $user->authenticate($user->username, $user->password);
                    $_SESSION['id'] = $user_account['id'];
                    $_SESSION['username'] = $user_account['username'];
                } catch(NotFoundException $e) {
                    $login_failed = true;
                    $page = 'login';
                }
        }
        $this->set(get_defined_vars());
        $this->render($page);
    }

    /**
    * Destroy session data for currently logged-in account
    */
    public function logout()
    {
        session_unset();
        session_destroy();
    }

}
?>
