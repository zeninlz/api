<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        return Article::all();
    }

    public function show($id)
    {
        return Article::findOrFail($id);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required|min:10',
        ], [
            'title.required' => 'De titel is verplicht.',
            'title.max' => 'De titel mag niet langer zijn dan 255 tekens.',
            'content.required' => 'De inhoud is verplicht.',
            'content.min' => 'De inhoud moet minimaal 10 tekens bevatten.',
        ]);

        $article = Article::create($validatedData);
        return response()->json($article, 201);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required|min:10',
        ], [
            'title.required' => 'De titel is verplicht.',
            'title.max' => 'De titel mag niet langer zijn dan 255 tekens.',
            'content.required' => 'De inhoud is verplicht.',
            'content.min' => 'De inhoud moet minimaal 10 tekens bevatten.',
        ]);

        $article = Article::findOrFail($id);
        $article->update($validatedData);
        return response()->json($article, 200);
    }

    public function delete($id)
    {
        Article::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
