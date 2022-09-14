<?php

declare(strict_types=1);

namespace Domain\Shared\Bus\Query;

interface QueryBus
{
    public function ask(Query $query): mixed;
}
