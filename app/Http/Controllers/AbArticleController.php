<?php

namespace App\Http\Controllers;

use App\Models\AbArticle;
use Illuminate\Http\Request;

class AbArticleController extends Controller
{
    public function SearchArticle(Request $request)
    {        $ab_article = new AbArticle();

        if($request->search )
        {
        $ab_article = $ab_article->ab_articleSearch($request->search);
        }
        else
        {
            $ab_article = $ab_article->get();
        }
        return view('Search', ['ab_article' => $ab_article]);
    }

public function addArticleAJAX(Request $r)
    {
        // Attempt to add the article
        $a = (new abArticle())->addArticle($r->name, $r->price, $r->description);

        if ($a) {
            return response()->json(['success' => 'SUCCESS']);
        } else {
            return response()->json(['error' => 'Failed to insert the article.']);
        } }
}
