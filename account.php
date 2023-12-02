<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Account</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        $CustomerID = "";
        if (isset($_GET['CustomerID']) && $_GET['CustomerID'] != '') {
            $CustomerID = $_GET['CustomerID'];
        }
    ?>

    <div class="container">
        <nav class="navigation-bar">
            <a href="http://localhost/airline/">
                <img class="logo" src="logo.png">
            </a>

            <style>
                .logo {
                    width: 30px;
                    height: auto;
                }
            </style>

            <nav class="nav-links">
                <a href="login.php" style="<?= $CustomerID == '' ? 'visibility:visible' : 'visibility:hidden' ?>">Login</a> &nbsp; &nbsp;
                <a href="signup.php" style="<?= $CustomerID == '' ? 'visibility:visible' : 'visibility:hidden' ?>">Sign-Up</a> &nbsp;
                <a href="account.php?CustomerID=<?=$CustomerID?>" style="<?= $CustomerID == '' ? 'visibility:hidden' : 'visibility:visible' ?>">Profile</a> &nbsp;
            </nav>
        </nav>

        <br><br><br>

        <?php
            if (isset($_GET['CustomerID']) && ($_GET['CustomerID']) != '') {
                $CustomerID = $_GET['CustomerID'];
                $conn = mysqli_connect("localhost", "root", "", "airport_db");

                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                $sql = "SELECT firstname, lastname, email, phonenumber FROM `Customer` WHERE CustomerID=$CustomerID;";
                $result = mysqli_query($conn, $sql);

                if ($result) {
                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        mysqli_free_result($result);
                        mysqli_close($conn);
                    } else {
                        echo "No user found with the given customerID.";
                    }
                } else {
                    echo "Error: " . mysqli_error($conn);
                }
            }
        ?>

        <h1>Your Profile</h1>
        <table class="info" id="info">
            <tr>
                <th>Name:</th>
                <td><?php echo $row['firstname'].' '. $row['lastname']; ?></td>
            </tr>
            <tr>
                <th>Email:</th>
                <td><?php echo $row['email']; ?></td>
            </tr>
            <tr>
                <th>Phone Number:</th>
                <td><?php echo $row['phonenumber']; ?></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;">
                    <button class="btn" id="update-account"><a id="update-account" href="/airline/updateAccount.php?CustomerID=<?=$CustomerID?>">Update Information</a></button>
                </td>
            </tr>
        </table>
        <br>

        <h2>Your Bookings</h2>

        <?php
            if (isset($_GET['delete'])) {
                $deleteBookingID = $_GET['delete'];
                $conn = mysqli_connect("localhost", "root", "", "airport_db");

                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                $deleteSql = "DELETE FROM bookings WHERE BookingID = '$deleteBookingID'";
                $deleteResult = mysqli_query($conn, $deleteSql);

                if ($deleteResult) {
                    echo "Booking ID $deleteBookingID deleted successfully.";
                } else {
                    echo "Error deleting booking: " . mysqli_error($conn);
                }

                mysqli_close($conn);
            }

            $conn = mysqli_connect("localhost", "root", "", "airport_db");

            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $bookingsql = "SELECT b.BookingID, b.TicketID, b.BookingDate, b.customerID, a.COMPANY, a.email, a.phoneNumber ".
                "FROM Bookings b ".
                "JOIN Tickets t ON b.TicketID = t.TicketID ".
                "JOIN Airlines a on t.AirlineCode = a.AirlineCode ".
                "WHERE CustomerID = '$CustomerID'";

            $result = mysqli_query($conn, $bookingsql);

            if ($result) {
                if (mysqli_num_rows($result) > 0) {
                    while ($bookingData = mysqli_fetch_assoc($result)) {
                        echo "<div class='box' id='booking-card'>";
                        echo '<h2 style="color:#153eb8">Booking ID: ' . $bookingData['BookingID'] . '</h2>';
                        echo '<p><b>Booking Date:</b> ' . $bookingData['BookingDate'] . '</p>';
                        echo '<p><b>Airline: </b>' . $bookingData['COMPANY'] . '</p>';
                        echo '<p><b>Contact </b>'.$bookingData['COMPANY']. ': ' . $bookingData['email'] . '</p>';
                        echo '<p><b>Call </b>'. $bookingData['COMPANY'].': ' . $bookingData['phoneNumber'] . '</p>';
                        echo '<p><a href="?delete=' . $bookingData['BookingID'] . '&CustomerID=' . $CustomerID . '">Cancel Booking</a></p>';
                        echo '</div>';
                    }
                    echo '<br><br><br>';
                    mysqli_free_result($result);
                    mysqli_close($conn);
                } else {
                    echo "No bookings found for the given customerID.";
                }
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        ?>
    </div>
</body>
</html>
