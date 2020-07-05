<?php include "templates/header.php" ?>

<div class="container">
    <div class="col-md-12">

        <div class="col-md-8">
            <?php

            if (isset($_GET['p_id'])) :
                $stmt = $pdo->prepare("SELECT * FROM posts WHERE post_author = ? ");
                $stmt->execute([$_GET['author']]);

                foreach ($stmt as $post) :

            ?>

                    <h1 class="page-header"></h1>
                    <h2>
                        <?php echo $post['post_title'] ?>
                    </h2>

                    <p class="lead">
                        by <?php echo $post['post_author'] ?>
                    </p>
                    <p>
                        <span class="glyphicon glyphicon-time"></span> <?php echo $post['post_date'] ?>
                    </p>

                    <hr>
                    <img class="img-responsive" src="assets/images/<?php echo $post['post_image'] ?>" alt="">
                    <hr>

                    <p><?php echo $post['post_content'] ?></p>

                    <hr>
            <?php endforeach;
            endif; ?>

            <hr>

        </div>
        <div class="col-md-4">
            <?php include "templates/sidebar.php" ?>
        </div>
    </div>
</div>

<hr>

<?php include "templates/footer.php" ?>
