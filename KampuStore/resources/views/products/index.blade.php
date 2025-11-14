@php($title='kampuStore - Market')
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ $title }}</title>

<style>
/* RESET */
*{margin:0;padding:0;box-sizing:border-box}

/* BODY */
body{
  font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Arial,sans-serif;
  background:#050816;
  color:#e5e7eb;
}

/* LINK */
a{text-decoration:none;color:inherit;}

/* ==== NAVBAR (sama seperti home/login/register) ==== */
.nav{
    position:fixed;
    top:0;left:0;right:0;
    z-index:100;
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:18px 40px;
    background:linear-gradient(90deg,#111827,#1f2937);
}
.nav-left{
    display:flex;
    align-items:center;
    gap:26px;
}
.nav-logo{
    font-weight:700;
    font-size:22px;
    letter-spacing:0.04em;
    color:#f9fafb;
}
.nav-logo:hover{opacity:.85;}

.nav-menu{
    display:flex;
    align-items:center;
    gap:24px;
    font-size:14px;
}
.nav-menu a{
    color:#e5e7eb;
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
    border:1px solid #4b5563;
    background:#020617;
    color:#e5e7eb;
    font-size:13px;
    outline:none;
}
.nav-search input::placeholder{
    color:#6b7280;
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
    color:#e5e7eb;
    position:relative;
    padding:0;
}
.icon-round{
    width:32px;
    height:32px;
    border-radius:999px;
    border:1px solid #4b5563;
    display:flex;
    align-items:center;
    justify-content:center;
    background:#020617;
    font-size:18px;
}
.icon-heart{ color:#fda4af; }
.icon-cart{ color:#e5e7eb; }
.icon-user{ color:#e5e7eb; }

/* DROPDOWN AKUN */
.account-wrapper{ position:relative; }
.account-menu{
  position:absolute;
  right:0;
  top:110%;
  background:#020617;
  border-radius:10px;
  box-shadow:0 12px 30px rgba(0,0,0,.6);
  padding:8px 0;
  min-width:170px;
  display:none;
  z-index:120;
  border:1px solid #374151;
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
  color:#e5e7eb;
  cursor:pointer;
}
.account-menu a:hover,
.account-menu button:hover{ background:#111827; }
.account-wrapper.open .account-menu{ display:block; }

/* ==== BACKGROUND MARKET (radial + blob) ==== */
.market-bg{
  min-height:100vh;
  padding:110px 30px 40px; /* 110 karena nav fixed */
  background:radial-gradient(circle at top left,#312e81 0,#020617 55%);
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
  background:rgba(15,23,42,0.9);
  padding:20px 18px;
  height:calc(100vh - 150px);
  overflow-y:auto;
  border-radius:16px;
  border:1px solid rgba(30,64,175,0.8);
  box-shadow:0 10px 30px rgba(0,0,0,.55);
}
.sidebar::-webkit-scrollbar{
  width:6px;
}
.sidebar::-webkit-scrollbar-thumb{
  background:#4b5563;
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
  color:#e5e7eb;
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
  color:#d1d5db;
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
  color:#f9fafb;
}
.breadcrumb{
  display:flex;
  align-items:center;
  gap:8px;
  margin-bottom:10px;
  font-size:13px;
  color:#9ca3af;
}

/* PRODUCT GRID */
.product-grid{
  display:grid;
  grid-template-columns:repeat(auto-fill,minmax(260px,1fr));
  gap:22px;
}
.product-card{
  background:#020617;
  border-radius:14px;
  overflow:hidden;
  box-shadow:0 10px 30px rgba(0,0,0,.6);
  transition:.2s;
  cursor:pointer;
  border:1px solid rgba(30,64,175,0.8);
}
.product-card:hover{
  transform:translateY(-5px);
  box-shadow:0 18px 40px rgba(0,0,0,.8);
}
.product-image{
  position:relative;
  background:#111827;
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
  background:#020617;
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

.product-info{ padding:14px 14px 13px; }
.product-name{
  font-weight:600;
  font-size:15px;
  margin-bottom:6px;
  color:#f9fafb;
}
.product-meta{
  font-size:12px;
  color:#9ca3af;
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
  color:#e5e7eb;
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
  background:#111827;
  font-size:18px;
  text-decoration:none;
  color:#e5e7eb;
  border:1px solid #374151;
  transition:.2s;
}
.reset-btn:hover{
  background:#020617;
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
  border:1px solid #4b5563;
  background:#020617;
  color:#e5e7eb;
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
  background:#111827;
  color:#f9fafb;
  font-size:13px;
  box-shadow:0 10px 25px rgba(0,0,0,.7);
  display:none;
}
</style>
</head>

<body>

{{-- NAVBAR --}}
<nav class="nav">
    <div class="nav-left">
        <a href="{{ route('home') }}" class="nav-logo">kampuStore</a>

        <div class="nav-menu">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('home') }}#about">About</a>
            <a href="{{ route('products.index') }}" class="active">Market</a>
            <a href="{{ route('home') }}#contact">Contact</a>
        </div>
    </div>

    {{-- SEARCH BAR (untuk produk) --}}
    <form class="nav-search" action="{{ route('products.index') }}" method="GET">
        <input type="text" name="q" placeholder="search product…" value="{{ request('q') }}">
        <button class="search-btn" type="submit">🔍</button>
    </form>

    {{-- ICONS KANAN --}}
    <div class="header-right">
        {{-- wishlist (HEADER) --}}
        <button class="icon-btn js-header-wishlist" type="button" title="Wishlist">
          <span class="icon-round icon-heart">❤️</span>
        </button>

        {{-- keranjang (HEADER) --}}
        <button class="icon-btn js-header-cart" type="button" title="Keranjang">
          <span class="icon-round icon-cart">🛒</span>
        </button>

        {{-- akun: klik => dropdown login/register + home --}}
        <div class="account-wrapper" id="accountWrapper">
          <button class="icon-btn js-account-toggle" type="button" title="Akun">
            <span class="icon-round icon-user">👤</span>
          </button>
          <div class="account-menu" id="accountMenu">
            @auth
              <div style="padding:6px 14px;font-size:12px;color:#9ca3af;">
                Halo, {{ auth()->user()->name }}
              </div>
              <a href="{{ route('home') }}">🏠 Back to Home</a>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Logout</button>
              </form>
            @else
              <a href="{{ route('home') }}">🏠 Back to Home</a>
              <a href="{{ route('login') }}">Login</a>
              <a href="{{ route('register') }}">Register</a>
            @endauth
          </div>
        </div>
    </div>
</nav>

{{-- MAIN MARKET AREA --}}
<main class="market-bg">
<div class="container">
  {{-- ==== SIDEBAR FILTER ==== --}}
  <aside class="sidebar">
  <form method="GET" action="{{ route('products.index') }}" id="filterForm">

    {{-- Kategori (default terbuka) --}}
    <div class="filter-section open" data-key="category">
      <div class="filter-title">
        <strong>Kategori</strong>
        <button type="button" class="filter-toggle"><span class="chev">⌄</span></button>
      </div>
      <div class="filter-content">
        @foreach($allCats as $c)
          <div class="filter-option">
            <input type="checkbox" name="cat[]" value="{{ $c['slug'] }}" id="cat-{{ $c['slug'] }}"
              @checked(in_array($c['slug'], $cats ?? []))>
            <label for="cat-{{ $c['slug'] }}">{{ $c['name'] }}</label>
          </div>
        @endforeach
      </div>
    </div>

    <hr style="border:none;border-top:1px solid #374151;margin:6px 0 10px;">

    {{-- JUDUL BESAR FILTER --}}
    <div class="filter-title" style="cursor:default;">
      <strong>Filter by:</strong>
    </div>

    {{-- Tipe --}}
    <div class="filter-section" data-key="type">
      <div class="filter-title">
        <strong>Tipe</strong>
        <button type="button" class="filter-toggle"><span class="chev">⌄</span></button>
      </div>

      <div class="filter-content">
        <div class="filter-option">
          <input type="checkbox" name="cond[]" value="baru" id="cond-baru"
                 @checked(in_array('baru', $cond ?? []))>
          <label for="cond-baru">Baru</label>
        </div>
        <div class="filter-option">
          <input type="checkbox" name="cond[]" value="bekas" id="cond-bekas"
                 @checked(in_array('bekas', $cond ?? []))>
          <label for="cond-bekas">Bekas</label>
        </div>
      </div>
    </div>

    {{-- Ukuran --}}
    <div class="filter-section" data-key="size">
      <div class="filter-title">
        <strong>Ukuran</strong>
        <button type="button" class="filter-toggle"><span class="chev">⌄</span></button>
      </div>
      <div class="filter-content">
        @foreach(['S','M','L','XL'] as $sz)
          <label class="filter-option" style="display:inline-flex;margin-right:10px;">
            <input type="checkbox" name="size[]" value="{{ $sz }}" @checked(in_array($sz, $sizes ?? []))> {{ $sz }}
          </label>
        @endforeach
        <div style="height:6px"></div>
      </div>
    </div>

    {{-- Harga --}}
    <div class="filter-section" data-key="price">
      <div class="filter-title">
        <strong>Harga</strong>
        <button type="button" class="filter-toggle"><span class="chev">⌄</span></button>
      </div>
      <div class="filter-content">
        <div style="font-size:12px;color:#d1d5db;margin-bottom:8px;">
          <span id="lblMin">Rp {{ number_format($priceMin ?: 0,0,',','.') }}</span> –
          <span id="lblMax">Rp {{ number_format($priceMax ?: 200000,0,',','.') }}</span>
        </div>
        <input type="range" id="rangeMin" min="0" max="200000" step="500"
               value="{{ $priceMin ?: 0 }}" style="width:100%">
        <input type="range" id="rangeMax" min="0" max="200000" step="500"
               value="{{ $priceMax ?: 200000 }}" style="width:100%;margin-top:6px">
        <input type="hidden" name="pmin" id="pmin" value="{{ $priceMin ?: 0 }}">
        <input type="hidden" name="pmax" id="pmax" value="{{ $priceMax ?: 200000 }}">
      </div>
    </div>

    {{-- Lokasi (scroll biasa) --}}
    <div class="filter-section" data-key="location">
      <div class="filter-title">
        <strong>Lokasi</strong>
        <button type="button" class="filter-toggle"><span class="chev">⌄</span></button>
      </div>

      <div class="filter-content">
          <div style="max-height:200px; overflow-y:auto; padding-right:4px;">
              @foreach($areas as $a)
                <label class="filter-option">
                  <input type="checkbox">
                  <span>{{ $a }}</span>
                </label>
              @endforeach
          </div>
      </div>
    </div>

    {{-- Rating --}}
    <div class="filter-section" data-key="rating">
      <div class="filter-title">
        <strong>Rating</strong>
        <button type="button" class="filter-toggle"><span class="chev">⌄</span></button>
      </div>
      <div class="filter-content">
        <select name="rmin">
          <option value="0" @selected(($ratingMin??0)==0)>Semua</option>
          @for($i=5;$i>=1;$i--)
            <option value="{{ $i }}" @selected(($ratingMin??0)==$i)>{{ $i }}★</option>
          @endfor
        </select>
      </div>
    </div>

    {{-- Stok --}}
    <div class="filter-section" data-key="stock">
      <div class="filter-title">
        <strong>Ketersediaan Stok</strong>
        <button type="button" class="filter-toggle"><span class="chev">⌄</span></button>
      </div>
      <div class="filter-content">
        <label class="filter-option">
          <input type="checkbox" name="in_stock" value="1" @checked($inStock ?? false)>
          <span>Hanya tampilkan yang stoknya ada</span>
        </label>
      </div>
    </div>

    {{-- query search tetap ikut --}}
    @if(request('q')) <input type="hidden" name="q" value="{{ request('q') }}"> @endif

    <div style="display:flex;gap:10px;margin-top:6px;">
      <button style="background:#f97316;color:#111827;border:none;padding:8px 12px;border-radius:8px;cursor:pointer;font-size:13px;font-weight:600;">Terapkan</button>
      <a href="{{ route('products.index') }}" class="reset-btn" title="Reset Filter">🗑️</a>
    </div>
  </form>
</aside>

  {{-- ==== KONTEN PRODUK ==== --}}
  <main class="main-content">
    <div class="breadcrumb">
        <span>Home</span> › <span>Market</span>
    </div>

    <h1 class="page-title">
        {{ ($cats??[]) ? (collect($allCats)->firstWhere('slug',$cats[0])['name'] ?? 'Katalog Produk') : 'Katalog Produk' }}
    </h1>

    @if($products->isEmpty())
      <p style="color:#e5e7eb;">Tidak ada produk.</p>
    @else
      <div class="product-grid">
        @foreach($products as $p)
          @php($isNew = ($p->condition ?? '') === 'baru')
          <a href="{{ route('products.show',$p) }}" class="product-card">
            <div class="product-image">
                {{-- badge Baru / Bekas --}}
                @if($p->condition)
                    <span class="badge {{ $isNew ? 'new' : 'used' }}">
                        {{ ucfirst($p->condition) }}
                    </span>
                @endif

                {{-- gambar produk --}}
                @if($p->image_url)
                    <img
                        src="{{ asset($p->image_url) }}"
                        alt="{{ $p->name }}"
                    >
                @else
                    <span style="font-size:13px;color:#9ca3af;padding:0 10px;text-align:center;">
                        {{ $p->name }}
                    </span>
                @endif

                {{-- tombol wishlist --}}
                <button class="favorite-btn" type="button" data-fav="0">🤍</button>
            </div>
            <div class="product-info">
              <div class="product-name">{{ $p->name }}</div>
              <div class="product-meta">{{ $p->seller_name ?? '-' }}</div>
              <div class="product-footer">
                <div class="product-price">Rp {{ number_format($p->price,0,',','.') }}</div>
                <button class="add-to-cart" type="button">🛒</button>
              </div>
            </div>
          </a>
        @endforeach
      </div>

      <div class="pagination">
        {{ $products->withQueryString()->links() }}
      </div>
    @endif
  </main>
</div>
</main>

<div id="toast" class="toast"></div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
</html>
