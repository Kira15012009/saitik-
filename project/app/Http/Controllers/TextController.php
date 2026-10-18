<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Text;
use App\Models\Category;

class TextController extends Controller
{
    public function index()
    {
        $texts = Text::with(['category', 'user'])
            ->where('is_published', true)
            ->orderByDesc('created_at')
            ->paginate(5);

        return view('index', compact('texts'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('journalist', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'heading'     => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'text'        => 'required|string',
        ]);

        $data['user_id'] = auth()->id();
        $data['is_published'] = true;

        Text::create($data);

        return redirect()->route('home')->with('success', 'Статья опубликована!');
    }

    public function category($slug = null)
    {
        $categories = Category::all();
        $selected = $slug
            ? Category::where('slug', $slug)->firstOrFail()
            : $categories->first();

        $texts = Text::with(['category', 'user'])
            ->where('category_id', $selected->id)
            ->where('is_published', true)
            ->orderByDesc('created_at')
            ->paginate(5);

        return view('category', compact('texts', 'categories', 'selected'));
    }
}