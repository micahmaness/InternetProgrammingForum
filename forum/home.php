<!--login page for the forum-->

<?php
    session_start();
    include"header.php";
    include"connection.php";
?>

<body>
    <div id='introduction'>
        <p>
            Welcome to the best forum on the internet!
        </p>
    </div>
<div>
<?php
    $signedin = array_key_exists('signed_in', $_SESSION) ? $_SESSION['signed_in'] : FALSE;
if(!$signedin)
{
    echo 'Sorry, you have to be <a class="item" href="/~tsnodderly/forum/login.php">logged in</a>.';
}
else
{
 //do a query for the topics
$sql = "SELECT id, topicname, content, author FROM posts";
         $result = $mysqli->query($sql);
         if(!$result)
        {
            echo 'The topics could not be displayed, please try again later.';
        }
        else
        {
            if(mysqli_num_rows($result) == 0)
            {
                echo 'There are no topics with this topic name.';
            }
            else
            {
                //prepare the table
                echo '<table align="center" border="1">
                      <tr>
                        <th>Topic</th>
                        <th>Author</th>
                      </tr>'; 
                while($row = mysqli_fetch_assoc($result))
                {               
                    echo '<tr>';
                        echo '<td class="leftpart">';
                            echo '<h3><a href="topicview.php?id=' . $row['id'] . '">' . $row['topicname'] . '</a></h3>';
                        echo '</td>';
                        echo '<td class="rightpart">'.$row['author'].'</td>';

                    echo '</tr>';
                }
            }
        }   
}
    
?>
    </div>
<!--
    <div id='wrapper'>
        <div id='content'>
            <form action='login.php' method='post'>
                Username: <input type='text' name='username' /><br>
                Password: <input type='password' name='password' /><br>
                <input type='submit' name='login' value='Log In' />
            </form>
        </div>
    </div>
-->
</body>
