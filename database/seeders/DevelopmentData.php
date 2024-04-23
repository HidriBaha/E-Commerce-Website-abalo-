<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\LazyCollection;

class DevelopmentData extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
     /*   DB::table('ab_user')->truncate();
        DB::table('ab_article')->truncate();
        DB::table('ab_articlecategory')->truncate();*/

    if($file = fopen('public/data/user.csv', 'r')) {
        $header = fgetcsv($file);
        $data = [];
        while (($line = fgetcsv($file, 1000, ';')) !== false) {
            DB::table('ab_user')->insert([
                'id' => $line[0],
                'ab_name' => $line[1],
                'ab_password' => bcrypt($line[2]),
                'ab_email' => $line[3]]);
        }
        fclose($file);
        //  DB::table('ab_user')->insert($data);
    }


      if(  $file = fopen('public/data/articlecategory.csv', 'r')){
        $header = fgetcsv($file);
        $data= [];
        while(($line=fgetcsv($file,1000,';'))!==false)
        {if($line[2]==='NULL'){$line[2]=null;}
            $data[]=[
            'id'=>$line[0],
            'ab_name'=>$line[1],
            'ab_parent'=>$line[2]];
        }
        fclose($file);
        DB::table('ab_articlecategory')->insert($data);}



        if($file = fopen('public/data/articles.csv', 'r')){
        $header = fgetcsv($file);
        $data= [];
        while(($line=fgetcsv($file,1000,';'))!==false)
        {//$price =str_replace('.',',',);
            $data[]=[  'id' => $line[0],
                'ab_name' => $line[1],
                'ab_price' => intval($line[2]),
                'ab_description' => $line[3],
                'ab_creator_id' => $line[4],
                'ab_createdate' => $line[5]];
        }
        fclose($file);

        DB::table('ab_article')->insert($data);}
    }




}
