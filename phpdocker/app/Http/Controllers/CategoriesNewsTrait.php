<?php

declare(strict_types=1);

namespace App\Http\Controllers;

trait CategoriesNewsTrait
{
  public function getCategoriesNews(int $id = null): array
  {

    $categories = [];
    $quantityNews = 10;

    if ($id === null) {
      for ($i = 1; $i < $quantityNews; $i++) {
        $news[$i] = [
          'id' => $i,
          'category' => $id,
          'tittle' => \fake()->jobTitle(),
          'decscription' => \fake()->text(100),
          'author' => \fake()->userName(),
          'created_at' => \now()->format('d-m-Y H:i'),
        ];
      }

      return $categories;
    }

    return [
      'id' => $id,
      'category' => $id,
      'tittle' => \fake()->jobTitle(),
      'decscription' => \fake()->text(100),
      'author' => \fake()->userName(),
      'created_at' => \now()->format('d-m-Y H:i'),
    ];
  }
}
