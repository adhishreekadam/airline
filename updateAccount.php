<!DOCTYPE html>
<html lang="eng">
<head>
    <meta charset="UTF-8">
    <title>Update Information</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
        <?php
            $CustomerID="";
            if(isset($_GET['CustomerID']) && $_GET['CustomerID']!= '') {
                $CustomerID=$_GET['CustomerID'];
            }
            if ($CustomerID == '') {
                if(isset($_POST['CustomerID']) && $_POST['CustomerID']!= '') {
                    $CustomerID=$_POST['CustomerID'];
                }
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
        
        <br><br><br>   

        <div class="container">
            <?php
            $message = "";
            if($CustomerID != '') {
                $CustomerExists = true;
                $conn = mysqli_connect("localhost", "root", "", "airport_db");
                
                // Check the connection
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }
                //Check whether Submit button on this form is clicked or not
                //If it is clicked that means we are here because user has changed 
                //the information and want to update.
                //declare all the fields that we want to display

                $firstname=$_POST['firstname'];
                $lastname=$_POST['lastname'];
                $email=$_POST['email'];
                $phonenumber = $_POST['phonenumber'];

                if ($_SERVER["REQUEST_METHOD"] == "POST" && $firstname != '' 
                    && $lastname != '' && $email != '' && $phonenumber != '')
                {
                    $update_sql = "UPDATE `customer` SET firstname = '$firstname'" .
                            ", lastname = '$lastname' " .
                            ", email = '$email'" .
                            ", phonenumber = '$phonenumber'" .
                            " WHERE CustomerID=" . $CustomerID ;
                    $result = mysqli_query($conn, $update_sql);
                    if ($result) {
                        $message = " Update Successful ";
                    }
                } 
                else {
                    //either some of the fields are empty or the page is loading for the first time
                    if (isset($_POST['submit'])) {
                        //show message saying all fields are required
                        $message = "Please enter all the fields";
                    } else {
                        //first time execution without any changes- data is taken from Database and displayed
                        $sql = "SELECT firstname, lastname, email, phonenumber FROM `customer` WHERE CustomerID=$CustomerID;";
                        $result = mysqli_query($conn, $sql);
                     
                        // check if the query was successful
                        if ($result) {
                            if (mysqli_num_rows($result) > 0) {
                                $row = mysqli_fetch_assoc($result);
                                $firstname = $row['firstname'];
                                $lastname = $row['lastname'];
                                $email = $row['email'];
                                $phonenumber = $row['phonenumber'];
                            } else
                            {
                                $CustomerExists = false;
                                $message = "Customer does not exist";
                            }
                        } else
                        {
                            $CustomerExists = false;
                            $message = "Customer does not exist";
                        }
                    }
                }

                if ($CustomerExists == true) {
                    echo"<h1>Update Your Information</h1>";

                    echo"<div class='box' id='update'>";
                        // form to update customer information
                        echo"<form action='updateAccount.php' method='post'>";
                            echo"<label for='message'>$message</label><br>";
                            echo"<label for='firstname'>First Name:</label>&nbsp;";
                            echo"<input type='text' id='entry' name='firstname' value=$firstname><br>";
                            echo"<br>";

                            echo"<label for='lastname'>Last Name:</label>&nbsp;";
                            echo"<input type='text' id='entry' name='lastname' value=$lastname><br>";
                            echo"<br>";

                            echo"<label for='email'>Email:</label>&nbsp;";
                            echo"<input type='text' id='entry' name='email' value=$email><br>";
                            echo"<br>";

                            echo"<label for='phonenumber'>Phone Number:</label>&nbsp;";
                            echo"<input type='text' id='entry' name='phonenumber' value=$phonenumber><br>";
                            echo"<br>";
                    
                            echo"<input type='hidden' name='CustomerID' value='$CustomerID'>";

                            echo"<br>";
                
                            echo"<input type='submit' class='btn' id='update'name='submit' value='Update Information'> ";
                    
                        echo"</form>";
                    echo"</div>";
                } 
                else {
                    //this is the case when customer doesn't exists at all
                    echo"<label for='message'>$message</label><br>";
                }
                
                mysqli_close($conn);
            }
            ?>
        </div> 
    </div>
</body>
</html>
