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
   /* echo 'Reply to this post <a href="/~tsnodderly/forum/reply.php?id='.$id.'">here</a>.';
echo '<table width="400" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">';
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

    
    echo '</table>';*/

include 'footer.php';
?>
