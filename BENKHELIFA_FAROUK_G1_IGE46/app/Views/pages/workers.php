<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Workers</title>
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
        <h1>Manage Workers</h1>
        <div>
            <label><input type="radio" name="action" value="add" onclick="showForm()"> Add</label>
            <label><input type="radio" name="action" value="update" onclick="showForm()"> Update</label>
            <label><input type="radio" name="action" value="delete" onclick="showForm()"> Delete</label>
            <label><input type="radio" name="action" value="search" onclick="showForm()"> Search</label>
        </div>

        <!-- Add Worker Form -->
        <div id="addForm" style="display: none;">
            <h2>Add Worker</h2>
            <form method="POST" action="/BENKHELIFA_FAROUK_G1_IGE46/public/workers/add">
                <input type="text" name="name" placeholder="Name" required>
                <input type="text" name="job_title" placeholder="Job Title" required>
                <input type="number" name="salary" placeholder="Salary" required>
                <input type="date" name="hire_date" required>
                <button type="submit">Add</button>
            </form>
        </div>

        <!-- Update Worker Form -->
        <div id="updateForm" style="display: none;">
            <h2>Update Worker</h2>
            <form method="POST" action="/BENKHELIFA_FAROUK_G1_IGE46/public/workers/update">
                <input type="number" name="id" placeholder="Worker ID" required>
                <input type="text" name="name" placeholder="Name">
                <input type="text" name="job_title" placeholder="Job Title">
                <input type="number" name="salary" placeholder="Salary">
                <input type="date" name="hire_date">
                <button type="submit">Update</button>
            </form>
        </div>

        <!-- Delete Worker Form -->
        <div id="deleteForm" style="display: none;">
            <h2>Delete Worker</h2>
            <form method="POST" action="/BENKHELIFA_FAROUK_G1_IGE46/public/workers/delete">
                <input type="number" name="id" placeholder="Worker ID" required>
                <button type="submit">Delete</button>
            </form>
        </div>

        <div id="searchForm" style="display: none;">
            <h2>Search Workers</h2>
            <form method="GET" action="/BENKHELIFA_FAROUK_G1_IGE46/public/workers">
                <input type="text" name="search_name" placeholder="Search by Name">
                <button type="submit" name="search_worker">Search</button>
            </form>
        </div>

        <!-- Display Workers -->
        <h2>Worker List</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Job Title</th>
                    <th>Salary</th>
                    <th>Hire Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($workers as $worker): ?>
                    <tr>
                        <td><?= htmlspecialchars($worker['id']) ?></td>
                        <td><?= htmlspecialchars($worker['name']) ?></td>
                        <td><?= htmlspecialchars($worker['job_title']) ?></td>
                        <td><?= htmlspecialchars($worker['salary']) ?></td>
                        <td><?= htmlspecialchars($worker['hire_date']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
