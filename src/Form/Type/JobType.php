<?php


namespace App\Form\Type;

use App\Entity\Constants\JobStatuses;
use App\Entity\Property;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Job;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;

/**
 * Class JobType
 * @package App\Form\Type
 */
class JobType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('summary', TextType::class)
            ->add('description', TextareaType::class, [])
            ->add('raisedBy', TextType::class, [])
            ->add('status', ChoiceType::class, [
                'choices' => JobStatuses::JOB_STATUSES,
                'empty_data' => JobStatuses::STATUS_OPEN
            ])
            ->add('property', EntityType::class, [
                'class' => Property::class
            ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Job::class,
            'csrf_protection' => false,
        ]);
    }

    public function getBlockPrefix(): string
    {
        return '';
    }
}
