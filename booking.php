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

                <nav class="nav-links">
                    <a href="login.php" style="<?= $CustomerID == '' ? 'visibility:visible':'visibility:hidden'?>">Login</a> &nbsp; &nbsp;
                    <a href="signup.php"style="<?= $CustomerID == '' ? 'visibility:visible':'visibility:hidden'?>">Sign-Up</a> &nbsp;
                    <a href="account.php?CustomerID=<?=$CustomerID?>"style="<?= $CustomerID == '' ? 'visibility:hidden':'visibility:visible'?>">Profile</a> &nbsp;
                </nav>
            </nav>

            <br><br><br><br><br>

            <?php
                $DepartTicket = "";
                $CustomerID = "";
                $ReturnTicket="";
                //get selected ticket id
                if(isset($_GET['DepartTicket']) && $_GET['DepartTicket']!= '') {
                    
                    $DepartTicket = $_GET['DepartTicket'];
                    
                    //connection
                    $conn = mysqli_connect("localhost", "root", "", "airport_db");
                    /* check connection */ 
                    if (!$conn) {
                        printf("Connect failed: %s\n", mysqli_connect_error());
                        exit();
                    }
                    //build query
                    $sql = "SELECT t.TicketID, t.DepartureCity, t.ArrivalCity, t.DepartureDate, t.ArrivalDate, t.DepartureTime, t.ArrivalTime, t.Price, a.COMPANY " . 
                            "FROM Tickets t " . 
                            "JOIN Airlines a ON t.AirlineCode = a.AirlineCode " .
                            "WHERE t.TicketID = \"$DepartTicket\";";

                    //run query
                   
                    $departResult = $conn->query($sql);
                  
                    //check whether customer id is provided or not in a variable named CustomerID
                    if(isset($_GET['CustomerID']) && $_GET['CustomerID']!= '')
                    {
                        //if provided make a database call to get customer information
                        $CustomerID = $_GET['CustomerID'];

                        //print welcome message
                        $sql = "SELECT * FROM `Customer` WHERE `CustomerID` = \"$CustomerID\";";
                        $customerResult = $conn->query($sql);
                        $customerRow = $customerResult->fetch_assoc();
                        echo "<h1>Welcome " . $customerRow["firstname"] . " " . $customerRow["lastname"]. "!</h1>";

                        $sql = "SELECT COUNT(BookingID) as booking_count FROM `Bookings` WHERE CustomerID=\"$CustomerID\";";
                        $count = $conn->query($sql);

                        //if number of bookings so far is >= 4 discounted price is shown
                        //if number is < 4 message is displayed
                        if ($count->num_rows > 0) {
                            $row = $count->fetch_assoc();
                            $bookingCount = $row['booking_count'];
                            
                            if($bookingCount >= 4)
                            {
                                $discount = 20;
                            }
                            if($bookingCount < 4)
                            {
                                $message = "<span style='color:#153eb8'>You are ". (4 - $bookingCount). " trips away from getting a discount.</span>";
                            }
                        }
                        else{
                            echo "No prior bookings were found.";
                        }
                    }
                
                    echo "<h2>Trip Summary</h2>";
                    echo "<br>";
                    if ($departResult->num_rows > 0) {
                    
                        $departRow = $departResult->fetch_assoc();
                       
                        echo "<div class='table-wrapper'>";
                        echo "<h3 id='return'> Departure Flight Details: </h3> <br>";
                        echo "<table class='tableNoBorder'>";
                       
                        echo "<tr class='trtdNoBorder'><td class='trtdNoBorder'>Departure Flight Date </td><td class='trtdNoBorder'>" . $departRow["DepartureDate"] . "</td></tr>";
                        echo "<tr class='trtdNoBorder'><td class='trtdNoBorder'>Departure </td><td class='trtdNoBorder'>" . $departRow["DepartureCity"] . "</td></tr>";
                        echo "<tr class='trtdNoBorder'><td class='trtdNoBorder'>Departure Time</td><td class='trtdNoBorder'>" . $departRow["DepartureTime"] . "</td></tr>";
                        echo "<tr class='trtdNoBorder'><td class='trtdNoBorder'>Arrival</td><td class='trtdNoBorder'>" . $departRow["ArrivalCity"] . "</td></tr>";
                        echo "<tr class='trtdNoBorder'><td class='trtdNoBorder'>Arrival Time</td><td class='trtdNoBorder'>" . $departRow["ArrivalTime"] . "</td></tr>";
                        echo "<tr class='trtdNoBorder'><td class='trtdNoBorder'>Airline</td><td class='trtdNoBorder'>" . $departRow["COMPANY"] . "</td></tr>";
                        echo "<tr class='trtdNoBorder'><td class='trtdNoBorder'>Price</td><td class='trtdNoBorder'>$" . $departRow["Price"] . "</td></tr>";
                        
                        echo "</div>";

                        if($discount > 0)
                        {
                            echo "<tr class='trtdNoBorder'><td class='trtdNoBorder'>Discounted Price</td><td class='trtdNoBorder'>$" . $departRow["Price"]-round($departRow["Price"]*$discount/100, 2) . "</td></tr>";
                        }
                        echo "</table>";
                        
                    }
                    //for return route 
                    if(isset($_GET['ReturnTicket']) && $_GET['ReturnTicket']!= '') {
                        
                        $ReturnTicket = $_GET['ReturnTicket'];
                        $sql = "SELECT t.TicketID, t.DepartureCity, t.ArrivalCity, t.DepartureDate, t.ArrivalDate, t.DepartureTime, t.ArrivalTime, t.Price, a.COMPANY " . 
                            "FROM Tickets t " . 
                            "JOIN Airlines a ON t.AirlineCode = a.AirlineCode " .
                            "WHERE t.TicketID = \"$ReturnTicket\";";
  
                        $returnResult = $conn->query($sql);
                        if ($returnResult->num_rows > 0) {
                    
                            $returnRow = $returnResult->fetch_assoc();
                            echo "<div class='table-wrapper' id='return'>";
                            echo "<h3 id='return'> Return Flight Details: </h3> <br>";
                            
                            echo "<table class='tableNoBorder'>";
                       
                            echo "<tr class='trtdNoBorder'><td class='trtdNoBorder'>Return Flight Date </td><td class='trtdNoBorder'>" . $returnRow["DepartureDate"] . "</td></tr>";
                            echo "<tr class='trtdNoBorder'><td class='trtdNoBorder'>Departure </td><td class='trtdNoBorder'>" . $returnRow["DepartureCity"] . "</td></tr>";
                            echo "<tr class='trtdNoBorder'><td class='trtdNoBorder'>Departure Time</td><td class='trtdNoBorder'>" . $returnRow["DepartureTime"] . "</td></tr>";
                            echo "<tr class='trtdNoBorder'><td class='trtdNoBorder'>Arrival</td><td class='trtdNoBorder'>" . $returnRow["ArrivalCity"] . "</td></tr>";
                            echo "<tr class='trtdNoBorder'><td class='trtdNoBorder'>Arrival Time</td><td class='trtdNoBorder'>" . $returnRow["ArrivalTime"] . "</td></tr>";
                            echo "<tr class='trtdNoBorder'><td class='trtdNoBorder'>Airline</td><td class='trtdNoBorder'>" . $returnRow["COMPANY"] . "</td></tr>";
                            echo "<tr class='trtdNoBorder'><td class='trtdNoBorder'>Price</td><td class='trtdNoBorder'>$" . $returnRow["Price"] . "</td></tr>";
                            
                            echo "</div>";

                            if($discount > 0)
                            {
                                echo "<tr class='trtdNoBorder'><td class='trtdNoBorder'>Discounted Price</td><td class='trtdNoBorder'>$". $departRow["Price"]-round($departRow["Price"]*$discount/100, 2) . "</td></tr>";
                            }
                            echo "</table>";
                        }
                    }
                    if($message != '')
                    {   
                        echo "&nbsp; &nbsp; &nbsp; &nbsp; ";
                        echo "<tr class='trtdNoBorder'><td class='trtdNoBorder'><span style='color:#153eb8''>Offer</span>: </td><td class='trtdNoBorder'>" . $message . "</td></tr>";
                    }

                    // if CustomerID is available continue to booking confirmation page
                    // else redirect to login page
                    $action='';
                    if(isset($_GET['CustomerID']) && $_GET['CustomerID']!= '')
                    {
                        $action = "bookingConfirmation.php";
                    }
                    else{
    
                        $action = "login.php";
                    }
                    echo "<form action=$action method='get'>";
                        if ($action == "bookingConfirmation.php") {

                            echo "<table class='tableNoBorder'>";
                            echo "<tr class='trtdNoBorder'><td class='trtdNoBorder'>Credit Card Number:</td><td class='trtdNoBorder'><input type='text' id='creditCardNumber' name='CreditCardNumber' placeholder='Enter your credit card number' style='width: 200px;' maxlength='16' required></td></tr>";
                            echo "<tr class='trtdNoBorder'><td class='trtdNoBorder'>Passport Number:</td><td class='trtdNoBorder'><input type='text' id='passportNumber' name='PassportNumber' placeholder='Enter your passport number' style='width: 200px;' maxlength='9' required></td></tr>";
                            
                            echo"</table>";
                        }
                        echo "<input type='hidden' name='DepartTicket' value='$DepartTicket'>";
                        echo "<input type='hidden' name='CustomerID' value='$CustomerID'>";
                        echo "<input type='hidden' name='ReturnTicket' value='$ReturnTicket'>";
                        echo "<br>";
                        echo "<input type='submit' id='confirm' name='BookingConfirmationPageButton' value='Confirm'>";

                    echo"</form>";
                }
                else {
                    echo "No Route Selected.";
                    
                    echo "<a href='/airline/index.php'>Click here to go back.</a>";

                }
                mysqli_close($conn);
            ?>
        </div>
    </body>
</html>


                


       
