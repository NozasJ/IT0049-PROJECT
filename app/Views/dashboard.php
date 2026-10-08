<div class="container" style="max-width: 800px;">
    <h1>Dashboard</h1>
    <p>Welcome, <?= esc(session()->get('full_name')) ?>!</p>

    <div style="display: flex; gap: 20px; margin-top: 20px; justify-content: center;">
        <div style="padding: 20px; background: #f9f9f9; border: 1px solid #ccc; border-radius: 8px; flex: 1;">
            <h3>Products</h3>
            <p style="font-size: 24px; font-weight: bold; margin: 10px 0;"><?= count($products ?? []) ?></p>
            <a href="<?= base_url('products') ?>" style="display: inline-block; padding: 8px 16px; font-size: 0.9rem; font-weight: 600; color: #3498db; background-color: #ebf5fb; border: 1px solid #aed6f1; border-radius: 6px; text-decoration: none; transition: all 0.2s ease;">Manage Products</a>
        </div>
        <div style="padding: 20px; background: #f9f9f9; border: 1px solid #ccc; border-radius: 8px; flex: 1;">
            <h3>Customers</h3>
            <p style="font-size: 24px; font-weight: bold; margin: 10px 0;"><?= count($customers ?? []) ?></p>
            <a href="<?= base_url('customers') ?>" style="display: inline-block; padding: 8px 16px; font-size: 0.9rem; font-weight: 600; color: #3498db; background-color: #ebf5fb; border: 1px solid #aed6f1; border-radius: 6px; text-decoration: none; transition: all 0.2s ease;">Manage Customers</a>
        </div>
        <div style="padding: 20px; background: #f9f9f9; border: 1px solid #ccc; border-radius: 8px; flex: 1;">
            <h3>Staff</h3>
            <p style="font-size: 24px; font-weight: bold; margin: 10px 0;"><?= count($users ?? []) ?></p>
            <a href="<?= base_url('users') ?>" style="display: inline-block; padding: 8px 16px; font-size: 0.9rem; font-weight: 600; color: #3498db; background-color: #ebf5fb; border: 1px solid #aed6f1; border-radius: 6px; text-decoration: none; transition: all 0.2s ease;">Manage Staff</a>
        </div>
    </div>
</div>