<?php
class User extends AppModel 
{
    const USERNAME_MIN_LENGTH = 1;
    const USERNAME_MAX_LENGTH = 30;
    const PASSWORD_MIN_LENGTH = 1;
    const PASSWORD_MAX_LENGTH = 30;

    public $validation = array(
        'username' => array(
            'length' => array('validate_between', self::USERNAME_MIN_LENGTH, self::USERNAME_MAX_LENGTH,),
            'format' => array('letters_only',),
        ),
        'password' => array(
            'length' => array('validate_between', self::PASSWORD_MIN_LENGTH, self::PASSWORD_MAX_LENGTH,),
        ),
    );

    /**
    * Adds new user
    * @param object $user
    */
    public function create() 
    {
        $this->validate();
        if($this->hasError()) {
            throw new ValidationException('Invalid user information');
        }
        
        $db = DB::conn();

        $params = array($this->username,$this->password);
        $db->query("INSERT INTO users (username, password, created, modified) VALUES (?, SHA1(?), NOW(), NOW())", $params);
    }

    /**
    * Checks if user is existing in the system
    * @param str username, str password
    * @return queried row
    */
    public function authenticate() 
    {
        $db = DB::conn();
        $query = "SELECT id, username FROM users WHERE username = ? AND password = SHA1(?)";        
        $user_account = $db->row($query, array($this->username,$this->password));
        if(!$user_account) {
            $this->is_failed_login = true;
            throw new NotFoundException('user not found');
        }

        return $user_account;
    }
}
?>
