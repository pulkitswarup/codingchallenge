<?php

namespace App\Controller;

use App\Dto\JobRequest;
use App\Service\JobService;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * class JobController
 * @Rest\NoRoute()
 */
class JobController extends FOSRestController
{
    /** @var JobService $service */
    private $service;

    /**
     * JobController Constructor
     *
     * @param JobService $service
     */
    public function __construct(JobService $service)
    {
        $this->service = $service;
    }

    /**
     * API Endpoint to create new jobs
     * @Route("job", methods={"POST"})
     * @ParamConverter("request", converter="fos_rest.request_body")

     * @param JobRequest $request
     * @param ConstraintViolationListInterface $validationErrors
     *
     * @return View
     */
    public function postJob(
        JobRequest $request,
        ConstraintViolationListInterface $validationErrors
    ) : View
    {
        if (count($validationErrors) > 0) {
            return $this->view($validationErrors, Response::HTTP_BAD_REQUEST);
        }
        $job = $this->service->create($request);
        return $this->view($job, Response::HTTP_CREATED);
    }
}
