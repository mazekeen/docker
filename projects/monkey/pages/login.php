<?php
include "templates/header.php";

if (isset($_POST['login'])) {

    $username = strip_tags($_POST['username']);
    $user_email = strip_tags($_POST['user_email']);
    $user_password = strip_tags($_POST['user_password']);

    if (empty($user_email)) {
        $errorMsg[] = "please enter email and password";
    } else if (empty($user_password)) {
        $errorMsg[] = "please enter email and password";
    } else {
        try {
            $select_stmt = $pdo->prepare("SELECT * FROM users WHERE user_email = ?");
            $select_stmt->execute([$user_email]);
            $user = $select_stmt->fetch();


                if ($user_email === $user["user_email"] && password_verify($user_password, $user['user_password'])) {

                        $_SESSION['username'] = $user['username'];
                        $_SESSION['user_email'] = $user['user_email'];
                        $_SESSION['user_password'] = $user['user_password'];
                        $_SESSION['user_firstname'] = $user['user_firstname'];
                        $_SESSION['user_lastname'] = $user['user_lastname'];
                        $_SESSION['user_role'] = $user['user_role'];
                        $loginMsg = "Successfully Login";


                } else {
                    $errorMsg[] = "Wrong";

                }

        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
}


if (isset($errorMsg)) {
    foreach ($errorMsg as $error) {
?>
        <div class="alert alert-danger">
            <strong><?php echo $error; ?></strong>
        </div>
    <?php
    }
}
if (isset($loginMsg)) {
    ?>
    <div class="alert alert-succes">
        <strong><?php echo $loginMsg; ?></strong>
    </div>
<?php
}
?>

<div class="container">

    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <h1>Login</h1>
                        <form role="form" action="?page=login" method="post" id="register-form" autocomplete="off">
                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="user_email" id="email" class="form-control" placeholder="somebody@example.com">
                            </div>
                            <div class="form-group">
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" name="user_password" id="key" class="form-control" placeholder="Password">
                            </div>

                            <input type="submit" name="login" id="btn-register" class="btn btn-custom btn-lg btn-block" value="Login">
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
</hr>

<?php include "templates/footer.php" ?>
