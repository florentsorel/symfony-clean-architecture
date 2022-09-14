<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Symfony\Messenger;

use Domain\Shared\Bus\Query\Query;
use Domain\Shared\Bus\Query\QueryBus;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

final class MessengerQueryBus implements QueryBus
{
    use HandleTrait {
        handle as handleQuery;
    }

    public function __construct(private readonly MessageBusInterface $queryBus)
    {
    }

    public function ask(Query $query): mixed
    {
        return $this->handleQuery($query);
    }
}
