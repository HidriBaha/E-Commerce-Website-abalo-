<?php
namespace App\Models;

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

    public function ab_articleSearch($request)
    {
        return $this->select('*')
            ->where('ab_name', 'ilike', '%' . $request . '%')->get();
    }

    public function addArticle($name, $price, $description)
    {
        if (isset($name) && $name !== "" && isset($price) && $price > 0 && isset($description) && $description !== "") {
            Log::debug('djd');
            // gibt größte ID zurück um größte Id+1 zurückzubekommen
            $maxId = DB::table('ab_article')->max('id');

            $q = DB::table('ab_article')->insert([

                'ab_name' => $name,
                'ab_price' => $price,
                'ab_description' => $description,
                'ab_creator_id' => 1
            ]);


        }
        return 1;
    }}
