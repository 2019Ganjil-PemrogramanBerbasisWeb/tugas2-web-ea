<?php
    if (isset($_COOKIE['member_login'])) {
        session_start();
        include 'db_con.php';
        if ($stmt = $con->prepare("SELECT id,username,validator  FROM accounts WHERE lookup = ?")) {
            $lookup = substr($_COOKIE['member_login'], 0, 12);
            $validator = substr($_COOKIE['member_login'], 12);
            $stmt->bind_param("s", $lookup);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0){
                $stmt->bind_result($id, $username, $dbvalidator);
                $stmt->fetch();
                if (hash_equals(hash('sha256', $validator), $dbvalidator)) {
                    $_SESSION['loggedin'] = TRUE;
                    $_SESSION['id'] = $id;
                    $_SESSION['name'] = $username;
                    header("Location: home.php");
                }
                
            }
            $stmt->close();
        }
    }
    if (isset($_SESSION['loggedin'])) {
        if ($_SESSION['loggedin'] == TRUE) {
            header("Location: home.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Authentication</title>
    <style>
        @charset "UTF-8";
        @import url(https://fonts.googleapis.com/css?family=Oswald|Roboto);
        body {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        font-family: "Roboto", sans-serif;
        background-color: #5356ad;
        overflow: hidden;
		}

        .table {
        display: table;
        width: 100%;
        height: 100%;
        }

        .table-cell {
        display: table-cell;
        vertical-align: middle;
        -moz-transition: all 0.5s;
        -o-transition: all 0.5s;
        -webkit-transition: all 0.5s;
        transition: all 0.5s;
        }

        .container {
        position: relative;
        width: 600px;
        margin: 30px auto 0;
        height: 320px;
        background-color: #999ede;
        top: 50%;
        margin-top: -160px;
        -moz-transition: all 0.5s;
        -o-transition: all 0.5s;
        -webkit-transition: all 0.5s;
        transition: all 0.5s;
        }
        .container .box {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
        }
        .container .box:before, .container .box:after {
        content: " ";
        position: absolute;
        left: 152px;
        top: 50px;
        background-color: #9297e0;
        transform: rotateX(52deg) rotateY(15deg) rotateZ(-38deg);
        width: 300px;
        height: 285px;
        -moz-transition: all 0.5s;
        -o-transition: all 0.5s;
        -webkit-transition: all 0.5s;
        transition: all 0.5s;
        }
        .container .box:after {
        background-color: #a5aae4;
        top: -10px;
        left: 80px;
        width: 320px;
        height: 180px;
        }
        .container .container-forms {
        position: relative;
        }
        .container .btn {
        cursor: pointer;
        text-align: center;
        margin: 0 auto;
        width: auto;
        color: #fff;
        background-color: #ff73b3;
        opacity: 1;
        -moz-transition: all 0.5s;
        -o-transition: all 0.5s;
        -webkit-transition: all 0.5s;
        transition: all 0.5s;
        }
        .container .btn:hover {
        opacity: 0.7;
        }
        .container .btn, .container input{
		padding: 10px 15px;
		text-align: center;
        }
        .container h2{
		padding: 0px 10px 15px;
        text-align: center;
        margin-top: 0px;
        }
        .container h4{
		padding: 5px 15px;
        text-align: center;
        margin-bottom: 0px;
        font-weight: normal;
        font-style: italic;
        }	
        .container input {
        margin: 0 auto 15px;
        display: block;
        width: 220px;
        -moz-transition: all 0.3s;
        -o-transition: all 0.3s;
        -webkit-transition: all 0.3s;
        transition: all 0.3s;
        }
        .container .container-forms .container-info {
        text-align: left;
        font-size: 0;
        }
        .container .container-forms .container-info .info-item {
        text-align: center;
        font-size: 16px;
        width: 300px;
        height: 320px;
        display: inline-block;
        vertical-align: top;
        color: #fff;
        opacity: 1;
        -moz-transition: all 0.3s;
        -o-transition: all 0.3s;
        -webkit-transition: all 0.3s;
        transition: all 0.3s;
        }
        .container .container-forms .container-info .info-item p {
        font-size: 20px;
        margin: 20px;
        }
        .container .container-forms .container-info .info-item .btn {
        background-color: transparent;
        border: 1px solid #fff;
        width: 60px;
        }
        .container .container-forms .container-info .info-item .table-cell {
        padding-right: 35px;
        }
        .container .container-forms .container-info .info-item:nth-child(2) .table-cell {
        padding-left: 35px;
        padding-right: 0;
        }
        .container .container-form {
        overflow: hidden;
        position: absolute;
        left: 30px;
        top: -30px;
        width: 305px;
        height: 380px;
        background-color: #fff;
        box-shadow: 0 0 15px 0 rgba(0, 0, 0, 0.2);
        -moz-transition: all 0.5s;
        -o-transition: all 0.5s;
        -webkit-transition: all 0.5s;
        transition: all 0.5s;
        }
        .container .container-form:before {
        content: "✔";
        position: absolute;
        left: 160px;
        top: -50px;
        color: #5356ad;
        font-size: 130px;
        opacity: 0;
        -moz-transition: all 0.5s;
        -o-transition: all 0.5s;
        -webkit-transition: all 0.5s;
        transition: all 0.5s;
        }
        .container .container-form .btn {
        border: none;
        position: relative;
        box-shadow: 0 0 10px 1px #ff73b3;
        margin-top: 30px;
        }
        .container .form-item {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        opacity: 1;
        -moz-transition: all 0.5s;
        -o-transition: all 0.5s;
        -webkit-transition: all 0.5s;
        transition: all 0.5s;
        }
        .container .form-item.sign-up {
        position: absolute;
        left: -100%;
        opacity: 0;
        }
        .container.log-in .box:before {
        position: absolute;
        left: 180px;
        top: 62px;
        height: 265px;
        }
        .container.log-in .box:after {
        top: 22px;
        left: 192px;
        width: 324px;
        height: 220px;
        }
        .container.log-in .container-form {
        left: 265px;
        }
        .container.log-in .container-form .form-item.sign-up {
        left: 0;
        opacity: 1;
        }
        .container.log-in .container-form .form-item.log-in {
        left: -100%;
        opacity: 0;
        }
        .container.active {
        width: 260px;
        height: 140px;
        margin-top: -70px;
        }
        .container.active .container-form {
        left: 30px;
        width: 200px;
        height: 200px;
        }
        .container.active .container-form:before {
        content: "✔";
        position: absolute;
        left: 51px;
        top: 5px;
        color: #5356ad;
        font-size: 130px;
        opacity: 1;
        }
        .container.active input, .container.active .btn, .container.active .info-item {
        display: none;
        opacity: 0;
        padding: 0px;
        margin: 0 auto;
        height: 0;
        }
        .container.active .form-item {
        height: 100%;
        }
        .container.active .container-forms .container-info .info-item {
        height: 0%;
        opacity: 0;
        }
        footer {
        display: flex;
        justify-content: center;
        padding: 15px;
        margin-top: 50px;
        background-color: #5356ad;
        color: #fff;
        }
        a {
            color: black;
            text-decoration: none;
            transition: 0.3s;
        }
        a:hover {
            text-shadow: 
    1px 0px 1px #ccc, 0px 1px 1px #eee, 
    2px 1px 1px #ccc, 1px 2px 1px #eee,
    3px 2px 1px #ccc, 2px 3px 1px #eee,
    4px 3px 1px #ccc, 3px 4px 1px #eee,
    5px 4px 1px #ccc, 4px 5px 1px #eee,
    6px 5px 1px #ccc, 5px 6px 1px #eee,
    7px 6px 1px #ccc;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="box"></div>
        <div class="container-forms">
            <div class="container-info">
                <div class="info-item">
                    <div class="table">
                        <div class="table-cell">
                            <p>Have an account?</p>
                            <div class="btn">Log in</div>
                        </div>
                    </div>
                </div>
                <div class="info-item">
                    <div class="table">
                        <div class="table-cell">
                            <p>Don't have an account?</p>
                            <div class="btn">Sign up</div>
                        </div>
                    </div>
                </div>
            </div>
        <div class="container-form">
            <div class="form-item log-in">
                <div class="table">
                    <form action="authenticate.php" method="post" class="table-cell">
                        <h2><a href="../index.php">e-Learning Academy Account</a></h2>
                        <h4>Remember me!</h4>
                        <input name="remember" type="checkbox" value="Remember me!">
                        <input name="username" placeholder="Username" type="text">
                        <input name="password" placeholder="Password" type="password">
                        <input type="submit" class="btn" value="Login">
                    </form>
                </div>
            </div>
            <div class="form-item sign-up">
                <div class="table">
                    <form action="registrar.php" method="post" class="table-cell">
                        <input name="email" placeholder="Email" type="text">
                        <input name="fullname" placeholder="Full Name" type="text">
                        <input name="username" placeholder="Username" type="text">
                        <input name="password" placeholder="Password" type="password">
                        <input type="submit" class="btn" value="Sign up">
                    </form>
                </div>
            </div>
 	</div>
    <script>    
        $(document).ready(function() {
            $(".info-item .btn").click(function() {
              $(".container").toggleClass("log-in");
            });
            $(".container-form .btn").click(function() {
               $(".container").addClass("active");
            });
        });
</script>
<footer>
    <p>Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved |</p>
</footer>    
</body>
</html>
