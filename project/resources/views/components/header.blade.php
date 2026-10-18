<header style="background: #2c3e50; padding: 15px 30px;">
    <nav style="display: flex; justify-content: space-between; align-items: center;">
        <a href="{{ route('home') }}" style="color: #fff; font-size: 22px; font-weight: bold; text-decoration: none;">
             Книжный Вестник
        </a>

        <ul style="display: flex; gap: 25px; list-style: none; margin: 0; padding: 0; align-items: center;">
            <li><a href="{{ route('home') }}" style="color: #ecf0f1; text-decoration: none;">Главная</a></li>
            <li><a href="{{ route('category') }}" style="color: #ecf0f1; text-decoration: none;">Категория</a></li>

            @auth
                @if (auth()->user()->role && in_array(auth()->user()->role->name, ['journalist', 'admin']))
                    <li><a href="{{ route('journalist') }}" style="color: #ecf0f1; text-decoration: none;">Журналист</a></li>
                @endif

                @if (auth()->user()->role && auth()->user()->role->name === 'admin')
                    <li><a href="{{ route('admin') }}" style="color: #ecf0f1; text-decoration: none;">Админ</a></li>
                @endif

                <li style="color: #f39c12; font-weight: bold;">Привет, {{ auth()->user()->login }}!</li>
                <li>
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" style="background: none; border: none; color: #ecf0f1; cursor: pointer; font-size: 16px;">
                            Выйти
                        </button>
                    </form>
                </li>
            @else
                <li><a href="{{ route('login') }}" style="color: #ecf0f1; text-decoration: none;">Вход</a></li>
                <li><a href="{{ route('register') }}" style="color: #ecf0f1; text-decoration: none;">Регистрация</a></li>
            @endauth
        </ul>
    </nav>
</header>