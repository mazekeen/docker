<?php include "templates/header.php" ?>

<div class="container">

    <div class="row">
        <div class="col-md-8">
            <?php

            if (isset($_GET['cat'])) :
                $stmt = $pdo->prepare("SELECT * FROM posts WHERE post_cat_id = ?");
                $stmt->execute([$_GET['cat']]);
                $posts = $stmt->fetchAll();


                foreach ($posts as $post) :

                ?>

                    <h1 class="page-header"></h1>
                    <h2>
                        <a href="?page=post&p_id=<?php echo $post['post_id']; ?>"><?php echo $post['post_title'] ?></a>
                    </h2>

                    <p class="lead">
                        by <a href="index.php"><?php echo $post['post_author'] ?></a>
                    </p>
                    <p>
                        <span class="glyphicon glyphicon-time"></span> <?php echo $post['post_date'] ?>
                    </p>

                    <hr>
                    <img class="img-responsive" src="assets/images/<?php echo $post['post_image'] ?>" alt="">
                    <hr>

                    <p><?php echo substr($post['post_content'],0,100 )?></p>

                    <a class="btn btn-primary" href="#">
                        Read More <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>

                    <hr>
                <?php endforeach; ?>
            <?php endif; ?>

        </div>
        <div class="col-md-4">
            <?php include "templates/sidebar.php" ?>
        </div>


    </div>
</div>


<hr>

<?php include "templates/footer.php" ?>
