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
                    <div class="col-xs-6">
                        <?php insertCategories(); ?>
                        <form action="?page=categories" method="post">
                            <div class="form-group">
                                <label>Add category</label>
                                <input class="form-control" type="text" name="cat_title">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="create">
                            </div>
                        </form>
                        <?php include "templates/update_cat.php"; ?>
                    </div>

                    <div class="col-xs-6">

                        <table class="table table-boardered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Categories Title</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php deleteCategories(); ?>
                                <?php findAllCategories(); ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

<?php include "templates/footer.php" ?>
