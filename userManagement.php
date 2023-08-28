<?php
require_once 'user.php';
require_once 'database.php';

$host = "localhost";
$username = "root";
$dbname = "ums";

class UserManagement
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function addUser($username, $email, $role)
    {
        $sql = "INSERT INTO user (username, email, role) VALUES (?, ?, ?)";
        $params = [$username, $email, $role];
        return $this->database->create($sql, $params);
    }

    public function getAllUsers()
    {
        $sql = "SELECT * FROM user";
        $users = $this->database->read($sql);

        return $users;
    }

    public function getUserById($userId)
    {
        $sql = "SELECT * FROM user WHERE user_id = ?";
        $user = $this->database->read($sql, [$userId]);

        if (!empty($user)) {
            return $user[0];
        }

        return null;
    }


    public function updateUser($id, $username, $email, $role)
    {
        $sql = "UPDATE user SET username = ?, email = ?, role = ? WHERE id = ?";
        $params = [$username, $email, $role, $id];
        return $this->database->update($sql, $params);
    }


    public function deleteUserById($userId)
    {
        $userData = $this->getUserById($userId);

        if ($userData && $userData['role'] === 'regular') {
            return "Only admins can delete users.";
        }

        $deleteSuccess = $this->database->delete("DELETE FROM user WHERE user_id = ?", [$userId]);

        if ($deleteSuccess) {
            return "User deleted successfully.";
        } else {
            $errorInfo = $this->database->getPDO()->errorInfo();
            return "Failed to delete user. Error: " . $errorInfo[2];
        }
    }


}

$database = new Database($host, $username, $dbname);
$userManagement = new UserManagement($database);

if (isset($_POST['add_user'])) {
    $newUsername = $_POST['username'];
    $newEmail = $_POST['email'];
    $newRole = $_POST['role'];

    $operationSuccess = $userManagement->addUser($newUsername, $newEmail, $newRole);

    if ($operationSuccess) {
        $message = "New user added successfully.";
    } else {
        $message = "Failed to add new user.";
    }
}




?>