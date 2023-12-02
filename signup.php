<!DOCTYPE html>
<html lang="eng">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <!-- Navigation Bar -->
        <nav class="navigation-bar">
            <a href="http://localhost/airline/">
                <img class="logo" src="logo.png"> 
            </a>
            <!-- Styling for Logo -->
            <style>
                    /* Define a CSS class for the image */
                    .logo {
                        width: 30px; /* Set the width to your desired size */
                        height: auto; /* Maintain the aspect ratio */
                    }
                    </style>

            <!-- Navigation bar Links -->
            <nav class="nav-links">
                <a href="login.php">Login</a> &nbsp; &nbsp;
                <a href="signup.php">Sign-Up</a> &nbsp;
                <a href="account.php?CustomerID=<?=$CustomerID?>"style="<?= $CustomerID == '' ? 'visibility:hidden':'visibility:visible'?>">Profile</a> &nbsp;
            </nav>
        </nav>

    <!-- Sign-Up Box -->
    <div class="box">
    <br><br><br> 
    <h1>Create new account</h1>
    <div><h2></h2></div>
    <div class="input">

    <!-- Sign-Up Form -->
    <form action='' method="get">
        <!-- Include customerID and ticketID fields in your form if needed -->
        <input type='text' name='firstname' id="firstname" required placeholder="First Name"> <br> <br>

        <input type='text' name='lastname' id="lastname" required placeholder="Last Name"> <br> <br>

        <input type='email' name='email' id="email" required placeholder="E-Mail"> <br> <br>

        <input type='text' name='phonenumber' id="phonenumber" required placeholder="Phone Number"> <br> <br>

        <input type='password' name='password' id="password" required placeholder="Password"> <br> <br>

        <input type='password' name='confirm_password' id="confirm_password" required placeholder="Confirm Password"> <br><br>

        <?php
            // hidden varibales for ticket information
            echo "<input type='hidden' name='DepartTicket' value='$DepartTicket'>";
            echo "<input type='hidden' name='ReturnTicket' value='$ReturnTicket'>";
        ?>
        <!-- Submit Button -->
        <button type="submit" class="btn" name="submit">Sign Up</button> <!-- <input type="submit" name="Submit" id="Submit"> -->
 
    </form>
    </div>
    </div>

                

    <?php
    // Check if ticket IDs are available
    $DepartTicket="";
    $ReturnTicket="";
    if(isset($_GET['DepartTicket']) && $_GET['DepartTicket']!= '') {
        $DepartTicket=$_GET['DepartTicket'];
    }
    if(isset($_GET['ReturnTicket']) && $_GET['ReturnTicket']!= '') {
        $ReturnTicket=$_GET['ReturnTicket'];
    }

    if (isset($_GET['submit'])) 
    {
        $conn = mysqli_connect("localhost", "root", "", "airport_db");
        /* check connection */ 
        if (!$conn) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }

        // signup logic
        $firstname = $_GET['firstname'];
        $lastname = $_GET['lastname'];
        $email = $_GET['email'];
        $phonenumber = $_GET['phonenumber'];
        $password = $_GET['password'];
        $confirm_password = $_GET['confirm_password'];

        if ($password != $confirm_password) {
            echo 'Error: Passwords do not match';
        } 
        else {
            $sql = "INSERT INTO `Customer` (`firstname`, `lastname`, `email`, `phonenumber`, `password`) VALUES ('$firstname', '$lastname','$email', '$phonenumber', '$password');";

            $customerEntry = $conn -> query($sql);

            if($customerEntry)
            {
                // Get the last inserted ID
                $CustomerID = mysqli_insert_id($conn);
                if ($DepartTicket != ''){
                    $redirectPage = "/airline/booking.php?DepartTicket=$DepartTicket&CustomerID=$CustomerID";
                    if ($ReturnTicket != '') {
                        $redirectPage = $redirectPage . "&ReturnTicket=$ReturnTicket";
                    }
                    header("Location: $redirectPage");
                } else {
                    //no ticket id specified so send user to search page
                    $redirectPage = "/airline/index.php?CustomerID=$CustomerID";
                    header("Location: $redirectPage");
                }
                exit();
            }
            else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        // Close the database connection
        mysqli_close($conn);
    }
    ?>

    
</body>
</html>
