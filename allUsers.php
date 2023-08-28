<?php
require_once 'userManagement.php';

$users = $userManagement->getAllUsers();
if (isset($_POST['delete_user'])) {
    $userIdToDelete = $_POST['user_id'];
    $deleteMessage = $userManagement->deleteUserById($userIdToDelete);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>All Users</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>
    <div class="container-users">
        <table>
            <h1>All Users</h1>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th class="actions">Actions</th>

            </tr>
            <?php foreach ($users as $user) { ?>
                <tr>
                    <td>
                        <?php echo $user['username']; ?>
                    </td>
                    <td>
                        <?php echo $user['email']; ?>
                    </td>
                    <td>
                        <?php echo $user['role']; ?>
                    </td>
                    <td>
                   
                    <form action="allUsers.php" method="post">
                <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                <button type="submit" name="edit_user">Edit</button>
                <button type="submit" name="delete_user">Delete</button>
            </form>
            </td>
                </tr>
            <?php } ?>
        </table>
        <?php if (isset($deleteMessage)) { ?>
            <p><?php echo $deleteMessage; ?></p>
        <?php } ?>
    </div>
</body>

</html>