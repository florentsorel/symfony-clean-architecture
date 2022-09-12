<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Doctrine\DataTransformer;

interface EntityTransformer
{
    public function toDomain($entity);

    public function toEntity($domain, $target = null);
}
