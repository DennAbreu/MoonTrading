<?php
include_once 'header.php'
?>

<link rel="stylesheet" href="css/login.css" type="text/css">
<title>Log In</title>

    <main>
        <section>
            <div class="content">

                <form action ="includes/login.inc.php"  method="post">
                    <h1>Sign In</h1>
                    <p>

                        <label>
                            Username/Email:<br>
                            <input type="text"  name ="uname" required>
                        </label>
                    </p>
                    <p>

                        <label>
                            Password:<br>
                            <input type="password"  name="password" required>
                        </label>
                    </p>


                    <!-- <p><br><a href=" #" class="button">Login</a> -->

                    <p><br><button type = "submit" name ="submit">Log In</button>

                    </p>

                </form>

                <div>
                    <p><a href="signup.php" class="regLink">Don't Have an Account? Sign Up Here!</a>
                    </p>
                </div>



            </div>

            <center>
                 <br><br>
             <?php
if (isset($_GET["error"])) {
    if ($_GET["error"] == "incorrectlogin") {
        echo "<p>Incorrect username or email!</p>";
    } else if ($_GET["error"] == "incorrectpassword") {
        echo "<p> Incorrect Password! </p>";
    }

}
?>
            </center>

        </section>


    </main>


</body>

</html>