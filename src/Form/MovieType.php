<?php

namespace App\Form;

use App\Entity\Movie;
use App\Entity\Horaire;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType; // Importez DateType
use Symfony\Component\Form\Extension\Core\Type\CollectionType;// Pour importer extension CollectionType

class MovieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Titlemovie')
            ->add('Content') 
            ->add('horaires', CollectionType::class, [
                'entry_type' => HoraireType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'by_reference' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Movie::class,
        ]);
    }
}
