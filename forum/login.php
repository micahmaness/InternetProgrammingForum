<!--login page for the forum-->

<?php
session_start();
include 'connection.php';
include 'header.php';

echo '<h3>Sign in</h3>';
//checking to see if signed in already
if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true)
{
    echo 'You are already signed in' /*,<a href="signout.php">sign out</a>'*/;
}
else
{
    if($_SERVER['REQUEST_METHOD'] != 'POST')
    {
        echo '<form method="post" action="">
            Username: <input type="text" name="username" />
            Password: <input type="password" name="password" />
            <input type="submit" value="Sign in" />
         </form>';
    }
    else
    {
        $errors = array();
        if(!isset($_POST['username']))
        {
            $errors[] = 'The username field must not be empty.';
        }
         
        if(!isset($_POST['password']))
        {
            $errors[] = 'The password field must not be empty.';
        }
         
        if(!empty($errors))
        {
            echo 'Please fill out the username and password correctly:)';
            echo '<ul>';
            foreach($errors as $key => $value)
            {
                echo '<li>' . $value . '</li>';
            }
            echo '</ul>';
        }
        else
        {
            $sql = "SELECT username, password FROM Login WHERE username = '" . mysqli_real_escape_string($mysqli, $_POST['username']) . "' AND password = '" . ($_POST['password']) . "'";
            $result = mysqli_query($mysqli, $sql);
            if(!$result)
            {
                //something went wrong, display the error
                echo 'Something went wrong while signing in. Please try again later.';
                //echo mysql_error(); //debugging purposes, uncomment when needed
            }
            else
            {
                if(mysqli_num_rows($result) == 0)
                {
                    echo 'You have supplied a wrong user/password combination. Please try again.';
                }
                else
                {
                    $_SESSION['signed_in'] = true;
                    while($row = mysqli_fetch_assoc($result))
                    {
                        //$_SESSION['id'] = $row['id'];
                        $_SESSION['username'] = $row['username'];
                    }
                    echo 'Welcome, ' . $_SESSION['username'];
                }
            }
        }
    }
}
 
include 'footer.php';
?>