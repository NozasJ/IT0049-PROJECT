<div class="container" style="max-width: 1000px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h1 style="margin: 0;">Customers</h1>
        <a href="<?= base_url('customers/new') ?>" class="btn">Add New Customer</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Full Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($customers as $customer): ?>
                <tr>
                    <td><strong><?= esc($customer['full_name']) ?></strong></td>
                    <td><?= esc($customer['email']) ?></td>
                    <td><?= esc($customer['phone'] ?? 'N/A') ?></td>
                    <td><?= date('M d, Y', strtotime($customer['created_at'])) ?></td>
                    <td>
                        <a href="<?= base_url('customers/' . $customer['id'] . '/edit') ?>" style="padding: 4px 8px; font-size: 13px;">Edit</a>
                        <form action="<?= base_url('customers/' . $customer['id']) ?>" method="POST" style="display: inline;" onsubmit="return confirm('Delete this customer?');">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" style="background: #e74c3c; padding: 4px 8px; font-size: 13px;">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php if (empty($customers)): ?>
                <tr><td colspan="5" style="text-align: center; color: #777;">No customers found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>