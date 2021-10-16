<?php

# require '../../lmsClasses/Cart.php';

class usersTest extends \PHPUnit\Framework\TestCase 
{
    public function testUsersAreReturned() 
    {
        $mockRepo = $this->createMock(usersDAO::class);

        $mockUsersObject = [
            # ($user_id, $user_name, $user_role, $login_id, $login_password)
            new users(1, 'Jonathan','engineer', 'test@hotmail.com', '0000')
        ];

        $mockRepo->method('getUsers')->willReturn($mockUsersObject);

        $users = $mockRepo->getUsers(1); #Getting back the database object

        $userId = $users[0]->getUserId();
        $userName = $users[0]->getUserName();
        $userRole = $users[0]->getUserRole();
        $loginId = $users[0]->getLoginId();
        $loginPassword = $users[0]->getLoginPassword();

        $this->assertEquals(1, $userId);
        $this->assertEquals('Jonathan', $userName);
        $this->assertEquals('engineer', $userRole); #Why is this null
        $this->assertEquals('test@hotmail.com', $loginId);
        $this->assertEquals('0000', $loginPassword);
    }
}
?>