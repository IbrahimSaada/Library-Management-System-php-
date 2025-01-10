<?php
session_start();
require('config.php');

$checkusername = $_SESSION['username'];
$getUserSql = "SELECT * FROM `user` WHERE `username` = '$checkusername' AND role='admin'";
$getUserResult = mysqli_query($con, $getUserSql);

if (mysqli_num_rows($getUserResult) > 0) {
    $id = $_GET['id1'];
    $username = $_GET['id2'];

    $reject = "DELETE FROM issuerequests WHERE username='$username' AND bookID='$id'";
    $result = mysqli_query($con, $reject);

    $message = "INSERT INTO message (username, bookID, message, time, date) VALUES ('$username', '$id', 'Your request for issue of BookId: $id has been rejected', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";

    $result3 = mysqli_query($con, $message);

    if ($result && $result3) {
        echo "<script type='text/javascript'>alert('Request rejected successfully and message sended')</script>";
        header("Refresh:0.01; url=issue_requests.php", true, 303);
    } else {
        echo "<script type='text/javascript'>alert('Error: " . mysqli_error($con) . "')</script>";
        header("Refresh:0.01; url=issue_requests.php", true, 303);
    }
} else {
    echo "<script type='text/javascript'>alert('Access Denied!!!')</script>";
    header("Refresh:0.01; url=issue_requests.php", true, 303);
}
?>
