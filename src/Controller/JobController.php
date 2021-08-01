<?php

namespace App\Controller;

use App\Entity\Job;
use App\Form\Type\JobType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class JobController
 * @package App\Controller
 *
 * @Route("/job")
 */
class JobController extends AbstractController
{
    /**
     * @Route("", name="api_job_get_collection", methods={"GET"})
     *
     * @param Request $request
     * @return Response
     */
    public function getCollection(Request $request): Response
    {
        $jobs = $this->getDoctrine()
            ->getRepository(Job::class)
            ->findAll();

        return $this->returnViewResponse($jobs);
    }

    /**
     * @Route("", name="api_job_new", methods={"POST"})
     *
     * @param Request $request
     * @return Response
     */
    public function post(Request $request): Response
    {
        $job = new Job();
        $form = $this->createForm(JobType::class, $job);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($job);
            $em->flush();

            return $this->returnViewResponse($job, Response::HTTP_CREATED);
        }

        return $this->returnViewResponse($this->getFormErrorMessages($form), Response::HTTP_BAD_REQUEST);
    }

    /**
     * @Route("/{id}", requirements={"id" = "\d+"}, name="api_job_update", methods={"PUT"})
     *
     * @param Job $job
     * @param Request $request
     * @return Response
     */
    public function put(Job $job, Request $request): Response
    {
        $form = $this->createForm(JobType::class, $job, ['method' => 'PUT']);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->returnViewResponse($job);
        }

        return $this->returnViewResponse($this->getFormErrorMessages($form), Response::HTTP_BAD_REQUEST);
    }

    /**
     * @Route("/{id}", requirements={"id" = "\d+"}, name="api_job_get", methods={"GET"})
     *
     * @param Job $job
     * @return object|void
     */
    public function getItem(Job $job): Response
    {
        return $this->returnViewResponse($job);
    }

    /**
     * @Route("/{id}", requirements={"id" = "\d+"}, name="api_job_delete", methods={"DELETE"})
     *
     * @param Job $job
     * @return object|void
     */
    public function delete(Job $job): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($job);
        $em->flush();

        return $this->returnViewResponse(null, Response::HTTP_NO_CONTENT);
    }
}
