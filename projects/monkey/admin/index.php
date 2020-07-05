<?php
if ($_GET['page']) {
    include './pages/'.$_GET['page'].'.php';

    return;
}

include './pages/homepage.php';
?>
