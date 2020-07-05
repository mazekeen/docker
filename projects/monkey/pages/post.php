<?php include "templates/header.php" ?>

<div class="container">
    <div class="col-md-12">

        <div class="col-md-8">
            <?php

            if (isset($_GET['p_id'])) :
                $stmt = $pdo->prepare("SELECT * FROM posts WHERE post_id = ? LIMIT 1");
                $stmt->execute([$_GET['p_id']]);

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


            <?php
            if (isset($_POST['create_comment'])) {
                    $query = "INSERT INTO comments (
                    comm_post_id,
                    comm_author,
                    comm_email,
                    comm_content,
                    comm_status,
                    comm_date

                    ) VALUES (?,?,?,?,?,?)";
                    $stmt = $pdo->prepare($query)->execute([
                        $_GET['p_id'],
                        $_POST['comm_author'],
                        $_POST['comm_email'],
                        $_POST['comm_content'],
                        'unapproved',
                        date('y-m-d'),
                    ]);





                if (empty($_POST['comm_author']) || empty($_POST['comm_email']) || empty($_POST['comm_content'])) {
                    echo "<script>alert('Fields cannot be empty')</script>";
                }
                $stmt = $pdo->prepare("UPDATE posts SET post_views_count = ? WHERE post_id = ?");
                $views_count = $stmt->execute([$post['post_views_count'] + 1, $_GET['p_id']]);

            }


            ?>

            <div class="well">
                <h4>Leave a Comment:</h4>
                <form action="" method="post" role="form">
                    <div class="form-group">
                        <label for="Author">Author</label>
                        <input type="text" name="comm_author" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="Email">Email</label>
                        <input type="email" name="comm_email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="comment">Your comment</label>
                        <textarea name="comm_content" class="form-control" rows="3"></textarea>
                    </div>
                    <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                </form>
            </div>

            <hr>




            <?php
            $stmt = $pdo->prepare("SELECT * FROM comments WHERE comm_post_id = ? AND comm_status = ? ORDER BY comm_id DESC");
            $stmt->execute([$_GET['p_id'], 'approved']);
            $comments = $stmt->fetchAll();
            foreach ($comments as $comm) :
            ?>

                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comm['comm_author'] ?>
                            <small><?php echo $comm['comm_date'] ?></small>
                        </h4>
                        <?php echo $comm['comm_content'] ?>
                    </div>
                </div>
            <?php endforeach; ?>

            <hr>

        </div>
        <div class="col-md-4">
            <?php include "templates/sidebar.php" ?>
        </div>
    </div>
</div>

    <hr>

    <?php include "templates/footer.php" ?>
