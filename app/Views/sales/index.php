<div class="container" style="max-width: 1000px;">
    <h1>Sales Transaction History</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Product</th>
                <th>Customer</th>
                <th>Sold By</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Date & Time</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($sales as $sale): ?>
                <tr>
                    <td>#<?= $sale['id'] ?></td>
                    <td><strong><?= esc($sale['product_name']) ?></strong></td>
                    <td><?= esc($sale['customer_name'] ?? 'Walk-in Customer') ?></td>
                    <td><?= esc($sale['staff_name']) ?></td>
                    <td><?= $sale['quantity'] ?></td>
                    <td style="color: #27ae60; font-weight: bold;">$<?= number_format($sale['total_price'], 2) ?></td>
                    <td style="font-size: 13px; color: #666;"><?= date('M d, Y h:i A', strtotime($sale['created_at'])) ?></td>
                </tr>
            <?php endforeach; ?>
            <?php if(empty($sales)): ?>
                <tr><td colspan="7" style="text-align: center; color: #777;">No sales transactions recorded yet.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>