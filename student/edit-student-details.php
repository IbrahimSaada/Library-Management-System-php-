<?php
session_start();
require('config.php');

$checkusername = $_SESSION['username'];
$getUserSql = "SELECT * FROM `user` WHERE `username` = '$checkusername' AND role='user'";
$getUserResult = mysqli_query($con, $getUserSql);

if (mysqli_num_rows($getUserResult) > 0) {
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LMS</title>
    <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link type="text/css" href="css/theme.css" rel="stylesheet">
    <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
    <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
        rel='stylesheet'>
</head>

<body>
    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                    <i class="icon-reorder shaded"></i></a><a class="brand" href="index-student.php">LMS </a>
                <div class="nav-collapse collapse navbar-inverse-collapse">
                    <ul class="nav pull-right">
                        <li class="nav-user dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="images/user.png" class="nav-avatar" />
                                <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="index-admin.php">Your Profile</a></li>
                                <!--li><a href="#">Edit Profile</a></li>
                                <li><a href="#">Account Settings</a></li-->
                                <li class="divider"></li>
                                <li><a href="logout.php">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- /.nav-collapse -->
            </div>
        </div>
        <!-- /navbar-inner -->
    </div>
    <!-- /navbar -->
    <div class="wrapper">
        <div class="container">
            <div class="row">
                <div class="span3">
                    <div class="sidebar">
                        <ul class="widget widget-menu unstyled">
                            <li class="active"><a href="index-student.php"><i class="menu-icon icon-home"></i>Home
                            </a></li>
                            <li><a href="message.php"><i class="menu-icon icon-inbox"></i>Messages</a>
                            </li>
                            <li><a href="book.php"><i class="menu-icon icon-book"></i>All Books </a></li>
                            <li><a href="current-borrowedbooks.php"><i class="menu-icon icon-list"></i>Currently Borrowed Books </a></li>
                        </ul>
                        <ul class="widget widget-menu unstyled">
                            <li><a href="logout.php"><i class="menu-icon icon-signout"></i>Logout </a></li>
                        </ul>
                    </div>
                    <!--/.sidebar-->
                </div>
                <!--/.span3-->

                <div class="span9">
                    <div class="module">
                        <div class="module-head">
                            <h3>Update Details</h3>
                        </div>
                        <div class="module-body">
                            <?php
                            $sql = "SELECT * FROM user WHERE username='$checkusername'";
                            $Result = mysqli_query($con, $getUserSql);
                            if (mysqli_num_rows($getUserResult) > 0)
                                $userData = mysqli_fetch_assoc($getUserResult);

                            $fname = $userData['fname'];
                            $lname = $userData['lname'];
                            $num = $userData['number'];
                            $pass = $userData['password'];
                            ?>
                            <form class="form-horizontal row-fluid" action="edit-student-details.php?id=<?php echo $checkusername  ?>" method="post">

                                <div class="control-group">
                                    <label class="control-label" for="FName"><b>First Name:</b></label>
                                    <div class="controls">
                                        <input type="text" id="FName" name="FName" value="<?php echo $fname ?>" class="span8" required>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="LName"><b>Last Name</b></label>
                                    <div class="controls">
                                        <input type="text" id="LName" name="LName" value="<?php echo $lname ?>" class="span8" required>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="MobNo"><b>Mobile Number:</b></label>
                                    <div class="controls">
                                        <input type="text" id="MobNo" name="MobNo" value="<?php echo $num ?>" class="span8" required>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="Password"><b>Password:</b></label>
                                    <div class="controls">
                                        <input type="password" id="Password" name="Password" value="" class="span8" required>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="controls">
                                        <button type="submit" name="submit" class="btn-primary"><center>Update Details</center></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--/.span9-->
            </div>
        </div>
        <!--/.container-->
    </div>
    <div class="footer">
        <div class="container">
            <b class="copyright">&copy; 2024 Library Management System </b>All rights reserved.
        </div>
    </div>
    <!--/.wrapper-->
    <script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
    <script src="scripts/flot/jquery.flot.resize.js" type="text/javascript"></script>
    <script src="scripts/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="scripts/common.js" type="text/javascript"></script>
</body>
<?php
if (isset($_POST['submit'])) {
    $getUserSql = "SELECT * FROM `user` WHERE `username` = '$checkusername'";
    $getUserResult = mysqli_query($con, $getUserSql);

    if ($getUserResult && mysqli_num_rows($getUserResult) > 0) {
        $userRow = mysqli_fetch_assoc($getUserResult);
        $pass = $_POST['Password'];
        if (password_verify($pass, $userRow['password'])) {
            $fname = $_POST['FName'];
            $lname = $_POST['LName'];
            $num = $_POST['MobNo'];
            $updateSql = "UPDATE `user` SET `fname`='$fname', `lname`='$lname', `number`='$num' WHERE `username`='$checkusername'";

            $updateResult = mysqli_query($con, $updateSql);
            if ($updateResult) {
                echo "<script type='text/javascript'>alert('Details updated successfully!')</script>";
            } else {
                echo "<script type='text/javascript'>alert('Error updating details. Please try again.')</script>";
            }
        } else {
            echo "<script type='text/javascript'>alert('Incorrect password. Please enter the correct password to update details.')</script>";
        }
    }
}
?>
</html>
<?php
} else {
    echo "<script type='text/javascript'>alert('Access Denied!!!')</script>";
}
?>
