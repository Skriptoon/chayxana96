<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<link href="/css/app.css" rel="stylesheet">
	<link href="/css/admin.style.css" rel="stylesheet">
    @yield('style')
	<script src="/js/bootstrap.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="/js/main.js"></script>
    @yield('script')
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	  <div class="container-fluid">
		<a class="navbar-brand" href="{{route('admin')}}">Админ панель</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		  <span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
		  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
			<li class="nav-item">
				<a class="nav-link" href="/admin/order">Заказы</a>
			</li>
			<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="menu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Меню
          </a>
          <ul class="dropdown-menu" aria-labelledby="menu">
            <li><a class="dropdown-item" href="{{route('admin_position')}}">Позиции</a></li>
            <li><a class="dropdown-item" href="{{route('admin_category')}}">Категории</a></li>
			</ul>
			</li>
			<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#" id="menu1" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Настройки
          </a>
          <ul class="dropdown-menu" aria-labelledby="menu1">
            <li><a class="dropdown-item" href="/admin/contacts">Контакты</a></li>
			<li><a class="dropdown-item" href="/admin/delivery">Условия доставки</a></li>
            <li><a class="dropdown-item" href="/admin/baner">Банеры на гл. странице</a></li>
			</ul>
			</li>
		  </ul>
		</div>
	  </div>
	</nav>
	@yield('content')
<script src="/js/admin.events.js"></script>