<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">


        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Healthy Lifestyle</a>
        </div>


        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php
                $categories = $pdo->query("SELECT * FROM categories")->fetchAll();
                foreach ($categories as $category) {
                    echo "<li><a href=" . $category['cat_title'] . ">" . $category['cat_title'] . "</a></li>";
                }

                if (isset($_GET['p_id'])) {
                    echo "<li><a href=\"admin/?page=posts&source=edit_post&p_id=" . $_GET['p_id'] . "\">Edit Post</a></li>";
                };

                ?>
                <li>
                    <a href="admin">Admin</a>
                </li>
                <li>
                    <a href="?page=login">Login</a>
                </li>
                <li>
                    <a href="?page=registration">Registration</a>
                </li>

            </ul>
        </div>
    </div>
</nav>
