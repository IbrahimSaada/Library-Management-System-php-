<?php
session_start();
require('config.php');

$checkusername = $_SESSION['username'];
$getUserSql = "SELECT * FROM `user` WHERE `username` = '$checkusername' AND role='user'";
$getUserResult = mysqli_query($con, $getUserSql);

if ($getUserResult) {
    $id = $_GET['id'];
    $username = $checkusername;

    // Check if the user has already borrowed 3 books
    $checkBorrowedBooksSql = "SELECT COUNT(*) AS total FROM borrowedbooks WHERE username = '$username' AND returndate IS NULL";
    $checkBorrowedBooksResult = mysqli_query($con, $checkBorrowedBooksSql);

    if ($checkBorrowedBooksResult) {
        $row = mysqli_fetch_assoc($checkBorrowedBooksResult);
        $totalBorrowedBooks = $row['total'];

        if ($totalBorrowedBooks >= 3) {
            echo "<script type='text/javascript'>alert('You have already borrowed the maximum number of books (3).')</script>";
            header("Refresh:0.01; url=book.php", true, 303);
        } else {
            // Check if the user has already requested 3 books
            $checkRequestedBooksSql = "SELECT COUNT(*) AS total FROM issuerequests WHERE username = '$username'";
            $checkRequestedBooksResult = mysqli_query($con, $checkRequestedBooksSql);

            if ($checkRequestedBooksResult) {
                $rowRequested = mysqli_fetch_assoc($checkRequestedBooksResult);
                $totalRequestedBooks = $rowRequested['total'];

                if ($totalRequestedBooks >= 3) {
                    echo "<script type='text/javascript'>alert('You have already requested the maximum number of books (3).')</script>";
                    header("Refresh:0.01; url=book.php", true, 303);
                } else {
                    // Check if a request or borrowing already exists for the same book
                    $checkExistingSql = "(SELECT username, BookID, issuedate FROM issuerequests WHERE username = '$username' AND BookID = '$id')
                                        UNION
                                        (SELECT username, bookID, issuedate FROM borrowedbooks WHERE username = '$username' AND bookID = '$id' AND returndate IS NULL)";
                    $checkExistingResult = mysqli_query($con, $checkExistingSql);

                    if ($checkExistingResult) {
                        if (mysqli_num_rows($checkExistingResult) > 0) {
                            echo "<script type='text/javascript'>alert('You have already requested or borrowed this book.')</script>";
                            header("Refresh:0.01; url=book.php", true, 303);
                        } else {
                            $sql = "INSERT INTO issuerequests (username, BookID, issuedate) VALUES ('$username', '$id', NOW())";
                            $result = mysqli_query($con, $sql);

                            if ($result) {
                                echo "<script type='text/javascript'>alert('Request Sent to Admin.')</script>";
                                header("Refresh:0.01; url=book.php", true, 303);
                            } else {
                                echo "<script type='text/javascript'>alert('Error Sending Request.')</script>";
                                header("Refresh:0.01; url=book.php", true, 303);
                            }
                        }
                    } else {
                        echo "<script type='text/javascript'>alert('Error checking existing requests/borrowings: " . mysqli_error($con) . "')</script>";
                        header("Refresh:0.01; url=book.php", true, 303);
                    }
                }
            } else {
                echo "<script type='text/javascript'>alert('Error checking requested books: " . mysqli_error($con) . "')</script>";
                header("Refresh:0.01; url=book.php", true, 303);
            }
        }
    } else {
        echo "<script type='text/javascript'>alert('Error checking borrowed books: " . mysqli_error($con) . "')</script>";
        header("Refresh:0.01; url=book.php", true, 303);
    }
} else {
    echo "<script type='text/javascript'>alert('Access Denied!!!')</script>";
}
?>
