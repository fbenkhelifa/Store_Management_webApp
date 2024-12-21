<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="/BENKHELIFA_FAROUK_G1_IGE46/public/css/dashboard.css"> <!-- Ensure correct path to your stylesheet -->
</head>
<body>
    <main>
        <div class="container">
            <h1>Welcome to the Store Management System</h1>
            <p class="subtitle">Choose an option from the menu to manage the application.</p>

            <div class="dashboard-options">
                <ul>
                    <li><a href="/BENKHELIFA_FAROUK_G1_IGE46/public/clients" class="btn">Manage Clients</a></li>
                    <li><a href="/BENKHELIFA_FAROUK_G1_IGE46/public/products" class="btn">Manage Products</a></li>
                    <li><a href="/BENKHELIFA_FAROUK_G1_IGE46/public/bills" class="btn">Manage Bills</a></li>

                    <?php if ($_SESSION['_role'] === 'admin'): ?>
                        <li><a href="/BENKHELIFA_FAROUK_G1_IGE46/public/workers" class="btn admin-link">Manage Workers</a></li>
                        <li><a href="/BENKHELIFA_FAROUK_G1_IGE46/public/users" class="btn admin-link">Manage Users</a></li>
                    <?php endif; ?>

                    <li><a href="/BENKHELIFA_FAROUK_G1_IGE46/public/logout" class="btn logout">Logout</a></li>
                </ul>
            </div>
        </div>
    </main>
</body>
</html>
