<div class="container" style="max-width: 1000px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h1 style="margin: 0;">Staff Members</h1>
        <a href="<?= base_url('users/new') ?>" class="btn">Add Staff Member</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Avatar</th>
                <th>Username</th>
                <th>Full Name</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td>
                        <?php if ($user['avatar']): ?>
                            <img src="<?= base_url('uploads/avatars/' . $user['avatar']) ?>" alt="Avatar" style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%;">
                        <?php else: ?>
                            <div style="width: 40px; height: 40px; border-radius: 50%; background: #2c3e50; color: white; display: flex; align-items: center; justify-content: center; font-weight: bold;">
                                <?= strtoupper(substr($user['full_name'], 0, 1)) ?>
                            </div>
                        <?php endif; ?>
                    </td>
                    <td><strong><?= esc($user['username']) ?></strong></td>
                    <td><?= esc($user['full_name']) ?></td>
                    <td><?= date('M d, Y', strtotime($user['created_at'])) ?></td>
                    <td>
                        <a href="<?= base_url('users/' . $user['id'] . '/edit') ?>" style="padding: 4px 8px; font-size: 13px;">Edit</a>
                        <?php if ($user['id'] != session()->get('user_id')): ?>
                            <form action="<?= base_url('users/' . $user['id']) ?>" method="POST" style="display: inline;" onsubmit="return confirm('Delete this staff user?');">
                                <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" style="background: #e74c3c; padding: 4px 8px; font-size: 13px;">Delete</button>
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php if (empty($users)): ?>
                <tr><td colspan="5" style="text-align: center; color: #777;">No staff users found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>