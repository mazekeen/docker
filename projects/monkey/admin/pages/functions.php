<?php
function usersOnline()
{
    global $pdo;
    $user_session = session_id();
    $user_time = time();
    $time_out_in_sec = 30;
    $time_out = $user_time - $time_out_in_sec;

    $stmt = $pdo->prepare("SELECT * FROM users_online WHERE user_session = ? ");
    $stmt->execute([$user_session]);
    $count = $stmt->rowCount();


    if ($count == NULL) {
        $query = "INSERT INTO users_online ( user_session,user_time) VALUES (?,?) ";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$user_session, $user_time]);
    } else {
        $stmt = $pdo->prepare("UPDATE users_online SET user_time = ? WHERE user_session = ?");
        $stmt->execute([$user_time, $user_session]);
    }
    $stmt = $pdo->prepare("SELECT * FROM users_online WHERE user_time > ? ");
    $r = $stmt->execute([$time_out]);
    return $r;

}

function insertCategories()
{
    global $pdo;
    if (isset($_POST['create'])) {
        if (empty($_POST['cat_title'])) {
            echo "This field should not be empty";
        } else {
            $sql = "INSERT INTO categories (cat_title) VALUES (?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$_POST['cat_title']]);
        }
    }
}


function deleteCategories()
{
    global $pdo;
    if (isset($_GET['delete'])) {
        $cat_id = $_GET['delete'];
        $stmt = $pdo->prepare("DELETE FROM categories WHERE cat_id = ?");
        $stmt->execute([$cat_id]);
    }
}

function findAllCategories()
{
    global $pdo;
    $categories = $pdo->query("SELECT * FROM categories")->fetchAll();

    foreach ($categories as $category) :
        echo "<tr>";
        echo "<td>" . $category['cat_id'] . "</td>";
        echo "<td>" . $category['cat_title'] . "</td>";
        echo "<td><a href=\"?page=categories&delete=" . $category['cat_id'] . "\">Delete</a> </td>";
        echo "<td><a href=\"?page=categories&edit=" . $category['cat_id'] . "\">Edit</a> </td>";
        echo "</tr>";
    endforeach;
}


?>
