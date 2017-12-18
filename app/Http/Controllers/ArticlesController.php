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

    public function categoryIndex(Category $category)
    {
        $articles = $category->articles;

        return view('articles.category_index', compact('articles', 'category'));
    }

    public function create(Article $article)
    {
        $categories = Category::all();

        $currentCategoryIds = $article->categories()->pluck('categories.id')->toArray();

        return view('articles.create', compact('categories', 'currentCategoryIds', 'article'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|min:5|max:2000',
            'text' => 'required|string|min:15|max:2000'
        ]);

        $article = Article::create([
            'title' => $request->title,
            'text' => $request->text,
            'user_id' => auth()->id(),
        ]);

        $article->categories()->attach($request->categories);

        return redirect('/articles');
    }

    public function show(Article $article, Category $category)
    {
        $comments = $article->comments;

        return view('articles.show', compact('article', 'comments', 'category'));
    }

    public function edit(Article $article)
    {
        $categories = Category::all();
        $currentCategoryIds = $article->categories()->pluck('categories.id')->toArray();
        return view('articles.edit', compact('article', 'categories', 'currentCategoryIds'));
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

        $article->categories()->sync($request->categories);


        return redirect('/articles');
    }

    public function destroy(Article $article,Request $request )
    {
        $article->delete();

       return redirect('/articles');
    }
}
