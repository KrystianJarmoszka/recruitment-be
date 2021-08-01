<?php

namespace App\Controller;

use App\Entity\Constants\RemovableInterface;
use App\Entity\Property;
use App\Form\Type\PropertyFilterType;
use App\Form\Type\PropertyType;
use App\Repository\Filter\PropertyListFilter;
use Knp\Component\Pager\Pagination\AbstractPagination;
use Knp\Component\Pager\PaginatorInterface;
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
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function getCollection(Request $request, PaginatorInterface $paginator): Response
    {
        $filter = new PropertyListFilter();
        $form = $this->createForm(PropertyFilterType::class, $filter, ['method' => 'GET']);
        $form->handleRequest($request);

        if ($this->getFormErrorMessages($form)) {
            return $this->returnViewResponse($this->getFormErrorMessages($form), Response::HTTP_BAD_REQUEST);
        }

        $properties = $this->getDoctrine()
            ->getRepository(Property::class)
            ->filterAndReturn($filter);

        /** @var AbstractPagination $pagination */
        $pagination = $paginator->paginate(
            $properties,
            $filter->getPage(),
            PropertyListFilter::LIMIT
        );

        return $this->returnCollectionViewResponse(
            $pagination,
            Response::HTTP_OK,
            ['list']
        );
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
     * @throws \Exception
     */
    public function delete(Property $property): Response
    {
        $property->setRemovable(RemovableInterface::REMOVED);

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return $this->returnViewResponse(null, Response::HTTP_NO_CONTENT);
    }
}
