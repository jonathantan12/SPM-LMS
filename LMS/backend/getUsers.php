<?php
    require_once('common.php');

    // Use this to pass in the user_role variable into the class function currently it is hard coded.
    // $user_role = $_GET["user_role"];
    $user_role = 'trainer';
    $dao = new usersDAO();
    $users = $dao->getUsers($user_role);

    $items = [];
    foreach ( $users as $aUser ) {
        $item["user_id"] = $aUser->getUserId();
        $item["user_name"] = $aUser->getUserName();
        $item["user_role"] = $aUser->getUserRole();
        $item["login_id"] = $aUser->getLoginId();
        $item["login_password"] = $aUser->getLoginPassword();
        $items[] = $item;
    }

    // make posts into json and return json data
    $postJSON = json_encode($items);
    echo $postJSON;
?>