<?php include './config/database.php'; ?>
<?php include './parts/header.php'; ?>

<ul>
<?php foreach ($data as $row): ?>
    <li>
        <?php foreach ($row as $key => $value): ?>
        <b><?php echo $key; ?>:</b> <span><?php echo $value; ?></span> <br/>
        <?php endforeach; ?>
    </li>
<?php endforeach; ?>
</ul>

<h1>This is the default page</h1>
<?php include './parts/footer.php'; ?>
