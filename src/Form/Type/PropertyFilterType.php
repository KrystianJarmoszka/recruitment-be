<?php

namespace App\Form\Type;

use App\Repository\Filter\PropertyListFilter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

/**
 * Class PropertyFilterType
 * @package App\Form\Type
 */
class PropertyFilterType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('page', null, [])
            ->add('keyword', null, [])
            ->add('name', null, [])
            ->add('order', null, []);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => PropertyListFilter::class,
            'csrf_protection' => false,
        ));
    }

    public function getBlockPrefix(): string
    {
        return '';
    }
}
