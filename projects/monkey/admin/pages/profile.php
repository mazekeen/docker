<?php include "templates/header.php" ?>
<?php
$stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
$stmt->execute([$_SESSION['username']]);
$user = $stmt->fetch();
if (isset($_SESSION['username'])) {

    $user['user_id'] = $_POST['user_id'] ?: $user['user_id'];
    $user['user_firstname'] = $_POST['user_firstname'] ?: $user['user_firstname'];
    $user['user_lastname'] = $_POST['user_lastname'] ?: $user['user_lastname'];
    $user['user_role'] = $_POST['user_role'] ?: $user['user_role'];
    $user['username'] = $_POST['username'] ?: $user['username'];
    $user['user_email'] = $_POST['user_email'] ?: $user['user_email'];
    $user['user_password'] = $_POST['user_password'] ?: $user['user_password'];

    $stmt = $pdo->prepare(
        "UPDATE users
            SET
                user_firstname = ?,
                user_lastname = ?,
                user_role = ?,
                username = ?,
                user_email = ?,
                user_password = ?
            WHERE username = ?"
    )->execute([
        $user['user_firstname'],
        $user['user_lastname'],
        $user['user_role'],
        $user['username'],
        $user['user_email'],
        $user['user_password'],
        $user['username'],
    ]);
};

?>

<div id="wrapper">


    <div id="page-wrapper">

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to admin
                        <small>Author</small>
                    </h1>
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
                            <input class="btn btn-primary" type="submit" name="edit_users" value="Update profile">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<?php include "templates/footer.php" ?>
