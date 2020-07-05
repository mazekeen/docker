<?php
if (isset($_GET['change_to_admin'])) {
    $stmt = $pdo->prepare("UPDATE users SET user_role = ? WHERE user_id = ?");
    $stmt->execute(['admin', $_GET['change_to_admin']]);

}

if (isset($_GET['change_to_sub'])) {
    $stmt = $pdo->prepare("UPDATE users SET user_role = ? WHERE user_id = ?");
    $stmt->execute(['subscriber', $_GET['change_to_sub']]);

}


if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM users WHERE user_id = ?");
    $stmt->execute([$_GET['delete']]);

}
?>


<div class="col-xs-6">
    <table class="table table-boarded table-hover">
        <thead>
            <tr>
                <th>Id</th>
                <th>Username</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Email</th>
                <th>Role</th>
                <th>Admin</th>
                <th>Subscriber</th>
                <th>Edit</th>
                <th>Delete</th>

            </tr>
        </thead>
        <tbody>

            <?php

            $users = $pdo->query("SELECT * FROM users")->fetchAll();

            foreach ($users as $user) :

                echo "<tr>";
                echo "<td>" . $user['user_id'] . "</td>";
                echo "<td>" . $user['username'] . "</td>";
                echo "<td>" . $user['user_firstname'] . "</td>";
                echo "<td>" . $user['user_lastname'] . "</td>";
                echo "<td>" . $user['user_email'] . "</td>";
                echo "<td>" . $user['user_role'] . "</td>";
                echo "<td><a href=\"?page=users&change_to_admin=" . $user['user_id'] . "\">Admin</a> </td>";
                echo "<td><a href=\"?page=users&change_to_sub=" . $user['user_id'] . "\">Subscriber</a> </td>";
                echo "<td><a href=\"?page=users&source=edit_users&edit_users=" . $user['user_id'] . "\">Edit</a> </td>";
                echo "<td><a href=\"?page=users&delete=" . $user['user_id'] . "\">Delete</a> </td>";
                echo "</tr>";
            endforeach;
            ?>
        </tbody>
    </table>
</div>
