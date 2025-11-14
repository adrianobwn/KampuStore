
<?php ($title='kampuStore - Market'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo e($title); ?></title>

<style>
/* RESET */
*{margin:0;padding:0;box-sizing:border-box}

/* THEME VARIABLES (default = dark) */
:root{
  --bg-body:#050816;
  --text-main:#e5e7eb;

  --nav-bg:linear-gradient(90deg,#111827,#1f2937);
  --nav-border-bottom:transparent;
  --nav-shadow:none;
  --nav-link-color:#e5e7eb;

  --market-bg:radial-gradient(circle at top left,#312e81 0,#020617 55%);

  --sidebar-bg:rgba(15,23,42,0.9);
  --sidebar-border:rgba(30,64,175,0.8);
  --sidebar-scroll-thumb:#4b5563;
  --sidebar-divider:#374151;
  --sidebar-select-bg:#020617;
  --sidebar-select-border:#4b5563;
  --sidebar-text:#d1d5db;

  --search-bg:#020617;
  --search-border:#4b5563;
  --search-text:#e5e7eb;
  --search-placeholder:#6b7280;

  --icon-border:#4b5563;
  --icon-bg:#020617;
  --icon-color:#e5e7eb;

  --page-title-color:#f9fafb;
  --breadcrumb-color:#9ca3af;

  --product-card-bg:#020617;
  --product-card-border:rgba(30,64,175,0.8);
  --product-image-bg:#111827;

  --reset-btn-bg:#111827;
  --reset-btn-border:#374151;

  --toast-bg:#111827;
}

/* LIGHT MODE OVERRIDE */
body.theme-light{
  --bg-body:#f9fafb;
  --text-main:#111827;

  --nav-bg:#ffffff;
  --nav-border-bottom:#e5e7eb;
  --nav-shadow:0 2px 8px rgba(15,23,42,0.08);
  --nav-link-color:#111827;

  --market-bg:#f3f4f6;

  --sidebar-bg:#ffffff;
  --sidebar-border:#e5e7eb;
  --sidebar-scroll-thumb:#9ca3af;
  --sidebar-divider:#e5e7eb;
  --sidebar-select-bg:#ffffff;
  --sidebar-select-border:#d1d5db;
  --sidebar-text:#4b5563;

  --search-bg:#ffffff;
  --search-border:#d1d5db;
  --search-text:#111827;
  --search-placeholder:#9ca3af;

  --icon-border:#d1d5db;
  --icon-bg:#ffffff;
  --icon-color:#111827;

  --page-title-color:#111827;
  --breadcrumb-color:#6b7280;

  --product-card-bg:#ffffff;
  --product-card-border:#e5e7eb;
  --product-image-bg:#e5e7eb;

  --reset-btn-bg:#e5e7eb;
  --reset-btn-border:#d1d5db;

  --toast-bg:#111827;
}

/* BODY */
body{
  font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Arial,sans-serif;
  background:var(--bg-body);
  color:var(--text-main);
}

/* LINK */
a{text-decoration:none;color:inherit;}

/* ==== NAVBAR ==== */
.nav{
    position:fixed;
    top:0;left:0;right:0;
    z-index:100;
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:18px 40px;
    background:var(--nav-bg);
    border-bottom:1px solid var(--nav-border-bottom);
    box-shadow:var(--nav-shadow);
}
.nav-left{
    display:flex;
    align-items:center;
    gap:26px;
}
.nav-logo{
  display:flex;
  align-items:center;
  font-weight:700;
  font-size:22px;
  letter-spacing:0.04em;
  color:#f9fafb;
  cursor:pointer;
}

.nav-logo img{
  height:40px;        /* sesuaikan tinggi logo */
  display:block;
}
body.theme-light .nav-logo{
 color:#111827;
}

.nav-menu{
    display:flex;
    align-items:center;
    gap:24px;
    font-size:14px;
}
.nav-menu a{
    color:var(--nav-link-color);
    position:relative;
}

/* underline animasi */
.nav-menu a::after{
    content:'';
    position:absolute;
    left:0;
    bottom:-4px;
    height:2px;
    width:100%;
    background:#f97316;
    border-radius:999px;
    transform:scaleX(0);
    transform-origin:left;
    opacity:0;
    transition:transform .25s ease-out, opacity .2s ease-out;
}
.nav-menu a:hover{
    color:#f97316;
}
.nav-menu a:hover::after{
    transform:scaleX(1);
    opacity:1;
}
.nav-menu a.active{
    color:#f97316;
}
.nav-menu a.active::after{
    transform:scaleX(1);
    opacity:1;
}

/* SEARCH DI NAV */
.nav-search{
    flex:1;
    max-width:420px;
    margin:0 24px;
    position:relative;
}
.nav-search input{
    width:100%;
    padding:9px 40px 9px 16px;
    border-radius:999px;
    border:1px solid var(--search-border);
    background:var(--search-bg);
    color:var(--search-text);
    font-size:13px;
    outline:none;
}
.nav-search input::placeholder{
    color:var(--search-placeholder);
}
.nav-search input:focus{
    border-color:#f97316;
}
.nav-search button{
    position:absolute;
    right:12px;
    top:50%;
    transform:translateY(-50%);
    background:none;
    border:none;
    cursor:pointer;
}

/* ICON HEADER DI KANAN */
.header-right{
    display:flex;
    align-items:center;
    gap:14px;
}
.icon-btn{
    background:none;
    border:none;
    cursor:pointer;
    color:var(--icon-color);
    position:relative;
    padding:0;
}
.icon-round{
    width:32px;
    height:32px;
    border-radius:999px;
    border:1px solid var(--icon-border);
    display:flex;
    align-items:center;
    justify-content:center;
    background:var(--icon-bg);
    font-size:18px;
}
.icon-heart{ color:#fda4af; }
.icon-cart{ /* ikut warna icon-color */ }
.icon-user{ /* ikut warna icon-color */ }

/* DROPDOWN AKUN */
.account-wrapper{ position:relative; }
.account-menu{
  position:absolute;
  right:0;
  top:110%;
  background:var(--sidebar-bg);
  border-radius:10px;
  box-shadow:0 12px 30px rgba(0,0,0,.6);
  padding:8px 0;
  min-width:190px;
  display:none;
  z-index:120;
  border:1px solid var(--sidebar-border);
}
.account-menu a,
.account-menu button{
  display:block;
  width:100%;
  padding:8px 14px;
  border:none;
  background:none;
  text-align:left;
  font-size:13px;
  color:var(--sidebar-text);
  cursor:pointer;
}
.account-menu a:hover,
.account-menu button:hover{ background:rgba(15,23,42,0.25); }
body.theme-light .account-menu a:hover,
body.theme-light .account-menu button:hover{ background:#f3f4f6; }

.account-wrapper.open .account-menu{ display:block; }

/* ==== BACKGROUND MARKET (radial + blob) ==== */
.market-bg{
  min-height:100vh;
  padding:110px 30px 40px; /* 110 karena nav fixed */
  background:var(--market-bg);
  position:relative;
  overflow:hidden;
}
.market-bg::before,
.market-bg::after{
  content:'';
  position:absolute;
  border-radius:999px;
  filter:blur(24px);
  opacity:0.45;
}
.market-bg::before{
  width:340px;height:340px;
  background:linear-gradient(135deg,#6366f1,#f97316);
  top:-140px;left:-80px;
}
.market-bg::after{
  width:300px;height:300px;
  background:linear-gradient(135deg,#0ea5e9,#22c55e);
  bottom:-140px;right:-60px;
}
body.theme-light .market-bg::before,
body.theme-light .market-bg::after{
  opacity:0.12;
}

/* LAYOUT WRAPPER */
.container{
  position:relative;
  z-index:1;
  display:flex;
  max-width:1400px;
  margin:0 auto;
  gap:26px;
}

/* SIDEBAR FILTER */
.sidebar{
  width:260px;
  background:var(--sidebar-bg);
  padding:20px 18px;
  height:calc(100vh - 150px);
  overflow-y:auto;
  border-radius:16px;
  border:1px solid var(--sidebar-border);
  box-shadow:0 10px 30px rgba(0,0,0,.55);
}
body.theme-light .sidebar{
  box-shadow:0 8px 20px rgba(148,163,184,0.35);
}
.sidebar::-webkit-scrollbar{
  width:6px;
}
.sidebar::-webkit-scrollbar-thumb{
  background:var(--sidebar-scroll-thumb);
  border-radius:999px;
}
.main-content{
  flex:1;
  padding:22px 10px 10px;
}

/* FILTER & ACCORDION */
.filter-section{ margin-bottom:18px; border:0; }
.filter-title{
  display:flex;
  align-items:center;
  justify-content:space-between;
  margin:10px 0 6px;
  cursor:pointer;
  user-select:none;
  font-weight:600;
  color:var(--sidebar-text);
}
.filter-toggle{
  appearance:none;
  border:none;
  background:none;
  cursor:pointer;
  font-size:14px;
  color:#9ca3af;
  display:inline-flex;
  align-items:center;
  gap:6px;
}
.chev{
  display:inline-block;
  transition:transform .2s ease;
}
.filter-content{
  overflow:hidden;
  transition:max-height .25s ease;
  max-height:0;
}
.filter-section.open .chev{ transform:rotate(180deg); }
.filter-section.open .filter-content{ max-height:600px; }

.filter-option{
  display:flex;
  align-items:center;
  margin:6px 0;
  cursor:pointer;
  font-size:13px;
  color:var(--sidebar-text);
}
.filter-option input[type="checkbox"]{
  margin-right:8px;
  width:16px;
  height:16px;
  cursor:pointer;
}
.filter-heading {
  font-size:15px;
  font-weight:700;
  margin:8px 0 6px;
}

/* PRICE LABEL */
.price-slider{ margin-top:6px; }
.price-range{
  width:100%;
  height:6px;
  background:#374151;
  border-radius:3px;
  position:relative;
}
.price-fill{
  height:100%;
  background:#7c3aed;
  border-radius:3px;
}

/* BREADCRUMB & TITLE */
.page-title{
  font-size:26px;
  font-weight:800;
  margin-bottom:18px;
  color:var(--page-title-color);
}
.breadcrumb{
  display:flex;
  align-items:center;
  gap:8px;
  margin-bottom:10px;
  font-size:13px;
  color:var(--breadcrumb-color);
}

/* PRODUCT GRID */
.product-grid{
  display:grid;
  grid-template-columns:repeat(auto-fill,minmax(260px,1fr));
  gap:22px;
}
.product-card{
  background:var(--product-card-bg);
  border-radius:14px;
  overflow:hidden;
  box-shadow:0 10px 30px rgba(0,0,0,.6);
  transition:.2s;
  cursor:pointer;
  border:1px solid var(--product-card-border);
}
body.theme-light .product-card{
  box-shadow:0 10px 25px rgba(148,163,184,0.45);
}
.product-card:hover{
  transform:translateY(-5px);
  box-shadow:0 18px 40px rgba(0,0,0,.8);
}
body.theme-light .product-card:hover{
  box-shadow:0 18px 40px rgba(148,163,184,0.7);
}
.product-image{
  position:relative;
  background:var(--product-image-bg);
  height:200px;
  display:flex;
  align-items:center;
  justify-content:center;
}
.product-image img{
  width:100%;
  height:100%;
  object-fit:cover;
}
.badge{
  position:absolute;
  top:12px;
  left:12px;
  padding:6px 14px;
  border-radius:20px;
  font-size:11px;
  font-weight:600;
  color:#fff;
}
.badge.new{ background:#60a5fa; }
.badge.used{ background:#7c3aed; }

.favorite-btn{
  position:absolute;
  top:12px;
  right:12px;
  background:var(--icon-bg);
  border:none;
  width:35px;
  height:35px;
  border-radius:50%;
  display:flex;
  align-items:center;
  justify-content:center;
  cursor:pointer;
  box-shadow:0 2px 8px rgba(0,0,0,.6);
  transition: transform .15s ease, background .15s ease;
}
.favorite-btn.active{
  transform:scale(1.1);
  background:#111827;
}
body.theme-light .favorite-btn.active{
  background:#e5e7eb;
}

.product-info{ padding:14px 14px 13px; }
.product-name{
  font-weight:600;
  font-size:15px;
  margin-bottom:6px;
  color:var(--page-title-color);
}
.product-meta{
  font-size:12px;
  color:var(--breadcrumb-color);
  margin-bottom:10px;
}
.product-footer{
  display:flex;
  justify-content:space-between;
  align-items:center;
}
.product-price{
  font-weight:700;
  font-size:16px;
  color:#f97316;
}
.add-to-cart{
  background:none;
  border:none;
  cursor:pointer;
  font-size:20px;
  color:var(--icon-color);
}
.add-to-cart:hover{ color:#f97316; }

/* Tombol Reset Filter */
.reset-btn{
  display:inline-flex;
  align-items:center;
  justify-content:center;
  width:35px;
  height:35px;
  border-radius:8px;
  background:var(--reset-btn-bg);
  font-size:18px;
  text-decoration:none;
  color:var(--text-main);
  border:1px solid var(--reset-btn-border);
  transition:.2s;
}
.reset-btn:hover{
  background:#020617;
}
body.theme-light .reset-btn:hover{
  background:#d1d5db;
}

/* form elemen lain di sidebar */
.sidebar select,
.sidebar input[type="range"]{
  width:100%;
}

/* dropdown select rating */
.sidebar select{
  padding:6px 8px;
  border-radius:8px;
  border:1px solid var(--sidebar-select-border);
  background:var(--sidebar-select-bg);
  color:var(--sidebar-text);
  font-size:13px;
}

/* checkbox stok text */
.sidebar span{
  font-size:13px;
}

/* pagination wrapper */
.pagination{
  margin-top:20px;
}

/* toast (kalau mau dipakai) */
.toast{
  position:fixed;
  bottom:20px;
  right:20px;
  padding:10px 14px;
  border-radius:8px;
  background:var(--toast-bg);
  color:#f9fafb;
  font-size:13px;
  box-shadow:0 10px 25px rgba(0,0,0,.7);
  display:none;
}
</style>
</head>

<body class="theme-dark"><!-- default night mode -->


<nav class="nav">
    <div class="nav-left">
        <a href="<?php echo e(route('home')); ?>" class="nav-logo">
                <img src="<?php echo e(asset('images/logo.png')); ?>" alt="kampuStore logo">
                <span>kampuStore</span>
            </a>

        <div class="nav-menu">
            <a href="<?php echo e(route('home')); ?>">Home</a>
            <a href="<?php echo e(route('home')); ?>#about">About</a>
            <a href="<?php echo e(route('products.index')); ?>" class="active">Market</a>
            <a href="<?php echo e(route('home')); ?>#contact">Contact</a>
        </div>
    </div>

    
    <form class="nav-search" action="<?php echo e(route('products.index')); ?>" method="GET">
        <input type="text" name="q" placeholder="search product…" value="<?php echo e(request('q')); ?>">
        <button class="search-btn" type="submit">🔍</button>
    </form>

    
    <div class="header-right">
        
        <button class="icon-btn js-header-wishlist" type="button" title="Wishlist">
          <span class="icon-round icon-heart">❤️</span>
        </button>

        
        <button class="icon-btn js-header-cart" type="button" title="Keranjang">
          <span class="icon-round icon-cart">🛒</span>
        </button>

        
        <div class="account-wrapper" id="accountWrapper">
          <button class="icon-btn js-account-toggle" type="button" title="Akun">
            <span class="icon-round icon-user">👤</span>
          </button>
          <div class="account-menu" id="accountMenu">
            <?php if(auth()->guard()->check()): ?>
              <div style="padding:6px 14px;font-size:12px;color:var(--breadcrumb-color);">
                Halo, <?php echo e(auth()->user()->name); ?>

              </div>
              <form method="POST" action="<?php echo e(route('logout')); ?>">
                <?php echo csrf_field(); ?>
                <button type="submit">Logout</button>
              </form>
            <?php else: ?>
              <a href="<?php echo e(route('login')); ?>">Login</a>
              <a href="<?php echo e(route('register')); ?>">Register</a>
            <?php endif; ?>

            <div style="border-top:1px solid rgba(55,65,81,0.9);margin:6px 0;"></div>
            <div style="padding:4px 14px;font-size:11px;letter-spacing:.08em;text-transform:uppercase;color:var(--breadcrumb-color);">
              Appearance
            </div>
            <button type="button" class="js-theme-mode" data-mode="dark">🌙 Night mode</button>
            <button type="button" class="js-theme-mode" data-mode="light">☀ Light mode</button>
          </div>
        </div>
    </div>
</nav>


<main class="market-bg">
<div class="container">
  
  <aside class="sidebar">
  <form method="GET" action="<?php echo e(route('products.index')); ?>" id="filterForm">

    
    <div class="filter-section open" data-key="category">
      <div class="filter-title">
        <strong>Kategori</strong>
        <button type="button" class="filter-toggle"><span class="chev">⌄</span></button>
      </div>
      <div class="filter-content">
        <?php $__currentLoopData = $allCats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="filter-option">
            <input type="checkbox" name="cat[]" value="<?php echo e($c['slug']); ?>" id="cat-<?php echo e($c['slug']); ?>"
              <?php if(in_array($c['slug'], $cats ?? [])): echo 'checked'; endif; ?>>
            <label for="cat-<?php echo e($c['slug']); ?>"><?php echo e($c['name']); ?></label>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    </div>

    <hr style="border:none;border-top:1px solid var(--sidebar-divider);margin:6px 0 10px;">

    
    <div class="filter-title" style="cursor:default;">
      <strong>Filter by:</strong>
    </div>

    
    <div class="filter-section" data-key="type">
      <div class="filter-title">
        <strong>Tipe</strong>
        <button type="button" class="filter-toggle"><span class="chev">⌄</span></button>
      </div>

      <div class="filter-content">
        <div class="filter-option">
          <input type="checkbox" name="cond[]" value="baru" id="cond-baru"
                 <?php if(in_array('baru', $cond ?? [])): echo 'checked'; endif; ?>>
          <label for="cond-baru">Baru</label>
        </div>
        <div class="filter-option">
          <input type="checkbox" name="cond[]" value="bekas" id="cond-bekas"
                 <?php if(in_array('bekas', $cond ?? [])): echo 'checked'; endif; ?>>
          <label for="cond-bekas">Bekas</label>
        </div>
      </div>
    </div>

    
    <div class="filter-section" data-key="size">
      <div class="filter-title">
        <strong>Ukuran</strong>
        <button type="button" class="filter-toggle"><span class="chev">⌄</span></button>
      </div>
      <div class="filter-content">
        <?php $__currentLoopData = ['S','M','L','XL']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sz): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <label class="filter-option" style="display:inline-flex;margin-right:10px;">
            <input type="checkbox" name="size[]" value="<?php echo e($sz); ?>" <?php if(in_array($sz, $sizes ?? [])): echo 'checked'; endif; ?>> <?php echo e($sz); ?>

          </label>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <div style="height:6px"></div>
      </div>
    </div>

    
    <div class="filter-section" data-key="price">
      <div class="filter-title">
        <strong>Harga</strong>
        <button type="button" class="filter-toggle"><span class="chev">⌄</span></button>
      </div>
      <div class="filter-content">
        <div style="font-size:12px;color:var(--sidebar-text);margin-bottom:8px;">
          <span id="lblMin">Rp <?php echo e(number_format($priceMin ?: 0,0,',','.')); ?></span> –
          <span id="lblMax">Rp <?php echo e(number_format($priceMax ?: 200000,0,',','.')); ?></span>
        </div>
        <input type="range" id="rangeMin" min="0" max="200000" step="500"
               value="<?php echo e($priceMin ?: 0); ?>" style="width:100%">
        <input type="range" id="rangeMax" min="0" max="200000" step="500"
               value="<?php echo e($priceMax ?: 200000); ?>" style="width:100%;margin-top:6px">
        <input type="hidden" name="pmin" id="pmin" value="<?php echo e($priceMin ?: 0); ?>">
        <input type="hidden" name="pmax" id="pmax" value="<?php echo e($priceMax ?: 200000); ?>">
      </div>
    </div>

    
    <div class="filter-section" data-key="location">
      <div class="filter-title">
        <strong>Lokasi</strong>
        <button type="button" class="filter-toggle"><span class="chev">⌄</span></button>
      </div>

      <div class="filter-content">
          <div style="max-height:200px; overflow-y:auto; padding-right:4px;">
              <?php $__currentLoopData = $areas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <label class="filter-option">
                  <input type="checkbox">
                  <span><?php echo e($a); ?></span>
                </label>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
      </div>
    </div>

    
    <div class="filter-section" data-key="rating">
      <div class="filter-title">
        <strong>Rating</strong>
        <button type="button" class="filter-toggle"><span class="chev">⌄</span></button>
      </div>
      <div class="filter-content">
        <select name="rmin">
          <option value="0" <?php if(($ratingMin??0)==0): echo 'selected'; endif; ?>>Semua</option>
          <?php for($i=5;$i>=1;$i--): ?>
            <option value="<?php echo e($i); ?>" <?php if(($ratingMin??0)==$i): echo 'selected'; endif; ?>><?php echo e($i); ?>★</option>
          <?php endfor; ?>
        </select>
      </div>
    </div>

    
    <div class="filter-section" data-key="stock">
      <div class="filter-title">
        <strong>Ketersediaan Stok</strong>
        <button type="button" class="filter-toggle"><span class="chev">⌄</span></button>
      </div>
      <div class="filter-content">
        <label class="filter-option">
          <input type="checkbox" name="in_stock" value="1" <?php if($inStock ?? false): echo 'checked'; endif; ?>>
          <span>Hanya tampilkan yang stoknya ada</span>
        </label>
      </div>
    </div>

    
    <?php if(request('q')): ?> <input type="hidden" name="q" value="<?php echo e(request('q')); ?>"> <?php endif; ?>

    <div style="display:flex;gap:10px;margin-top:6px;">
      <button style="background:#f97316;color:#111827;border:none;padding:8px 12px;border-radius:8px;cursor:pointer;font-size:13px;font-weight:600;">Terapkan</button>
      <a href="<?php echo e(route('products.index')); ?>" class="reset-btn" title="Reset Filter">🗑️</a>
    </div>
  </form>
</aside>

  
  <main class="main-content">
    <div class="breadcrumb">
        <span>Home</span> › <span>Market</span>
    </div>

    <h1 class="page-title">
        <?php echo e(($cats??[]) ? (collect($allCats)->firstWhere('slug',$cats[0])['name'] ?? 'Katalog Produk') : 'Katalog Produk'); ?>

    </h1>

    <?php if($products->isEmpty()): ?>
      <p style="color:var(--sidebar-text);">Tidak ada produk.</p>
    <?php else: ?>
      <div class="product-grid">
        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php ($isNew = ($p->condition ?? '') === 'baru'); ?>
          <a href="<?php echo e(route('products.show',$p)); ?>" class="product-card">
            <div class="product-image">
                
                <?php if($p->condition): ?>
                    <span class="badge <?php echo e($isNew ? 'new' : 'used'); ?>">
                        <?php echo e(ucfirst($p->condition)); ?>

                    </span>
                <?php endif; ?>

                
                <?php if($p->image_url): ?>
                    <img
                        src="<?php echo e(asset($p->image_url)); ?>"
                        alt="<?php echo e($p->name); ?>"
                    >
                <?php else: ?>
                    <span style="font-size:13px;color:var(--breadcrumb-color);padding:0 10px;text-align:center;">
                        <?php echo e($p->name); ?>

                    </span>
                <?php endif; ?>

                
                <button class="favorite-btn" type="button" data-fav="0">🤍</button>
            </div>
            <div class="product-info">
              <div class="product-name"><?php echo e($p->name); ?></div>
              <div class="product-meta"><?php echo e($p->seller_name ?? '-'); ?></div>
              <div class="product-footer">
                <div class="product-price">Rp <?php echo e(number_format($p->price,0,',','.')); ?></div>
                <button class="add-to-cart" type="button">🛒</button>
              </div>
            </div>
          </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>

      <div class="pagination">
        <?php echo e($products->withQueryString()->links()); ?>

      </div>
    <?php endif; ?>
  </main>
</div>
</main>

<div id="toast" class="toast"></div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
/* THEME TOGGLE */
(function(){
  const THEME_KEY = 'kampuStoreTheme';
  const body = document.body;

  function applyTheme(mode){
    if(mode !== 'light' && mode !== 'dark') mode = 'dark';
    body.classList.remove('theme-light','theme-dark');
    body.classList.add('theme-' + mode);
  }

  // initial load
  const saved = localStorage.getItem(THEME_KEY);
  applyTheme(saved || 'dark');

  // handle click di menu akun
  document.querySelectorAll('.js-theme-mode').forEach(btn => {
    btn.addEventListener('click', () => {
      const mode = btn.getAttribute('data-mode');
      applyTheme(mode);
      localStorage.setItem(THEME_KEY, mode);

      Swal.fire({
        icon: 'success',
        title: mode === 'light' ? 'Light mode aktif' : 'Night mode aktif',
        timer: 1000,
        showConfirmButton: false
      });
    });
  });
})();
</script>

<script>
(function(){
  const accWrapper = document.getElementById('accountWrapper');
  const accToggle  = document.querySelector('.js-account-toggle');

  if (!accWrapper || !accToggle) return;

  // klik icon akun => toggle menu
  accToggle.addEventListener('click', (e)=>{
    e.stopPropagation();
    accWrapper.classList.toggle('open');
  });

  // klik di luar => tutup menu
  document.addEventListener('click', ()=>{
    accWrapper.classList.remove('open');
  });
})();
</script>

<script>
(function(){
  const rMin = document.getElementById('rangeMin');
  const rMax = document.getElementById('rangeMax');
  const pmin = document.getElementById('pmin');
  const pmax = document.getElementById('pmax');
  const lblMin = document.getElementById('lblMin');
  const lblMax = document.getElementById('lblMax');

  function rupiah(n){ return 'Rp ' + (Number(n)||0).toLocaleString('id-ID'); }
  function sync(){
    let a = Math.min(+rMin.value, +rMax.value-500);
    let b = Math.max(+rMax.value, +rMin.value+500);
    rMin.value = a; rMax.value = b;
    pmin.value = a; pmax.value = b;
    lblMin.textContent = rupiah(a);
    lblMax.textContent = rupiah(b);
  }
  if(rMin && rMax){ rMin.addEventListener('input', sync); rMax.addEventListener('input', sync); sync(); }
})();
</script>

<script>
(function() {
  const SEED = 'filterAccordion:v3:'; // versi baru biar state lama ke-reset

  document.querySelectorAll('.filter-section').forEach(section => {
    const key = section.getAttribute('data-key') || Math.random().toString(36).slice(2);
    const title = section.querySelector('.filter-title');
    const content = section.querySelector('.filter-content');

    if (!title || !content) return;

    // restore state
    const saved = localStorage.getItem(SEED + key);
    if (saved === 'open') {
      section.classList.add('open');
    } else if (saved === 'closed') {
      section.classList.remove('open');
    }

    if (section.classList.contains('open')) {
      content.style.maxHeight = content.scrollHeight + 'px';
    } else {
      content.style.maxHeight = '0px';
    }

    title.addEventListener('click', () => {
      const isOpen = section.classList.toggle('open');

      if (isOpen) {
        content.style.maxHeight = content.scrollHeight + 'px';
        localStorage.setItem(SEED + key, 'open');
      } else {
        content.style.maxHeight = '0px';
        localStorage.setItem(SEED + key, 'closed');
      }
    });

    const ro = new ResizeObserver(() => {
      if (section.classList.contains('open')) {
        content.style.maxHeight = content.scrollHeight + 'px';
      }
    });
    ro.observe(content);
  });
})();
</script>

<script>
(function(){

  // klik fav
  document.querySelectorAll('.product-card .favorite-btn').forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      e.stopPropagation();

      const isFav = btn.getAttribute('data-fav') === '1';

      if (isFav) {
        btn.setAttribute('data-fav', '0');
        btn.textContent = '🤍';
        btn.classList.remove('active');

        Swal.fire({
          icon: 'info',
          title: 'Dihapus dari Wishlist',
          timer: 1200,
          showConfirmButton: false
        });
      } else {
        btn.setAttribute('data-fav', '1');
        btn.textContent = '❤️';
        btn.classList.add('active');

        Swal.fire({
          icon: 'success',
          title: 'Ditambahkan ke Wishlist!',
          timer: 1200,
          showConfirmButton: false
        });
      }
    });
  });

  // klik cart
  document.querySelectorAll('.product-card .add-to-cart').forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      e.stopPropagation();

      Swal.fire({
        icon: 'success',
        title: 'Ditambahkan ke Keranjang!',
        text: 'Produk berhasil masuk ke keranjang.',
        timer: 1500,
        showConfirmButton: false
      });
    });
  });

  // icon header wishlist
  const headerWishlist = document.querySelector('.js-header-wishlist');
  if (headerWishlist) {
    headerWishlist.addEventListener('click', () => {
      Swal.fire({
        icon: 'info',
        title: 'Wishlist kamu',
        text: 'Fitur wishlist belum aktif.',
        confirmButtonColor: '#f97316'
      });
    });
  }

  // icon header cart
  const headerCart = document.querySelector('.js-header-cart');
  if (headerCart) {
    headerCart.addEventListener('click', () => {
      Swal.fire({
        icon: 'info',
        title: 'Keranjang kamu',
        text: 'Fitur keranjang belum aktif.',
        confirmButtonColor: '#f97316'
      });
    });
  }

})();
</script>
</body>
</html><?php /**PATH E:\laragon\www\KampuStore\KampuStore\resources\views/products/index.blade.php ENDPATH**/ ?>