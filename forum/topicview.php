<?php
include 'connection.php';
include 'header.php';


$tbl_name="posts"; // Table name 

$id=$_GET['id'];
$sql="SELECT id, topicname, content, pic FROM $tbl_name WHERE id = $id";
$result = $mysqli->query($sql);

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

    
    echo '</table>';
?>
<?php

$tbl_name2="topicreply"; // Switch to table "forum_answer"
$sql2="SELECT * FROM $tbl_name2 WHERE question_id='$id'";
$result2=mysqli_query($mysqli, $sql2);
while($rows=mysql_fetch_array($mysqli, $result2)){
?>

<table width="400" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
<tr>
<td><table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
<tr>
<td bgcolor="#F8F7F1"><strong>ID</strong></td>
<td bgcolor="#F8F7F1">:</td>
<td bgcolor="#F8F7F1"><?php echo $rows['a_id']; ?></td>
</tr>
<tr>
<td width="18%" bgcolor="#F8F7F1"><strong>Name</strong></td>
<td width="5%" bgcolor="#F8F7F1">:</td>
<td width="77%" bgcolor="#F8F7F1"><?php echo $rows['a_name']; ?></td>
</tr>
<tr>
<td bgcolor="#F8F7F1"><strong>Answer</strong></td>
<td bgcolor="#F8F7F1">:</td>
<td bgcolor="#F8F7F1"><?php echo $rows['a_answer']; ?></td>
</tr>
</table></td>
</tr>
</table><br>

<?php
}

$sql3="SELECT view FROM $tbl_name WHERE id='$id'";
$result3=mysqli_query($mysqli, $sql3);
$rows=mysql_fetch_array($result3);
$view=$rows['view'];

// if have no counter value set counter = 1
if(empty($view)){
$view=1;
$sql4="INSERT INTO $tbl_name(view) VALUES('$view') WHERE id='$id'";
$result4=mysqli_query($mysqli, $sql4);
}

// count more value
$addview=$view+1;
$sql5="update $tbl_name set view='$addview' WHERE id='$id'";
$result5=mysqli_query($mysqli, $sql5);
mysqli_close($mysqli);
?>

<BR>
<table width="400" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
<tr>
<form name="form1" method="post" action="reply.php">
<td>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
<tr>
<td width="18%"><strong>Name</strong></td>
<td width="3%">:</td>
<td width="79%"><input name="a_name" type="text" id="a_name" size="45"></td>
</tr>
<tr>
<td valign="top"><strong>Answer</strong></td>
<td valign="top">:</td>
<td><textarea name="a_answer" cols="45" rows="3" id="a_answer"></textarea></td>
</tr>
<tr>
<td>&nbsp;</td>
<td><input name="id" type="hidden" value="<?php echo $id; ?>"></td>
<td><input type="submit" name="Submit" value="Submit"> <input type="reset" name="Submit2" value="Reset"></td>
</tr>
</table>
</td>
</form>
</tr>
</table>
<?php
include 'footer.php';
?>
