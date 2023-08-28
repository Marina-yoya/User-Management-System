<?php
require_once 'userManagement.php';

?>

<!DOCTYPE html>
<html>

<head>
    <title>User Management</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>
    <div class="container">
        <h1>User Management</h1>
        <form action="userPage.php" method="POST" novalidate>
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>

            <label for="email">Email:</label>
            <input type="text" name="email" id="email" required>

            <label for="role">Role:</label>
            <select name="role" id="role" required>
                <option value="regular">Regular User</option>
                <option value="admin">Admin</option>
            </select>
            <div class="button-container">
                <button class="users" type="submit" name="add_user">Add User</button>
                <a href="allUsers.php" class="users">All Users</a>
            </div>

        </form>

        <?php if (isset($errors) && !empty($errors)) { ?>
            <div class="error-container">
                <ul>
                    <?php foreach ($errors as $error) { ?>
                        <li><?php echo $error; ?></li>
                    <?php } ?>
                </ul>
            </div>
        <?php } elseif (isset($message)) { ?>
            <p>
                <?php echo $message; ?>
            </p>
        <?php } ?>
        

    </div>
</body>

</html>