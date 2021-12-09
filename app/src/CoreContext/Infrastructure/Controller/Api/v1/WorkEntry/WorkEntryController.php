<?php

namespace App\CoreContext\Infrastructure\Controller\Api\v1\WorkEntry;

use App\CoreContext\Application\Command\WorkEntry\CreateWorkEntry;
use App\CoreContext\Application\Command\WorkEntry\CreateWorkEntryHandler;
use App\CoreContext\Application\Query\WorkEntry\FindWorkEntriesByUser;
use App\CoreContext\Application\Query\WorkEntry\FindWorkEntriesByUserHandler;
use App\CoreContext\Application\Query\WorkEntry\FindWorkEntriesQuery;
use App\CoreContext\Application\Query\WorkEntry\FindWorkEntriesQueryHandler;
use App\CoreContext\Application\Query\WorkEntry\FindWorkEntryQuery;
use App\CoreContext\Application\Query\WorkEntry\FindWorkEntryQueryHandler;
use App\CoreContext\Infrastructure\Validator\Application\Command\WorkEntry\CreateWorkEntryValidator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class WorkEntryController extends AbstractController
{
    /** @Route("/workentries", methods={"GET"}) */
    public function index(FindWorkEntriesQueryHandler $queryHandler)
    {
        $workEntries = $queryHandler->handle(new FindWorkEntriesQuery());
        $workEntriesArray = [];
        // TODO: Convert to JSON through a parser
        foreach ($workEntries as $workEntry)
            $workEntriesArray[] = [
              "id" => $workEntry->id(),
              "userId" => $workEntry->userId(),
              "startDate" => $workEntry->startDate(),
              "endDate" => $workEntry->endDate(),
              "createdAt" => $workEntry->createdAt(),
              "updatedAt" => $workEntry->updatedAt()
            ];

        return $this->json($workEntriesArray);
    }

    /** @Route("/users/{userId}/workentries", methods={"GET"}) */
    public function list(string $userId, FindWorkEntriesByUserHandler $queryHandler)
    {
        $query = new FindWorkEntriesByUser($userId);

        // TODO: Validate the query
        $workEntries = $queryHandler->handle($query);

        $workEntriesArray = [];
        // TODO: Convert to JSON through a parser
        foreach ($workEntries as $workEntry)
            $workEntriesArray[] = [
                "id" => $workEntry->id(),
                "userId" => $workEntry->userId(),
                "startDate" => $workEntry->startDate(),
                "endDate" => $workEntry->endDate(),
                "createdAt" => $workEntry->createdAt(),
                "updatedAt" => $workEntry->updatedAt()
            ];

        return $this->json($workEntriesArray);
    }

    /** @Route("/workentries/{id}", methods={"GET"}) */
    public function show(string $id, FindWorkEntryQueryHandler $queryHandler)
    {
        $query = new FindWorkEntryQuery($id);

        // TODO: Validate the query
        $workEntry = $queryHandler->handle($query);

        return $this->json([
            "id" => $workEntry->id(),
            "userId" => $workEntry->userId(),
            "startDate" => $workEntry->startDate(),
            "endDate" => $workEntry->endDate(),
            "createdAt" => $workEntry->createdAt(),
            "updatedAt" => $workEntry->updatedAt()
        ]);
    }

    /** @Route("/workentries", methods={"POST"}) */
    public function create(Request $request, CreateWorkEntryHandler $handler, CreateWorkEntryValidator $validator)
    {
        $params = $request->request->all();

        $validator->validate($params);

        // TODO: Validator should contain properties after validation to avoid null checking
        $endDate = $params["endDate"] ?? null;

        $command = new CreateWorkEntry($params["userId"], $params["startDate"], $endDate);

        $handler->handle($command);

        return $this->json(null, 201);
    }
}
