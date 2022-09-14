<?php

declare(strict_types=1);

namespace App\Api\Http\Controller;

use App\Api\Infrastructure\View\Actor\ActorView;
use App\Shared\Http\Controller\AbstractController;
use Domain\Actor\GetActorById\ActorId;
use Domain\Actor\GetActorById\GetActorByIdResponse;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
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
            /** @var GetActorByIdResponse $actorResponse */
            $actorResponse = $this->ask(new ActorId($actorId));

            $actorViewModel = ActorView::fromDomain($actorResponse->getActor());

            // @todo add a serializer
            return $this->json($actorViewModel->toArray());
        } catch (HandlerFailedException $exception) {
            return $this->json([
                'message' => $exception->getPrevious()->getMessage(),
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
