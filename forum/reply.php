<?php
include 'connection.php';
include 'header.php';

echo '<h3>Reply to a Topic</h3>'; 
$id=$_GET['id'];
$signedin = array_key_exists('signed_in', $_SESSION) ? $_SESSION['signed_in'] : FALSE;
if(!$signedin)
{
    echo 'Sorry, you have to be <a href="/~tsnodderly/forum/login.php">logged in</a> to create a topic.';
}
else
{
 
if($_SERVER['REQUEST_METHOD'] != 'POST') {

         
                echo '<form method="post" action="topicview.php" enctype="multipart/form-data">';

                echo 'Message: <textarea name="content" /></textarea>
                      <input type="file" name="pic" />
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
            echo 'An error occured while creating your topic. Please try again later.';
        }
        else
        {
            $reply = $_POST["content"];
            $username = $_SESSION["username"];
            
    $pic = $_FILES["pic"]; 

    //Process the image that is uploaded by the user
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($pic["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

    if (move_uploaded_file($pic["tmp_name"], $target_file)) {
        echo "The file ". basename( $pic["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }

    $image = $target_dir.basename( $pic["name"]); // used to store the filename in a variable




            
            
            $sql = "INSERT INTO topicreply (a_name, a_answer)
                   values ($reply', '$username')";

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
                header("Location: topicview.php?id='.$id.'");

                }
            }
    }
}
include 'footer.php';
?>