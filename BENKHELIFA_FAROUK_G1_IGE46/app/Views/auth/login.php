<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/BENKHELIFA_FAROUK_G1_IGE46/public/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Login</h1>

        <?php if (isset($_GET['error'])): ?>
            <p style="color: red;"><?php echo htmlspecialchars($_GET['error']); ?></p>
        <?php endif; ?>

        <form action="/BENKHELIFA_FAROUK_G1_IGE46/public/login" method="POST">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" required>
            
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
            
            <button type="submit">Login</button> 
        </form>
    </div>
</body>
</html>
