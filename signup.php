<?php
    include_once 'header.php';
?>

<link rel="stylesheet" href="css/signup.css" type="text/css">
<title>Sign Up</title>

    <main>
        <section>
            <div class="content">
                <form action = "includes/signup.inc.php"  method = "post">
                    <h1>Sign Up</h1>
                    <p>
                        <label>
                            Name:<br>
                            <input type="text"  name="name" required>
                        </label>
                    </p>
                    <p>
                        <label>
                            Username:<br>
                            <input type="text"  name="username" required>
                        </label>
                    </p>
                     <p>
                        <label>
                            Email:<br>
                            <input type="text"  name ="email" required>
                        </label>
                    </p>
                    <p>
                        <label>
                            Password:<br>
                            <input type="password"  name="password" required>
                        </label>
                    </p>
                     <p>
                        <label>
                             Repeat Password:<br>
                            <input type="password"  name="passwordRep" required>
                        </label>
                    </p>
                    <!-- <p><br><a href=" #" class="button">Register</a> -->
                    <p><br><button type ="submit" name ="submit">Sign Up</button>
                </form>

                <div>
                    <p><a href="login.php" class="logLink">Already Have An Account? Sign in Here!</a>
                    </p>
                </div>

                <center>
                 <br><br>
             <?php
                if(isset($_GET["error"])){
                    if($_GET["error"] == "invalidusername"){
                        echo "<p>The username entered  is invalid!</p>";
                    }
                    else if($_GET["error"] == "invalidemail"){
                        echo "<p> The email entered is invalid! </p>";
                    }
                    else if($_GET["error"] == "passwordsdontmatch"){
                        echo "<p>Passwords do not match!</p>";
                    }
                    else if($_GET["error"] == "usernameexists"){
                        echo "<p>A profile is already using this username or email!</p>";
                    }  else if($_GET["error"] == "noerror"){
                        echo "<p>Signup Successful!</p>";
                    }
                }
                ?>
            </center>
        

            </div>
        
             
        </section>
    </main>


</body>
</html>