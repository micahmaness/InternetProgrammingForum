<?php
include 'connection.php';
include 'header.php';
 
$tbl_name="posts"; // Table name 
 
// Get value of id that sent from hidden field 
$id=$_POST['id'];
 
// Find highest answer number. 
$sql="SELECT MAX(a_id) AS Maxa_id FROM $tbl_name WHERE id='$id'";
$result=mysqli_query($mysqli, $sql);
$rows=mysql_fetch_array($result);
 
// add + 1 to highest answer number and keep it in variable name "$Max_id". if there no answer yet set it = 1 
if ($rows) {
$Max_id = $rows['Maxa_id']+1;
}
else {
$Max_id = 1;
}
 
// get values that sent from form 
$a_name=$_POST['a_name'];
$a_answer=$_POST['a_answer']; 
 
// Insert answer 
$sql2="INSERT INTO $tbl_name(question_id, a_id, a_name, a_answer)VALUES('$id', '$Max_id', '$a_name', '$a_answer')";
$result2=mysqli_query($mysqli, $sql2);
 
if($result2){
echo "Successful<BR>";
echo "<a href='viewtopic.php?id=".$id."'>View your answer</a>";
 
// If added new answer, add value +1 in reply column 
$tbl_name2="topicreply";
$sql3="UPDATE $tbl_name2 SET reply='$Max_id' WHERE id='$id'";
$result3=mysqli_query($mysqli, $sql3);
}
else {
echo "ERROR";
}
 
// Close connection
mysqli_close();
?>
<?php
include 'footer.php';
?>