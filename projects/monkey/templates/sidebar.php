
<div class="well">
    <h4>Blog Search</h4>
    <form action="?page=search" method="post">
        <div class="input-group">
            <input name="search" type="text" class="form-control">
            <span class="input-group-btn">
                <button name="submit" class="btn btn-default" type="submit">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>
        </div>
    </form>

</div>


<div class="well">

    <?php
    $categories = $pdo->query("SELECT * FROM categories")->fetchAll();
    ?>
    <h4>Blog Categories</h4>
    <div class="row">
        <div class="col-lg-12">
            <ul class="list-unstyled">
                <?php foreach ($categories as $category) : ?>
                    <li>
                        <a href="?page=category&cat=<?php echo $category['cat_id']; ?>"><?php echo $category['cat_title']; ?> </a>
                    </li>
                <?php endforeach; ?>


            </ul>
        </div>

    </div>

</div>

<div class="well">
    <?php include "templates/widget.php" ?>
</div>
