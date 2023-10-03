<?php

namespace App\Services\Interfaces;

interface Parser
{
    public function setLink(string $link): Parser;

    public function saveParseData(): void;
}
