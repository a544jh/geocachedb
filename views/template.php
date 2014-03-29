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

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Add new <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="geocacheform.php">Geocache</a></li>
                                <li><a href="trackableform.php">Trackable</a></li>
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
        
        <?php if (!empty($data->success)): ?>
        <div class="alert alert-success"><?php echo $data->success; ?></div>
        <?php endif; ?>
        
        <div id ="content">
            <?php require 'views/'.$page;?>
        </div>
    </body>
</html>