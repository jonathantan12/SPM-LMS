<?php
  class user{
    private $userID;
    private $username;
    private $userRole;
    private $loginID;
    private $loginPwd;


    // constructor
    public function __construct($userID, $username, $userRole, $loginID, $loginPwd) {
        $this->userID = $userID;
        $this->username = $username;
        $this->$userRole = $userRole;
        $this->$loginID = $loginID;
        $this->$loginPwd = $loginPwd;

    }

    public function getUserID() {
        return $this->userID;
    }

    public function getUsername() {
      return $this->username;
    }

    public function getUserRole() {
      return $this->userRole;
    }

    public function getLoginID() {
      return $this->loginID;
    }

    public function getLoginPwd() {
      return $this->loginPwd;
    }

}
?>