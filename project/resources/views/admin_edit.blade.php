<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Редактировать статью — Книжный Вестник</title>
</head>
<body style="margin: 0; font-family: Arial, sans-serif; background: #f4f6f8; min-height: 100vh; display: flex; flex-direction: column;">

    <x-header />

    <main style="flex: 1; max-width: 800px; margin: 30px auto; padding: 0 20px; width: 100%; box-sizing: border-box;">
        <h1 style="color: #2c3e50;">Редактировать статью #{{ $text->id }}</h1>

        @if ($errors->any())
            <div style="background: #f8d7da; color: #721c24; padding: 12px; border-radius: 4px; margin-bottom: 15px;">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('admin.articles.update', $text->id) }}"
              style="background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.08);">
            @csrf

            <label for="heading" style="display: block; margin-bottom: 5px; font-weight: bold; color: #2c3e50;">
                Заголовок:
            </label>
            <input type="text" id="heading" name="heading"
                   value="{{ old('heading', $text->heading) }}" required
                   style="width: 100%; padding: 10px; margin-bottom: 15px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px;">

            <label for="text" style="display: block; margin-bottom: 5px; font-weight: bold; color: #2c3e50;">
                Текст статьи:
            </label>
            <textarea id="text" name="text" rows="12" required
                      style="width: 100%; padding: 10px; margin-bottom: 15px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; resize: vertical;">{{ old('text', $text->text) }}</textarea>

            <div style="display: flex; gap: 10px; align-items: center;">
                <button type="submit"
                        style="background: #2980b9; color: #fff; padding: 12px 30px; border: none; border-radius: 4px; cursor: pointer; font-size: 16px;">
                    Сохранить изменения
                </button>

                <a href="{{ route('admin') }}"
                   style="color: #555; text-decoration: none; padding: 12px 20px;">
                    ← Назад в админку
                </a>
            </div>
        </form>
    </main>

    <x-footer />

</body>
</html>