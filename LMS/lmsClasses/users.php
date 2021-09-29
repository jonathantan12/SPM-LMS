<?php
  class users{
    private $user_id;
    private $user_name;  
    private $user_role;
    private $login_id;
    private $login_password;

    public function __construct($user_id, $user_name, $user_role, $login_id, $login_password) {
        $this->user_id = $user_id;
        $this->user_name = $user_name;
        $this->user_role = $user_role;
        $this->login_id = $login_id;
        $this->login_password = $login_password;
    }

    public function getUserId() {
      return $this->user_id;
    }

    public function getUserName() {
      return $this->user_name;
    }

    public function getUserRole() {
      return $this->user_role;
    }

    public function getLoginId() {
        return $this->login_id;
    }

    public function getLoginPassword() {
        return $this->login_password;
    }

}
?>