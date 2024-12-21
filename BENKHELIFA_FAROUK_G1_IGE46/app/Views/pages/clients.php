<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Clients</title>
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
        <h1>Manage Clients</h1>
        <div>
            <label><input type="radio" name="action" value="add" onclick="showForm()"> Add</label>
            <label><input type="radio" name="action" value="update" onclick="showForm()"> Update</label>
            <label><input type="radio" name="action" value="delete" onclick="showForm()"> Delete</label>
            <label><input type="radio" name="action" value="search" onclick="showForm()"> Search</label>
        </div>

        <!-- Add Client Form -->
        <div id="addForm" style="display: none;">
            <h2>Add Client</h2>
            <form method="POST" action="/BENKHELIFA_FAROUK_G1_IGE46/public/clients/add">
                <input type="text" name="name" placeholder="Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="text" name="phone" placeholder="Phone">
                <input type="text" name="address" placeholder="Address">
                <button type="submit">Add</button>
            </form>
        </div>

        <!-- Update Client Form -->
        <div id="updateForm" style="display: none;">
            <h2>Update Client</h2>
            <form method="POST" action="/BENKHELIFA_FAROUK_G1_IGE46/public/clients/update">
                <input type="number" name="id" placeholder="Client ID" required>
                <input type="text" name="name" placeholder="Name">
                <input type="email" name="email" placeholder="Email">
                <input type="text" name="phone" placeholder="Phone">
                <input type="text" name="address" placeholder="Address">
                <button type="submit">Update</button>
            </form>
        </div>

        <!-- Delete Client Form -->
        <div id="deleteForm" style="display: none;">
            <h2>Delete Client</h2>
            <form method="POST" action="/BENKHELIFA_FAROUK_G1_IGE46/public/clients/delete">
                <input type="number" name="id" placeholder="Client ID" required>
                <button type="submit">Delete</button>
            </form>
        </div>

        <div id="searchForm" style="display: none;">
            <h2>Search Clients</h2>
            <form method="GET" action="/BENKHELIFA_FAROUK_G1_IGE46/public/clients/search">
                <input type="text" name="search_name" placeholder="Search by Name or ID">
                <button type="submit">Search</button>
            </form>
        </div>

        <h2>Client List</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($clients)): ?>
                    <?php foreach ($clients as $client): ?>
                        <tr>
                            <td><?= htmlspecialchars($client['id']) ?></td>
                            <td><?= htmlspecialchars($client['name']) ?></td>
                            <td><?= htmlspecialchars($client['email']) ?></td>
                            <td><?= htmlspecialchars($client['phone']) ?></td>
                            <td><?= htmlspecialchars($client['address']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="5">No clients found</td></tr>
                <?php endif; ?>
            </tbody>
        </table>


</body>
</html>
