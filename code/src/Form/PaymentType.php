<?php

namespace App\Form;

use App\Entity\Payment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PaymentType extends AbstractType
{
    CONST CURRENT = 'current';

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', ChoiceType::class, [
                'choices' => $this->getYears(1900),
            ])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Payment::class,
        ]);
    }

    private function getYears($min, $max=self::CURRENT)
    {
        if (! is_numeric($min)) {
            throw new \InvalidArgumentException("minimumdate is invalid");
        }

        $max = $max === 'current' ? date('Y') : $max;

        if ($min > $max) {
            throw new \InvalidArgumentException("Mindate can not be larger than maxdate");
        }

        $years = range($min, $max);
        rsort($years);

        return array_combine($years, $years);
    }
}
