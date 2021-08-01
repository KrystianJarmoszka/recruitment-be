<?php

namespace App\Controller;

use App\Entity\Property;
use App\Form\Type\PropertyType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PropertyController
 * @package App\Controller
 *
 * @Route("/property")
 */
class PropertyController extends AbstractController
{
    /**
     * @Route("", name="api_property_get_collection", methods={"GET"})
     *
     * @param Request $request
     * @return Response
     */
    public function getCollection(Request $request): Response
    {
        $properties = $this->getDoctrine()
            ->getRepository(Property::class)
            ->findAll();

        return $this->returnViewResponse($properties);
    }

    /**
     * @Route("", name="api_property_new", methods={"POST"})
     *
     * @param Request $request
     * @return Response
     */
    public function post(Request $request): Response
    {
        $property = new Property();
        $form = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($property);
            $em->flush();

            return $this->returnViewResponse($property, Response::HTTP_CREATED);
        }

        return $this->returnViewResponse($this->getFormErrorMessages($form), Response::HTTP_BAD_REQUEST);
    }

    /**
     * @Route("/{id}", requirements={"id" = "\d+"}, name="api_property_update", methods={"PUT"})
     *
     * @param Property $property
     * @param Request $request
     * @return Response
     */
    public function put(Property $property, Request $request): Response
    {
        $form = $this->createForm(PropertyType::class, $property, ['method' => 'PUT']);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->returnViewResponse($property);
        }

        return $this->returnViewResponse($this->getFormErrorMessages($form), Response::HTTP_BAD_REQUEST);
    }

    /**
     * @Route("/{id}", requirements={"id" = "\d+"}, name="api_property_get", methods={"GET"})
     *
     * @param Property $property
     * @return object|void
     */
    public function getItem(Property $property): Response
    {
        return $this->returnViewResponse($property);
    }

    /**
     * @Route("/{id}", requirements={"id" = "\d+"}, name="api_property_delete", methods={"DELETE"})
     *
     * @param Property $property
     * @return object|void
     */
    public function delete(Property $property): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($property);
        $em->flush();

        return $this->returnViewResponse(null, Response::HTTP_NO_CONTENT);
    }
}
