
<html >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: white;
            color: white;
        }
        .container {
            max-width: 800px;
            height: 500px; /* Set a fixed height for the container */
            margin: 150px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .form, .image {
            flex: 1;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #8e44ad;
            font-size: 24px;
        }
        form {
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
            color: #333;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #8e44ad;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #6c3483;
        }
        .btn-back {
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            text-decoration: none;
            cursor: pointer;
            font-size: 16px;
            display: inline-block;
            transition: background-color 0.3s;
        }
        .btn-back:hover {
            background-color: #2980b9;
        }
        .image img {
            width: 100%;
            height: 100%; 
            object-fit: cover; 
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
    </style>
</head>
<body>
    <div class="container">
        <div class="form">
            <h1>Login</h1>
            <form action="login_adminAction.php" method="POST">
                <label for="email">Email:</label><br>
                <input type="text" id="email" name="email"><br>
                <label for="password">Password:</label><br>
                <input type="password" id="password" name="password"><br>
                <input type="submit" value="Login">
                <p style="color: black;">Don't have an account? <a href="signup_admin.php">Sign up</a></p> 
            </form>
        </div>
        <div class="image">
            <img src="../images/2.jfif" alt="Image">
        </div>
    </div>
</body>
</html>
