<?php

namespace App\Story;

use App\Entity\Product;
use App\Factory\ProductFactory;
use Zenstruck\Foundry\Story;

final class DefaultProductsStory extends Story
{
    public function build(): void
    {
        ProductFactory::create(100);
    }
}
