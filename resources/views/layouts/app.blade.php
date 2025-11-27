<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $title ?? 'KampuStore' }}</title>
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
  
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    
    body { 
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Arial, sans-serif; 
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      min-height: 100vh;
      color: #1f2937;
    }
    
    a { text-decoration: none; color: inherit; }
    
    /* Navbar */
    nav {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      z-index: 1000;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 16px 40px;
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      border-bottom: 1px solid rgba(102, 126, 234, 0.2);
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }
    
    .logo { 
      font-weight: 800; 
      font-size: 24px;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      cursor: pointer;
      transition: transform 0.2s;
    }
    
    .logo:hover { transform: scale(1.05); }
    
    .search-bar { 
      flex: 1; 
      max-width: 500px; 
      margin: 0 40px; 
      position: relative;
    }
    
    .search-bar input {
      width: 100%; 
      padding: 12px 44px 12px 20px; 
      border: 2px solid #e5e7eb;
      border-radius: 50px; 
      font-size: 14px;
      transition: all 0.3s;
      background: white;
    }
    
    .search-bar input:focus {
      outline: none;
      border-color: #667eea;
      box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
    }
    
    .search-bar button {
      position: absolute;
      right: 8px;
      top: 50%;
      transform: translateY(-50%);
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      border: none;
      width: 36px;
      height: 36px;
      border-radius: 50%;
      color: white;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: transform 0.2s;
    }
    
    .search-bar button:hover {
      transform: translateY(-50%) scale(1.1);
    }
    
    .nav-icons { 
      display: flex; 
      align-items: center; 
      gap: 20px; 
    }
    
    .nav-icon {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      background: #f3f4f6;
      color: #6b7280;
      font-size: 20px;
      cursor: pointer;
      transition: all 0.3s;
    }
    
    .nav-icon:hover {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      transform: translateY(-2px);
    }
    
    .user-menu {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 8px 16px;
      background: #f3f4f6;
      border-radius: 50px;
      font-size: 14px;
      font-weight: 500;
      color: #374151;
    }
    
    .auth-links {
      display: flex;
      gap: 12px;
    }
    
    .auth-btn {
      padding: 10px 24px;
      border-radius: 50px;
      font-size: 14px;
      font-weight: 600;
      transition: all 0.3s;
      display: inline-flex;
      align-items: center;
      gap: 6px;
    }
    
    .btn-login {
      background: white;
      color: #667eea;
      border: 2px solid #667eea;
    }
    
    .btn-login:hover {
      background: #667eea;
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
    }
    
    .btn-register {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      border: 2px solid transparent;
    }
    
    .btn-register:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(118, 75, 162, 0.4);
    }
    
    .btn-logout {
      border: none;
      background: #fee2e2;
      color: #dc2626;
      cursor: pointer;
      padding: 8px 16px;
      border-radius: 50px;
      font-size: 13px;
      font-weight: 600;
      transition: all 0.3s;
    }
    
    .btn-logout:hover {
      background: #dc2626;
      color: white;
      transform: translateY(-1px);
    }
    
    /* Container */
    .container { 
      max-width: 1280px; 
      margin: 100px auto 40px; 
      padding: 0 24px;
    }
    
    /* Footer */
    footer { 
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      border-top: 1px solid rgba(102, 126, 234, 0.2);
      padding: 24px 0; 
      text-align: center; 
      font-size: 14px; 
      color: #6b7280;
      margin-top: 80px;
    }
    
    footer strong {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      font-weight: 700;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
      nav {
        padding: 12px 16px;
        flex-wrap: wrap;
        gap: 12px;
      }
      
      .search-bar {
        order: 3;
        width: 100%;
        margin: 0;
        max-width: none;
      }
      
      .logo { font-size: 20px; }
      
      .container {
        margin-top: 140px;
        padding: 0 16px;
      }
    }
  </style>
</head>
<body>

  <nav>
    <a href="{{ route('home') }}" class="logo">KampuStore</a>

    <form class="search-bar" action="{{ route('products.index') }}" method="GET">
      <input type="text" name="q" placeholder="Cari produk, penjual, kategori..." value="{{ request('q') }}">
      <button type="submit"><i class="uil uil-search"></i></button>
    </form>

    <div class="nav-icons">
      <a href="{{ route('products.index') }}" class="nav-icon" title="Market">
        <i class="uil uil-store"></i>
      </a>
      
      @auth
        <div class="user-menu">
          <i class="uil uil-user-circle"></i>
          <span>{{ auth()->user()->name }}</span>
        </div>
        @if(auth()->user()->seller)
          <a href="{{ route('seller.dashboard') }}" class="auth-btn btn-login">
            <i class="uil uil-dashboard"></i>
            Dashboard
          </a>
        @endif
        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
          @csrf
          <button type="submit" class="btn-logout">
            <i class="uil uil-sign-out-alt"></i> Logout
          </button>
        </form>
      @else
        <div class="auth-links">
          <a href="{{ route('login') }}" class="auth-btn btn-login">
            <i class="uil uil-shop"></i>
            Login
          </a>
          <a href="{{ route('register') }}" class="auth-btn btn-register">
            <i class="uil uil-store-alt"></i>
            Daftar Penjual
          </a>
        </div>
      @endauth
    </div>
  </nav>

  <div class="container">
    @yield('content')
  </div>

  <footer>
    &copy; {{ date('Y') }} <strong>KampuStore</strong> - Marketplace Mahasiswa UNDIP
  </footer>

</body>
</html>
