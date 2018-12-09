<?php
include 'connection.php';
include 'header.php';


$tbl_name="posts"; // Table name 

$id=$_GET['id'];
$sql="SELECT id, topicname, content, pic FROM $tbl_name WHERE id = $id";
$result = $mysqli->query($sql);

    echo '<table class="topicviewtable" width="400" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">';
        echo '<tr>';
        echo '<td><table width="100%" border="0" cellpadding="3" cellspacing="1" bordercolor="1" bgcolor="#FFFFFF">';
    
$posts = $result-> fetch_assoc();
        echo '<tr>'.'<td bgcolor="#F8F7F1">'.'<strong>'.$posts['topicname'].'</strong>'.'</td>'.'</tr>';
        echo '<tr>';
            echo '<td bgcolor="#F8F7F1">' . $posts['content'];
            echo '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td>' . '<img src="'.$posts['pic'].'"/>';
            echo '</td>';
            echo '</tr>';

        echo '</table>'.'</td>';
    echo '</tr>';


    echo '</table>';
   echo '<a class="item" href="/~tsnodderly/forum/reply.php?id='.$id.'">Reply to this post here.</a> <br> <br>';



echo '<table width="400" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">';

$sql2="SELECT id, reply, author FROM reply where id=$id";
$result2 = $mysqli->query($sql2);
$reply = $result2-> fetch_assoc();

         $result2 = $mysqli->query($sql2);
         if(!$result2)
        {
            echo 'This topic has no replies.';
        }
        else
        {
            if(mysqli_num_rows($result2) == 0)
            {
                echo 'This topic has no replies.';
            }
            else
            {
                //prepare the table
                echo '<table align="center" border="1">
                      <tr>
                        <th>Author</th>
                        <th>Response</th>
                      </tr>'; 
                while($row = mysqli_fetch_assoc($result2))
                {               
                    echo '<tr>';
                        echo '<td class="leftpart">';
                            echo '<h3>' . $row['author'] . '</a></h3>';
                        echo '</td>';
                        echo '<td class="rightpart">'.$row['reply'].'</td>';

                    echo '</tr>';
                }
            }
        }

    echo '</table>';



//include 'footer.php';
?>
