<?php include "config/database.php" ?>
<?php include "templates/header.php" ?>
<?php include "templates/navigation.php" ?>

<div class="container">
    <div class="row">

        <div class="col-md-8">
            <?php
                $stmt = $pdo->prepare(
                    'SELECT * FROM posts WHERE post_tags LIKE :search'
                );
                $stmt->execute([
                    ':search' => '%' . $_POST['search'] . '%',
                ]);

                $posts = $stmt->fetchAll();
            ?>
            <?php if (!$stmt->rowCount() == 0): ?>
                <?php
                    foreach ($posts as $post):
                        $post_title = $post['post_title'];
                        $post_author = $post['post_author'];
                        $post_date = $post['post_date'];
                        $post_image = $post['post_image'];
                        $post_content = $post['post_content'];
                ?>
                    <h1 class="page-header">
                    </h1>

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

                    <img class="img-responsive" src="assets/images/<?php echo $post_image; ?>" alt="">

                    <hr>

                    <p><?php echo $post_content ?></p>
                    <a class="btn btn-primary" href="#">
                        Read More <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>

                    <hr>
                <?php endforeach; ?>
            <?php else: ?>
                Nothing found
            <?php endif; ?>
        </div>

        <div class="col-md-4">
            <?php include "templates/sidebar.php" ?>
        </div>
    </div>
</div>
