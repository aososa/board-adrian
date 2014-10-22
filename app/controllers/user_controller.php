<?php
class UserController extends AppController {
    public function add() {
        $user = new User;
        $page = Param::get('page_next','add');
        
        switch($page) {
            case 'add':
                break;
            case 'add_end':
                $user->username = Param::get('username');
                $user->password = Param::get('password');
                echo "User added";
                try {
                    $user->create();
                } catch(ValidationException $e) {
                    $page = 'add';
                }
                break;
        }
        $this->set(get_defined_vars());
        $this->render('add');
    }

    public function login() {
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
                 } catch(UserNotFoundException $e) {
                     echo "Login failed";
                     $page = 'login';
                 }
        }
        $this->set(get_defined_vars());
        $this->render($page);
    }

    public function logout()
    {
        session_unset();
        session_destroy();
    }

}
?>
