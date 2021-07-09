<?php

namespace App\Form;

use App\Entity\Announce;
use Doctrine\DBAL\Types\BooleanType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnnounceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                "label" => 'Titre',
                "attr" => [
                    "class" => "form-control"
                ]
            ])
            ->add('description', TextareaType::class, [
                "label" => 'Description', 
                "attr" => [
                    "class" => "form-control"
                ]
            ])
            ->add('introduction', TextType::class, [
                "label" => 'Introduction', 
                "attr" => [
                    "class" => "form-control"
                ]
            ])
            ->add('price', IntegerType::class, [
                "label" => 'Prix en Fcfa',
                "attr" => [
                    "class" => "form-control"
                ]
            ])
            ->add('address', TextareaType::class, [
                "label" => 'Adresse',
                "attr" => [
                     "class" => "form-control"
                ]
            ])
            ->add('coverImage', FileType::class, [
                'required' => false,
                "data_class" => null,
                "mapped" => true,
                "label" => 'Image de couverture', 
                "attr" => [
                   "class" => "form-control",
                ]
            ])
            ->add('rooms', IntegerType::class, [
                "attr" => [
                    "label" => 'Nombre de chambre', "class" =>"form-control"
                ]
            ])
            ->add('isAvailable', CheckboxType::class, [
                "label" => 'Disponible',
                
            ])

            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Announce::class,
        ]);
    }
}
