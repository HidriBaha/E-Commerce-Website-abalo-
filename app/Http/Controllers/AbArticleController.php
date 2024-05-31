<?php

namespace App\Http\Controllers;

use App\Models\AbArticle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AbArticleController extends Controller
{
    public function SearchArticle(Request $request)
    {
        $ab_article = new AbArticle();

        if ($request->search) {
            $ab_article = $ab_article->ab_articleSearch($request->search);
        } else {
            $ab_article = $ab_article->get();
        }
        return view('Search', ['ab_article' => $ab_article]);
    }

    public function SearchAPI(Request $request)
    {
        Log::debug('SearchAPI');
        if ($request->has('search')) {
            $search = $request->input('search');


            $articles = abArticle::ab_articleSearch($search);
            return response()->json($articles);
        }
    }

    public function addArticleAJAX(Request $r)
    {
        // Attempt to add the article
        $r = (new abArticle())->addArticle($r->name, $r->price, $r->description);

        if ($r) {
            return response()->json(['success' => 'SUCCESS']);
        } else {
            return response()->json(['error' => 'Failed to insert the article.']);
        }
    }

public function addArticleAPI(Request $r)
{
    Log::debug($r);
    if($r->has('name') && $r->has('price') && $r->has('description'))
    {
        $name = $r->input('name');
        $price = $r->input('price');
        $description = $r->input('description');

        $article = new abArticle();
        $article->addArticle($name, $price, $description);


        return response()->json(['id' => $article->id]);    }

    else{
        return response()->json(['error' => 'Missing parameters.']);
    }



}
    public function addtocart(Request $r): \Illuminate\Http\JsonResponse
    {
        $creatorId = 1;
        $success = (new abArticle())->addtocart($r->articleid, $creatorId);//creatorid noch nicht implementiert
        $cartdata = (new abArticle())->getcart($creatorId);//antwortet immer mit updated cart
        if ($success) {
            return response()->json([
                'success' => 'article was added to cart',
                'cartdata' => $cartdata
            ]);
        } else {
            return response()->json([
                'error' => 'article is already in your cart',
                'cartdata' => $cartdata
            ]);
        } }

    public function getcart(Request $r)
    {
        $creatorId = 1; //normalerweise würde ich die über cookies oder sessionid abrufen, aber login ist nicht implementiert
        $cart = (new abArticle())->getcart($creatorId);
        return response()->json([
            'success' => 'successfully got cartdata',
            'cartdata' => $cart
        ]);
    }
    public function deleteCartedArticle(Request $r)
    {
        $shoppingcartid = $r->route('shoppingcartid');
        $articleId = $r->route('articleId');
        $creatorId = 1;
        $success = (new abArticle())->deletefromcart($articleId, $shoppingcartid);
        $cartdata = (new abArticle())->getcart($creatorId);
        if ($success) {
            return response()->json([
                'success' => 'deleted article from cart',
                'cartdata' => $cartdata
            ]);
        } else {
            return response()->json([
                'error' => 'failed to delete article',
                'cartdata' => $cartdata
            ]);
        }

    }}
