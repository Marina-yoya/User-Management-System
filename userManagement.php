<?php
require_once 'user.php'; 
require_once 'database.php';

$host = "localhost";
$username = "root";
$dbname = "ums";

class UserManagement {
    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function addUser($username, $email, $role) {
        $sql = "INSERT INTO user (username, email, role) VALUES (?, ?, ?)";
        $params = [$username, $email, $role];
        return $this->database->create($sql, $params);
    }

    public function getUserById($id) {
        $sql = "SELECT * FROM user WHERE id = ?";
        $params = [$id];
        $result = $this->database->read($sql, $params);
        if (!empty($result)) {
            $userData = $result[0];
            return new User($userData['id'], $userData['username'], $userData['email'], $userData['role']);
        }
        return null;
    }

    public function updateUser($id, $username, $email, $role) {
        $sql = "UPDATE user SET username = ?, email = ?, role = ? WHERE id = ?";
        $params = [$username, $email, $role, $id];
        return $this->database->update($sql, $params);
    }

    public function deleteUser($id) {
        $sql = "DELETE FROM user WHERE id = ?";
        $params = [$id];
        return $this->database->delete($sql, $params);
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