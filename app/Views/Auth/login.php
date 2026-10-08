<div class="container">
    <h1>Sign In</h1>

    <form action="<?= base_url('login') ?>" method="POST">
        <?= csrf_field() ?>

        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="Enter username" required autofocus>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter password" required>

        <button type="submit" style="margin-top: 10px;">Login</button>
    </form>
</div>