<?php
session_start();
require_once "database-feature.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["action"]) && $_POST["action"] === "register") {
        $username = trim($_POST["username"] ?? "");
        $password = trim($_POST["password"] ?? "");

        if ($username === "" || $password === "") {
            $message = "Please enter username and password.";
        } else {
            $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
            $stmt->execute([$username]);
            if ($stmt->fetch()) {
                $message = "Username already exists.";
            } else {
                $hash = password_hash($password, PASSWORD_BCRYPT);
                $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
                $stmt->execute([$username, $hash]);
                $message = "Registration successful. You can log in now.";
            }
        }
    }

    if (isset($_POST["action"]) && $_POST["action"] === "login") {
        $username = trim($_POST["username"] ?? "");
        $password = trim($_POST["password"] ?? "");

        if ($username === "" || $password === "") {
            $message = "Please enter username and password.";
        } else {
            $stmt = $pdo->prepare("SELECT id, password FROM users WHERE username = ?");
            $stmt->execute([$username]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user && password_verify($password, $user["password"])) {
                $_SESSION["user_id"] = $user["id"];
                $_SESSION["username"] = $username;
                header("Location: dashboard-feature.php");
                exit;
            } else {
                $message = "Invalid username or password.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Library Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f4f8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: #ffffff;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
            width: 320px;
        }
        h2 {
            margin-top: 0;
            text-align: center;
        }
        .tabs {
            display: flex;
            margin-bottom: 15px;
        }
        .tab {
            flex: 1;
            text-align: center;
            padding: 8px;
            cursor: pointer;
            background: #e5e9f0;
            border-radius: 4px 4px 0 0;
            margin-right: 2px;
            font-size: 14px;
        }
        .tab.active {
            background: #4c6ef5;
            color: #ffffff;
            font-weight: bold;
        }
        form {
            display: none;
        }
        form.active {
            display: block;
        }
        label {
            display: block;
            margin-top: 10px;
            font-size: 14px;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 7px;
            margin-top: 3px;
            border: 1px solid #ccd0d5;
            border-radius: 4px;
            font-size: 14px;
        }
        button {
            width: 100%;
            padding: 8px;
            margin-top: 15px;
            border: none;
            border-radius: 4px;
            background: #4c6ef5;
            color: #ffffff;
            font-size: 14px;
            cursor: pointer;
        }
        button:hover {
            background: #3b5bdb;
        }
        .message {
            margin-top: 10px;
            font-size: 13px;
            color: #d6336c;
            text-align: center;
            min-height: 18px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Library System</h2>
    <div class="tabs">
        <div class="tab active" id="loginTab">Login</div>
        <div class="tab" id="registerTab">Register</div>
    </div>

    <div class="message"><?php echo htmlspecialchars($message); ?></div>

    <form id="loginForm" class="active" method="post">
        <input type="hidden" name="action" value="login">
        <label>Username</label>
        <input type="text" name="username" required>
        <label>Password</label>
        <input type="password" name="password" required>
        <button type="submit">Login</button>
    </form>

    <form id="registerForm" method="post">
        <input type="hidden" name="action" value="register">
        <label>Username</label>
        <input type="text" name="username" required>
        <label>Password</label>
        <input type="password" name="password" required>
        <button type="submit">Register</button>
    </form>
</div>

<script>
    const loginTab = document.getElementById("loginTab");
    const registerTab = document.getElementById("registerTab");
    const loginForm = document.getElementById("loginForm");
    const registerForm = document.getElementById("registerForm");

    loginTab.addEventListener("click", () => {
        loginTab.classList.add("active");
        registerTab.classList.remove("active");
        loginForm.classList.add("active");
        registerForm.classList.remove("active");
    });

    registerTab.addEventListener("click", () => {
        registerTab.classList.add("active");
        loginTab.classList.remove("active");
        registerForm.classList.add("active");
        loginForm.classList.remove("active");
    });
</script>
</body>
</html>