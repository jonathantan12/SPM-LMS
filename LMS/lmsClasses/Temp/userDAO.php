<?php
class userDAO {

    # Add a new user into the database
    // expects a user class
    public function add($user) {
        $connMgr = new ConnectionManager();
        $pdo = $connMgr->getConnection();
        $sql = 'insert into users (userID, username, userRole, loginID, loginPwd) values (:userID, :username, :userRole, :loginID, :loginPwd)';
        $isAddOK = FALSE;
        try { 
            $stmt = $pdo->prepare($sql); 

            $userID = $user->getUserID();
            $username = $user->getUsername();
            $userRole = $user->getUserRole();
            $loginID = $user->getLoginID();
            $loginPwd = $user->getLoginPwd();
            
            $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->bindParam(':userRole', $userRole, PDO::PARAM_STR);
            $stmt->bindParam(':loginID', $loginID, PDO::PARAM_STR);
            $stmt->bindParam(':loginPwd', $loginPwd, PDO::PARAM_STR);
            
        
            if ($stmt->execute()) {
                $isAddOK = TRUE;
            }
            
            $stmt->closeCursor();
            $pdo = null;
        } catch (Exception $e) {
            return $isAddOK;    
        }

        return $isAddOK;
    }


    public function getAllByRole($userRole) {
        $connMgr = new ConnectionManager();
        $conn = $connMgr->getConnection();

        $sql = "SELECT
                    username, 
                    userRole
                FROM users
                WHERE userRole = :userRole"; 
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':userRole', $userRole, PDO::PARAM_STR);


        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $user = [];
        while( $row = $stmt->fetch() ) {
            $user = [$row['username'],
                     $row['userRole']];
        }

        $stmt = null;
        $conn = null;

        return $user;
    }

    
}

?>
