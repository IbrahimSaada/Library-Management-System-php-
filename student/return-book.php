<?php
session_start();
require('config.php');

$checkusername = $_SESSION['username'];
$getUserSql = "SELECT * FROM `user` WHERE `username` = '$checkusername' AND role='user'";
$getUserResult = mysqli_query($con, $getUserSql);

if (mysqli_num_rows($getUserResult) > 0) {
    $id = $_GET['id'];

    $checkOverdueSql = "SELECT * FROM borrowedbooks WHERE bookID = '$id' AND username = '$checkusername' AND returndate IS NULL";
    $overdueResult = mysqli_query($con, $checkOverdueSql);

    if (mysqli_num_rows($overdueResult) > 0) {
        $row = mysqli_fetch_assoc($overdueResult);
        $issuedDate = strtotime($row['issuedate']);
        $currentDate = time();
        $overdueDays = floor(($currentDate - $issuedDate) / (60 * 60 * 24));

        $allowedDays = 15;
        $overdueFee = 10;

        if ($overdueDays > $allowedDays) {
            $fee = 10;
            $updateFeeSql = "UPDATE borrowedbooks SET fees = $fee WHERE bookID = '$id' AND username = '$checkusername'";
            mysqli_query($con, $updateFeeSql);
            echo "<script type='text/javascript'>alert('Book is overdue. Overdue fee: $$fee');</script>";
        }
    }
    $getAvailabilitySql = "SELECT availability FROM books WHERE bookID='$id'";
    $availabilityResult = mysqli_query($con, $getAvailabilitySql);

    if (mysqli_num_rows($availabilityResult) > 0) {
        $row = mysqli_fetch_assoc($availabilityResult);
        $currentAvailability = $row['availability'];
        $updatedAvailability = $currentAvailability + 1;
        $updateAvailableBooksSql = "UPDATE books SET availability = $updatedAvailability WHERE bookID='$id'";
        mysqli_query($con, $updateAvailableBooksSql);

        $updateReturnDateSql = "UPDATE borrowedbooks SET returndate = NOW() WHERE bookID = '$id' AND username = '$checkusername'";
        mysqli_query($con, $updateReturnDateSql);

        echo "<script type='text/javascript'>alert('Book Is Returned.');</script>";
        header("Refresh:0.01; url=current-borrowedbooks.php", true, 303);
    } else {
        echo "<script type='text/javascript'>alert('Error fetching book availability.');</script>";
    }
} else {
    echo "<script type='text/javascript'>alert('Access Denied!!!');</script>";
}
?>
