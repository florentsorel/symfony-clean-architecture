<?php

declare(strict_types=1);

namespace App\Api\Http\Controller;

use App\Api\Application\Query\Actor\FindActorQuery;
use App\Api\Application\Query\Actor\FindActorRequest;
use Doctrine\ORM\EntityNotFoundException;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

class FindActorController extends AbstractController
{
    public function __construct(
        private readonly FindActorQuery $findActorQuery,
        private readonly LoggerInterface $logger
    ) {
    }

    #[Route('/actors/{actorId}')]
    public function __invoke(int $actorId): JsonResponse
    {
        try {
            $actor = $this->findActorQuery->handle(new FindActorRequest($actorId));

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
