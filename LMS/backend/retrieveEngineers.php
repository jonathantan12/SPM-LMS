<?php
    require_once('common.php');
    $userRole = $_GET['userRole'];
    $userDAO = new UserProfileDAO;
    $result = $userProfileDAO->getAllByRole($userRole);
    
    echo $result;
?>