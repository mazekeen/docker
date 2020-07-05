<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">Admin</a>
    </div>

    <ul class="nav navbar-right top-nav">
        <li><a href="">Users Online: <?php echo usersOnline(); ?></a></li>
        <li><a href="../index.php">HOME SITE</a></li>

        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>
                <?php
                if (isset($_SESSION['username'])) {
                    echo $_SESSION['username'];
                }
                ?>
                <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li>
                    <a href="?page=profile"><i class="fas fa-user"></i> Profile</a>
                </li>
                <li>
                    <a href="../?page=logout"><i class="fas fa-power-off"></i> Log Out</a>
                </li>
            </ul>
        </li>
    </ul>

    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li>
                <a href="index.php "><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            </li>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#posts_dropdown"><i class="fas fa-arrows-alt-v"></i> Posts <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="posts_dropdown" class="collapse">
                    <li>
                        <a href="?page=posts">View All Posts</a>
                    </li>
                    <li>
                        <a href="?page=posts&source=add_post">Add Post</a>
                    </li>
                </ul>
            </li>
            <li class="active">
                <a href="?page=categories"><i class="fa fa-fw fa-file"></i> Categories </a>
            </li>

            <li class="">
                <a href="?page=comments"><i class="far fa-comments"></i> Comments </a>
            </li>

            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fas fa-users"></i> Users <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="demo" class="collapse">
                    <li>
                        <a href="?page=users">View All Users</a>
                    </li>
                    <li>
                        <a href="?page=users&source=add_users">Add User</a>
                    </li>
                </ul>
            </li>

            <li class="active">
                <a href="?page=profile"><i class="fas fa-user-circle"></i></i> Profile </a>
            </li>

        </ul>
    </div>

</nav>
