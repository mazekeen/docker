<?php include "templates/header.php" ?>

<?php

if (isset($_REQUEST['submit'])) {
    $username = strip_tags($_REQUEST['username']);
    $user_email = strip_tags($_REQUEST['user_email']);
    $user_password = strip_tags($_REQUEST['user_password']);
    $user_role = 'subscriber';
    $user_firstname = '';
    $user_lastname = '';

    if (empty($username)) {
        $errorMsg[] = "Please enter username";
    } else if (empty($user_email)) {
        $errorMsg[] = "Please enter email";
    } else if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
        $errorMsg[] = "Please enter a valid email address";
    } else if (empty($user_password)) {
        $errorMsg[] = "Please enter password";
    } else if (strlen($user_password) < 6) {
        $errorMsg[] = "Password must be at least 6 characters";
    } else {

        try {
            $select_stmt = $pdo->prepare("SELECT username, user_email FROM users WHERE
            username = ? OR user_email = ?");
            $select_stmt->execute([$username, $user_email]);
            $user = $select_stmt->fetch(PDO::FETCH_ASSOC);

            if ($user['username'] == $username) {
                $errorMsg[] = "Sorry username already exists";
            } else if ($user['user_email'] == $user_email) {
                $errorMsg[] = "Sorry email already exists";
            } else if (!isset($errorMsg)) {
                $new_password = password_hash($user_password, PASSWORD_DEFAULT);

                $query = "INSERT INTO users (
                            username,
                            user_email,
                            user_password,
                            user_role,
                            user_firstname,
                            user_lastname
                            ) VALUES (?,?,?,?,?,?)";

                $stmt = $pdo->prepare($query);
                if ($stmt->execute([
                    $username,
                    $user_email,
                    $new_password,
                    $user_role,
                    $user_firstname,
                    $user_lastname
                ])) {
                    $registerMsg = "Register Successfully!";
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}




if (isset($errorMsg)) {
    foreach ($errorMsg as $error) {
?>
        <div class="alert alert-danger">
            <strong>WRONG!<?php echo $error; ?></strong>
        </div>
    <?php
    }
}
if (isset($registerMsg)) {

    ?>
    <div class="alert alert-succes">
        <strong><?php echo $registerMsg; ?></strong>
    </div>
<?php
}
?>

<div class="container">

    <section id="register">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <h1>Register</h1>
                        <form role="form" action="?page=registration" method="post" id="register-form" autocomplete="off">
                            <div class="form-group">
                                <label for="username" class="sr-only">username</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Enter Username">
                            </div>
                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="user_email" id="email" class="form-control" placeholder="somebody@example.com">
                            </div>
                            <div class="form-group">
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" name="user_password" id="key" class="form-control" placeholder="Password">
                            </div>

                            <input type="submit" name="submit" id="btn-register" class="btn btn-custom btn-lg btn-block" value="Register">
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
<hr>



<?php include "templates/footer.php" ?>

<?php /*
if (isset($_REQUEST['login'])) {
    $username = strip_tags($_REQUEST['username_email']);
    $user_email = strip_tags($_REQUEST['username_email']);
    $user_password = strip_tags($_REQUEST['user_password']);

    if (empty($username)) {
        $errorMsg[] = "please enter username or email";
    } else if (empty($user_email)) {
        $errorMsg[] = "please enter username or email";
    } else if (empty($user_password)) {
        $errorMsg[] = "please enter password";
    } else {
        try {
            $select_stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? OR user_email = ?");
            $select_stmt->execute([$username, $user_email]);
            $user = $select_stmt->fetch(PDO::FETCH_ASSOC);

            if ($select_stmt->rowCount() > 0) {
                if ($username === $user['username'] or $user_email === $user["user_email"]) {
                    if (password_verify($user_password, $user['user_password'])) {
                        $_SESSION['login'] = $user['user_id'];
                        $loginMsg = "Successfully Login";
                        header("Location:../admin");
                    } else {
                        $errorMsg[] = "wrong password";
                        header("Location:../index");
                    }
                } else {
                    $errorMsg[] = "wrong username or email";
                    header("Location:../index");
                }
            } else {
                $errorMsg[] = "wrong username or email";
                header("Location:../index");
            }
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
}
if (isset($_POST['login'])) {
    $username = ($_POST['username']);
    $user_password = ($_POST['user_password']);
    $user_role = 'admin';

            $select_stmt = $pdo->prepare("SELECT * FROM users
            WHERE username = ?
            AND user_role = ? ");
            $select_stmt->execute([$username,$user_role]);
            $users = $select_stmt->fetch(PDO::FETCH_ASSOC);


                if ($username == $user['username'] && $user_role == $user['user_role'] && password_verify($user_password, $user['user_password'])) {

                        $_SESSION['username'] = $user['username'];
                        $_SESSION['user_firstname'] = $user['user_firstname'];
                        $_SESSION['user_lastname'] = $user['user_lastname'];
                        $_SESSION['user_role'] = $user['user_role'];

                        header("Location:../admin");
                    }
    }



*/?>
