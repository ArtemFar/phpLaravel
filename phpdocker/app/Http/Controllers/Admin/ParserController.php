<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ParserService;
use Illuminate\Http\Request;
use App\Services\Interfaces\Parser;

class ParserController extends Controller
{
    public function __invoke(Request $request, Parser $parserService)
    {
        $url = "https://lenta.ru/rss";
        $url2 = "https://news.rambler.ru/rss/tech/";

        $parserService->setLink($url)->saveParseData();
    }
}
