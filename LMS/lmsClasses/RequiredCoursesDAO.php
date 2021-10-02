<?php
require_once 'autoload.php';

class requiredCoursesDAO {
    public function getRequiredCourses($user_id) {
        $connMgr = new ConnectionManager();
        $pdo = $connMgr->getConnection();

        $sql = 'SELECT * FROM required_courses WHERE user_id = :user_id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $result = [];
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        while($row = $stmt->fetch()) {
            $result[] = new requiredCourses($row['required_course_id'], $row['user_id'], $row['user_n ame'], $row['course_id'], $row['course_name']);
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