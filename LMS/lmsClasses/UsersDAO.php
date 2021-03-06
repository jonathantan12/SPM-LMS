<?php
require_once 'autoload.php';

class usersDAO {
    public function getUsers($user_role) {
        $connMgr = new ConnectionManager();
        $pdo = $connMgr->getConnection();

        $sql = 'SELECT * FROM users WHERE user_role = :user_role';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':user_role', $user_role, PDO::PARAM_STR);
        $stmt->execute();
        $result = [];
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        while($row = $stmt->fetch()) {
            $result[] = new users($row['user_id'], $row['user_name'], $row['user_role'], $row['login_id'], $row['login_password']);
        }
        $stmt = null;
        $pdo = null;

        return $result;
    }

}

// $dao = new usersDAO();
// $users = $dao->getUsers();

// $items = [];
// foreach ( $users as $aUser ) {
//     $item["user_id"] = $aUser->getUserId();
//     $item["user_name"] = $aUser->getUserName();
//     $item["user_role"] = $aUser->getUserRole();
//     $item["login_id"] = $aUser->getLoginId();
//     $item["login_password"] = $aUser->getLoginPassword();
//     $items[] = $item;
// }

// // make posts into json and return json data
// $postJSON = json_encode($items);
// echo $postJSON;

?>