<!DOCTYPE html>
<html lang="eng">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body class="loginphp">
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
                <a href="login.php" style="<?= $CustomerID == '' ? 'visibility:visible':'visibility:hidden'?>">Login</a> &nbsp; &nbsp;
                <a href="signup.php"style="<?= $CustomerID == '' ? 'visibility:visible':'visibility:hidden'?>">Sign-Up</a> &nbsp;
                <a href="account.php?CustomerID=<?=$CustomerID?>"style="<?= $CustomerID == '' ? 'visibility:hidden':'visibility:visible'?>">Profile</a> &nbsp;
            </nav>
        </nav>
        
        <!-- Login Box -->
        <div class="box">
            <br><br><br> 
            <h1>Login</h1>
            <div class="input">
    <?php

        // Check if ticket IDs are present
        $DepartTicket="";
        $ReturnTicket="";
        if(isset($_GET['DepartTicket']) && $_GET['DepartTicket']!= '') {
            $DepartTicket=$_GET['DepartTicket'];
        }
        if(isset($_GET['ReturnTicket']) && $_GET['ReturnTicket']!= '') {
            $ReturnTicket=$_GET['ReturnTicket'];
        }
        if(isset($_GET['email']) && $_GET['email']!= '' 
                && isset($_GET['password']) && $_GET['password'] != '')
        {
            $email = $_GET['email'];
            $password = $_GET['password'];

            $conn = mysqli_connect("localhost", "root", "", "airport_db");
            /* check connection */ 
            if (!$conn) {
                printf("Connect failed: %s\n", mysqli_connect_error());
                exit();
            }

            // Search for the user in the customer table
            $sql = "SELECT CustomerID FROM `Customer` WHERE `email` = '$email' AND `password` = '$password';";
            $search_result = $conn -> query($sql);
            if ($search_result) {
                $row = mysqli_fetch_assoc($search_result);

                if ($row) {
                    $CustomerID =  $row["CustomerID"];
                    
                    // Redirect user based on ticket information
                    if ($DepartTicket != ''){
                        $redirectPage = "/airline/booking.php?DepartTicket=$DepartTicket&CustomerID=$CustomerID";
                        if ($ReturnTicket != '') {
                            $redirectPage = $redirectPage . "&ReturnTicket=$ReturnTicket";
                        }

                        header("Location: $redirectPage");
                        exit();
                    } else {
                        // Redirect to search page if no ticket ID is specified
                        $redirectPage = "/airline/index.php?CustomerID=$CustomerID";
                        header("Location: $redirectPage");
                        exit();
                    }

                } else {
                    // Email and password not found in the customer table
                    echo 'Invalid Email or Password.';
                }
            } 
            // Close the database connection
            mysqli_close($conn);
            
        } else {
            // Show an error message if the email and password are not provided
            if(isset($_GET['submit'])) {
                echo "Please Enter UserId and Password";
            }
        }
    ?>
                <!-- Login Form -->
                <form action='' method="get">
                    <br>
                    <input type='email' name='email' id="email" required placeholder="E-Mail">
                    <br><br>
                    <input type='password' name='password' id="password" required placeholder="Password">
                    <br><br>

                    <?php
                        // hidden variables for ticket information
                        echo "<input type='hidden' name='DepartTicket' value='$DepartTicket'>";
                        echo "<input type='hidden' name='ReturnTicket' value='$ReturnTicket'>";
                    ?>

                    <!-- Submit Button -->
                    <button type="submit" class="btn">Log In</button> <!-- <input type="submit" name="Submit" id="Submit"> -->
                </form>
                <br>
                <!-- Sign-up link with ticket information being passed -->
                <p>Don't have an account?</p> <a class="signup" href="/airline/signup.php?DepartTicket=<?=$DepartTicket?>&ReturnTicket=<?=$ReturnTicket?>"> Sign Up Here</a>
            </div>
        </div>
    </div>

    

</body>
</html>
