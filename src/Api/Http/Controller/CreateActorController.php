<?php

namespace App\Api\Http\Controller;

use App\Api\Application\Command\Actor\CreateActorCommand;
use App\Api\Application\Command\Actor\CreateActorHandler;
use App\Api\Infrastructure\View\Actor\ActorView;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

class CreateActorController extends AbstractController
{
    public function __construct(
        private readonly CreateActorHandler $handler,
        private readonly LoggerInterface $logger
    ) {
    }

    #[Route('/actor', methods: 'POST')]
    public function __invoke(Request $request): JsonResponse
    {
        try {
            $actor = $this->handler->handle(
                CreateActorCommand::fromRequest($request->request)
            );

            return $this->json((new ActorView($actor))->toArray(), Response::HTTP_CREATED);
        } catch (Throwable $exception) {
            $this->logger->error($exception->getMessage());

            return $this->json([
                'message' => 'An error has occurred',
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
