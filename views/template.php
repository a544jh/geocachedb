<?php require_once 'libs/models/user.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <title>geocachedb</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/bootstrap-theme.css" rel="stylesheet">
        <link href="css/main.css" rel="stylesheet">

        <script src="js/jquery-1.11.0.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-geocahedb" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">Geocahedb</a>
                </div>
                <div>
                    <ul class="nav navbar-nav">
                        <li><a href="geocachelist.php">Search geocahes</a></li>
                        <li><a href="trackablelist.php">Search trackables</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Add new <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="addcache.php">Geocache</a></li>
                                <li><a href="addtrackable.php">Trackable</a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <?php if (!loggedIn()): ?>
                        <li><a href="login.php">Login</a></li>
                        <?php else: ?>
                        <li><a href="profile.php"><?php echo $_SESSION['user']->getUsername(); ?></a></li>
                        <li><a href="logout.php">Logout</a></li>
                        <?php endif; ?>                        
                    </ul>
                </div>
            </div>
        </nav>
        
        <?php if (!empty($data->error)): ?>
        <div class="alert alert-danger"><?php echo $data->error; ?></div>
        <?php endif; ?>
        
        <?php if(!empty($data->errors)): foreach ($data->errors as $error):?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endforeach; endif; ?>
        
        <?php if (!empty($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?php echo $_SESSION['error']; ?></div>
        <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
        
        <?php if (!empty($_SESSION['success'])): ?>
        <div class="alert alert-success"><?php echo $_SESSION['success']; ?></div>
        <?php unset($_SESSION['success']); ?>
        <?php endif; ?>
        
        <div id ="content">
            <?php require 'views/'.$page;?>
        </div>
    </body>
</html>