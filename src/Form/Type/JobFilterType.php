<?php

namespace App\Form\Type;

use App\Repository\Filter\JobListFilter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class JobFilterType
 * @package App\Form\Type
 */
class JobFilterType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('summary', TextType::class, [])
            ->add('page', TextType::class, [])
            ->add('keyword', TextType::class, [])
            ->add('order', TextType::class, []);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => JobListFilter::class,
            'csrf_protection' => false,
        ));
    }

    public function getBlockPrefix(): string
    {
        return '';
    }
}
