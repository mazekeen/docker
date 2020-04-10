<!-- Page Content -->
<div class="container">
        <div class="row">
            <!-- Blog Entries Column -->
            <div class="col-md-8">
<?php   
        $keyword='search';
        $query = $pdo->prepare('SELECT post_tags FROM posts');
        $query->bindValue('search', '$keyword' );
        $query->execute();  

        if (!$query->rowCount() == 0) {
        while ($results = $query->fetch()) {
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
                <?php  }
        } else {
         echo 'Nothing found';
         } ?>
            </div>
