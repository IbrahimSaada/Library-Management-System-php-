<?php
session_start();
require('config.php');

$checkusername = $_SESSION['username'];
$getUserSql = "SELECT * FROM `user` WHERE `username` = '$checkusername' AND role='admin'";
$getUserResult = mysqli_query($con, $getUserSql);

if ((mysqli_num_rows($getUserResult) > 0)) {
    if (isset($_GET['id1'], $_GET['id2'], $_GET['id3'], $_GET['id4'])) {
        $bookid = $_GET['id1'];
        $username = $_GET['id2'];
        $date = $_GET['id3'];
        $avail=$_GET['id4'];
        $defaultDueDate = date('Y-m-d', strtotime($date . ' + 15 days'));
        $sql = "INSERT INTO borrowedbooks (username, bookID, issuedate, duedate, fees) VALUES ('$username', '$bookid', '$date', '$defaultDueDate', 0)";
        $result = mysqli_query($con, $sql);

        if ($result) {
            $delete = "DELETE FROM issuerequests WHERE username='$username' AND bookID='$bookid'";
            $result1 = mysqli_query($con, $delete);
            $update = "UPDATE books SET availability = ($avail - 1) WHERE bookID = '$bookid'";
            $result2 = mysqli_query($con, $update);
            $message = "INSERT INTO message (username, bookID, message, time, date) VALUES ('$username', '$bookid', 'Your request for issue of BookId: $bookid has been accepted', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
            $result3 = mysqli_query($con, $message);

            if ($result1 && $result2 && $result3) {
                echo "<script type='text/javascript'>alert('Book borrowed successfully and message sended')</script>";
                header("Refresh:0.01; url=issue_requests.php", true, 303);
            } else {
                echo "<script type='text/javascript'>alert('Error on delete query: " . mysqli_error($con) . "')</script>";
                header("Refresh:0.01; url=issue_requests.php", true, 303);
            }
        } else {
            echo "<script type='text/javascript'>alert('Error')</script>";
            header("Refresh:0.01; url=issue_requests.php", true, 303);
        }
    } else {
        echo "<script type='text/javascript'>alert('Invalid parameters')</script>";
        header("Refresh:0.01; url=issue_requests.php", true, 303);
    }
} else {
    echo "<script type='text/javascript'>alert('Access Denied!!!')</script>";
    header("Refresh:0.01; url=issue_requests.php", true, 303);
}
?>
