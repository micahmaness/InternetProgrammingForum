<?php
include 'connection.php';
include 'header.php';

echo '<h3>Reply to a Topic</h3>'; 
$id=$_GET['id'];
$signedin = array_key_exists('signed_in', $_SESSION) ? $_SESSION['signed_in'] : FALSE;
if(!$signedin)
{
    echo 'Sorry, you have to be <a href="/~tsnodderly/forum/login.php">logged in</a> to reply.';
}
else
{
 
if($_SERVER['REQUEST_METHOD'] != 'POST') {

         
                echo '<form method="post" action="reply.php?id='.$id.'" enctype="multipart/form-data">';

                echo 'Message: <textarea name="content" /></textarea>
                    <input id="submit" type="submit" value="Reply" name="submit" />
                 </form>';

                
                
            }

    else
    {
        //start the transaction
        $query  = "BEGIN WORK;";
        $result = mysqli_query($mysqli, $query);
         
        if(!$result)
        {
            echo 'An error occured while creating your reply. Please try again later';
        }
        else
        {
            $reply = $_POST["content"];
            $username = $_SESSION["username"];
            
   
            $sql = "INSERT INTO reply (id, reply, author) VALUES ('$id', '$reply', '$username')";

            $result = mysqli_query($mysqli, $sql);
            if(!$result)
            {
                //something went wrong, display the error
                echo 'An error occured while inserting your data. Please try again later.' . mysqli_error($mysqli);
                $sql = "ROLLBACK;";
                $result = mysqli_query($mysqli, $sql);
            }
            else
                {
                    $sql = "COMMIT;";
                    $result = mysqli_query($mysqli, $sql);
                    echo 'You have successfully replied.';
                    header("Location: topicview.php?id=$id");

                }
            }
    }
}
include 'footer.php';
?>
