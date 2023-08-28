<?php
require_once 'userManagement.php';

?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit User</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>
    <div class="container">
        <h1>Edit User</h1>
        <form action="editUser.php?user_id=<?php echo $userId; ?>" method="POST">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" value="<?php echo $username; ?>" required>

            <label for="email">Email:</label>
            <input type="text" name="email" id="email" value="<?php echo $email; ?>" required>

            <label for="role">Role:</label>
            <select name="role" id="role" required>
                <option value="regular" <?php if ($role === 'regular')
                    echo 'selected'; ?>>Regular User</option>
                <option value="admin" <?php if ($role === 'admin')
                    echo 'selected'; ?>>Admin</option>
            </select>

            <button type="submit" name="update_user">Update User</button>
        </form>
        <?php if (isset($message)) { ?>
            <p>
                <?php echo $message; ?>
            </p>
        <?php } ?>
    </div>
</body>

</html>