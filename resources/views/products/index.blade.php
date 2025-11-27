@php($title='kampuStore - Market')
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ $title }}</title>

<link rel="stylesheet"
      href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">

<style>
/* RESET */
*{margin:0;padding:0;box-sizing:border-box}

/* THEME VARIABLES (default = dark) – DISESUAIKAN DENGAN LOGIN/HOME */
:root{
  --bg-body:#050b1f;
  --text-main:#e5e7eb;

  --nav-bg:linear-gradient(90deg,#020617,#020617);
  --nav-border-bottom:rgba(30,64,175,0.5);
  --nav-shadow:0 14px 40px rgba(15,23,42,0.9);
  --nav-link-color:#e5e7eb;

  --market-bg:radial-gradient(circle at top left,#1f3b8a 0,#020617 52%,#020617 100%);

  --sidebar-bg:rgba(15,23,42,0.96);
  --sidebar-border:rgba(59,130,246,0.65);
  --sidebar-scroll-thumb:#4b5563;
  --sidebar-divider:rgba(55,65,81,0.85);
  --sidebar-select-bg:#020617;
  --sidebar-select-border:#3b82f6;
  --sidebar-text:#e5e7eb;

  --search-bg:#020617;
  --search-border:#1d4ed8;
  --search-text:#e5e7eb;
  --search-placeholder:#9ca3af;

  --icon-border:rgba(59,130,246,0.7);
  --icon-bg:rgba(15,23,42,0.9);
  --icon-color:#e5e7eb;

  --page-title-color:#f9fafb;
  --breadcrumb-color:#9ca3af;

  --reset-btn-bg:#020617;
  --reset-btn-border:#1f2937;

  --toast-bg:#020617;

  /* khusus MARKET (card produk, dll) */
  --product-card-bg:#1b2652;
  --product-card-border:rgba(110,130,230,0.5);
  --product-image-bg:#223066;
}

/* LIGHT MODE OVERRIDE – DISESUAIKAN DENGAN LOGIN/HOME */
body.theme-light{
  --bg-body:#eef2ff;
  --text-main:#1a2550;

  --nav-bg:#ffffff;
  --nav-border-bottom:#d9ddf0;
  --nav-shadow:0 4px 12px rgba(20,30,60,0.08);
  --nav-link-color:#1a2450;

  --market-bg:linear-gradient(
      135deg,
      #ffffff 0%,
      #e3e8ff 40%,
      #d5ddff 100%
  );

  --sidebar-bg:#ffffff;
  --sidebar-border:#cfd6f5;
  --sidebar-scroll-thumb:#97a3d5;
  --sidebar-divider:#d6dcfa;

  --sidebar-select-bg:#f2f4ff;
  --sidebar-select-border:#b9c4ef;
  --sidebar-text:#1f2b60;

  --search-bg:#ffffff;
  --search-border:#c4ccf2;
  --search-text:#1a1f3f;
  --search-placeholder:#9aa6d6;

  --icon-border:#c4ccf2;
  --icon-bg:#ffffff;
  --icon-color:#1b234a;

  --page-title-color:#1a2450;
  --breadcrumb-color:#6b76a5;

  --product-card-bg:#ffffff;
  --product-card-border:#d3daf9;
  --product-image-bg:#e4e8ff;

  --reset-btn-bg:#e3e6ff;
  --reset-btn-border:#c5cdf5;

  --toast-bg:#1b2652;
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
  height:40px;
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

/* HEADER RIGHT (toggle + icons) */
.header-right{
  display:flex;
  align-items:center;
  gap:14px;
}

/* THEME TOGGLE (SAMA DENGAN LOGIN/HOME/REGISTER/FORGOT) */
.theme-toggle-wrapper{
  display:flex;
  justify-content:center;
  align-items:center;
}
.toggle-switch{
  position:relative;
  display:inline-block;
  width:74px;
  height:36px;
  transform:scale(0.95);
  transition:transform .2s;
}
.toggle-switch:hover{
  transform:scale(1);
}
.toggle-switch input{
  opacity:0;
  width:0;
  height:0;
}
.slider{
  position:absolute;
  cursor:pointer;
  inset:0;
  background:linear-gradient(145deg,#fbbf24,#f97316);
  transition:.4s;
  border-radius:34px;
  box-shadow:0 0 12px rgba(249,115,22,0.5);
  overflow:hidden;
}
.slider:before{
  position:absolute;
  content:"☀️";
  height:28px;
  width:28px;
  left:4px;
  bottom:4px;
  background:white;
  transition:.4s;
  border-radius:50%;
  display:flex;
  align-items:center;
  justify-content:center;
  font-size:16px;
  box-shadow:0 0 10px rgba(0,0,0,0.15);
  z-index:2;
}
.clouds{
  position:absolute;
  width:100%;
  height:100%;
  overflow:hidden;
  pointer-events:none;
}
.cloud{
  position:absolute;
  width:24px;
  height:24px;
  fill:rgba(255,255,255,0.9);
  filter:drop-shadow(0 2px 3px rgba(0,0,0,0.08));
}
.cloud1{
  top:6px;
  left:10px;
  animation:floatCloud1 8s infinite linear;
}
.cloud2{
  top:10px;
  left:38px;
  transform:scale(0.85);
  animation:floatCloud2 12s infinite linear;
}
@keyframes floatCloud1{
  0%{transform:translateX(-20px);opacity:0;}
  20%{opacity:1;}
  80%{opacity:1;}
  100%{transform:translateX(80px);opacity:0;}
}
@keyframes floatCloud2{
  0%{transform:translateX(-20px) scale(0.85);opacity:0;}
  20%{opacity:0.7;}
  80%{opacity:0.7;}
  100%{transform:translateX(80px) scale(0.85);opacity:0;}
}
input.js-theme-toggle:checked + .slider{
  background:linear-gradient(145deg,#1f2937,#020617);
  box-shadow:0 0 14px rgba(15,23,42,0.8);
}
input.js-theme-toggle:checked + .slider:before{
  transform:translateX(38px);
  content:"🌙";
}
input.js-theme-toggle:checked + .slider .cloud{
  opacity:0;
  transform:translateY(-18px);
}

/* ICON HEADER DI KANAN – semua bulat & animasi sama */
.icon-btn{
  background:none;
  border:none;
  cursor:pointer;
  position:relative;
  padding:0;
}

/* bentuk bulat dasar */
.icon-round{
  width:32px;
  height:32px;
  border-radius:999px;
  border:1px solid #3b82f6;          /* biru neon */
  display:flex;
  align-items:center;
  justify-content:center;
  background:var(--icon-bg);
  font-size:18px;
  color:var(--icon-color);
  box-shadow:0 0 0 1px rgba(15,23,42,0.6);
  transition:
    transform .18s ease,
    background .18s ease,
    border-color .18s ease,
    box-shadow .18s ease;
}

/* hover semua icon kanan */
.header-right .icon-btn:hover .icon-round{
  transform:translateY(-2px);
  background:#ffffff;
  border-color:#d1d5db;
  box-shadow:
    0 0 0 1px rgba(148,163,184,0.5),
    0 8px 18px rgba(0,0,0,.45);
}

/* warna isi icon khusus */
.icon-round.icon-heart{ color:#fda4af; }      /* hati tetap pink */
.icon-round.icon-cart{ /* ikut warna default */ }
.icon-round.icon-user{ /* ikut warna default */ }

/* ====== STORE DROPDOWN (TOMBOL TOKO) ====== */

.store-wrapper{
  position:relative;
}

/* box dropdown toko */
.store-menu{
  position:absolute;
  right:0;
  top:110%;
  min-width:260px;
  padding:14px 16px 12px;
  border-radius:16px;

  background:rgba(15,23,42,0.9);
  border:1px solid rgba(148,163,184,0.55);
  box-shadow:0 18px 40px rgba(0,0,0,.85);
  backdrop-filter:blur(18px);
  -webkit-backdrop-filter:blur(18px);

  opacity:0;
  visibility:hidden;
  transform:translateY(-6px) scale(.97);
  transform-origin:top right;
  pointer-events:none;
  transition:
    opacity .18s ease-out,
    transform .18s ease-out,
    visibility .18s ease-out;
  z-index:120;
  text-align:center;
}

/* hover & pinned (class is-open) => tampil */
.store-wrapper:hover .store-menu,
.store-wrapper.is-open .store-menu{
  opacity:1;
  visibility:visible;
  transform:translateY(0) scale(1);
  pointer-events:auto;
}

/* isi text */
.store-empty-text{
  display:flex;
  flex-direction:column;
  gap:4px;
  font-size:12px;
  color:var(--sidebar-text);
  margin-bottom:10px;
}
.store-empty-title{
  font-weight:600;
  font-size:13px;
}
.store-empty-sub{
  font-size:11px;
  opacity:.9;
}

/* tombol hijau "Buka Toko Gratis" */
.store-cta{
  display:inline-flex;
  align-items:center;
  justify-content:center;
  padding:9px 18px;
  border-radius:999px;

  background:#f97316; /* oranye */
  color:#111827;

  font-size:13px;
  font-weight:700;
  margin-bottom:6px;

  box-shadow:0 10px 22px rgba(248,113,22,.55); /* oranye glow */

  transition:
    background .18s ease,
    transform .18s ease,
    box-shadow .18s ease;
}

.store-cta:hover{
  background:#fb923c; /* oranye terang (hover) */
  transform:translateY(-2px);
  box-shadow:0 14px 26px rgba(248,113,22,.65);
}

/* Light mode */
body.theme-light .store-cta{
  background:#f97316;
  color:#111827;
  box-shadow:0 10px 22px rgba(248,113,22,.45);
}

/* link kecil di bawah */
.store-help-link{
  display:inline-block;
  font-size:11px;
  color:#38bdf8;
  text-decoration:underline;
  text-underline-offset:3px;
}
.store-help-link:hover{
  color:#111827;
}

/* light mode */
body.theme-light .store-menu{
  background:#ffffff;
  border-color:#d1d5f0;
  box-shadow:0 18px 40px rgba(148,163,184,.6);
}
body.theme-light .store-empty-text{
  color:#111827;
}
body.theme-light .store-cta{
  color:#f9fafb;
}
body.theme-light .store-help-link{
  color:#0f766e;
}

/* WRAPPER AKUN */
.account-wrapper{
  position:relative;
}

/* DROPDOWN AKUN (default: sembunyi, dipakai hover / klik di mobile) */
.account-menu{
  position:absolute;
  right:0;
  top:110%;
  min-width:260px;
  padding:12px 12px 14px;
  border-radius:16px;

  background:rgba(15,23,42,0.88);
  border:1px solid rgba(148,163,184,0.55);
  box-shadow:0 18px 40px rgba(0,0,0,.85);
  backdrop-filter:blur(18px);
  -webkit-backdrop-filter:blur(18px);

  opacity:0;
  visibility:hidden;
  transform:translateY(-6px) scale(.97);
  transform-origin:top right;
  pointer-events:none;
  transition:
    opacity .18s ease-out,
    transform .18s ease-out,
    visibility .18s ease-out;
  z-index:120;
}

/* saat icon akun di-hover (desktop) atau wrapper dikasih class is-open (mobile) */
.account-wrapper:hover .account-menu,
.account-wrapper.is-open .account-menu{
  opacity:1;
  visibility:visible;
  transform:translateY(0) scale(1);
  pointer-events:auto;
}

/* animasi lama masih bisa dipakai kalau mau, tapi tidak wajib
@keyframes dropdownFade{...}
*/

/* ====== styling isi dropdown biar mirip Tokopedia ======= */

.profile-info{
  padding:10px 14px;
  border-radius:12px;
  background:rgba(15,23,42,0.96);
  border:1px solid rgba(148,163,184,0.4);
  margin:4px 4px 8px;
  display:flex;
  flex-direction:column;
  gap:3px;
  transition:
    background .18s ease,
    border-color .18s ease,
    box-shadow .18s ease,
    transform .18s ease;
  cursor:pointer;
}

.profile-info:hover{
  background:linear-gradient(
    135deg,
    rgba(30,64,175,0.95),
    rgba(15,23,42,0.98)
  );
  border-color:#60a5fa;
  box-shadow:0 0 0 1px rgba(37,99,235,0.5);
  transform:translateY(-1px);
}

body.theme-light .profile-info{
  background:#f9fafb;
  border-color:#e5e7f5;
}
body.theme-light .profile-info:hover{
  background:#e5e9ff;
  border-color:#4f46e5;
  box-shadow:0 0 0 1px rgba(79,70,229,0.4);
}


.profile-list{
  margin:0 4px 6px;
  padding:6px 0;
  border-top:1px solid var(--sidebar-divider);
  border-bottom:1px solid var(--sidebar-divider);
  display:flex;
  flex-direction:column;
}

.profile-item{
  padding:6px 10px;
  font-size:13px;
  color:var(--sidebar-text);
  border-radius:8px;
  display:flex;
  justify-content:space-between;
  align-items:center;
  cursor:pointer;
  transition:background .16s ease,color .16s ease,transform .16s ease;
}

.profile-item:hover{
  background:rgba(15,23,42,0.95);
  color:#f97316;
  transform:translateX(2px);
}

body.theme-light .account-menu{
  background:#ffffff;
  border-color:#d1d5f0;
  box-shadow:0 18px 40px rgba(148,163,184,.6);
}
body.theme-light .profile-info{
  background:#f9fafb;
  border-color:#e5e7f5;
}
body.theme-light .profile-name{
  color:#111827;
}
body.theme-light .profile-item:hover{
  background:#f3f4ff;
  color:#ea580c;
}


/* animasi muncul */
@keyframes dropdownFade{
  from{
    opacity:0;
    transform:translateY(-6px) scale(.97);
  }
  to{
    opacity:1;
    transform:translateY(0) scale(1);
  }
}

/* salam di atas tombol */
.account-menu .account-greet{
  padding:10px 16px 12px;
  font-size:14.5px;
  font-weight:600;
  color:#f1f5f9;
  letter-spacing:0.3px;
  text-shadow:0 0 6px rgba(255,255,255,0.06);
}
body.theme-light .account-menu .account-greet{
  color:#1e293b;
  text-shadow:none;
}
.account-menu .account-greet:hover{
  text-decoration:underline;
  text-decoration-thickness:1px;
  text-underline-offset:4px;
}

/* BASE TOMBOL DROPDOWN (Login, Register, Logout) */
.account-menu .custom-btn{
  width:100%;
  height:38px;
  border-radius:999px;
  padding:0 16px;

  font-family:inherit;
  font-size:13px;
  font-weight:600;

  display:flex;
  align-items:center;
  justify-content:center;

  background:transparent;
  color:var(--sidebar-text);
  border:none;
  cursor:pointer;
  outline:none;

  transition:all 0.3s ease;
  box-shadow:
    inset 2px 2px 2px 0px rgba(255,255,255,.05),
    7px 7px 20px 0px rgba(0,0,0,.25),
    4px 4px 5px 0px rgba(0,0,0,.2);
}

/* LOGIN / LOGOUT = outline gelap */
.account-menu .btn-auth-outline{
  border:1px solid rgba(249,115,22,0.7);
  background:rgba(15,23,42,0.9);
  color:var(--sidebar-text);
}

/* REGISTER = gradient oranye */
.account-menu .btn-auth-primary{
  background:linear-gradient(
    135deg,
    #f97316 0%,
    #fb923c 50%,
    #f97316 100%
  );
  color:#111827;
  box-shadow:0 10px 24px rgba(248,113,22,.55);
}

/* efek hover */
.account-menu .custom-btn:hover{
  box-shadow:
    4px 4px 6px 0 rgba(255,255,255,.15),
    -4px -4px 6px 0 rgba(15,23,42,.7),
    inset -4px -4px 6px 0 rgba(255,255,255,.08),
    inset 4px 4px 6px 0 rgba(0,0,0,.55);
  transform:translateY(-1px);
}

/* light mode */
body.theme-light .account-menu .btn-auth-outline{
  background:#f9fafb;
  border-color:#f97316;
  color:#111827;
}
body.theme-light .account-menu .btn-auth-primary{
  box-shadow:0 8px 18px rgba(248,113,22,.55);
}


/* ==== BACKGROUND MARKET (radial + blob) ==== */
.market-bg{
  min-height:100vh;
  padding:110px 30px 40px;
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

/* CUSTOM CHECKBOX */
.input[type="checkbox"]{
  display:none;
}
.custom-checkbox{
  display:inline-block;
  width:20px;
  height:20px;
  border:2px solid var(--sidebar-select-border);
  border-radius:4px;
  position:relative;
  cursor:pointer;
  background:var(--sidebar-select-bg);
}
.custom-checkbox::after{
  content:"";
  position:absolute;
  top:50%;
  left:50%;
  transform:translate(-50%, -50%);
  width:10px;
  height:10px;
  background-color:#f97316;
  border-radius:2px;
  opacity:0;
}
.input[type="checkbox"]:checked + .custom-checkbox::after{
  opacity:1;
}
.filter-option-text{
  margin-left:8px;
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

/* ==== WELCOME BANNER (INTERAKTIF – SAMA TEMA DENGAN LOGIN & HOME) ==== */
.welcome-banner{
  width:100%;
  padding:26px 34px;
  border-radius:22px;

  background:linear-gradient(
      135deg,
      rgba(23,37,84,0.88),
      rgba(30,58,138,0.88),
      rgba(15,23,42,0.92)
  );

  border:1px solid rgba(59,130,246,0.55);
  box-shadow:0 16px 40px rgba(0,0,0,.65);

  color:var(--text-main);

  margin-bottom:22px;
  display:flex;
  flex-direction:column;
  gap:8px;

  opacity:0;
  transform:translateY(12px);
  animation:bannerReveal .55s ease forwards;
}

@keyframes bannerReveal{
  from{opacity:0;transform:translateY(12px);}
  to{opacity:1;transform:translateY(0);}
}

.welcome-title{
  font-size:26px;
  font-weight:800;
  color:var(--page-title-color);
}

.welcome-sub{
  font-size:15px;
  color:var(--breadcrumb-color);
}

/* === CTA BUTTON: WARNA ORANYE (SAMA DENGAN TOMBOL DI LOGIN/HOME) === */
.welcome-cta{
  margin-top:10px;
  display:inline-flex;
  padding:10px 20px;

  background:#f97316;
  color:#111827;

  font-size:14px;
  font-weight:700;
  border-radius:999px;
  border:none;
  cursor:pointer;

  align-self:flex-start;
  transition:.25s ease;
  box-shadow:0 12px 26px rgba(248,113,22,.55);
}

.welcome-cta:hover{
  transform:translateY(-2px);
  background:#fb923c;
}

/* === LIGHT MODE === */
body.theme-light .welcome-banner{
  background:linear-gradient(135deg,#ffffff,#eef2ff);
  border:1px solid #d9ddf0;
  box-shadow:0 12px 30px rgba(148,163,184,0.45);
}

body.theme-light .welcome-title{
  color:#1a2450;
}

body.theme-light .welcome-sub{
  color:#4b5563;
}

body.theme-light .welcome-cta{
  background:#f97316;
  color:#111827;
}


/* TOP CHAT BAR (CHAT DENGAN PENJUAL) */
.top-chat-bar{
  display:flex;
  align-items:center;
  justify-content:space-between;
  gap:10px;
  padding:14px 16px;
  border-radius:18px;

  background:linear-gradient(
      135deg,
      rgba(15,23,42,0.96),
      rgba(15,23,42,0.98)
  );
  border:1px solid rgba(59,130,246,0.55);
  box-shadow:0 12px 30px rgba(0,0,0,.65);

  margin-bottom:16px;
  font-size:13px;
  color:var(--sidebar-text);
  flex-wrap:wrap;
}

body.theme-light .top-chat-bar{
  background:#ffffff;
  border-color:#d9ddf0;
  box-shadow:0 10px 24px rgba(148,163,184,0.45);
}

.top-chat-text{
  display:flex;
  flex-direction:column;
  gap:2px;
}

.top-chat-text strong{
  font-size:14px;
  color:var(--page-title-color);
}

/* tombol chat seller – oranye sama seperti banner/login */
.chat-seller-btn{
  display:inline-flex;
  align-items:center;
  gap:6px;
  padding:9px 18px;
  border-radius:999px;
  border:none;
  cursor:pointer;

  background:#f97316;
  color:#111827;
  font-size:13px;
  font-weight:600;
  white-space:nowrap;
  box-shadow:0 10px 24px rgba(248,113,22,.55);
  transition:.2s ease;
}

.chat-seller-btn:hover{
  background:#fb923c;
  transform:translateY(-1px);
}

.chat-seller-btn span.icon{
  font-size:15px;
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
  transition:transform .15s ease, background .15s ease;
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

/* toast */
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

/* === FLOATING AI CHAT BUTTON & PANEL === */
.floating-chat-btn{
  position:fixed;
  right:24px;
  bottom:24px;
  width:52px;
  height:52px;
  border-radius:999px;
  border:none;
  background:#f97316;
  color:#111827;
  display:flex;
  align-items:center;
  justify-content:center;
  font-size:24px;
  cursor:pointer;
  box-shadow:0 14px 30px rgba(0,0,0,.75);
  z-index:140;
  transition:transform .15s ease, box-shadow .15s ease, background .15s ease;
}
.floating-chat-btn:hover{
  transform:translateY(-2px);
  box-shadow:0 20px 40px rgba(0,0,0,.85);
  background:#fb923c;
}
body.theme-light .floating-chat-btn{
  box-shadow:0 14px 30px rgba(148,163,184,.8);
}

.ai-chat-panel{
  position:fixed;
  right:24px;
  bottom:90px;
  width:320px;
  max-height:420px;
  background:var(--sidebar-bg);
  border-radius:18px;
  border:1px solid var(--sidebar-border);
  box-shadow:0 18px 40px rgba(0,0,0,.8);
  display:none;
  flex-direction:column;
  z-index:139;
  overflow:hidden;
}
body.theme-light .ai-chat-panel{
  box-shadow:0 18px 40px rgba(148,163,184,.75);
}
.ai-chat-header{
  padding:10px 12px;
  border-bottom:1px solid var(--sidebar-divider);
  display:flex;
  align-items:center;
  justify-content:space-between;
  font-size:13px;
  color:var(--sidebar-text);
}
.ai-chat-title{
  font-weight:600;
}
.ai-chat-badge{
  font-size:10px;
  padding:3px 8px;
  border-radius:999px;
  background:rgba(248,113,22,0.15);
  color:#fed7aa;
}
body.theme-light .ai-chat-badge{
  background:#fef3c7;
  color:#9a3412;
}
.ai-chat-close{
  border:none;
  background:none;
  cursor:pointer;
  font-size:16px;
  color:var(--sidebar-text);
}
.ai-chat-messages{
  padding:10px 12px;
  flex:1;
  overflow-y:auto;
  font-size:12px;
}
.ai-chat-message{
  margin-bottom:8px;
  max-width:82%;
  padding:7px 9px;
  border-radius:10px;
  line-height:1.4;
}
.ai-chat-message.user{
  margin-left:auto;
  background:#f97316;
  color:#111827;
  border-bottom-right-radius:2px;
}
.ai-chat-message.bot{
  margin-right:auto;
  background:rgba(15,23,42,0.9);
  border-bottom-left-radius:2px;
  color:var(--sidebar-text);
}
body.theme-light .ai-chat-message.bot{
  background:#f3f4f6;
}
.ai-chat-footer{
  padding:8px 10px 9px;
  border-top:1px solid var(--sidebar-divider);
  display:flex;
  gap:6px;
}
.ai-chat-input{
  flex:1;
  resize:none;
  border-radius:10px;
  border:1px solid var(--sidebar-select-border);
  padding:6px 8px;
  font-size:12px;
  background:var(--sidebar-select-bg);
  color:var(--sidebar-text);
  outline:none;
  max-height:60px;
}
.ai-chat-send{
  border:none;
  border-radius:10px;
  padding:6px 10px;
  font-size:12px;
  font-weight:600;
  background:#f97316;
  color:#111827;
  cursor:pointer;
}

/* responsive AI chat (mobile) */
@media(max-width:600px){
  .ai-chat-panel{
    width:calc(100% - 32px);
    right:16px;
  }
}
/* === AI CHAT (INPUT) === */
.container_chat_bot{
  display:flex;
  flex-direction:column;
  max-width:100%;
  width:100%;
  margin-top:6px;
}

.container_chat_bot .container-chat-options{
  position:relative;
  display:flex;
  background:linear-gradient(
    to bottom right,
    rgba(148,163,184,0.8),
    rgba(30,64,175,0.9),
    rgba(15,23,42,1)
  );
  border-radius:16px;
  padding:1.5px;
  overflow:hidden;
}

.container_chat_bot .container-chat-options::after{
  position:absolute;
  content:"";
  top:-10px;
  left:-10px;
  background:radial-gradient(
    ellipse at center,
    #ffffff,
    rgba(255,255,255,0.3),
    rgba(255,255,255,0.1),
    rgba(0,0,0,0)
  );
  width:30px;
  height:30px;
  filter:blur(1px);
}

/* isi chat box */
.container_chat_bot .container-chat-options .chat{
  display:flex;
  flex-direction:column;
  background-color:rgba(15,23,42,0.95);
  border-radius:15px;
  width:100%;
  overflow:hidden;
}
body.theme-light .container_chat_bot .container-chat-options .chat{
  background-color:#f9fafb;
}

.container_chat_bot .container-chat-options .chat .chat-bot{
  position:relative;
  display:flex;
}

/* textarea */
.container_chat_bot .chat .chat-bot textarea{
  background-color:transparent;
  border-radius:16px;
  border:none;
  width:100%;
  height:60px;
  color:var(--sidebar-text);
  font-family:inherit;
  font-size:12px;
  font-weight:400;
  padding:10px 12px;
  resize:none;
  outline:none;
}

/* scrollbar textarea */
.container_chat_bot .chat .chat-bot textarea::-webkit-scrollbar{
  width:8px;
  height:8px;
}
.container_chat_bot .chat .chat-bot textarea::-webkit-scrollbar-track{
  background:transparent;
}
.container_chat_bot .chat .chat-bot textarea::-webkit-scrollbar-thumb{
  background:#6b7280;
  border-radius:5px;
}
.container_chat_bot .chat .chat-bot textarea::-webkit-scrollbar-thumb:hover{
  background:#4b5563;
  cursor:pointer;
}

/* placeholder */
.container_chat_bot .chat .chat-bot textarea::placeholder{
  color:#e5e7eb;
  opacity:.8;
  transition:color .25s ease;
}
body.theme-light .container_chat_bot .chat .chat-bot textarea::placeholder{
  color:#9ca3af;
}
.container_chat_bot .chat .chat-bot textarea:focus::placeholder{
  color:transparent;
}

/* bawah: tombol dan icon kecil */
.container_chat_bot .chat .options{
  display:flex;
  justify-content:space-between;
  align-items:flex-end;
  padding:8px 10px 9px;
}

.container_chat_bot .chat .options .btns-add{
  display:flex;
  gap:8px;
}
.container_chat_bot .chat .options .btns-add button{
  display:flex;
  align-items:center;
  justify-content:center;
  color:rgba(249,250,251,0.25);
  background-color:transparent;
  border:none;
  cursor:pointer;
  transition:all .25s ease;
}
body.theme-light .container_chat_bot .chat .options .btns-add button{
  color:rgba(31,41,55,0.3);
}
.container_chat_bot .chat .options .btns-add button:hover{
  transform:translateY(-3px);
  color:#ffffff;
}
body.theme-light .container_chat_bot .chat .options .btns-add button:hover{
  color:#111827;
}

/* tombol submit (pesawat) */
.container_chat_bot .chat .options .btn-submit{
  display:flex;
  padding:2px;
  background-image:linear-gradient(to top,#292929,#555555,#292929);
  border-radius:10px;
  box-shadow:inset 0 6px 2px -4px rgba(255,255,255,0.5);
  cursor:pointer;
  border:none;
  outline:none;
  transition:transform .15s ease;
}
body.theme-light .container_chat_bot .chat .options .btn-submit{
  background-image:linear-gradient(to top,#e5e7eb,#ffffff,#e5e7eb);
  box-shadow:inset 0 4px 2px -4px rgba(156,163,175,0.8);
}

.container_chat_bot .chat .options .btn-submit i{
  width:30px;
  height:30px;
  padding:6px;
  background:rgba(0,0,0,0.1);
  border-radius:10px;
  backdrop-filter:blur(3px);
  color:#8b8b8b;
  display:flex;
  align-items:center;
  justify-content:center;
}
body.theme-light .container_chat_bot .chat .options .btn-submit i{
  background:rgba(255,255,255,0.6);
  color:#4b5563;
}

.container_chat_bot .chat .options .btn-submit svg{
  transition:all .3s ease;
}
.container_chat_bot .chat .options .btn-submit:hover svg{
  color:#f3f6fd;
  filter:drop-shadow(0 0 5px #ffffff);
}
body.theme-light .container_chat_bot .chat .options .btn-submit:hover svg{
  color:#111827;
  filter:drop-shadow(0 0 4px rgba(148,163,184,0.7));
}
.container_chat_bot .chat .options .btn-submit:focus svg{
  color:#f3f6fd;
  filter:drop-shadow(0 0 5px #ffffff);
  transform:scale(1.15) rotate(45deg) translateX(-2px) translateY(1px);
}
body.theme-light .container_chat_bot .chat .options .btn-submit:focus svg{
  color:#0f172a;
}
.container_chat_bot .chat .options .btn-submit:active{
  transform:scale(0.92);
}

/* TAGS DI BAWAH */
.container_chat_bot .tags{
  padding:10px 2px 0;
  display:flex;
  flex-wrap:wrap;
  color:var(--sidebar-text);
  font-size:10px;
  gap:6px;
}
.container_chat_bot .tags span{
  padding:4px 9px;
  background-color:rgba(15,23,42,0.9);
  border:1.5px solid #363636;
  border-radius:999px;
  cursor:pointer;
  user-select:none;
}
body.theme-light .container_chat_bot .tags span{
  background-color:#e5e7eb;
  border-color:#cbd5f5;
}

/* supaya panel AI scroll tetap oke */
.ai-chat-messages{
  padding:10px 12px;
  flex:1;
  overflow-y:auto;
  font-size:12px;
}

/* pesan bubble tetap pakai style lama (biarin) */

</style>
</head>

<body class="theme-dark"><!-- default night mode -->

{{-- NAVBAR --}}
<nav class="nav">
  <div class="nav-left">
    <a href="{{ route('home') }}" class="nav-logo">
      <img src="{{ asset('images/logo.png') }}" alt="kampuStore logo">
      <span>kampuStore</span>
    </a>

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

  {{-- TOGGLE TEMA + ICONS --}}
  <div class="header-right">
    {{-- THEME TOGGLE (SAMA DENGAN HALAMAN LAIN) --}}
    <div class="theme-toggle-wrapper">
      <label class="toggle-switch">
        <input type="checkbox" class="js-theme-toggle">
        <span class="slider">
          <div class="clouds">
            <svg viewBox="0 0 100 100" class="cloud cloud1">
              <path d="M30,45 Q35,25 50,25 Q65,25 70,45 Q80,45 85,50 Q90,55 85,60 Q80,65 75,60 Q65,60 60,65 Q55,70 50,65 Q45,70 40,65 Q35,60 25,60 Q20,65 15,60 Q10,55 15,50 Q20,45 30,45"></path>
            </svg>
            <svg viewBox="0 0 100 100" class="cloud cloud2">
              <path d="M30,45 Q35,25 50,25 Q65,25 70,45 Q80,45 85,50 Q90,55 85,60 Q80,65 75,60 Q65,60 60,65 Q55,70 50,65 Q45,70 40,65 Q35,60 25,60 Q20,65 15,60 Q10,55 15,50 Q20,45 30,45"></path>
            </svg>
          </div>
        </span>
      </label>
    </div>

    {{-- wishlist (HEADER) --}}
    <button class="icon-btn js-header-wishlist" type="button" title="Wishlist">
      <span class="icon-round icon-heart">❤️</span>
    </button>

    {{-- keranjang (HEADER) --}}
    <button class="icon-btn js-header-cart" type="button" title="Keranjang">
      <span class="icon-round icon-cart">🛒</span>
    </button>

    {{-- Toko + Dropdown --}}
    <div class="store-wrapper" id="storeWrapper">
      <button type="button" class="icon-btn store-btn js-store-toggle" title="Toko">
        <span class="icon-round">
          <i class="uil uil-store"></i>
        </span>
      </button>

      <div class="store-menu" id="storeMenu">
        <div class="store-empty-text">
          <span class="store-empty-title">Kamu belum memiliki toko.</span>
          <span class="store-empty-sub">
            Buka toko gratis dan mulai jualan di kampuStore.
          </span>
        </div>

        @auth
          @if(auth()->user()->seller && auth()->user()->seller->status === 'approved')
            {{-- Seller sudah disetujui --}}
            <a href="{{ route('seller.dashboard') }}" class="store-cta">
              Kelola Toko Anda
            </a>
          @elseif(auth()->user()->seller && auth()->user()->seller->status === 'pending')
            {{-- Seller menunggu verifikasi --}}
            <div class="store-cta" style="background: linear-gradient(135deg, #f59e0b, #d97706); cursor: not-allowed;">
              Menunggu Verifikasi Admin
            </div>
          @else
            {{-- Seller ditolak atau belum daftar (seharusnya tidak terjadi) --}}
            <a href="{{ route('seller.dashboard') }}" class="store-cta">
              Dashboard Toko
            </a>
          @endif
        @else
          {{-- Belum login --}}
          <a href="{{ route('register') }}" class="store-cta">
            Daftar Toko Gratis
          </a>
        @endauth

        <a href="#" class="store-help-link">
          Tokomu bermasalah? Pelajari selengkapnya
        </a>
      </div>
    </div>

    {{-- akun: klik => dropdown login/register --}}
    <div class="account-wrapper" id="accountWrapper">
      <button class="icon-btn js-account-toggle" type="button" title="Akun">
        <span class="icon-round icon-user">👤</span>
      </button>

      <div class="account-menu" id="accountMenu">
        @auth
          <div class="profile-info">
            <div class="profile-name">{{ auth()->user()->name }}</div>
            <div class="profile-role">Akun kampuStore</div>
          </div>

          {{-- MENU LIST --}}
          <div class="profile-list">
              <a href="#" class="profile-item">Pembelian</a>
              <a href="#" class="profile-item">Wishlist</a>
              <a href="#" class="profile-item">Toko Favorit</a>
              <a href="#" class="profile-item">Pengaturan</a>
          </div>

          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                    class="custom-btn btn-auth-outline"
                    style="margin:6px 10px 4px;">
              Logout
            </button>
          </form>
        @else
          <a href="{{ route('login') }}"
            class="custom-btn btn-auth-outline"
            style="margin:4px 10px 2px;">
            Login
          </a>

          <a href="{{ route('register') }}"
            class="custom-btn btn-auth-primary"
            style="margin:2px 10px 6px;">
            Register
          </a>
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
              <label class="filter-option">
                <input
                  type="checkbox"
                  class="input"
                  name="cat[]"
                  value="{{ $c['slug'] }}"
                  id="cat-{{ $c['slug'] }}"
                  @checked(in_array($c['slug'], $cats ?? []))
                >
                <span class="custom-checkbox"></span>
                <span class="filter-option-text">{{ $c['name'] }}</span>
              </label>
            @endforeach
          </div>
        </div>

        <hr style="border:none;border-top:1px solid var(--sidebar-divider);margin:6px 0 10px;">

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
            <label class="filter-option">
              <input
                type="checkbox"
                class="input"
                name="cond[]"
                value="baru"
                id="cond-baru"
                @checked(in_array('baru', $cond ?? []))
              >
              <span class="custom-checkbox"></span>
              <span class="filter-option-text">Baru</span>
            </label>

            <label class="filter-option">
              <input
                type="checkbox"
                class="input"
                name="cond[]"
                value="bekas"
                id="cond-bekas"
                @checked(in_array('bekas', $cond ?? []))
              >
              <span class="custom-checkbox"></span>
              <span class="filter-option-text">Bekas</span>
            </label>
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
              <label class="filter-option" style="display:flex;margin-right:10px;">
                <input
                  type="checkbox"
                  class="input"
                  name="size[]"
                  value="{{ $sz }}"
                  @checked(in_array($sz, $sizes ?? []))
                >
                <span class="custom-checkbox"></span>
                <span class="filter-option-text">{{ $sz }}</span>
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
            <div style="font-size:12px;color:var(--sidebar-text);margin-bottom:8px;">
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
                  <input
                    type="checkbox"
                    class="input"
                    name="area[]"
                    value="{{ $a }}"
                  >
                  <span class="custom-checkbox"></span>
                  <span class="filter-option-text">{{ $a }}</span>
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
              <input
                type="checkbox"
                class="input"
                name="in_stock"
                value="1"
                @checked($inStock ?? false)
              >
              <span class="custom-checkbox"></span>
              <span class="filter-option-text">Hanya tampilkan yang stoknya ada</span>
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

      {{-- WELCOME BANNER --}}
      <div class="welcome-banner">
        @auth
          <div class="welcome-title">Selamat datang, {{ auth()->user()->name }}!</div>
          <div class="welcome-sub">
            Mulai belanja kebutuhan kampus dari sesama mahasiswa <strong>UNDIP</strong>
          </div>
        @else
          <div class="welcome-title">Selamat datang di kampuStore!</div>
          <div class="welcome-sub">
            Belanja perlengkapan kampus dari mahasiswa UNDIP lain — lebih aman dan cepat
          </div>

          <a href="{{ route('login') }}" class="welcome-cta">
            Login untuk mulai belanja
          </a>
        @endauth
      </div>

      {{-- BAR CHAT DENGAN PENJUAL DI ATAS --}}
      <div class="top-chat-bar">
        <div class="top-chat-text">
          <strong>Butuh tanya-tanya dulu ke penjual?</strong>
          <span>Kamu bisa ngobrol dulu soal kondisi barang, nego harga, atau janjian COD.</span>
        </div>
        <button type="button" class="chat-seller-btn" id="chatSellerBtn">
          <span class="icon"></span>
          <span>Chat dengan Penjual</span>
        </button>
      </div>

      <div class="breadcrumb">
        <span>Home</span> › <span>Market</span>
      </div>

      <h1 class="page-title">
        {{ ($cats??[]) ? (collect($allCats)->firstWhere('slug',$cats[0])['name'] ?? 'Katalog Produk') : 'Katalog Produk' }}
      </h1>

      @if($products->isEmpty())
        <p style="color:var(--sidebar-text);">Tidak ada produk.</p>
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
                  <span style="font-size:13px;color:var(--breadcrumb-color);padding:0 10px;text-align:center;">
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

{{-- FLOATING AI CHAT BUTTON & PANEL --}}
<button type="button" class="floating-chat-btn" id="aiChatToggle" title="Chat dengan AI">
  💬
</button>

<div class="ai-chat-panel" id="aiChatPanel">
  <div class="ai-chat-header">
    <div style="display:flex;flex-direction:column;gap:2px;">
      <span class="ai-chat-title">kampuStore AI Assistant</span>
      <span style="font-size:10px;color:var(--breadcrumb-color);">
        Tanya seputar produk & tips belanja
      </span>
    </div>
    <button type="button" class="ai-chat-close" id="aiChatClose">✕</button>
  </div>

  {{-- LOG CHAT SINGKAT (optional) --}}
  <div class="ai-chat-messages" id="aiChatMessages">
    <div class="ai-chat-message bot">
      Hai! Aku asisten AI kampuStore.
      Tulis pertanyaanmu di bawah, misalnya:
      "Rekomendasi kalkulator di bawah 200K" atau "Tips cek kondisi laptop bekas".
      (Mockup: belum terhubung ke backend beneran.)
    </div>
  </div>

  {{-- INPUT  --}}
  <div class="container_chat_bot">
    <div class="container-chat-options">
      <div class="chat">
        <div class="chat-bot">
          <textarea
            id="marketAiInput"
            name="chat_bot"
            placeholder="Tanyakan sesuatu ke AI kampuStore..."
          ></textarea>
        </div>
        <div class="options">
          <div class="btns-add">
            <button type="button" class="market-ai-extra" data-type="voice" title="(mock) Voice">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                <path
                  fill="none"
                  stroke="currentColor"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M7 8v8a5 5 0 1 0 10 0V6.5a3.5 3.5 0 1 0-7 0V15a2 2 0 0 0 4 0V8"
                />
              </svg>
            </button>
            <button type="button" class="market-ai-extra" data-type="attach" title="(mock) Attach">
              <svg viewBox="0 0 24 24" height="20" width="20" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M4 5a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v4a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1zm0 10a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v4a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1zm10 0a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v4a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1zm0-8h6m-3-3v6"
                  stroke-width="2"
                  stroke-linejoin="round"
                  stroke-linecap="round"
                  stroke="currentColor"
                  fill="none"
                />
              </svg>
            </button>
            <button type="button" class="market-ai-extra" data-type="globe" title="(mock) Tools">
              <svg viewBox="0 0 24 24" height="20" width="20" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10s-4.477 10-10 10m-2.29-2.333A17.9 17.9 0 0 1 8.027 13H4.062a8.01 8.01 0 0 0 5.648 6.667M10.03 13c.151 2.439.848 4.73 1.97 6.752A15.9 15.9 0 0 0 13.97 13zm9.908 0h-3.965a17.9 17.9 0 0 1-1.683 6.667A8.01 8.01 0 0 0 19.938 13M4.062 11h3.965A17.9 17.9 0 0 1 9.71 4.333A8.01 8.01 0 0 0 4.062 11m5.969 0h3.938A15.9 15.9 0 0 0 12 4.248A15.9 15.9 0 0 0 10.03 11m4.259-6.667A17.9 17.9 0 0 1 15.973 11h3.965a8.01 8.01 0 0 0-5.648-6.667"
                  fill="currentColor"
                />
              </svg>
            </button>
          </div>
          <button type="button" class="btn-submit" id="marketAiSend">
            <i>
              <svg viewBox="0 0 512 512">
                <path
                  fill="currentColor"
                  d="M473 39.05a24 24 0 0 0-25.5-5.46L47.47 185h-.08a24 24 0 0 0 1 45.16l.41.13l137.3 58.63a16 16 0 0 0 15.54-3.59L422 80a7.07 7.07 0 0 1 10 10L226.66 310.26a16 16 0 0 0-3.59 15.54l58.65 137.38c.06.2.12.38.19.57c3.2 9.27 11.3 15.81 21.09 16.25h1a24.63 24.63 0 0 0 23-15.46L478.39 64.62A24 24 0 0 0 473 39.05"
                />
              </svg>
            </i>
          </button>
        </div>
      </div>
    </div>

    <div class="tags" id="marketAiTags">
      <span data-template="Rekomendasi buku kuliah akuntansi harga di bawah 100K">
        Rekomendasi buku kuliah
      </span>
      <span data-template="Tips cek laptop bekas sebelum COD di area UNDIP">
        Tips cek laptop bekas
      </span>
      <span data-template="Rekomendasi perlengkapan kos untuk mahasiswa baru UNDIP">
        Ide perlengkapan kos
      </span>
    </div>
  </div>
</div>


<div id="toast" class="toast"></div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- SweetAlert untuk flash message global --}}
@if(session('success') || session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if(session('success'))
                Swal.fire({
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    confirmButtonColor: '#f97316',
                    confirmButtonText: 'OK'
                });
            @endif

            @if(session('error'))
                Swal.fire({
                    title: 'Gagal!',
                    text: '{{ session('error') }}',
                    icon: 'error',
                    confirmButtonColor: '#ef4444',
                    confirmButtonText: 'OK'
                });
            @endif
        });
    </script>
@endif


<script>
  // THEME TOGGLE – sinkron dengan login/register/forgot/home
  (function(){
    const THEME_KEY = 'kampuStoreTheme';
    const body = document.body;
    const checkbox = document.querySelector('.js-theme-toggle');

    function applyTheme(mode){
      if(mode === 'light'){
        body.classList.add('theme-light');
      } else {
        body.classList.remove('theme-light');
      }
    }

    const saved = localStorage.getItem(THEME_KEY) || 'dark';
    applyTheme(saved);

    if(checkbox){
      // checked = dark, unchecked = light
      checkbox.checked = (saved !== 'light');

      checkbox.addEventListener('change', () => {
        const mode = checkbox.checked ? 'dark' : 'light';
        applyTheme(mode);
        localStorage.setItem(THEME_KEY, mode);
      });
    }
  })();
</script>

<script>
(function(){
  const storeWrapper = document.getElementById('storeWrapper');
  const storeToggle  = document.querySelector('.js-store-toggle');
  const storeMenu    = document.getElementById('storeMenu');

  const accWrapper   = document.getElementById('accountWrapper');
  const accToggle    = document.querySelector('.js-account-toggle');
  const accMenu      = document.getElementById('accountMenu');

  let storePinned = false;
  let accPinned   = false;

  function openStorePin(){
    if (!storeWrapper) return;
    storePinned = true;
    storeWrapper.classList.add('is-open');
  }
  function closeStore(){
    if (!storeWrapper) return;
    storePinned = false;
    storeWrapper.classList.remove('is-open');
  }

  function openAccPin(){
    if (!accWrapper) return;
    accPinned = true;
    accWrapper.classList.add('is-open');
  }
  function closeAcc(){
    if (!accWrapper) return;
    accPinned = false;
    accWrapper.classList.remove('is-open');
  }

  // === TOMBOL TOKO ===
  if (storeToggle && storeWrapper && storeMenu) {
    storeToggle.addEventListener('click', function(e){
      e.stopPropagation();

      // kalau akun lagi kebuka, tutup dulu
      closeAcc();

      if (storePinned) {
        closeStore();
      } else {
        openStorePin();
      }
    });

    // klik di dalam menu toko jangan tembus ke document
    storeMenu.addEventListener('click', function(e){
      e.stopPropagation();
    });
  }

  // === TOMBOL AKUN ===
  if (accToggle && accWrapper && accMenu) {
    accToggle.addEventListener('click', function(e){
      e.stopPropagation();

      // kalau toko lagi kebuka, tutup dulu
      closeStore();

      if (accPinned) {
        closeAcc();
      } else {
        openAccPin();
      }
    });

    // klik di dalam menu akun jangan tembus ke document
    accMenu.addEventListener('click', function(e){
      e.stopPropagation();
    });
  }

  // === KLIK DI LUAR: tutup dua-duanya ===
  document.addEventListener('click', function(e){
    if (storeWrapper && !storeWrapper.contains(e.target)) {
      closeStore();
    }
    if (accWrapper && !accWrapper.contains(e.target)) {
      closeAcc();
    }
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
  const SEED = 'filterAccordion:v4:';

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

<script>
/* CHAT DENGAN PENJUAL (BAR ATAS) + AI FLOATING CHAT (baru, pakai container_chat_bot) */
(function(){
  // Chat dengan penjual (bar atas)
  const chatSellerBtn = document.getElementById('chatSellerBtn');
  if (chatSellerBtn) {
    chatSellerBtn.addEventListener('click', function(){
      Swal.fire({
        icon: 'info',
        title: 'Chat dengan Penjual',
        html: 'Fitur chat langsung dengan penjual belum aktif.<br><br>'+
              'Sementara, kamu bisa:<br>• Hubungi kontak yang penjual cantumkan di deskripsi produk<br>'+
              '• Atau gunakan AI Assistant di kanan bawah untuk tanya-tanya dulu seputar barang 😊',
        confirmButtonColor: '#f97316'
      });
    });
  }

  // Floating AI chat
  const toggleBtn  = document.getElementById('aiChatToggle');
  const panel      = document.getElementById('aiChatPanel');
  const closeBtn   = document.getElementById('aiChatClose');
  const inputEl    = document.getElementById('marketAiInput');
  const sendBtn    = document.getElementById('marketAiSend');
  const messagesEl = document.getElementById('aiChatMessages');
  const tagsEl     = document.getElementById('marketAiTags');

  function togglePanel(forceOpen){
    if (!panel) return;
    const isOpen = panel.style.display === 'flex';
    const next = (typeof forceOpen === 'boolean') ? forceOpen : !isOpen;
    panel.style.display = next ? 'flex' : 'none';
    if (next && inputEl){
      setTimeout(()=>inputEl.focus(), 80);
    }
  }

  function appendMessage(type, text){
    if (!messagesEl || !text.trim()) return;
    const div = document.createElement('div');
    div.className = 'ai-chat-message ' + (type === 'user' ? 'user' : 'bot');
    div.textContent = text;
    messagesEl.appendChild(div);
    messagesEl.scrollTop = messagesEl.scrollHeight;
  }

  function handleSend(){
    if (!inputEl) return;
    const txt = inputEl.value.trim();
    if (!txt) return;
    appendMessage('user', txt);
    inputEl.value = '';

    // mockup balasan AI
    setTimeout(()=>{
      appendMessage('bot',
        'Ini hanya contoh tampilan AI. '+
        'Di implementasi sebenarnya, pesan kamu akan dikirim ke backend AI untuk dijawab otomatis.'
      );
    }, 450);
  }

  // button floating
  if (toggleBtn){
    toggleBtn.addEventListener('click', ()=>togglePanel());
  }
  if (closeBtn){
    closeBtn.addEventListener('click', ()=>togglePanel(false));
  }

  // kirim
  if (sendBtn){
    sendBtn.addEventListener('click', handleSend);
  }
  if (inputEl){
    inputEl.addEventListener('keydown', e=>{
      if (e.key === 'Enter' && !e.shiftKey){
        e.preventDefault();
        handleSend();
      }
    });
  }

  // tags → isi textarea
  if (tagsEl && inputEl){
    tagsEl.querySelectorAll('span[data-template]').forEach(tag=>{
      tag.addEventListener('click', ()=>{
        const template = tag.getAttribute('data-template') || tag.textContent;
        inputEl.value = template;
        inputEl.focus();
      });
    });
  }

})();
</script>


</body>
</html>
