<?php
include_once 'loginHeader.php'
?>
<link rel="stylesheet" href="css/login.css" type="text/css">
<title>Log In</title>

<div class = 'bodyStyle'>
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


                    <p><br><button type = "submit" name ="submit">Log In</button>

                    </p>

                </form>

                <div>
                    <p><a href="signup.php" class="regLink">Don't Have an Account? Sign Up Here!</a>
                    </p>
                </div>



            </div>

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
</div>


</body>

</html>