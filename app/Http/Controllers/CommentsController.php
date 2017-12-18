<?php

namespace App\Http\Controllers;

use App\Article;
use App\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store(Request $request, Article $article)
    {
        $this->validate($request, [
            'body' => 'required|string|min:1|max:10000'
        ]);

        $article->addComment([
            'body' => $request->body,
            'user_id' => auth()->id()
        ]);

        return back();
    }
}
