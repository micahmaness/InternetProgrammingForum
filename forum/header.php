<!--header for forum-->
<!DOCTYPE html PUBLIC>
<html>

<head>


    <link rel="stylesheet" href="style.css">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>The Forum</title>
    <script> 
        function validateuser(user) {
            console.log("Is this running?");
            var obj = "Object=" + user;
            var request = new XMLHttpRequest();
            var url = "gethint.php";
            request.open("POST", url, true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.onreadystatechange = function() {
                if (request.readyState == 4 && request.status == 200) {
                    var return_data = request.responseText;
                    console.log(return_data);
                    return_data = JSON.parse(return_data);
                    if (return_data) {
                        document.getElementById('content').innerHTML = "USERNAME ALREADY TAKEN!";
                        document.getElementById('submit').disabled = true;
                        
                    } else {
                        document.getElementById('content').innerHTML = "";
                        document.getElementById('submit').disabled = false;
                    }
                    }
            }
            
            request.send(obj);
                }
            
            
        
        
        function addlistener() {
            document.getElementById('username').addEventListener('input', function(event){validateuser(document.getElementById('username').value)});
        }
        
        setTimeout(addlistener, 2000);
        
    </script>
</head>

<body>
    <h1>The Forum</h1>
    <div id="wrapper">
        <div id="menu">
            <a class="item" href="/~tsnodderly/forum/home.php">Home</a><br>
            <a class="item" href="/~tsnodderly/forum/createtopic.php">Create A New Topic</a>
        </div>
<div id="userbar">
<?php
    if(!isset($_SESSION)){session_start();}   
    if ($_SESSION){
    if($_SESSION['signed_in'])
    {
        echo 'Hello ' . $_SESSION['username'] .'<br><a class="item" href="signout.php">Sign out</a><br>';
    }
    }
    //else
    //{
      //  echo '<a class="item" href="/~tsnodderly/forum/login.php">Log in</a>';
    //}
?>
</div>
    </div>
    <div id="content"></div>
