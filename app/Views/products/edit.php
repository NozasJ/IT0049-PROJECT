<div class="container">
    <h1>Edit Product</h1>

    <form action="<?= base_url('products/' . $product['id']) ?>" method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <input type="hidden" name="_method" value="PUT">

        <label for="name">Product Name</label>
        <input type="text" id="name" name="name" value="<?= old('name', $product['name']) ?>" required>

        <label for="price">Price ($)</label>
        <input type="number" step="0.01" id="price" name="price" value="<?= old('price', $product['price']) ?>" required>

        <label for="stock_quantity">Stock Quantity</label>
        <input type="number" id="stock_quantity" name="stock_quantity" value="<?= old('stock_quantity', $product['stock_quantity']) ?>" required>

        <label for="image">Product Image</label>
        <input type="file" id="image" name="image" accept="image/*" style="border: none; padding: 0;">
        <?php if ($product['image']): ?>
            <p style="font-size: 13px; color: #666; margin-top: 5px;">
                Current Image: <br>
                <img src="<?= base_url('uploads/products/' . $product['image']) ?>" alt="Current Product" style="width: 60px; height: 60px; object-fit: cover; margin-top: 5px; border-radius: 4px;">
            </p>
        <?php endif; ?>

        <div style="display: flex; gap: 10px; margin-top: 20px;">
            <button type="submit">Update Product</button>
            <a href="<?= base_url('products') ?>" style="display: inline-flex; align-items: center; justify-content: center; padding: 10px 20px; font-family: inherit; font-size: 0.95rem; font-weight: 600; color: #ffffff; background-color: #7f8c8d; border-radius: 6px; text-decoration: none; border: none; cursor: pointer; transition: background-color 0.15s ease, transform 0.1s ease; box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);">Cancel</a>
        </div>
    </form>
</div>