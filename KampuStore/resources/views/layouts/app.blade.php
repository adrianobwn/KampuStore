<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $title ?? 'KampuStore' }}</title>

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

    <form class="search-bar" action="{{ route('products.index') }}" method="GET">
      <input type="text" name="q" placeholder="search" value="{{ request('q') }}">
    </form>

    <div class="icons">
      <a href="#">❤️</a>
      <a href="#">🛒</a>
      @auth
        <span style="font-size:14px;">Halo, {{ auth()->user()->name }}</span>
        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
          @csrf
          <button style="border:none;background:none;color:#c00;cursor:pointer;">Logout</button>
        </form>
      @else
        <a href="{{ route('login') }}" style="font-size:14px;color:#007bff;">Login</a>
        <a href="{{ route('register') }}" style="font-size:14px;color:#007bff;">Register</a>
      @endauth
    </div>
  </nav>

  <div class="container">
    @yield('content')
  </div>

  <footer>
    &copy; {{ date('Y') }} KampuStore
  </footer>

</body>
</html>
