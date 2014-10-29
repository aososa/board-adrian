<?php
class AppController extends Controller
{
    const LOGIN_PAGE = '/user/login';

    public $default_view_class = 'AppLayoutView';

    public function beforeFilter() {
        $allowed_actions = array('user');
        if(!in_array($this->name, $allowed_actions) && !is_logged_in()) {
            redirect($url = self::LOGIN_PAGE);
        }
    }
}
