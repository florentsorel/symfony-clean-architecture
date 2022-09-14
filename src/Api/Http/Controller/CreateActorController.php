<?php

namespace App\Api\Http\Controller;

use App\Api\Infrastructure\View\Actor\ActorView;
use App\Shared\Http\Controller\AbstractController;
use Domain\Actor\Actor;
use Domain\Actor\CreateActor\CreateActorCommand;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Throwable;

final class CreateActorController extends AbstractController
{
    public function __construct(
        private readonly LoggerInterface $logger
    ) {
    }

    #[Route('/actors', methods: 'POST')]
    public function __invoke(Request $request): JsonResponse
    {
        try {
            $command = new CreateActorCommand(
                $request->request->get('name'),
                1 === (int) $request->request->get('active')
            );

            $envelope = $this->handle($command);

            /** @var Actor $actor */
            $actor = $envelope->last(HandledStamp::class)->getResult();

            $actorViewModel = ActorView::fromDomain($actor);

            return new JsonResponse($actorViewModel->toArray(), Response::HTTP_CREATED, [
                'Location' => $this->generateUrl(
                    'get_actor',
                    ['actorId' => $actor->getId()],
                    UrlGeneratorInterface::ABSOLUTE_URL
                ),
            ]);
        } catch (Throwable $exception) {
            $this->logger->error($exception->getMessage());

            return $this->json([
                'message' => 'An error has occurred',
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
