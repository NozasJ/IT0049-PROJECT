<div class="container">
    <h1>Record New Sale</h1>

    <form action="<?= base_url('sales/store') ?>" method="POST">
        <?= csrf_field() ?>
        
        <label for="product_id">Select Product</label>
        <select name="product_id" id="product_id" required style="display: block; width: 100%; padding: 10px 14px; margin-top: 6px; margin-bottom: 16px; font-size: 15px; border: 1px solid #ccc; border-radius: 6px;">
            <option value="">-- Choose Product --</option>
            <?php foreach($products as $product): ?>
                <option value="<?= $product['id'] ?>">
                    <?= esc($product['name']) ?> - $<?= number_format($product['price'], 2) ?> (Stock: <?= $product['stock_quantity'] ?>)
                </option>
            <?php endforeach; ?>
        </select>

        <label for="customer_id">Select Customer (Optional)</label>
        <select name="customer_id" id="customer_id" style="display: block; width: 100%; padding: 10px 14px; margin-top: 6px; margin-bottom: 16px; font-size: 15px; border: 1px solid #ccc; border-radius: 6px;">
            <option value="">-- Walk-in Customer --</option>
            <?php foreach($customers as $customer): ?>
                <option value="<?= $customer['id'] ?>">
                    <?= esc($customer['full_name']) ?> (<?= esc($customer['email']) ?>)
                </option>
            <?php endforeach; ?>
        </select>

        <label for="quantity">Quantity</label>
        <input type="number" name="quantity" id="quantity" min="1" value="1" required>

        <button type="submit" style="margin-top: 10px;">Complete Transaction</button>
    </form>
</div>