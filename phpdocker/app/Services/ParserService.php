<?php

namespace App\Services;

use App\Services\Contracts\Parser;
use Illuminate\Support\Facades\Storage;
use JetBrains\PhpStorm\NoReturn;
use Orchestra\Parser\Xml\Facade as XmlParserData;

class ParserService implements Parser

{
    private string $link;

    public function setLink(string $link): Parser
    {
        $this->link = $link;

        return $this;
    }

    #[NoReturn] public function saveParseData(): void
    {
        $parser = XmlParserData::load($this->link);

        $data = $parser->parse([
            'title' => [
                'uses' => 'channel.title',
            ],
            'link' => [
                'uses' => 'channel.link',
            ],
            'description' => [
                'uses' => 'channel.description',
            ],
            'image' => [
                'uses' => 'channel.image.url',
            ],
            'news' => [
                'uses' => 'channel.item[title,link,author,description,pubDate,category]'
            ],
        ]);

        $explode = explode("/", $this->link);
        $fileName = end($explode);

        Storage::append('parse/' . $fileName . ".json", json_encode($data));
    }
}