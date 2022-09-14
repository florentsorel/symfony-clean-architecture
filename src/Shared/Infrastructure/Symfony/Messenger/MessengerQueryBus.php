<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Symfony\Messenger;

use Domain\Shared\Bus\Query\Query;
use Domain\Shared\Bus\Query\QueryBus;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

final class MessengerQueryBus implements QueryBus
{
    use HandleTrait;

    private MessageBusInterface $queryBus;

    public function __construct(MessageBusInterface $queryBus)
    {
        $this->messageBus = $queryBus;
    }

    public function ask(Query $query): mixed
    {
        return $this->handle($query);
    }
}
