<?php
include 'connection.php';
include 'header.php';

echo '<h3>Create A User</h3>'; 

    if($_SERVER['REQUEST_METHOD'] != 'POST') {

         
                echo '<form method="post" action="">
            Username: <input id="username" type="text" name="username" />
            Password: <input id="password" type="password" name="password" />
            <input id="submit" type="submit" value="Create User" />
            </form>';
        
    }

    else
    {
        
        
        //start the transaction
        $query  = "BEGIN WORK;";
        $result = mysqli_query($mysqli, $query);
         
        if(!$result)
        {
            echo 'An error occured while creating your username. Please try again later.';
        }
        else
        {
            $username = $_POST["username"];
            $password = $_POST["password"];
            
            $sql = "INSERT INTO Login (username, password)
                   values ('$username', '$password')";
            $result = mysqli_query($mysqli, $sql);
 
            if(!$result)
            {
                //something went wrong, display the error
                echo 'An error occured while inserting your data. Please try again later.' . mysqli_error($mysqli);
                $sql = "ROLLBACK;";
                $result = mysqli_query($mysqli, $sql);
            }
            else

                    $sql = "COMMIT;";
                    $result = mysqli_query($mysqli, $sql);
                    echo 'You have successfully created a new user. Please sign in <a href="/~tsnodderly/forum/login.php">here</a> to access the forum.';

                }
            }


 
include 'footer.php';
?>
