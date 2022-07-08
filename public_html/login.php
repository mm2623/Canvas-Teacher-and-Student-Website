<?php session_start();?>
<?php require_once "functions.php"; ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" href="style.css?v=1.1">

<?php
if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $data = array(
        'username' => $username,
        'password' => $password
    );

    $url = "https://afsaccess4.njit.edu/~mm2623/canvas/middle.php";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $result = curl_exec($ch);
    curl_close($ch);
}

$recieved_array = array();
$recieved_array = json_decode($result,true);
$email_recieved = $recieved_array['email_matched'];
$password_revieved = $recieved_array['password_matched'];
$status_recieved = $recieved_array['status'];

if ($status_recieved == "STUDENT"){
    $_SESSION["user"] = $username;
    $_SESSION["roles"] = $status_recieved;
    redirect('student.php');
}
if($status_recieved == "TEACHER"){
    $_SESSION["user"] = $username;
    $_SESSION["roles"] = $status_recieved;
    redirect('teacher.php');
}
if ($status_recieved == "NONE"){
    flash("INVALID CREDITIALS", "danger");
    //echo"<h1 style:color=red;><center>INVALID CREDITIALS</center></h1>";
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <div id="top"></div>

</head>

<body class="login-body">
    <b><h1 id=title>CANVAS</h1></b>
    <div class="loginbox">
        <h2><u>Login</u></h2>
        <form action method = "post">
            <p>Username</p>
            <input class="login-input-box" type="text" name="username" placeholder="Enter Username">
            <p>Password</p>
            <input class="login-input-box" type="password" name="password" placeholder="Enter Password"><br>
            <button class = "login-btn" type="submit" name="submit">LOGIN</button><br>
            <a href="#">Don't Have Account?</a><br>
            <a href="#">Forgot Password?</a>
        </form>
    </div>
</body>
<?php require_once 'flash.php' ?>
