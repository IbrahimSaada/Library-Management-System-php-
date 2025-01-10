<?php
session_start();
require('config.php');

$checkusername = $_SESSION['username'];
$getUserSql = "SELECT * FROM `user` WHERE `username` = '$checkusername' AND role='admin'";
$getUserResult = mysqli_query($con, $getUserSql);

if (mysqli_num_rows($getUserResult) > 0) {
       if (isset($_POST['submit'])) {
        $searchTerm = mysqli_real_escape_string($con, $_POST['title']);
        $sql = "SELECT borrowedbooks.*, books.bookname
                    FROM borrowedbooks, books
                    WHERE borrowedbooks.bookID = books.bookID
                    AND (borrowedbooks.username LIKE '$searchTerm%'
                    OR borrowedbooks.bookID LIKE '$searchTerm%') AND borrowedbooks.returndate IS NULL;";
    } else {
        $sql = "SELECT borrowedbooks.*, books.bookname
                    FROM borrowedbooks, books
                    WHERE borrowedbooks.bookID = books.bookID AND borrowedbooks.returndate IS NULL;";
    }

    $result = mysqli_query($con, $sql);
    echo '<script>window.location.hash = "#tables";</script>';
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
                    <i class="icon-reorder shaded"></i>
                </a><a class="brand" href="index.php">LMS </a>
                <div class="nav-collapse collapse navbar-inverse-collapse">
                    <ul class="nav pull-right">
                        <li class="nav-user dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="images/user.png" class="nav-avatar" />
                                <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="index-admin.php">Your Profile</a></li>
                                <li class="divider"></li>
                                <li><a href="logout.php">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="wrapper">
        <div class="container">
            <div class="row">
                <div class="span3">
                    <div class="sidebar">
                        <ul class="widget widget-menu unstyled">
                            <li class="active"><a href="index-admin.php"><i class="menu-icon icon-home"></i>Home </a></li>
                            <li><a href="message.php"><i class="menu-icon icon-inbox"></i>Messages</a></li>
                            <li><a href="student.php"><i class="menu-icon icon-user"></i>Manage Students </a></li>
                            <li><a href="book.php"><i class="menu-icon icon-book"></i>All Books </a></li>
                            <li><a href="addbook.php"><i class="menu-icon icon-edit"></i>Add Books </a></li>
                            <li><a href="IssueReturn-Requests.php"><i class="menu-icon icon-tasks"></i>Issue/Return Requests </a></li>
                            <li><a href="borrowedbooks.php"><i class="menu-icon icon-list"></i>Currently Borrowed Books </a></li>
                        </ul>
                        <ul class="widget widget-menu unstyled">
                            <li><a href="logout.php"><i class="menu-icon icon-signout"></i>Logout </a></li>
                        </ul>
                    </div>
                </div>

                <div class="span9">
                    <form class="form-horizontal row-fluid" action="borrowedbooks.php" method="post">
                        <div class="control-group">
                            <label class="control-label" for="Search"><b>Search:</b></label>
                            <div class="controls">
                                <input type="text" id="title" name="title"
                                    placeholder="Enter username of a Student/Book ID." class="span8" required>
                                <button type="submit" name="submit" class="btn">Search</button>
                            </div>
                        </div>
                    </form>
                    <br>

                    <!-- Add the opening <table> tag here -->
                    <table class="table" id="tables">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Book ID</th>
                                <th>Book Name</th>
                                <th>Issue Date</th>
                                <th>Due Date</th>
                                <th>Return Date</th>
                                <th>Dues</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                                $username = $row['username'];
                                $bookid = $row['bookID'];
                                $bookname = $row['bookname'];
                                $issuedate = $row['issuedate'];
                                $duedate = $row['duedate'];
                                $returndate=$row['returndate'];
                                $dues = $row['fees'];
                                ?>
                                <tr>
                                    <td><?php echo strtoupper($username) ?></td>
                                    <td><?php echo $bookid ?></td>
                                    <td><?php echo $bookname ?></td>
                                    <td><?php echo $issuedate ?></td>
                                    <td><?php echo $duedate ?></td>
                                     <td><?php echo $returndate ?></td>
                                    <td><?php
                                        if ($dues > 0)
                                            echo "<font color='red'>" . $dues . "</font>";
                                        else
                                            echo "<font color='green'>0</font>";
                                        ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="footer">
        <div class="container">
            <b class="copyright">&copy; 2024 Library Management System </b>All rights reserved.
        </div>
    </div>

    <!-- Your existing script tags -->
    <script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
    <script src="scripts/flot/jquery.flot.resize.js" type="text/javascript"></script>
    <script src="scripts/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <
<?php }
else {
    echo "<script type='text/javascript'>alert('Access Denied!!!')</script>";
} ?>