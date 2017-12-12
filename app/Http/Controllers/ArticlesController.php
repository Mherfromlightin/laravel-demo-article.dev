<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->get();

        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('articles.create', compact('categories'));
    }

    public function store(Request $request)
    {
       $this->validate($request, [
           'title' => 'required|string|min:5|max:2000',
           'text' => 'required|string|min:15|max:2000'
       ]);

       $article = Article::create($request->only(['title', 'text']));
       $article->categories()->attach($request->categories);

       return redirect('/articles');
    }

    public function show(Article $article)
    {
        $comments = $article->comments;

        return view('articles.show', compact('article', 'comments'));
    }

    public function edit(Article $article)
    {
        return view('articles.edit',compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $this->validate($request, [
            'title' => 'required|string|min:5|max:2000',
            'text' => 'required|string|min:15|max:2000'
        ]);

        $article->update([
            'title' => $request->title,
            'text' => $request->text,
        ]);

        return redirect('/articles');
    }

    public function destroy(Article $article)
    {
        $article->delete();

        return redirect('/articles');
    }
}
