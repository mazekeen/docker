<?php include "templates/header.php" ?>

<div id="wrapper">

    <div id="page-wrapper">

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to Comments
                        <small>Author</small>
                    </h1>
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

                                $stmt = $pdo->prepare("SELECT * FROM comments WHERE comm_post_id = ?");
                                $stmt->execute([$_GET['id']]);
                                $comments = $stmt->fetchAll();

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
                                    echo "<td><a href='?page=post_comm&delete=" . $comm['comm_id'] . "&id=" . $_GET['id'] . "'>Delete</a> </td>";
                                    echo "</tr>";
                                endforeach;
                                ?>
                            </tbody>
                        </table>
                    </div>
