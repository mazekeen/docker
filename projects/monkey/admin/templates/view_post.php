<?php
if (isset($_POST['checkboxArray'])) {

    foreach ($_POST['checkboxArray'] as $postValueId) {
        $bulk_options = $_POST['bulk_options'];
        switch ($bulk_options) {
            case 'published':
                $stmt = $pdo->prepare("UPDATE posts SET post_status = ? WHERE post_id = ?");
                $stmt->execute([$_POST['bulk_options'], $postValueId]);
                break;
            case 'draft':
                $stmt = $pdo->prepare("UPDATE posts SET post_status = ? WHERE post_id = ?");
                $stmt->execute([$_POST['bulk_options'], $postValueId]);
                break;
            case 'delete':
                $stmt = $pdo->prepare("DELETE FROM posts WHERE post_id = ?");
                $stmt->execute([$postValueId]);
                break;
        }
    }
}
?>

<div class="col-xs-8">
    <form action="" method="post">
        <table class="table table-boarded table-hover">
            <div id="bulkOptionsContainer" class="col-xs-4">
                <select class="form-control" name="bulk_options" id="">
                    <option value="">Select Options</option>
                    <option value="published">Publish</option>
                    <option value="draft">Draft</option>
                    <option value="delete">Delete</option>
                </select>
            </div>

            <input type="submit" name="submit" class="btn btn-success" value="Apply">
            <a class="btn btn-primary" href="?page=posts&source=add_post">Add New</a>
            <thead>
                <tr>
                    <th><input id="selectAllboxes" type="checkbox"></th>
                    <th>Id</th>
                    <th>Category</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Status</th>
                    <th>Image</th>
                    <th>Tags</th>
                    <th>Content</th>
                    <th>Comments</th>
                    <th>Date</th>
                    <th>View Post</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    <th>Views</th>
                </tr>
            </thead>
            <tbody>

                <?php

                $posts = $pdo->query(
                    "SELECT * FROM posts AS p JOIN categories AS c WHERE c.cat_id = p.post_cat_id"
                )->fetchAll();


                foreach ($posts as $post) :
                    echo "<tr>";
                ?>
                    <td><input class='checkBoxes' id='selectAllboxes' type='checkbox' name='checkboxArray[]' value='<?php echo $post['post_id']; ?>'></td>
                <?php
                    echo "<td>" . $post['post_id'] . "</td>";
                    echo "<td>" . $post['cat_title'] . "</td>";
                    echo "<td>" . $post['post_title'] . "</td>";
                    echo "<td>" . $post['post_author'] . "</td>";
                    echo "<td>" . $post['post_status'] . "</td>";
                    echo '<td> <img class="img-responsive" src="assets/images/' . $post['post_image'] . '" alt="image">  </td>';
                    echo "<td>" . $post['post_tags'] . "</td>";
                    echo "<td>" . $post['post_content'] . "</td>";

                    $stmt = $pdo->prepare("SELECT * FROM comments WHERE comm_post_id = ? ");
                    $stmt->execute([$post['post_id']]);
                    $stmt->fetch();
                    $count_comments = $stmt->rowCount();

                    echo "<td><a href=\"?page=post_comm&id=" . $post['post_id'] . "\">$count_comments</a></td>";
                    echo "<td>" . $post['post_date'] . "</td>";
                    echo "<td><a href=\"../?page=post&p_id=" . $post['post_id'] . "\">View Post</a> </td>";
                    echo "<td><a href=\"?page=posts&source=edit_post&p_id=" . $post['post_id'] . "\">Edit</a> </td>";
                    echo "<td><a onClick=\"javascript:return confirm('Are you sure you want to delete?')\" href='?page=posts&delete=" . $post['post_id'] . "'>Delete</a> </td>";
                    echo "<td><a href=\"?page=posts&reset=" . $post['post_id'] . "\">{$post['post_views_count']}</a> </td>";
                    echo "</tr>";
                endforeach;

                if (isset($_GET['delete'])) {
                    $post_id = $_GET['delete'];
                    $stmt = $pdo->prepare("DELETE FROM posts WHERE post_id = ?");
                    $stmt->execute([$post_id]);
                }
                if (isset($_GET['reset'])) {
                    $post_id = $_GET['reset'];
                    $stmt = $pdo->prepare("UPDATE posts SET post_views_count = ? WHERE post_id = ?");
                    $reset = $stmt->execute([0, $post_id]);
                }
                ?>
            </tbody>
        </table>
    </form>
</div>
