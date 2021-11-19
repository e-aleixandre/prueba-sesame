<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\WorkEntry;
use App\Repository\WorkEntryRepository;
use App\Service\ValidationErrors;
use DateTime;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Validator as CustomAssert;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class WorkEntryController extends AbstractController
{
    private ValidatorInterface $validator;

    /**
     * @param ValidatorInterface $validator
     */
    public function __construct(ValidatorInterface $validator) {
        $this->validator = $validator;
    }

    /**
     * Show a single WorkEntry given its id
     *
     * @Route("/workentries/{id}", name="workentry_show", methods={"GET"})
     *
     * @param $id
     * @param WorkEntryRepository $workEntryRepository
     * @return JsonResponse
     */
    public function show($id, WorkEntryRepository $workEntryRepository): JsonResponse
    {
        $workEntry = $workEntryRepository->find($id);

        if (!$workEntry)
            throw $this->createNotFoundException();

        return $this->json($workEntry->getAsArray());
    }

    /**
     * Create a new WorkEntry
     *
     * @Route("/workentries", name="workentry_create", methods={"POST"})
     *
     * @param Request $request
     * @param ValidationErrors $validationErrors
     * @param EntityManagerInterface $entityManager
     * @return JsonResponse
     * @throws \Exception
     */
    public function create(Request $request, ValidationErrors $validationErrors, EntityManagerInterface $entityManager): JsonResponse
    {
        $violations = $this->validateWorkEntry($request->request->all());

        // If there are input errors, parse them and respond...
        if ($violations->count())
        {
            return $this->json($validationErrors->parse($violations), 400);
        }

        // No errors, create the new WorkEntry
        $workEntry = new WorkEntry();

        $user = $entityManager->getRepository(User::class)->find($request->get('userId'));

        $workEntry->setUser($user)
            ->setStartDate(new DateTime($request->get('startDate')));

        // Set the endDate only if it's there
        $endDate = $request->get('endDate');

        if ($endDate)
            $workEntry->setEndDate(new DateTime($endDate));

        $entityManager->persist($workEntry);
        $entityManager->flush();

        return $this->json($workEntry->getAsArray(), 201);
    }

    /**
     * Updates a WorkEntry
     *
     * @Route("/workentries/{id}", name="workentry_update", methods={"PUT"})
     *
     * @param $id
     * @param Request $request
     * @param WorkEntryRepository $workEntryRepository
     * @param ValidationErrors $validationErrors
     * @param EntityManagerInterface $entityManager
     * @return JsonResponse
     * @throws \Exception
     */
    public function update($id, Request $request, WorkEntryRepository $workEntryRepository, ValidationErrors $validationErrors, EntityManagerInterface $entityManager): JsonResponse
    {
        $workEntry = $workEntryRepository->find($id);

        // Throw 404 if no WorkEntry is found
        if (!$workEntry)
            throw $this->createNotFoundException();

        // Validate the input
        $violations = $this->validateWorkEntry($request->request->all());

        if ($violations->count())
            return $this->json($validationErrors->parse($violations), 400);

        // The WorkEntry exists and the input is correct
        $user = $entityManager->getRepository(User::class)->find($request->get('userId'));

        $workEntry
            ->setUser($user)
            ->setStartDate(new DateTime($request->get('startDate')));

        // Set the endDate only if it's there
        $endDate = $request->get('endDate');

        if ($endDate)
            $workEntry->setEndDate(new DateTime($endDate));

        $entityManager->flush();

        return $this->json($workEntry->getAsArray());
    }

    /**
     * Deletes a WorkEntry
     *
     * @Route("/workentries/{id}", name="workentry_delete", methods={ "DELETE" })
     *
     * @param $id
     * @param WorkEntryRepository $workEntryRepository
     * @param EntityManagerInterface $entityManager
     * @return JsonResponse
     */
    public function delete($id, WorkEntryRepository $workEntryRepository, EntityManagerInterface $entityManager): JsonResponse
    {
        $workEntry = $workEntryRepository->find($id);

        if (!$workEntry)
            throw $this->createNotFoundException();

        $entityManager->remove($workEntry);

        return $this->json($workEntry->getAsArray());
    }

    /**
     * @param $data
     * @return ConstraintViolationListInterface
     */
    private function validateWorkEntry($data): ConstraintViolationListInterface
    {
        $constraints = new Assert\Collection([
            'userId' => [
                new Assert\NotBlank(),
                // Checks that the id belongs to a real user
                new CustomAssert\UserId(),
            ],
            'startDate' => [
                new Assert\NotBlank(),
                new Assert\DateTime()
            ],
            'endDate' => [
                new Assert\Optional([
                    new Assert\DateTime(),
                    // Check that endDate is not lower than startDate
                    new Assert\Callback(function($object, ExecutionContextInterface $context) {
                        $startDate = $context->getRoot()['startDate'];
                        $endDate = $object;

                        if (is_a($startDate, DateTime::class) && is_a($endDate, DateTime::class)) {
                            if ($endDate->format('U') - $startDate->format('U') < 0) {
                                $context->buildViolation('endDate can\'t be lower than startDate')
                                    ->addViolation();
                            }
                        }
                    })
                ])
            ]
        ]);

        return $this->validator->validate($data, $constraints);
    }
}