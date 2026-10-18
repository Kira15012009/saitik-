<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Админ — Книжный Вестник</title>
</head>
<body style="margin: 0; font-family: Arial, sans-serif; background: #f4f6f8; min-height: 100vh; display: flex; flex-direction: column;">

    <x-header />

    <main style="flex: 1; max-width: 1200px; margin: 30px auto; padding: 0 20px; width: 100%; box-sizing: border-box;">
        <h1 style="color: #2c3e50;">Панель администратора</h1>

        @if (session('success'))
            <div style="background: #d4edda; color: #155724; padding: 12px; border-radius: 4px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div style="background: #f8d7da; color: #721c24; padding: 12px; border-radius: 4px; margin-bottom: 20px;">
                {{ session('error') }}
            </div>
        @endif

        
        <h2 style="color: #2980b9; margin-top: 40px;">Управление статьями</h2>

        <table style="width: 100%; border-collapse: collapse; background: #fff; box-shadow: 0 2px 6px rgba(0,0,0,0.08); border-radius: 8px; overflow: hidden;">
            <thead style="background: #2c3e50; color: #fff;">
                <tr>
                    <th style="padding: 12px; text-align: left;">ID</th>
                    <th style="padding: 12px; text-align: left;">Заголовок</th>
                    <th style="padding: 12px; text-align: left;">Категория</th>
                    <th style="padding: 12px; text-align: left;">Автор</th>
                    <th style="padding: 12px; text-align: left;">Статус</th>
                    <th style="padding: 12px; text-align: left;">Действия</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($texts as $text)
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 12px;">{{ $text->id }}</td>
                        <td style="padding: 12px;">{{ $text->heading }}</td>
                        <td style="padding: 12px;">{{ $text->category->name ?? '—' }}</td>
                        <td style="padding: 12px;">{{ $text->user->login ?? '—' }}</td>
                        <td style="padding: 12px;">
                            @if ($text->is_published)
                                <span style="color: green; font-weight: bold;">Активна</span>
                            @else
                                <span style="color: #e74c3c; font-weight: bold;">Заблокирована</span>
                            @endif
                        </td>
                        <td style="padding: 12px; white-space: nowrap;">
                            {{-- Редактировать --}}
                            <a href="{{ route('admin.articles.edit', $text->id) }}"
                               style="background: #3498db; color: #fff; padding: 6px 12px; border-radius: 4px; text-decoration: none; font-size: 14px;">
                                Редактировать
                            </a>

                            {{-- Блокировать / Разблокировать --}}
                            <form method="POST" action="{{ route('admin.articles.toggle', $text->id) }}" style="display: inline;">
                                @csrf
                                <button type="submit"
                                        style="background: #f39c12; color: #fff; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer; font-size: 14px;">
                                    {{ $text->is_published ? 'Блокировать' : 'Разблокировать' }}
                                </button>
                            </form>

                            {{-- Удалить --}}
                            <form method="POST" action="{{ route('admin.articles.delete', $text->id) }}"
                                  onsubmit="return confirm('Удалить статью «{{ $text->heading }}»?');"
                                  style="display: inline;">
                                @csrf
                                <button type="submit"
                                        style="background: #e74c3c; color: #fff; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer; font-size: 14px;">
                                    Удалить
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="padding: 20px; text-align: center; color: #777;">
                            Статей пока нет.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        
        <h2 style="color: #2980b9; margin-top: 40px;">Управление ролями пользователей</h2>

<table style="width: 100%; border-collapse: collapse; background: #fff; box-shadow: 0 2px 6px rgba(0,0,0,0.08); border-radius: 8px; overflow: hidden;">
    <thead style="background: #2c3e50; color: #fff;">
        <tr>
            <th style="padding: 12px; text-align: left;">ID</th>
            <th style="padding: 12px; text-align: left;">Логин</th>
            <th style="padding: 12px; text-align: left;">Текущая роль</th>
            <th style="padding: 12px; text-align: left;">Изменить роль</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($users as $user)
            <tr style="border-bottom: 1px solid #eee;">
                <td style="padding: 12px;">{{ $user->id }}</td>
                <td style="padding: 12px;">{{ $user->login }}</td>
                <td style="padding: 12px;">
                    <span style="font-weight: bold; color: #2c3e50;">
                        {{ $user->role->name ?? '—' }}
                    </span>
                </td>
                <td style="padding: 12px;">
                    <form method="POST" action="{{ route('admin.users.role', $user->id) }}" style="display: flex; gap: 8px; align-items: center;">
                        @csrf
                        <select name="role_id" style="padding: 6px 10px; border: 1px solid #ccc; border-radius: 4px;">
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                        <button type="submit"
                                style="background: #27ae60; color: #fff; border: none; padding: 6px 14px; border-radius: 4px; cursor: pointer; font-size: 14px;">
                            Сохранить
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" style="padding: 20px; text-align: center; color: #777;">
                    Пользователей пока нет.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

    </main>

    <x-footer />

</body>
</html>