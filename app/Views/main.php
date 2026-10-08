

<div class="card-header-flex">
    <h1 style="font-size: 1.75rem; font-weight: 700;">System Overview</h1>
    <a href="<?= base_url('sales/create') ?>" class="btn btn-primary" style="width: auto;">New Sale</a>
</div>

<div class="dashboard-grid">
    <div class="dash-card">
        <h3>Total Products</h3>
        <div class="count"><?= count($products ?? []) ?></div>
    </div>
    <div class="dash-card" style="border-left-color: #16a34a;">
        <h3>Registered Customers</h3>
        <div class="count"><?= count($customers ?? []) ?></div>
    </div>
    <div class="dash-card" style="border-left-color: #f59e0b;">
        <h3>Staff Members</h3>
        <div class="count"><?= count($users ?? []) ?></div>
    </div>
</div>

<div class="card-container">
    <h2 class="card-title">Quick Actions</h2>
    <div style="display: flex; gap: 12px; flex-wrap: wrap;">
        <a href="<?= base_url('products/new') ?>" class="btn btn-secondary">Add Product</a>
        <a href="<?= base_url('customers/new') ?>" class="btn btn-secondary">Add Customer</a>
        <a href="<?= base_url('users/new') ?>" class="btn btn-secondary">Add Staff</a>
        <a href="<?= base_url('sales') ?>" class="btn btn-secondary">View Sales History</a>
    </div>
</div>

