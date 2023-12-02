<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Airline Homepage</title>
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
                        width: 30px; /* Set the width to your desired size */
                        height: auto; /* Maintain the aspect ratio */
                    }
                    </style>

                <nav class="nav-links">
                    <a href="login.php" id="loginlink"style="<?= $CustomerID == '' ? 'visibility:visible':'visibility:hidden'?>">Login</a> &nbsp; &nbsp;
                    <a href="signup.php"style="<?= $CustomerID == '' ? 'visibility:visible':'visibility:hidden'?>">Sign-Up</a> &nbsp;
                    <a href="account.php?CustomerID=<?=$CustomerID?>"style="<?= $CustomerID == '' ? 'visibility:hidden':'visibility:visible'?>">Profile</a> &nbsp;
                </nav>
            </nav>

            <br><br><br>    

            <form action="" method="get">
                <?php
                    $discount=0;
                    $message="";

                    echo "<input type='hidden' name='CustomerID' value='$CustomerID'>";
                ?>
                <div class="row">
                    <div class="wrapper" id="index">
                        <input type="date" name="DepartureDate" required id="date" placeholder="Depart:&nbsp;" value="<?= isset($_GET['DepartureDate'])  == true ? $_GET['DepartureDate']:''?>" class="form-control"> &nbsp;
                        <input type="date" name="ReturnDate" id="date" placeholder="Return:&nbsp;" value="<?= isset($_GET['ReturnDate'])  == true ? $_GET['ReturnDate']:''?>" class="form-control"> &nbsp;
                    </div>
                    <br>
                    <div class="wrapper">

                       <!-- Assigning the chosen values to variables if selected otherwise left blank to pass into the form -->
                        <label>
                            <select name="DepartureCity" required>
                                <option value="">Departing City</option>
                                <option value="Hartsfield-Jackson Int, United States" 
                                    <?= isset($_GET['DepartureCity'])  == true ? ($_GET['DepartureCity'] == 'Hartsfield-Jackson Int, United States' ? 'selected':'') : '' ?>> 
                                    Atlanta, Georgia
                                </option>
                                <option value="Buenos Aires, Argentina" 
                                    <?= isset($_GET['DepartureCity'])  == true ? ($_GET['DepartureCity'] == 'Buenos Aires, Argentina' ? 'selected':'') : '' ?>>
                                    Buenos Aires, Argentina
                                </option>
                                <option value="Istanbul, Turkey" 
                                    <?= isset($_GET['DepartureCity'])  == true ? ($_GET['DepartureCity'] == 'Istanbul, Turkey'? 'selected':'') : ''?>>
                                    Istanbul, Turkey
                                </option>
                                <option value="Sydney, Australia" 
                                    <?= isset($_GET['DepartureCity'])  == true ? ($_GET['DepartureCity'] == 'Sydney, Australia'? 'selected':'') : ''?>>
                                    Sydney, Australia
                                </option>
                                <option value="John F Kennedy Intl, United States" 
                                    <?= isset($_GET['DepartureCity'])  == true ? ($_GET['DepartureCity'] == 'John F Kennedy Intl, United States'? 'selected':'') : ''?>>
                                    Queens, New York
                                </option>
                                <option value="Jeju International Airport, South Korea" 
                                    <?= isset($_GET['DepartureCity'])  == true ? ($_GET['DepartureCity'] == 'Jeju International Airport, South Korea'? 'selected':'') : ''?>>
                                    Jeju City, South Korea
                                </option>
                                <option value="Paris, France" 
                                    <?= isset($_GET['DepartureCity'])  == true ? ($_GET['DepartureCity'] == 'Paris, France'? 'selected':'') : ''?>>
                                    Paris, France
                                </option>
                                <option value="Beijing Capital International, China" 
                                    <?= isset($_GET['DepartureCity'])  == true ? ($_GET['DepartureCity'] == 'Beijing Capital International, China'? 'selected':'') : ''?>>
                                    Beijing, China
                                </option>
                                <option value="LaGuardia Airport, New York" 
                                    <?= isset($_GET['DepartureCity'])  == true ? ($_GET['DepartureCity'] == 'LaGuardia Airport, New York'? 'selected':'') : ''?>>
                                    LaGuardia Airport, New York
                                </option>
                                <option value="Incheon International Airport, South Korea" 
                                    <?= isset($_GET['DepartureCity'])  == true ? ($_GET['DepartureCity'] == 'Incheon International Airport, South Korea'? 'selected':'') : ''?>>
                                    Seoul, South Korea
                                </option>
                                
                            </select>
                        </label> &nbsp; &nbsp; &nbsp; &nbsp;

                        <!--Display for the City Drop Down.-->

                        <label>
                          
                            <select name="ArrivalCity">
                                <option value="">Arrival City</option>

                                <option value="Hartsfield-Jackson Int, United States">Atlanta, Georgia</option>
                                <option value="Beijing Capital International, China">Beijing, China</option>
                                <option value="Istanbul, Turkey">Istanbul, Turkey</option>
                                <option value="Jeju International Airport, South Korea">Jeju Island, South Korea</option>
                                <option value="Sydney, Australia">Sydney, Australia</option>
                                <option value="John F Kennedy Intl, United States">Queens, New York</option>
                                <option value="Paris, France">Paris, France</option>
                                <option value="LaGuardia Airport, New York">LaGuardia Airport, New York</option>
                                <option value="Incheon International Airport, South Korea">Seoul, South Korea</option>
                                <option value="Buenos Aires, Argentina">Buenos Aires, Argentina</option>

                            </select> 
                        </label> &nbsp; &nbsp;
                        <button type="submit" class="btn">Search</button> &nbsp; &nbsp;
                        
                        <button onclick="window.location.href'http://localhost/airline/'" class="btn">Reset</button>
                    </div> &nbsp; &nbsp;
                </div>
            </form>
            


            <div id="result">
                    <!--Beginning of PHP code.-->
                    <?php

                        $conn = mysqli_connect("localhost", "root", "", "airport_db");

                        /* check connection */ 
                        if (!$conn) {
                            printf("Connect failed: %s\n", mysqli_connect_error());
                            exit();
                        }
                        /* close connection */

                        if(isset($_GET['DepartureDate']) && $_GET['DepartureDate']!= '' 
                        && isset($_GET['DepartureCity']) && $_GET['DepartureCity'] != ''
                        && isset($_GET['ArrivalCity']) && $_GET['ArrivalCity'] != '')
                        { 
                            $departure_date = $_GET['DepartureDate'];
                            $departure_city= $_GET['DepartureCity'];
                            $arrival_city= $_GET['ArrivalCity'];

                            $sql = "SELECT t.TicketID, t.DepartureCity, t.ArrivalCity, t.DepartureDate, t.ArrivalDate, t.DepartureTime, t.ArrivalTime, t.Price, a.COMPANY " . 
                                "FROM Tickets t " . 
                                "JOIN Airlines a ON t.AirlineCode = a.AirlineCode " .
                                "WHERE t.DepartureDate = '$departure_date' " . 
                                "AND t.DepartureCity = '$departure_city' " . 
                                "AND t.ArrivalCity = '$arrival_city' ";  

                            $result = $conn -> query($sql);
                         
                            if($result->rows = 0)
                            {
                                echo "No Results Found";
                            }

                            //count the number of previous bookings for the specific CustomerID
                            if ($CustomerID != '') 
                            {
                                $sql = "SELECT COUNT(b.BookingID) as booking_count " . 
                                    " FROM `Bookings` b " .
                                    " WHERE b.CustomerID=\"$CustomerID\";";
                                $count = $conn->query($sql);

                                //if number of bookings so far is >= 4 then show discounted price
                                //if number is < 4 displaying a message
    
                                if ($count->num_rows > 0) {
                                    $row = $count->fetch_assoc();
                                    $bookingCount = $row['booking_count'];
                                    if($bookingCount >= 4)
                                    {
                                        $discount = 20;
                                    }
                                    if($bookingCount < 4)
                                    {
                                        $message = "You are ". (4 - $bookingCount). " trips away from getting a discount.";
                                    }
                                }
                            }

                            if(isset($_GET['ReturnDate']) && $_GET['ReturnDate'] != '')
                            {
                                $return_date = $_GET['ReturnDate'];
            
                                echo "<br/>";
                                $sql = "SELECT t.TicketID, t.DepartureCity, t.ArrivalCity, t.DepartureDate, t.ArrivalDate, t.DepartureTime, t.ArrivalTime, t.Price, a.COMPANY " . 
                                "FROM Tickets t " . 
                                "JOIN Airlines a ON t.AirlineCode = a.AirlineCode " .
                                "WHERE t.DepartureDate = '$return_date' " . 
                                "AND t.DepartureCity = '$arrival_city' " . 
                                "AND t.ArrivalCity = '$departure_city' " ;  
                             
                                echo "<br/>";
                                $returnResult = $conn -> query($sql);
                            }
                        }

                        /*Creates the visual table.*/
                        echo "<form action='booking.php' method='get'>";
                        if ($message != "")
                        {
                            echo "$message<br/>";
                        }
                        if($result->num_rows > 0)
                        {
                            ?>
                            <div class="table-wrapper">
                            <table>
                              
                                <tr>
                                    <th>Departure City</th>
                                    <th>Arrival City</th>
                                    <th>Departure Date</th>
                                    <th>Arrival Date</th>
                                    <th>Departure Time</th>
                                    <th>Arrival Time</th>
                                    <th>Airline</th>
                                    <th>Price</th>
                                    <?php
                                        if($discount > 0)
                                        {
                                            echo "<th>Discounted Price</th>";
                                        }
                                    ?>
                                    <th>Book</th>
                                </tr>
                        <?php
                            
                            while ($row = $result->fetch_assoc())
                            {
                                echo "<tr>" .
                                        "<td>" . $row["DepartureCity"] . "</td>" .
                                        "<td>". $row["ArrivalCity"] . "</td>" .
                                        "<td>" . $row["DepartureDate"] . "</td>" .
                                        "<td>" . $row["ArrivalDate"] . "</td>" .
                                        "<td>" . $row["DepartureTime"] . "</td>" .
                                        "<td>" . $row["ArrivalTime"] . "</td>" .
                                        "<td>" . $row["COMPANY"] . "</td>" .
                                        "<td>" . $row["Price"] . "</td>";
                                if($discount > 0)
                                {
                                    echo "<td>" . ($row["Price"]-round($row["Price"]*$discount/100, 2)) . "</td>";
                                }
                                echo "<td style='text-align:center;'><input type='radio' name='DepartTicket' value='" . $row["TicketID"] . "'></td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                                                    
                        }
                        
                        if(isset($_GET['ReturnDate']) && $_GET['ReturnDate'] != '')
                        {
                            if($returnResult->num_rows > 0)
                            {
                                ?>
                                <table>
                                    <tr>
                                        <td colspan = "8" style="text-align: center;">
                                            Return Flights
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Departure City</th>
                                        <th>Arrival City</th>
                                        <th>Departure Date</th>
                                        <th>Arrival Date</th>
                                        <th>Departure Time</th>
                                        <th>Arrival Time</th>
                                        <th>Airline</th>
                                        <th>Price</th>
                                    <?php
                                        if($discount > 0)
                                        {
                                            echo "<th>Discounted Price</th>";
                                        }
                                    ?>
                                        <th>Book</th>
                                    </tr>
                                <?php
                                while ($row = $returnResult->fetch_assoc())
                                {
                                    echo "<tr>".
                                            "<td>" . $row["DepartureCity"] . "</td>" .
                                            "<td>". $row["ArrivalCity"] . "</td>" .
                                            "<td>" . $row["DepartureDate"] . "</td>" .
                                            "<td>" . $row["ArrivalDate"] . "</td>" .
                                            "<td>" . $row["DepartureTime"] . "</td>" .
                                            "<td>" . $row["ArrivalTime"] . "</td>" . 
                                            "<td>" . $row["COMPANY"] . "</td>" .
                                            "<td>" . $row["Price"] . "</td>" ;
                                            if($discount > 0)
                                            {
                                                echo "<td>" . $row["Price"]-round($row["Price"]*$discount/100, 2) . "</td>";
                                            }
                                            echo "<td style='text-align:center;'><input type='radio' name='ReturnTicket' value='" . $row["TicketID"] . "'></td>";
                                            echo "</tr>";
                                }
                                echo "</table>";   
                            }
                          
                        }
                        ?>
                        </table>
                    </div> <br>
                    <?php
                        echo "<input type='hidden' name='CustomerID' value='$CustomerID'>";
                        
                        echo "<input type='submit' id='book' name='BookingPageButton' value='Book'>";
                        
                        echo "</form>";
                        mysqli_close($conn);
                    ?>
                
            </div>
        </div>
    </body>
</html>
