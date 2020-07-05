<?php
$stmt = $pdo
    ->prepare(
        "SELECT * FROM posts AS p JOIN categories AS c WHERE p.post_cat_id = c.cat_id AND post_id = ?"
    );

$stmt->execute([$_GET['p_id']]);
$post = $stmt->fetch();

if (isset($_POST['upload_post'])) {
    move_uploaded_file($post_image_temp, getcwd() . "/uploads/images/$post_image");

    $post['post_title'] = $_POST['post_title'] ?: $post['post_title'];
    $post['post_author'] = $_POST['post_author'] ?: $post['post_author'];
    $post['post_cat_id'] = $_POST['post_cat_id'] ? (int) $_POST['post_cat_id'] : $post['post_cat_id'];
    $post['post_status'] = $_POST['post_status'] ?: $post['post_status'];
    $post['post_image'] = $_FILES['post_image']['name'] ?: $post['post_image'];
    $post['post_tags'] = $_POST['post_tags'] ?: $post['post_tags'];
    $post['post_content'] = $_POST['post_content'] ?: $post['post_content'];
    $post['post_date'] = date('d-m-y');

    $stmt = $pdo->prepare(
        "UPDATE posts
        SET
            post_cat_id = ?,
            post_title = ?,
            post_author = ?,
            post_image = ?,
            post_content = ?,
            post_date = ?,
            post_tags = ?,
            post_status = ?
        WHERE post_id = ?"
    )->execute([
        $post['post_cat_id'],
        $post['post_title'],
        $post['post_author'],
        $post['post_image'],
        $post['post_content'],
        $post['post_date'],
        $post['post_tags'],
        $post['post_status'],
        $post['post_id'],
    ]);
    echo "<p class='bg-success'> Post Updated. <a href=\"..\?page=post&p_id=" . $post['post_id'] . "\">View Post</a> or <a href='?page=posts'>Edit More Posts </a></p>";

}

?>
<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label>Post Title</label>
        <input value="<?php echo $post['post_title']; ?>" type="text" class="form-control" name="post_title">
    </div>

    <?php
    $categories = $pdo->query("SELECT * FROM categories")->fetchAll();
    ?>
    <div>
        <label>Post Category</label>
        <select name="post_cat_id">
            <?php foreach ($categories as $category) : ?>
                <option value="<?php echo $category['cat_id']; ?>" <?php if ($post['post_cat_id'] === $category['cat_id']) : ?>selected="selected" <?php endif; ?>>
                    <?php echo $category['cat_title']; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>


    <div class="form-group">
        <label>Post Author</label>
        <input value="<?php echo  $post['post_author']; ?>" type="text" class="form-control" name="post_author">
    </div>
    <label>Post Status</label>
    <select name="post_status">
        <option value='<?php echo $post['post_status']; ?>'><?php echo $post['post_status']; ?></option>
        <?php if ($post['post_status'] === 'published') :
            echo "<option value='draft'>draft</option>";
        else :
            echo "<option value='published'>published</option>";
        endif;

        ?>
    </select>

    <div class="form-group">
        <label>Image</label>
        <input type="file" name="post_image">
    </div>

    <?php if ($post['post_image']) : ?>
        <div class="form-group">
            <img width="200" src="assets/images/<?php echo $post['post_image']; ?>" alt="">
        </div>
    <? endif; ?>

    <div class="form-group">
        <label>Post Tags</label>
        <input value="<?php echo $post['post_tags']; ?>" type="text" class="form-control" name="post_tags">
    </div>
    <div class="form-group">
        <label>Post Content</label>
        <textarea class="form-control" name="post_content" cols="30" rows="10"><?php echo $post['post_content']; ?></textarea>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="upload_post" value="Publish Post">
    </div>
</form>
