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
        $sql = "UPDATE user SET username = ?, email = ?, role = ? WHERE user_id = ?";
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

    $errors = array();

    if (empty($newUsername)) {
        $errors[] = "Username is required";
    }

    if (empty($newEmail)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

    if (empty($newRole)) {
        $errors[] = "Role is required";
    }

    if (empty($errors)) {

        $operationSuccess = $userManagement->addUser($newUsername, $newEmail, $newRole);

        if ($operationSuccess) {
            $message = "New user added successfully";
        } else {
            $message = "Failed to add new user";
        }
    }
}


if (isset($_GET['user_id'])) {
    $userId = $_GET['user_id'];
    $user = $userManagement->getUserById($userId);

    if ($user) {
        $username = $user['username'];
        $email = $user['email'];
        $role = $user['role'];
    } else {
        $message = "User not found.";
    }
}

if (isset($_POST['update_user'])) {
    $updatedUsername = $_POST['username'];
    $updatedEmail = $_POST['email'];
    $updatedRole = $_POST['role'];

    if (empty($updatedUsername)) {
        $errors[] = "Username is required";
    }

    if (empty($updatedEmail)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($updatedEmail, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

    if (empty($updatedRole)) {
        $errors[] = "Role is required";
    }

    if (empty($errors)) {
        $updateSuccess = $userManagement->updateUser($userId, $updatedUsername, $updatedEmail, $updatedRole);

        if ($updateSuccess) {
            $message = "User updated successfully";
        } else {
            $message = "Failed to update user.";
        }
    }
}



if (isset($_POST['delete_user'])) {
    $userIdToDelete = $_POST['user_id'];
    $deleteMessage = $userManagement->deleteUserById($userIdToDelete);
} elseif (isset($_POST['edit_user'])) {

    $userIdToEdit = $_POST['user_id'];
    header("Location: editUser.php?user_id=$userIdToEdit");
    exit();
}




?>