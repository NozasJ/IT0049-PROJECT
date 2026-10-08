<div class="container">
    <h1>Add Staff Member</h1>

    <form action="<?= base_url('users') ?>" method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <label for="username">Username</label>
        <input type="text" id="username" name="username" value="<?= old('username') ?>" required>

        <label for="full_name">Full Name</label>
        <input type="text" id="full_name" name="full_name" value="<?= old('full_name') ?>" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>

        <label for="avatar">Avatar Image</label>
        <input type="file" id="avatar" name="avatar" accept="image/*" style="border: none; padding: 0;">

        <div style="display: flex; gap: 10px; margin-top: 20px;">
            <button type="submit">Save Staff Member</button>
            <a href="<?= base_url('users') ?>" style="display: inline-flex; align-items: center; justify-content: center; padding: 10px 20px; font-family: inherit; font-size: 0.95rem; font-weight: 600; color: #ffffff; background-color: #7f8c8d; border-radius: 6px; text-decoration: none; border: none; cursor: pointer; transition: background-color 0.15s ease, transform 0.1s ease; box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);">Cancel</a>
        </div>
    </form>
</div>