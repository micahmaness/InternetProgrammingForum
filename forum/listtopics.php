<?php
    include 'connection.php';
    include 'header.php';

    echo '<h3>All the topics on the Forum!</h3>';
    
    $signedin = array_key_exists('signed_in', $_SESSION) ? $_SESSION['signed_in'] : FALSE;
if(!$signedin)
{
    echo 'Sorry, you have to be <a href="/~tsnodderly/forum/login.php">logged in</a> to create a topic.';
}
else
{
    
    $sql = "SELECT * FROM posts";
    $result = $mysqli->query($sql);
    
    echo '<table>';
        echo '<tr>';
        echo '<th>Topic Name </th>';
        echo '<th>Content </th>';
        echo '<th>Author </th>';
        echo '</tr>';
    
    while($posts = $result-> fetch_assoc()) {
        echo '<tr>'.'<td>'.$posts['topicname'].'</td>'.'<td>'.$posts['content'].'</td>'.'<td>'.$posts['author'].'</td>'.'</tr>';
    }
    
    echo '</table>';
    
}
    include 'footer.php';
    ?>


header to refresh to page
<input type="file" name="imageUpload" id="imageUpload">
while($row = mysql_fetch_row($result)) {
    echo "<tr>";
    echo "<td><img src='uploads/$row[6].jpg' height='150px' width='300px'></td>";
    echo "</tr>\n";
}

