<?php

declare(strict_types=1);

namespace Domain\Shared\Bus\Command;

interface CommandBus
{
    public function handle(Command $command): void;
}
