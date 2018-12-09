<?php
include 'connection.php';
include 'header.php';

echo '<h3>Create A Topic</h3>'; 
$signedin = array_key_exists('signed_in', $_SESSION) ? $_SESSION['signed_in'] : FALSE;
if(!$signedin)
{
    echo 'Sorry, you have to be <a href="/~tsnodderly/forum/login.php">logged in</a> to create a topic.';
}
else
{
    if($_SERVER['REQUEST_METHOD'] != 'POST') {

         
                echo '<form method="post" action="createtopic.php" enctype="multipart/form-data">
                    Topic: <input id="submit" type="text" name="topicname" /><br><br><br>';

                echo 'Message: <textarea class="messageBox" name="content" /></textarea><br><br><br>
                      <input type="file" name="pic" />
                    <input id="submit" type="submit" value="Create topic" name="submit" />
                 </form>';

                
                
            }

    else
    {
        if (empty($_POST['topicname'])) {
            echo 'The topic name field is empty. Please enter a topic name.';
        } else {
        //start the transaction
        $query  = "BEGIN WORK;";
        $result = mysqli_query($mysqli, $query);
         
        if(!$result)
        {
            echo 'An error occured while creating your topic. Please try again later.';
        }
        else
        {
            $topicname = $_POST["topicname"];
            $content = $_POST["content"];
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




            
            
            $sql = "INSERT INTO posts (topicname, content, author, pic)
                   values ('$topicname', '$content', '$username', '$image')";
            
            /*$sql = "INSERT INTO posts(topicname, content, author)
                   VALUES(" . mysqli_real_escape_string($mysqli, $_POST['topicname']) . ", " . mysqli_real_escape_string($mysqli, $_POST['content']) . "," . $_SESSION['username'] . ")";*/
                // TS switched the session to username instead of id.
                      
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
                    header("Location: home.php");
                    // TS changed ->
                    /*echo 'You have successfully created <a href="topicview.php?id='. $topicid . '">your new topic</a>.';*/
                }
            }
    }
}}
 
include 'footer.php';
?>
