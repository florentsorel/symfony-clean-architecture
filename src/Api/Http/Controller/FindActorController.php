<?php

declare(strict_types=1);

namespace App\Api\Http\Controller;

use App\Shared\Http\Controller\AbstractController;
use Doctrine\ORM\EntityNotFoundException;
use Domain\Actor\GetActorById\ActorId;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

class FindActorController extends AbstractController
{
    public function __construct(
        private readonly LoggerInterface $logger
    ) {
    }

    #[Route('/actors/{actorId}')]
    public function __invoke(int $actorId): JsonResponse
    {
        try {
            $actor = $this->ask(new ActorId($actorId));

            return $this->json($actor->getActorView()->toArray());
        } catch (EntityNotFoundException) {
            return $this->json([
                'message' => 'Actor not found',
                'code' => Response::HTTP_NOT_FOUND,
            ], Response::HTTP_NOT_FOUND);
        } catch (Throwable $exception) {
            $this->logger->error($exception->getMessage());

            return $this->json([
                'message' => 'An error has occurred',
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
