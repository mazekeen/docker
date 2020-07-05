<?php
if (isset($_POST['create_post'])) {
    $post_title = $_POST['post_title'];
    $post_author = $_POST['post_author'];
    $post_cat_id = $_POST['post_cat_id'];
    $post_status = $_POST['post_status'];

    $post_image = $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];

    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_views_count = 0;
    $post_date = date('d-m-y');


    move_uploaded_file($post_image_temp, getcwd() . "/uploads/images/$post_image");

    $query = "INSERT INTO posts (
        post_cat_id,
        post_title,
        post_author,
        post_image,
        post_content,
        post_date,
        post_tags,
        post_status,
        post_views_count
    ) VALUES (?,?,?,?,?,?,?,?,?)";
    $stmt = $pdo->prepare($query)->execute([
        $post_cat_id,
        $post_title,
        $post_author,
        $post_image,
        $post_content,
        $post_date,
        $post_tags,
        $post_status,
        $post_views_count
    ]);
    $post['post_id'] = $pdo->lastInsertId();
    echo "<p class='bg-success'> Post Created. <a href=\"..\?page=post&p_id=" . $post['post_id'] . "\">View Post</a> or <a href='?page=posts'>Edit More Posts </a></p>";
}
?>


<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label>Post Title</label>
        <input type="text" class="form-control" name="post_title">
    </div>

    <?php
        $categories = $pdo->query("SELECT * FROM categories")->fetchAll();
    ?>
    <div>
        <label>Post Category</label>
        <select name="post_cat_id">
            <?php foreach($categories as $category): ?>
            <option value="<?php echo $category['cat_id']; ?>"><?php echo $category['cat_title']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>


    <div class="form-group">
        <label>Post Author</label>
        <input type="text" class="form-control" name="post_author">
    </div>
    <div class="form-group">
        <label>Post Status</label>
        <select name="post_status" id="">
            <option value="published">published</option>
            <option value="draft">draft</option>
        </select>
    </div>
    <div class="form-group">
        <label>Post Image</label>
        <input type="file" name="post_image">
    </div>
    <div class="form-group">
        <label>Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>
    <div class="form-group">
        <label>Post Content</label>
        <textarea class="form-control" name="post_content" cols="30" rows="10">
        </textarea>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
    </div>
</form>
