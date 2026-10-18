<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
</head>
<body style="margin: 0; font-family: Arial, sans-serif; background: #f4f6f8; min-height: 100vh; display: flex; flex-direction: column;">
    <x-header />

    < <main style="flex: 1; max-width: 1000px; margin: 30px auto; padding: 0 20px; width: 100%; box-sizing: border-box; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.08);">
        <h1 style="margin-top: 0;">Регистрация</h1>

        @if ($errors->any())
            <div style="color: #e74c3c; margin-bottom: 15px;">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <label>Логин:</label>
            <input type="text" name="login" value="{{ old('login') }}" required
                   style="width: 100%; padding: 10px; margin-bottom: 15px; box-sizing: border-box;">

            <label>Пароль:</label>
            <input type="password" name="password" required
                   style="width: 100%; padding: 10px; margin-bottom: 15px; box-sizing: border-box;">

            <label>Подтверждение пароля:</label>
            <input type="password" name="password_confirmation" required
                   style="width: 100%; padding: 10px; margin-bottom: 15px; box-sizing: border-box;">

            <button type="submit" style="background: #2980b9; color: #fff; padding: 12px 25px; border: none; border-radius: 4px; cursor: pointer;">
                Зарегистрироваться
            </button>
        </form>

        <p style="margin-top: 20px;">Уже есть аккаунт? <a href="{{ route('login') }}">Войти</a></p>
    </main>

    <x-footer />
</body>
</html>