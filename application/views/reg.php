<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Registration</title>
    <link href="<?= base_url('system/css/style.css') ?>" rel="stylesheet" type="text/css"/>
    <style>
        body {
            background: #3e4144;
        }
        .form {
            margin: 50px auto;
            width: 300px;
            padding: 30px 25px;
            background: white;
        }
        h1.login-title {
            color: #666;
            margin: 0px auto 25px;
            font-size: 25px;
            font-weight: 300;
            text-align: center;
        }
        .login-input {
            font-size: 15px;
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 25px;
            height: 25px;
            width: calc(100% - 23px);
        }
        .login-input:focus {
            border-color:#6e8095;
            outline: none;
        }
        .login-button {
            color: #fff;
            background: #55a1ff;
            border: 0;
            outline: 0;
            width: 100%;
            height: 50px;
            font-size: 16px;
            text-align: center;
            cursor: pointer;
        }
        .link {
            color: #666;
            font-size: 15px;
            text-align: center;
            margin-bottom: 0px;
        }
        .link a {
            color: #666;
        }
        h3 {
            font-weight: normal;
            text-align: center;
        }
    </style>
</head>
<body>
    <form class="form" action="" method="post">
        <h1 class="login-title">Registration</h1>
        <input type="text" class="login-input" name="username" placeholder="Username" required />
        <input type="text" class="login-input" name="email" placeholder="Email Adress">
        <input type="password" class="login-input" name="password" placeholder="Password">
        <input type="submit" name="submit" value="Register" class="login-button">
        <p class="link"><a href="login">Click to Login</a></p>
    </form>
</body>
</html>
