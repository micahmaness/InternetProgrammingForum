<?php
    include 'connection.php';
    
    $obj = $_POST['Object'];
    $query = "SELECT count(*) c FROM Login WHERE username = '$obj'";
    $result = mysqli_query($mysqli, $query);
    $row = $result -> fetch_assoc();

    $c = $row['c'] > 0;
    $c = json_encode($c);
    echo $c;
?>