<?php
if (isset($_POST['create_users'])) {
    $user_id = $_POST['user_id'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];
    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $user_password = password_hash($user_password, PASSWORD_DEFAULT);
    $query = "INSERT INTO users (
        user_firstname,
        user_lastname,
        user_role,
        username,
        user_email,
        user_password

    ) VALUES (?,?,?,?,?,?)";
    $stmt = $pdo->prepare($query)->execute([
        $user_firstname,
        $user_lastname,
        $user_role,
        $username,
        $user_email,
        $user_password

    ]);
    echo "User Created." . " " . "<a href='?page=users'>View Users</a>";
}
?>


<form action="" method="post" enctype="multipart/form-data">


    <div class="form-group">
        <label>Firstname</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>
    <div class="form-group">
        <label>Lastname</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>
<select name="user_role">
    <option value="options">Select Options</option>
    <option value="admin">Admin</option>
    <option value="subscriber">Subscriber</option>
</select>
    <div class="form-group">
        <label>Username</label>
        <input type="text" class="form-control" name="username">
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="email" class="form-control" name="user_email">
    </div>
    <div class="form-group">
        <label>Password</label>
        <input type="password" class="form-control" name="user_password">
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_users" value="Add user">
    </div>
</form>
