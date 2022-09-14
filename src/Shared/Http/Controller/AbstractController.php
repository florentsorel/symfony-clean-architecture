<?php

declare(strict_types=1);

namespace App\Shared\Http\Controller;

use Domain\Shared\Bus\Command\Command;
use Domain\Shared\Bus\Command\CommandBus;
use Domain\Shared\Bus\Query\Query;
use Domain\Shared\Bus\Query\QueryBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController as SymfonyAbstractController;

abstract class AbstractController extends SymfonyAbstractController
{
    public static function getSubscribedServices(): array
    {
        return array_merge(
            parent::getSubscribedServices(),
            [
                CommandBus::class,
                QueryBus::class,
            ]
        );
    }

    public function handle(Command $command): void
    {
        /** @var CommandBus $commandBus */
        $commandBus = $this->container->get(CommandBus::class);
        $commandBus->handle($command);
    }

    public function ask(Query $query): mixed
    {
        /** @var QueryBus $queryBus */
        $queryBus = $this->container->get(QueryBus::class);

        return $queryBus->ask($query);
    }
}
