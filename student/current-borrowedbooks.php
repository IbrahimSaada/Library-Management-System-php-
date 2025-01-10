<?php
session_start();
require('config.php');
?>
<?php
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
                                <img src="images/user.png" class="nav-avatar"/>
                                <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="index-student.php">Your Profile</a></li>
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
                            <li class="active"><a href="index-student.php"><i class="menu-icon icon-home"></i>Home
                                </a></li>
                            <li><a href="message.php"><i class="menu-icon icon-inbox"></i>Messages</a>
                            </li>
                            <li><a href="book.php"><i class="menu-icon icon-book"></i>All Books </a></li>
                            <li><a href="current-borrowedbooks.php"><i class="menu-icon icon-list"></i>Currently Borrowed Books </a>
                            </li>
                        </ul>
                        <ul class="widget widget-menu unstyled">
                            <li><a href="logout.php"><i class="menu-icon icon-signout"></i>Logout </a></li>
                        </ul>
                    </div>
                </div>
                <div class="span9">
                    <form class="form-horizontal row-fluid" action="current-borrowedbooks.php" method="post">
                        <div class="control-group">
                            <label class="control-label" for="Search"><b>Search:</b></label>
                            <div class="controls">
                                <input type="text" id="title" name="title"
                                       placeholder="Enter Book Name" class="span8" required>
                                <button type="submit" name="submit" class="btn">Search</button>
                            </div>
                        </div>
                    </form>
                    <br>
                    <?php
                    $username = $_SESSION['username'];
                    if (isset($_POST['submit'])) {
                        $s = $_POST['title'];
                    $sql = "SELECT * FROM borrowedbooks, books WHERE borrowedbooks.bookID = books.bookID AND borrowedbooks.username = '$username' AND (bookname = '$s' OR bookname LIKE '%$s%') AND borrowedbooks.returndate is NULL";
                    } else {
                        $sql = "SELECT * FROM borrowedbooks, books WHERE borrowedbooks.bookID = books.bookID AND borrowedbooks.username = '$username' AND borrowedbooks.returndate is NULL";
                    }

                    $result = $con->query($sql);
                    $rowcount = mysqli_num_rows($result);

                    if (!$rowcount) {
                        echo "<br><center><h2><b><i>No Results</i></b></h2></center>";
                    } else {
                        ?>
                        <table class="table" id="tables">
                            <thead>
                            <tr>
                                <th>Book id</th>
                                <th>Book name</th>
                                <th>Issue Date</th>
                                <th>Due date</th>
                                <th>Return Date</th>
                                <th>Fees</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            while ($row = $result->fetch_assoc()) {
                                $bookid = $row['bookID'];
                                $name = $row['bookname'];
                                $issuedate = $row['issuedate'];
                                $duedate = $row['duedate'];
                                $returndate = $row['returndate'];
                                $fees = $row['fees'];
                                ?>
                                <tr>
                                    <td><?php echo $bookid ?></td>
                                    <td><?php echo $name ?></td>
                                    <td><?php echo $issuedate ?></td>
                                    <td><?php echo $duedate ?></td>
                                    <td><?php echo $returndate ?></td>
                                    <td><?php echo $fees ?></td>
                                    <td><center>
                                            <a href="return-book.php?id=<?php echo $bookid; ?>"class="btn btn-primary">Return</a>
                                        </center></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    <?php } ?>
                </div>
            </div>
        </div>
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
    <!-- Your existing script tags -->
    </body>

    </html>

    <?php
} else {
    echo "<script type='text/javascript'>alert('Access Denied!!!')</script>";
}
?>
