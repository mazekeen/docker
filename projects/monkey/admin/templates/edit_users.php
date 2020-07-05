<?php
$stmt = $pdo->prepare("SELECT * FROM users WHERE user_id LIKE ?");
$stmt->execute([$_GET['edit_users']]);
$user = $stmt->fetch();

if (isset($_POST['edit_users'])) {
    $user['user_id'] = $_POST['user_id'] ?: $user['user_id'];
    $user['user_firstname'] = $_POST['user_firstname'] ?: $user['user_firstname'];
    $user['user_lastname'] = $_POST['user_lastname'] ?: $user['user_lastname'];
    $user['user_role'] = $_POST['user_role'] ?: $user['user_role'];
    $user['username'] = $_POST['username'] ?: $user['username'];

    $stmt = $pdo->prepare(
        "UPDATE users
            SET
                user_firstname = ?,
                user_lastname = ?,
                user_role = ?,
                username = ?

            WHERE user_id = ?"
    )->execute([
        $user['user_firstname'],
        $user['user_lastname'],
        $user['user_role'],
        $user['username'],
        $user['user_id']
    ]);
};
?>
<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label>Firstname</label>
        <input type="text" value="<?php echo  $user['user_firstname']; ?>" class="form-control" name="user_firstname">
    </div>
    <div class="form-group">
        <label>Lastname</label>
        <input type="text" value="<?php echo  $user['user_lastname']; ?>" class="form-control" name="user_lastname">
    </div>
    <div class="form-group">
        <select name="user_role">
            <option value="<?php echo $user['user_role']; ?>"><?php echo $user['user_role']; ?></option>
            <?php if ($user['user_role'] == 'admin') {
                echo "<option value='subscriber'>subscriber</option>";
            } else {
                echo  "<option value='admin'>admin</option>";
            }

            ?>

        </select>
    </div>
    <div class="form-group">
        <label>Username</label>
        <input type="text" value="<?php echo  $user['username']; ?>" class="form-control" name="username">
    </div>


    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="edit_users" value="Edit user">
    </div>
</form>
