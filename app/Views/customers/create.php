<div class="container">
    <h1>Add Customer</h1>

    <form action="<?= base_url('customers') ?>" method="POST">
        <?= csrf_field() ?>

        <label for="full_name">Full Name</label>
        <input type="text" id="full_name" name="full_name" value="<?= old('full_name') ?>" required>

        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" value="<?= old('email') ?>" required>

        <label for="phone">Phone Number (Optional)</label>
        <input type="text" id="phone" name="phone" value="<?= old('phone') ?>">

        <div style="display: flex; gap: 10px; margin-top: 20px;">
            <button type="submit">Save Customer</button>
            <a href="<?= base_url('customers') ?>" style="display: inline-flex; align-items: center; justify-content: center; padding: 10px 20px; font-family: inherit; font-size: 0.95rem; font-weight: 600; color: #ffffff; background-color: #7f8c8d; border-radius: 6px; text-decoration: none; border: none; cursor: pointer; transition: background-color 0.15s ease, transform 0.1s ease; box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);">Cancel</a>
        </div>
    </form>
</div>