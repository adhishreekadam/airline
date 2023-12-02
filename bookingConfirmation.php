<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Booking Page</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>

        <?php
            $CustomerID="";
            if(isset($_GET['CustomerID']) && $_GET['CustomerID']!= '') {
                $CustomerID=$_GET['CustomerID'];
            }
        ?>

        <div class="container">
            <nav class="navigation-bar">
            <a href="http://localhost/airline/">
                <img class="logo" src="logo.png"> 
            </a>

            <style>
                    /* Define a CSS class for the image */
                    .logo {
                        width: 30px;
                        height: auto; 
                    }
                    </style>

                <style>
                    /* Define a CSS class for the image */
                    .logo {
                        width: 30px; 
                        height: auto; 
                    }
                    </style>
                <nav class="nav-links">
                    <a href="login.php" style="<?= $CustomerID == '' ? 'visibility:visible':'visibility:hidden'?>">Login</a> &nbsp; &nbsp;
                    <a href="signup.php"style="<?= $CustomerID == '' ? 'visibility:visible':'visibility:hidden'?>">Sign-Up</a> &nbsp;
                    <a href="account.php?CustomerID=<?=$CustomerID?>"style="<?= $CustomerID == '' ? 'visibility:hidden':'visibility:visible'?>">Profile</a> &nbsp;
                </nav>
            </nav>

            <br><br><br>

            <?php

                if(isset($_GET['DepartTicket']) && $_GET['DepartTicket']!= '' 
                && isset($_GET['CustomerID']) && $_GET['CustomerID']!= '' )
                {
                    $DepartTicket = $_GET['DepartTicket'];
                    $CustomerID =$_GET['CustomerID'];

                    $conn = mysqli_connect("localhost", "root", "", "airport_db");
                    /* check connection */ 
                    if (!$conn) {
                        printf("Connect failed: %s\n", mysqli_connect_error());
                        exit();
                    }
                    //randomly generate booking id
                    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $bookingID = substr(str_shuffle($characters), 0, 5);

                    $sql = "INSERT INTO `Bookings` (`BookingID`, `BookingDate`, `customerID`, `TicketID`) VALUES ('$bookingID', CURRENT_DATE(), '$CustomerID', '$DepartTicket');";
                    $dBookingResult = $conn->query($sql);
                
                    if(isset($_GET['ReturnTicket']) && $_GET['ReturnTicket']!= '')
                    {
                        $ReturnTicket = $_GET['ReturnTicket'];
                        $sql = "INSERT INTO `Bookings` (`BookingID`, `BookingDate`, `customerID`, `TicketID`) VALUES ('$bookingID', CURRENT_DATE(), '$CustomerID', '$ReturnTicket');";
                        $rBookingResult = $conn->query($sql);
                    }
                    mysqli_close($conn);

                    echo "<table class='tableNoBorder'>";
                    
                        echo "<tr class='trtdNoBorder'><td class='trtdNoBorder'><h1>Congratulations!</h1></td></tr>";
                        echo "<tr class='trtdNoBorder'><td class='trtdNoBorder'><h2>You have successfully made a booking.</h2></td>";
                        echo "<tr class='trtdNoBorder'><td class='trtdNoBorder'><h2>Booking ID: ". $bookingID . "</h2></td>";
                        
                    echo"</table>";
                }
                else{
                    echo "Incorrect Information.";
                    echo "<br/>";
                    echo "<a href='/airline/index.php'>Click Here</a> to go to Search Flight page.";
                }
            ?>

        </div>
    </body>
</html>
