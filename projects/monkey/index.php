<?php include "templates/config.php" ?>

<!-- Header -->

<?php include "templates/header.php" ?>

<!-- Navigation -->
<?php include "templates/navigation.php" ?>

    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <?php
                
                $posts = $pdo->query("SELECT * FROM posts")->fetchAll();
                
                foreach($posts as $post): 
                    $post_title = $post['post_title'];
                    $post_author = $post['post_author'];
                    $post_date = $post['post_date'];
                    $post_image = $post['post_image'];
                    $post_content = $post['post_content'];
                 ?>
               
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author ?></a>
                </p>
                <p>
                    <span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?>
                </p>

                <hr>

                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">

                <hr>

                <p><?php echo $post_content ?></p>
                <a class="btn btn-primary" href="#">
                    Read More <span class="glyphicon glyphicon-chevron-right"></span>
                </a>

                <hr>
                <?php endforeach; ?>
            </div>

           
            <!-- Blog Sidebar Widgets Column -->
            <?php include "templates/sidebar.php" ?>

        </div>
        <!-- /.row -->
    </div>

    <hr>

<?php include "templates/footer.php" ?>