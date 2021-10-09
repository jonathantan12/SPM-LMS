<?php
require_once 'autoload.php';

class RequiredCoursesDAO {
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
            $result[] = new requiredCourses($row['required_course_id'], $row['user_id'], $row['user_name'], $row['course_id'], $row['course_name']);
        }
        $stmt = null;
        $pdo = null;

        return $result;
    }

    public function getEligibleLearners($course_id) {
        $connMgr = new ConnectionManager();
        $pdo = $connMgr->getConnection();

        $sql = 'SELECT * FROM required_courses WHERE course_id = :course_id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':course_id', $course_id, PDO::PARAM_INT);
        $stmt->execute();
        $result = [];
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        while($row = $stmt->fetch()) {
            $result[] = new requiredCourses($row['required_course_id'], $row['user_id'], $row['user_name'], $row['course_id'], $row['course_name']);
        }
        $stmt = null;
        $pdo = null;

        return $result;
    }

    public function deleteRequiredCourse($user_id, $course_id) {
        $result = FALSE;
        $connMgr = new ConnectionManager();
        $pdo = $connMgr->getConnection();

        $sql = 'DELETE FROM required_courses WHERE user_id = :user_id && course_id = :course_id';
        
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->bindParam(':course_id', $course_id, PDO::PARAM_INT);

            if($stmt->execute()) {
                $result = TRUE;
            }
        } catch (Exception $e) {
            return $result;    
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