<?php include "templates/header.php" ?>

<div class="container">
    <div class="col-md-12">

        <div class="col-md-8">
            <?php
            $per_page = 2;
            if(isset($_GET['w_page'])) {
                $page = $_GET['w_page'];
            } else {
                $page = "";
            }
            if($page == "" || $page == 1) {
                $page_1 = 0;
            } else {
                $page_1 = ($page * $per_page) - $per_page;
            }



            $stmt = $pdo->prepare("SELECT * FROM posts");
            $stmt->execute();
            $count = $stmt->rowCount();

            $count = ceil($count / $per_page);

            $stmt = $pdo->prepare("SELECT * FROM posts WHERE post_status = ? LIMIT ?,?");
            $stmt->execute(['published', $page_1, $per_page]);
            $posts = $stmt->fetchAll();


            foreach ($posts as $post) :

            ?>

                <h1 class="page-header"></h1>
                <h2>
                    <a href="?page=post&p_id=<?php echo $post['post_id']; ?>"><?php echo $post['post_title'] ?> </a>
                </h2>

                <p class="lead">
                    by <a href="?page=author_posts&author=<?php echo $post['post_author'] ?>&&p_id=<?php echo $post['post_id'] ?>"><?php echo $post['post_author'] ?></a>
                </p>
                <p>
                    <span class="glyphicon glyphicon-time"></span> <?php echo $post['post_date']; ?>
                </p>

                <hr>
                <a href="?page=post&p_id=<?php echo $post['post_id']; ?>">
                    <img class="img-responsive" src="assets/images/<?php echo  $post['post_image']; ?>" alt="">
                </a>
                <hr>

                <p><?php echo substr($post['post_content'], 0, 100) ?></p>
                <a class="btn btn-primary" href="?page=post&p_id=<?php echo $post['post_id']; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>


                <hr>
            <?php endforeach; ?>
        </div>

        <div class="col-md-4">
            <?php include "templates/sidebar.php" ?>
        </div>
    </div>
</div>
<ul class="pager">
    <?php
    for($i = 1; $i <= $count; $i++) {
        if($i == $page) {
            echo "<li><a class='active_link' href='index.php?w_page={$i}'>{$i}</a></li>";
        } else {
            echo "<li><a href='index.php?w_page={$i}'>{$i}</a></li>";
        }
    }
    ?>
</ul>

<hr>

<?php include "templates/footer.php" ?>
