<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Bills</title>
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
        <h1>Manage Bills</h1>
        <div>
            <label><input type="radio" name="action" value="add" onclick="showForm()"> Add</label>
            <label><input type="radio" name="action" value="update" onclick="showForm()"> Update</label>
            <label><input type="radio" name="action" value="delete" onclick="showForm()"> Delete</label>
            <label><input type="radio" name="action" value="search" onclick="showForm()"> Search</label>
        </div>

        <!-- Add Bill Form -->
        <div id="addForm" style="display: none;">
            <h2>Add Bill</h2>
            <form method="POST" action="/BENKHELIFA_FAROUK_G1_IGE46/public/bills/add">
                <input type="number" name="worker_id" placeholder="Worker ID" required>
                <input type="number" name="user_id" placeholder="User ID" required>
                <input type="number" name="client_id" placeholder="Client ID" required>
                <input type="text" name="product_ids" placeholder="Product IDs (comma-separated)" required>
                <input type="date" name="date" required>
                <input type="number" name="total_price" placeholder="Total Price" required>
                <button type="submit">Add</button>
            </form>
        </div>

        <!-- Update Bill Form -->
        <div id="updateForm" style="display: none;">
            <h2>Update Bill</h2>
            <form method="POST" action="/BENKHELIFA_FAROUK_G1_IGE46/public/bills/update">
                <input type="number" name="id" placeholder="Bill ID" required>
                <input type="number" name="worker_id" placeholder="Worker ID">
                <input type="number" name="user_id" placeholder="User ID">
                <input type="number" name="client_id" placeholder="Client ID">
                <input type="text" name="product_ids" placeholder="Product IDs (comma-separated)">
                <input type="date" name="date">
                <input type="number" name="total_price" placeholder="Total Price">
                <button type="submit">Update</button>
            </form>
        </div>

        <!-- Delete Bill Form -->
        <div id="deleteForm" style="display: none;">
            <h2>Delete Bill</h2>
            <form method="POST" action="/BENKHELIFA_FAROUK_G1_IGE46/public/bills/delete">
                <input type="number" name="id" placeholder="Bill ID" required>
                <button type="submit">Delete</button>
            </form>
        </div>

        <!-- Search Bill Form -->
        <div id="searchForm" style="display: none;">
            <h2>Search Bills</h2>
            <form method="GET" action="/BENKHELIFA_FAROUK_G1_IGE46/public/bills/search">
                <input type="number" name="bill_id" placeholder="Search by Bill ID">
                <button type="submit">Search</button>
            </form>
        </div>

        <!-- Display Bills -->
        <h2>Bill List</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Worker ID</th>
                    <th>User ID</th>
                    <th>Client ID</th>
                    <th>Product IDs</th>
                    <th>Date</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bills as $bill): ?>
                    <tr>
                        <td><?= htmlspecialchars($bill['id']) ?></td>
                        <td><?= htmlspecialchars($bill['worker_id']) ?></td>
                        <td><?= htmlspecialchars($bill['user_id']) ?></td>
                        <td><?= htmlspecialchars($bill['client_id']) ?></td>
                        <td><?= htmlspecialchars($bill['product_ids']) ?></td>
                        <td><?= htmlspecialchars($bill['date']) ?></td>
                        <td><?= htmlspecialchars($bill['total_price']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
