<?php

namespace App\Models;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbArticle extends Model
{
    use HasFactory;
    protected $table = 'ab_article';
    protected $primaryKey = 'id';
protected $fillable=[
  'id',
    'ab_name',
    'ab_price',
    'ab_description',

];
    public function ab_articleSearch($request)
    {
        return $this->select('*')
            ->where('ab_name', 'ilike', '%'.$request.'%')->get();

    }
}
    {
}
