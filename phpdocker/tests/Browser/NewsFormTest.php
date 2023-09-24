<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class NewsFormTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testFormAddNews(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/news/create')
                    ->type('title', '1')
                    ->press('Save')
                    ->assertSee('Количество символов в поле наименование должно быть не меньше 3');
        });
    }
}
