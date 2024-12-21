<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bill Details</title>
    <link rel="stylesheet" href="/BENKHELIFA_FAROUK_G1_IGE46/public/css/bill_details.css">
    <script>
        function printBill() {
            window.print();
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Bill Details</h1>
        <table>
            <tr>
                <th>Bill ID</th>
                <td><?= htmlspecialchars($billDetails[0]['bill_id']) ?></td>
            </tr>
            <tr>
                <th>Date</th>
                <td><?= htmlspecialchars($billDetails[0]['bill_date']) ?></td>
            </tr>
            <tr>
                <th>Client Name</th>
                <td><?= htmlspecialchars($billDetails[0]['client_name']) ?></td>
            </tr>
            <tr>
                <th>Worker Name</th>
                <td><?= htmlspecialchars($billDetails[0]['worker_name']) ?></td>
            </tr>
            <tr>
                <th>Total Price</th>
                <td><?= htmlspecialchars($billDetails[0]['total_price']) ?></td>
            </tr>
        </table>

        <h3>Products in this Bill</h3>
        <table>
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($billDetails as $detail): ?>
                    <tr>
                        <td><?= htmlspecialchars($detail['product_name']) ?></td>
                        <td><?= htmlspecialchars($detail['product_price']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <button onclick="printBill()">Print Bill</button>
    </div>
</body>
</html>
