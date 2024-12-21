<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
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
        <h1>Manage Products</h1>
        <div>
            <label><input type="radio" name="action" value="add" onclick="showForm()"> Add</label>
            <label><input type="radio" name="action" value="update" onclick="showForm()"> Update</label>
            <label><input type="radio" name="action" value="delete" onclick="showForm()"> Delete</label>
            <label><input type="radio" name="action" value="search" onclick="showForm()"> Search</label>
        </div>

        <!-- Add Product Form -->
        <div id="addForm" style="display: none;">
            <h2>Add Product</h2>
            <form method="POST" action="/BENKHELIFA_FAROUK_G1_IGE46/public/products/add">
                <input type="text" name="name" placeholder="Name" required>
                <input type="text" name="description" placeholder="Description" required>
                <input type="number" name="price" placeholder="Price" required>
                <input type="number" name="stock" placeholder="Stock" required>
                <button type="submit">Add</button>
            </form>
        </div>

        <!-- Update Product Form -->
        <div id="updateForm" style="display: none;">
            <h2>Update Product</h2>
            <form method="POST" action="/BENKHELIFA_FAROUK_G1_IGE46/public/products/update">
                <input type="number" name="id" placeholder="Product ID" required>
                <input type="text" name="name" placeholder="Name">
                <input type="text" name="description" placeholder="Description">
                <input type="number" name="price" placeholder="Price">
                <input type="number" name="stock" placeholder="Stock">
                <button type="submit">Update</button>
            </form>
        </div>

        <!-- Delete Product Form -->
        <div id="deleteForm" style="display: none;">
            <h2>Delete Product</h2>
            <form method="POST" action="/BENKHELIFA_FAROUK_G1_IGE46/public/products/delete">
                <input type="number" name="id" placeholder="Product ID" required>
                <button type="submit">Delete</button>
            </form>
        </div>

        <!-- Search Product Form -->
        <div id="searchForm" style="display: none;">
            <h2>Search Products</h2>
            <form method="GET" action="/BENKHELIFA_FAROUK_G1_IGE46/public/products">
                <input type="text" name="search_name" placeholder="Search by Name">
                <button type="submit" name="search_product">Search</button>
            </form>
        </div>

        <!-- Display Products -->
        <h2>Product List</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Stock</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?= htmlspecialchars($product['id']) ?></td>
                            <td><?= htmlspecialchars($product['name']) ?></td>
                            <td><?= htmlspecialchars($product['description']) ?></td>
                            <td><?= htmlspecialchars($product['price']) ?></td>
                            <td><?= htmlspecialchars($product['stock']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="5">No products found</td></tr>
                <?php endif; ?>
            </tbody>
        </table>

    </div>
</body>
</html>
