<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Text;
use App\Models\User;
use App\Models\Role;

class AdminController extends Controller
{
    
    public function index()
    {
        $texts = Text::with(['category', 'user'])
            ->orderByDesc('created_at')
            ->get();

        $users = User::with('role')->get();
        $roles = Role::all();

        return view('admin', compact('texts', 'users', 'roles'));
    }

    
    public function edit($id)
    {
        $text = Text::findOrFail($id);
        return view('admin_edit', compact('text'));
    }

    
    public function update(Request $request, $id)
    {
        $text = Text::findOrFail($id);

        $data = $request->validate([
            'heading' => 'required|string|max:255',
            'text'    => 'required|string',
        ]);

        $text->update($data);

        return redirect()->route('admin')->with('success', 'Статья обновлена!');
    }

    
    public function togglePublish($id)
    {
        $text = Text::findOrFail($id);
        $text->is_published = !$text->is_published;
        $text->save();

        return redirect()->route('admin')->with(
            'success',
            $text->is_published ? 'Статья опубликована' : 'Статья заблокирована'
        );
    }

   
    public function destroy($id)
    {
        $text = Text::findOrFail($id);
        $text->delete();

        return redirect()->route('admin')->with('success', 'Статья удалена');
    }

    
    public function updateRole(Request $request, $id)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = User::findOrFail($id);
        $user->role_id = $request->role_id;
        $user->save();

        return redirect()->route('admin')->with('success', 'Роль пользователя обновлена!');
    }
}