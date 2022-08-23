<?php

declare(strict_types=1);

namespace App\Domain\Form;

use App\Domain\Entity\CsvFile;
use App\Domain\Entity\Employee;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class EmployeeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('employee', FileType::class, [
                'label' => 'Employee (CSV file)',

                'mapped' => false,

                'required' => false,

                'constraints' => [
                    new File([
                        'maxSize' => '2000Mi',
                        'mimeTypes' => [
                            'text/csv',
                            'text/csv-schema',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid CSV document',
                    ])
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Employee::class,
        ]);
    }
}