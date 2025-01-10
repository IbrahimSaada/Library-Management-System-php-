<?php
session_start();
require('config.php');
?>
<?php
$checkusername=$_SESSION['username'];
$getUserSql = "SELECT * FROM `user` WHERE `username` = '$checkusername' AND role='admin'";
$getUserResult = mysqli_query($con, $getUserSql);
if ((mysqli_num_rows($getUserResult) > 0)) {
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
                        <i class="icon-reorder shaded"></i></a><a class="brand" href="index.php">LMS </a>
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
                                <li class="active"><a href="index-admin.php"><i class="menu-icon icon-home"></i>Home
                                </a></li>
                                 <li><a href="message.php"><i class="menu-icon icon-inbox"></i>Messages</a>
                                </li>
                                <li><a href="student.php"><i class="menu-icon icon-user"></i>Manage Students </a>
                                </li>
                                <li><a href="book.php"><i class="menu-icon icon-book"></i>All Books </a></li>
                                <li><a href="addbook.php"><i class="menu-icon icon-edit"></i>Add Books </a></li>
                                <li><a href="IssueReturn-Requests.php"><i class="menu-icon icon-tasks"></i>Issue/Return Requests </a></li>
                                <li><a href="borrowedbooks.php"><i class="menu-icon icon-list"></i>Currently Borrowed Books </a></li>
                            </ul>
                            <ul class="widget widget-menu unstyled">
                                <li><a href="logout.php"><i class="menu-icon icon-signout"></i>Logout </a></li>
                            </ul>
                        </div>
                        <!--/.sidebar-->
                    </div>
                    <!--/.span3-->
                    <!--/.span9-->
                    <div class="span9">
                    <div class="content">

                        <div class="module" id="er">
                            <div class="module-head">
                                <h3>Add Book</h3>
                            </div>
                            <div class="module-body">

                                    
                                    <br >

                                    <form class="form-horizontal row-fluid" action="addbook.php" method="post">
                                        <div class="control-group">
                                            <label class="control-label" for="bookname"><b>Book Title</b></label>
                                            <div class="controls">
                                                <input type="text" id="bookname" name="bookname" placeholder="Title" class="span8" required>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="bookauthor"><b>Author</b></label>
                                            <div class="controls">
                                                <input type="text" id="bookauthor" name="bookauthor" class="span8" required>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="Year"><b>Year</b></label>
                                            <div class="controls">
                                                <input type="text" id="year" name="year" placeholder="Year" class="span8" required>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="Availability"><b>Number of Copies</b></label>
                                            <div class="controls">
                                                <input type="text" id="availability" name="availability" placeholder="Number of Copies" class="span8" required>
                                            </div>
                                        </div>
                                        

                                        <div class="control-group">
                                            <div class="controls">
                                                <button type="submit" name="submit"class="btn">Add Book</button>
                                            </div>
                                        </div>
                                    </form>
                            </div>
                        </div>

                        
                        
                    </div><!--/.content-->
                </div>

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
        <script>window.location.hash = "#er";</script>';
<?php
if (isset($_POST['submit'])) {
    $title = mysqli_real_escape_string($con, $_POST['bookname']);
    $author = mysqli_real_escape_string($con, $_POST['bookauthor']);
    $year = mysqli_real_escape_string($con, $_POST['year']);
    $availability = mysqli_real_escape_string($con, $_POST['availability']);

    $sql1 = "INSERT INTO books (bookname, bookauthor, year, availability) VALUES ('$title', '$author', '$year', '$availability')";
    $result = mysqli_query($con, $sql1);

    if ($result) {
        $lastInsertedBookID = mysqli_insert_id($con);

        // Define $sql2 here
        $sql2 = "INSERT INTO editbooksby (username, bookID, action) VALUES ('$checkusername', '$lastInsertedBookID', 'add')";
        $result2 = mysqli_query($con, $sql2);

        if ($result2) {
            echo "<script type='text/javascript'>alert('Book added successfully')</script>";
        } else {
            echo "<script type='text/javascript'>alert('Error inserting into editbooksby: " . mysqli_error($con) . "')</script>";
        }
    } else {
        echo "<script type='text/javascript'>alert('Error adding book: " . mysqli_error($con) . "')</script>";
    }
}
?>
      
    </body>

</html>


<?php }
else {
    echo "<script type='text/javascript'>alert('Access Denied!!!')</script>";
} ?>