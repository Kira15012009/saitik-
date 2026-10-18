<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Главная — Книжный Вестник</title>
</head>
<body style="margin: 0; font-family: Arial, sans-serif; background: #f4f6f8; min-height: 100vh; display: flex; flex-direction: column;">

    <x-header />

    <main style="flex: 1; max-width: 1000px; margin: 30px auto; padding: 0 20px; width: 100%; box-sizing: border-box;">
        <h1 style="color: #2c3e50;">Все новости</h1>

        @if (session('success'))
            <div style="background: #d4edda; color: #155724; padding: 12px; border-radius: 4px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif

        @forelse ($texts as $text)
            <article style="background: #fff; padding: 20px; border-radius: 8px; margin-bottom: 20px; box-shadow: 0 2px 6px rgba(0,0,0,0.08);">
                <h2 style="color: #2980b9; margin-top: 0;">{{ $text->heading }}</h2>
                <p style="color: #999; font-size: 14px; margin: 5px 0;">
                    {{ $text->category->name }} · Автор: {{ $text->user->login }} ·
                    {{ $text->created_at->format('d.m.Y H:i') }}
                </p>
                <p style="color: #555; line-height: 1.6;">{{ Str::limit($text->text, 200) }}</p>
            </article>
        @empty
            <p>Пока нет ни одной статьи.</p>
        @endforelse

        <div>{{ $texts->links() }}</div>
    </main>

    <x-footer />

</body>
</html>