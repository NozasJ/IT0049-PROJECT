<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'POS System') ?></title>

    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body>

<header>
    <nav>
        <div class="brand">
            <a href="<?= base_url('/') ?>" style="font-size: 1.2rem;">Home</a>
        </div>
        <div>
            <?php if (session()->get('isLoggedIn')): ?>
                <a href="<?= base_url('sales/create') ?>">Record Sale</a>
                <a href="<?= base_url('sales') ?>">Sales History</a>
                <a href="<?= base_url('products') ?>">Products</a>
                <a href="<?= base_url('customers') ?>">Customers</a>
                <a href="<?= base_url('users') ?>">Staff</a>
                <a href="<?= base_url('logout') ?>" style="color: #e74c3c;">Logout</a>
            <?php endif; ?>
        </div>
    </nav>
</header>

<main class="main-content">
   
    <?php if (session()->getFlashdata('success')): ?>
        <div style="background: #d4edda; color: #155724; padding: 10px; border-radius: 4px; margin-bottom: 15px;">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div style="background: #f8d7da; color: #721c24; padding: 10px; border-radius: 4px; margin-bottom: 15px;">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>