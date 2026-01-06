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
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Library System Login</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
* {
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

body {
    background: linear-gradient(135deg, #4c6ef5, #364fc7);
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 0;
}

.container {
    background: #ffffff;
    width: 360px;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.2);
    animation: fadeIn 0.5s ease-in-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(15px); }
    to { opacity: 1; transform: translateY(0); }
}

h2 {
    text-align: center;
    font-weight: 600;
    margin-bottom: 20px;
    color: #343a40;
}

.tabs {
    display: flex;
    background: #f1f3f5;
    border-radius: 8px;
    overflow: hidden;
    margin-bottom: 20px;
}

.tab {
    flex: 1;
    padding: 10px;
    text-align: center;
    cursor: pointer;
    font-size: 14px;
    color: #495057;
    transition: 0.3s;
}

.tab.active {
    background: #4c6ef5;
    color: #fff;
    font-weight: 500;
}

form {
    display: none;
}

form.active {
    display: block;
}

label {
    font-size: 13px;
    color: #495057;
    margin-top: 12px;
    display: block;
}

input {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border-radius: 6px;
    border: 1px solid #ced4da;
    font-size: 14px;
    transition: border 0.3s;
}

input:focus {
    outline: none;
    border-color: #4c6ef5;
}

button {
    width: 100%;
    padding: 10px;
    margin-top: 20px;
    background: #4c6ef5;
    color: #fff;
    border: none;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: background 0.3s;
}

button:hover {
    background: #3b5bdb;
}

.message {
    text-align: center;
    font-size: 13px;
    color: #e03131;
    min-height: 18px;
    margin-bottom: 10px;
}
</style>
</head>

<body>
<div class="container">
    <h2>📚 Library System</h2>

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

        <button type="submit">Sign In</button>
    </form>

    <form id="registerForm" method="post">
        <input type="hidden" name="action" value="register">
        <label>Username</label>
        <input type="text" name="username" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit">Create Account</button>
    </form>
</div>

<script>
const loginTab = document.getElementById("loginTab");
const registerTab = document.getElementById("registerTab");
const loginForm = document.getElementById("loginForm");
const registerForm = document.getElementById("registerForm");

loginTab.onclick = () => {
    loginTab.classList.add("active");
    registerTab.classList.remove("active");
    loginForm.classList.add("active");
    registerForm.classList.remove("active");
};

registerTab.onclick = () => {
    registerTab.classList.add("active");
    loginTab.classList.remove("active");
    registerForm.classList.add("active");
    loginForm.classList.remove("active");
};
</script>
</body>
</html>
