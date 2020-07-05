<?php
if (isset($_GET['approve'])) {
    $stmt = $pdo->prepare("UPDATE comments SET comm_status = ? WHERE comm_id = ?");
    $stmt->execute(['approved', $_GET['approve']]);

}

if (isset($_GET['unapprove'])) {
    $stmt = $pdo->prepare("UPDATE comments SET comm_status = ? WHERE comm_id = ?");
    $stmt->execute(['unapproved', $_GET['unapprove']]);

}


if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM comments WHERE comm_id = ?");
    $stmt->execute([$_GET['delete']]);

}
?>


<div class="col-xs-6">
    <table class="table table-boarded table-hover">
        <thead>
            <tr>
                <th>Id</th>
                <th>Author</th>
                <th>Comment</th>
                <th>Email</th>
                <th>Status</th>
                <th>In Response to</th>
                <th>Date</th>
                <th>Approve</th>
                <th>Unapprove</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>

            <?php

            $comments = $pdo->query("SELECT * FROM comments")->fetchAll();

            foreach ($comments as $comm) :
                $stmt = $pdo->prepare("SELECT * FROM posts WHERE post_id=?");
                $stmt->execute([$comm['comm_post_id']]);
                $post = $stmt->fetch();

                echo "<tr>";
                echo "<td>" . $comm['comm_id'] . "</td>";
                echo "<td>" . $comm['comm_author'] . "</td>";
                echo "<td>" . $comm['comm_content'] . "</td>";
                echo "<td>" . $comm['comm_email'] . "</td>";
                echo "<td>" . $comm['comm_status'] . "</td>";

                echo "<td><a href=\"..\?page=post&p_id=" . $post['post_id'] . "\">" . $post['post_title'] . "</td>";

                echo "<td>" . $comm['comm_date'] . "</td>";
                echo "<td><a href=\"?page=comments&approve=" . $comm['comm_id'] . "\">Approve</a> </td>";
                echo "<td><a href=\"?page=comments&unapprove=" . $comm['comm_id'] . "\">Unapprove</a> </td>";
                echo "<td><a href=\"?page=comments&delete=" . $comm['comm_id'] . "\">Delete</a> </td>";
                echo "</tr>";
            endforeach;
            ?>
        </tbody>
    </table>
</div>
