<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Doctrine\DataTransformer;

use Domain\Shared\Domain;

interface EntityTransformer
{
    public function toDomain($entity): Domain;

    public function toEntity($domain, $target = null);
}
