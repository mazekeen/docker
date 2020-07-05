<?php
if (isset($_POST['edit'])) {
    if (empty($_POST['cat_title'])) {
        echo "This field should not be empty";
    } else {
        $sql = "UPDATE categories SET cat_title = ? WHERE cat_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$_POST['cat_title'], $_POST['cat_id']]);
    }
}

if (isset($_GET['edit'])) :
    $stmt = $pdo->prepare('SELECT * FROM categories WHERE cat_id LIKE ? LIMIT 1');
    $stmt->execute([$_GET['edit']]);
    $category = $stmt->fetch();

?>

    <form action="?page=categories" method="post">
        <div class="form-group">
            <label>Edit category</label>
            <input value="<?php echo $category['cat_id'] ?>" type="hidden" name="cat_id" />
            <input value="<?php echo $category['cat_title'] ?>" class="form-control" type="text" name="cat_title" />

        </div>

        <div class="form-group">
            <input class="btn btn-primary" type="submit" name="edit">
        </div>
    </form>
<?php endif; ?>
