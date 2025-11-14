<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo e($title ?? 'KampuStore'); ?></title>

  <style>
    body { margin:0; font-family: 'Segoe UI', Tahoma, sans-serif; background:#fafafa; color:#222; }
    a { text-decoration:none; color:inherit; }
    nav {
      display:flex; align-items:center; justify-content:space-between;
      padding:10px 40px; border-bottom:1px solid #ddd; background:#fff;
    }
    .logo { font-weight:700; font-size:20px; }
    .search-bar { flex:1; max-width:400px; margin:0 40px; position:relative; }
    .search-bar input {
      width:100%; padding:8px 36px 8px 14px; border:1px solid #ccc;
      border-radius:20px; font-size:14px;
    }
    .icons { display:flex; align-items:center; gap:25px; font-size:20px; }
    .icon { width:24px; height:24px; display:inline-block; }
    .container { max-width:1200px; margin:20px auto; padding:0 20px; }

    footer { border-top:1px solid #ddd; padding:15px 0; text-align:center; font-size:14px; color:#777; margin-top:40px; }
  </style>
</head>
<body>

  <nav>
    <div class="logo">kampuStore</div>

    <form class="search-bar" action="<?php echo e(route('products.index')); ?>" method="GET">
      <input type="text" name="q" placeholder="search" value="<?php echo e(request('q')); ?>">
    </form>

    <div class="icons">
      <a href="#">❤️</a>
      <a href="#">🛒</a>
      <?php if(auth()->guard()->check()): ?>
        <span style="font-size:14px;">Halo, <?php echo e(auth()->user()->name); ?></span>
        <form method="POST" action="<?php echo e(route('logout')); ?>" style="display:inline;">
          <?php echo csrf_field(); ?>
          <button style="border:none;background:none;color:#c00;cursor:pointer;">Logout</button>
        </form>
      <?php else: ?>
        <a href="<?php echo e(route('login')); ?>" style="font-size:14px;color:#007bff;">Login</a>
        <a href="<?php echo e(route('register')); ?>" style="font-size:14px;color:#007bff;">Register</a>
      <?php endif; ?>
    </div>
  </nav>

  <div class="container">
    <?php echo $__env->yieldContent('content'); ?>
  </div>

  <footer>
    &copy; <?php echo e(date('Y')); ?> KampuStore
  </footer>

</body>
</html>
<?php /**PATH E:\laragon\www\KampuStore\KampuStore\resources\views/layouts/app.blade.php ENDPATH**/ ?>