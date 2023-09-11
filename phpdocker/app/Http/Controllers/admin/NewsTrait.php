<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewsTrait extends Controller
{
    
    public function getNews(int $id = null): array
    {
        $news = [];
         $quantityNews = 10;

         if ($id === null){
            for($i=1; $i < $quantityNews; $i++){
                $news[] = [
                    'id' => $i,
                    'title'=> \fake()->jobTitle(),
                    'description'=> \fake()->text(maxNbChars:100),
                    'author'=> \fake()->username(),
                    'created_at'=> \now()->format(format:'d-m-Y H:i'),
                ];
            }
            return $news
         }
         return [
            'id' => $i,
            'title'=> \fake()->jobTitle(),
            'description'=> \fake()->text(maxNbChars:100),
            'author'=> \fake()->username(),
            'created_at'=> \now()->format(format:'d-m-Y H:i'),
        ];
    }
}
