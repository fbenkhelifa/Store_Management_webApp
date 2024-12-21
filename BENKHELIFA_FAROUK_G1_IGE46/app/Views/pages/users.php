<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="/BENKHELIFA_FAROUK_G1_IGE46/public/css/style.css">
    <script>
        function showForm() {
            const action = document.querySelector('input[name="action"]:checked').value;
            ['add', 'update', 'delete', 'search'].forEach(form => {
                document.getElementById(`${form}Form`).style.display = action === form ? 'block' : 'none';
            });
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Manage Users</h1>

        <!-- Action Selection -->
        <div>
            <label><input type="radio" name="action" value="add" onclick="showForm()"> Add</label>
            <label><input type="radio" name="action" value="update" onclick="showForm()"> Update</label>
            <label><input type="radio" name="action" value="delete" onclick="showForm()"> Delete</label>
            <label><input type="radio" name="action" value="search" onclick="showForm()"> Search</label>
        </div>

        <!-- Add User Form -->
        <div id="addForm" style="display: none;">
            <h2>Add User</h2>
            <form method="POST" action="/BENKHELIFA_FAROUK_G1_IGE46/public/users/store">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <select name="_role" required>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
                <button type="submit">Add</button>
            </form>
        </div>

        <!-- Update User Form -->
        <div id="updateForm" style="display: none;">
            <h2>Update User</h2>
            <form method="POST" action="/BENKHELIFA_FAROUK_G1_IGE46/public/users/update">
                <input type="number" name="id" placeholder="User ID" required>
                <input type="text" name="username" placeholder="Username">
                <input type="password" name="password" placeholder="Password">
                <select name="_role">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
                <button type="submit">Update</button>
            </form>
            <?php if (isset($_GET['error']) && $_GET['error'] === 'username_taken'): ?>
                <div class="error">The username is already taken. Please choose another one.</div>
            <?php endif; ?>

        </div>

        <!-- Delete User Form -->
        <div id="deleteForm" style="display: none;">
            <h2>Delete User</h2>
            <form method="POST" action="/BENKHELIFA_FAROUK_G1_IGE46/public/users/delete">
                <input type="number" name="id" placeholder="User ID" required>
                <button type="submit">Delete</button>
            </form>
        </div>

        <!-- Search User Form -->
        <div id="searchForm" style="display: none;">
            <h2>Search Users</h2>
            <form method="GET" action="/BENKHELIFA_FAROUK_G1_IGE46/public/users">
                <input type="text" name="search_name" placeholder="Search by Username">
                <button type="submit">Search</button>
            </form>
        </div>

        <!-- Display User List -->
        <h2>User List</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Role</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($users)): ?>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= htmlspecialchars($user['id']) ?></td>
                            <td><?= htmlspecialchars($user['username']) ?></td>
                            <td><?= htmlspecialchars($user['_role']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="4">No users found</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>