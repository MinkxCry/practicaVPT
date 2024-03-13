<?php

namespace App\Form;

use App\Entity\Proveedores;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SupplierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre', TextType::class, [
                'label' => 'Nombre',
                'attr' => [
                    'placeholder' => 'Nombre',
                    'autocomplete' => 'off',
                    'class' => 'form-control',
                    'required' => true
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Correo electrónico',
                'attr' => [
                    'placeholder' => 'Correo electrónico',
                    'autocomplete' => 'off',
                    'class' => 'form-control',
                    'required' => true
                ]
            ])
            ->add('numeroTelefono', TelType::class, [
                'label' => 'Número de teléfono',
                'attr' => [
                    'placeholder' => 'Número de teléfono',
                    'autocomplete' => 'off',
                    'class' => 'form-control',
                    'required' => true,
                    'pattern' => '^[0-9\+\(\) ]+$'
                ],
            ])
            ->add('tipo', ChoiceType::class, [
                'label' => 'Tipo de proveedor',
                'choices' => [
                    'Hotel' => 'Hotel',
                    'Pista' => 'Pista',
                    'Complemento' => 'Complemento'
                ],
                'attr' => [
                    'placeholder' => 'Eliga un tipo',
                    'autocomplete' => 'off',
                    'class' => 'form-control',
                    'required' => true
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Guardar',
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
            ]);

        // Agregar campo "Activo" solo al modificar
        if ($options['modificar']) {
            $builder->add('activo', ChoiceType::class, [
                'label' => 'Elige el estado',
                'choices' => [
                    'Activo' => '1',
                    'Inactivo' => '0'
                ],
                'attr' => [
                    'placeholder' => 'Actividad',
                    'autocomplete' => 'off',
                    'class' => 'form-control',
                    'required' => false
                ]
            ]);
        }

        /*->add('fechaIntroduccion', )
        ->add('fechaActualizacion')*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Proveedores::class,
            'modificar' => false
        ]);
    }
}
