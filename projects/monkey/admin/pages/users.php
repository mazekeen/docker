<?php include "templates/header.php" ?>

<div id="wrapper">

    <div id="page-wrapper">

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to admin
                        <small>Author</small>
                    </h1>
                    <?php
                    if (isset($_GET['source'])) {
                        $source = $_GET['source'];
                    } else {
                        $source = '';
                    }
                    switch ($source) {
                        case 'add_users';
                            include "templates/add_users.php";
                            break;
                        case 'edit_users';
                            include "templates/edit_users.php";
                            break;
                        default:
                            include "templates/view_users.php";
                            break;
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>

</div>

<?php include "templates/footer.php" ?>
