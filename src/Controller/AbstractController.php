<?php

namespace App\Controller;

use App\Form\Type\JobType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\AbstractFOSRestController;

class AbstractController extends AbstractFOSRestController
{
    /**
     * @param $data
     * @param int $status
     * @param array|string[] $serializationGroups
     * @return Response
     */
    public function returnViewResponse($data, int $status = Response::HTTP_OK, array $serializationGroups = ['default']): Response
    {
        $view = $this->view($data, $status);

        return $this->handleView($view);
    }

    /**
     * @param FormInterface $form
     * @return array
     */
    public function getFormErrorMessages(FormInterface $form): array
    {
        $errors = array();

//        var_dump($form->getErrors());

        foreach ($form->getErrors() as $key => $error) {

            if ($form->isRoot()) {
                $errors['#'][] = $error->getMessage();
            } else {
                $errors[] = $error->getMessage();
            }
        }

        if ($form->isSubmitted()) {
            foreach ($form->all() as $child) {
                if (!$child->isValid()) {
                    $errors[$child->getName()] = $this->getFormErrorMessages($child);
                }
            }
        }

        return $errors;
    }
}
