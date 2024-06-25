<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class articleHasCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = fopen(base_path('/public/data/article_has_articlecategory.csv'),"r");
        $i = 0;
        while($row = fgets($file))
        {
            if($i!=0){
                $num = explode(";", $row);
                DB::table('ab_article_has_articlecategory')->insert([
                    'ab_articlecategory_id' => (int) $num[0],
                    'ab_article_id' => (int) $num[1]
                ]);
            }
            $i++;
        }
        fclose($file);
    }
}
