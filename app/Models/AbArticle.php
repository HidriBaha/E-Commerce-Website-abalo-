<?php
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AbArticle extends Model
{
    use HasFactory;

    protected $table = 'ab_article';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'ab_name',
        'ab_price',
        'ab_description',
    ];

    public static function ab_articleSearch($request)
    {
        return DB::table('ab_article')
            ->where('ab_name', 'ilike', '%' . $request . '%')->get();
    }

    public function addArticle($name, $price, $description)
    {
        if (isset($name) && $name !== "" && isset($price)  && isset($description) && $description !== "") {
            Log::debug('Adding new article.');

            // Get the current maximum ID to calculate the new ID
            $maxId = DB::table('ab_article')->max('id');
            $newId = $maxId + 1;

            // Insert the new article into the database
            $inserted = DB::table('ab_article')->insert([
                'id' => $newId,
                'ab_name' => $name,
                'ab_price' => $price,
                'ab_description' => $description,
                'ab_creator_id' => 1, // Assuming creator ID is fixed as 1 for now
            'ab_createdate' => Carbon::now(),
            ]);

            // Check if the insert was successful
            if ($inserted) {
                return $newId;
            } else {
                return null;
            }
        }
        return null;
    }
    public function addtocart($articleId, $creatorId)
    {
        $shoppingcartId = DB::table('ab_shoppingcart')->where('ab_creator_id', $creatorId)->value('id');
        if(DB::table('ab_shoppingcart_item')
            ->where('ab_shoppingcart_id', $shoppingcartId)
            ->where('ab_article_id', $articleId)
            ->exists()){
            return 0;//article ist schon im warenkorb
        }
        else{
            DB::table('ab_shoppingcart_item')->insert([

                'ab_shoppingcart_id' => $shoppingcartId,
                'ab_article_id' => $articleId,
                'ab_createdate' => now()
            ]);
            return 1;

        }

    }
    public function getcart($creatorId)
    {
        return $shoppingCarts = DB::table('ab_shoppingcart')
            ->join('ab_shoppingcart_item', 'ab_shoppingcart.id', '=', 'ab_shoppingcart_item.ab_shoppingcart_id')//mit chatgpt generiert, mit creator id joint der shoppingcarttabelle um warenkorb id zu finden, dann werden die ids aus dem warenkorb in der ab_article tabelle gesuch
            ->join('ab_article', 'ab_shoppingcart_item.ab_article_id', '=', 'ab_article.id') // Join mit der Tabelle ab_article
            ->where('ab_shoppingcart.ab_creator_id', $creatorId)
            ->select('ab_shoppingcart.*', 'ab_shoppingcart_item.*', 'ab_article.ab_name as product_name', 'ab_article.ab_price', 'ab_article.ab_description') // Auswählen der gewünschten Spalten
            ->get();

    }
    public function deletefromcart($articleId, $shoppingcartId)
    {
        if(DB::table('ab_shoppingcart_item')->where('ab_shoppingcart_id','=',$shoppingcartId)
            ->where('ab_article_id','=',$articleId)->delete()){
            return 1;
        }
        else{
            return 0;
        }
    }
}
