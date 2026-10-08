<div class="container" style="max-width: 1000px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h1 style="margin: 0;">Products</h1>
        <a href="<?= base_url('products/new') ?>" class="btn">Add New Product</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Stock Quantity</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td>
                        <?php if ($product['image']): ?>
                            <img src="<?= base_url('uploads/products/' . $product['image']) ?>" alt="Product" style="width: 40px; height: 40px; object-fit: cover; border-radius: 4px;">
                        <?php else: ?>
                            <span style="color: #999; font-size: 12px;">No Image</span>
                        <?php endif; ?>
                    </td>
                    <td><strong><?= esc($product['name']) ?></strong></td>
                    <td style="color: #27ae60; font-weight: bold;">$<?= number_format($product['price'], 2) ?></td>
                    <td><?= $product['stock_quantity'] ?> units</td>
                    <td>
                        <a href="<?= base_url('products/' . $product['id'] . '/edit') ?>" style="padding: 4px 8px; font-size: 13px;">Edit</a>
                        <form action="<?= base_url('products/' . $product['id']) ?>" method="POST" style="display: inline;" onsubmit="return confirm('Delete this product?');">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" style="background: #e74c3c; padding: 4px 8px; font-size: 13px;">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php if (empty($products)): ?>
                <tr><td colspan="5" style="text-align: center; color: #777;">No products found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>