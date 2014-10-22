<?php
class User extends AppModel {
        public $validation = array(
           'username' => array(
	      'length' => array('validate_between', 1, 30,),
	      'format' => array('letters_only',),
           ),
           'password' => array(
	      'length' => array('validate_between', 1, 30,),
           ),
        );

	public function create() {
		$this->validate();
		if($this->hasError()) {
		   throw new ValidationException("Invalid user information.");
		}
		
		$db = DB::conn();

		$params = array($this->username,$this->password);
		$db->query("INSERT INTO users (username, password, created, modified) VALUES (?, SHA1(?), NOW(), NOW())", $params);
	}

	public function authenticate($username, $password) {
		$db = DB::conn();
		$query = "SELECT id, username FROM users WHERE username = ? AND password = SHA1(?)";		

		$user_account = $db->row($query, array($username,$password));
		if(!$user_account) {
		   $this->is_failed_login = true;
		   throw new UserNotFoundException('user not found');
		}

		return $user_account;
	}


}
?>
