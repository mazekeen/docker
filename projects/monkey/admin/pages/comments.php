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
                        case 'add_post';
                            include "templates/add_post.php";
                            break;
                        case 'edit_post';
                            include "templates/edit_post.php";
                            break;
                        default:
                            include "templates/view_comm.php";
                            break;
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>

</div>

<?php include "templates/footer.php" ?>
