<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Symfony\Messenger;

use Domain\Shared\Bus\Command\Command;
use Domain\Shared\Bus\Command\CommandBus;
use Symfony\Component\Messenger\MessageBusInterface;

final class MessengerBusCommand implements CommandBus
{
    public function __construct(private readonly MessageBusInterface $commandBus)
    {
    }

    public function handle(Command $command): void
    {
        $this->commandBus->dispatch($command);
    }
}
