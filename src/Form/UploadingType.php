<?php
/* !\class: UploadingType
 *  \brief: Class with the definition of the input objects for the new form
 *  \author: Ing. David Rincón
 *  \date: 10/11/2023
 */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UploadingType extends AbstractType
{
    /* !\fn: buildForm
    *  \brief: For defining properties of the fields
    *  \author: Ing. David Rincón
    *    \date: 10/11/2023
    *  \param1:$builder (FormBuilderInterface object)
    *  \param2:$options (Array)
    *  \return NONE
    */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('attachment', FileType::class, ['label' => 'Commands file (in txt)'])
            ->add('submit', SubmitType::Class, ['label' => 'Send'])
        ;
    }

    /* !\fn: configureOptions
    *  \brief: For configuring additional properties of the fields (It's not used in this case)
    *  \author: Ing. David Rincón
    *    \date: 10/11/2023
    *  \param1:$resolver (OptionsResolver object)
    *  \return NONE
    */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
