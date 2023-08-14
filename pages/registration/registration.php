<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTRATION PAGE</title>
</head>
<body>
<form method="post" action="do_register.php" enctype="multipart/form-data">
    <label>username:<input type="text" id="username" name="username"> </label> <br>
    <label>password:<input type="password" id="password" name="password"> </label> <br>
    <label>avatar:<input type="file" id="avatar_img" name="avatar_img"> </label> <br>
    <input type="submit" value="Register">
    <a href='../auth/login.php'><input type="button" value="login"></a>

    </form>
</body>
</html>