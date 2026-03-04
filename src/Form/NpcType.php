<?php

namespace App\Form;

use App\Entity\Npc;
use App\Entity\Clase;
use App\Entity\Raza;
use App\Entity\Lugares;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType; 
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NpcType extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options): void{
    $builder
        ->add('nombre', TextType::class, ['label' => 'Nombre del NPC:'])
        ->add('raza', EntityType::class, ['class' => Raza::class, 'choice_label' => 'nombre', 'label' => 'Raza del NPC:'])
        ->add('clase', EntityType::class, ['class' => Clase::class, 'choice_label' => 'nombre', 'label' => 'Clase del NPC:'])
        ->add('genero', ChoiceType::class, ['label' => 'Género del NPC:', 'choices' => ['Masculino' => 'H', 'Femenino' => 'M'], 'expanded' => true, 'multiple' => false])
        ->add('edad', IntegerType::class, ['label' => 'Edad del NPC:', 'attr' => ['min' => 0]])
        ->add('lugar', EntityType::class, ['class' => Lugares::class, 'choice_label' => 'nombre', 'label' => 'Lugar del NPC:'])
        ->add('vivo', ChoiceType::class, ['label' => '¿Está el NPC vivo?', 'choices' => ['Si' => true, 'No' => false], 'expanded' => true, 'multiple' => false])
        ->add('comerciante', ChoiceType::class, ['label' => '¿El NPC es un comerciante?', 'choices' => ['Si' => true, 'No' => false], 'expanded' => true, 'multiple' => false])
        ->add('amistoso', ChoiceType::class, ['label' => '¿El NPC es amistoso?', 'choices' => ['Si' => true, 'No' => false], 'expanded' => true, 'multiple' => false])
        ->add('descripcion', TextType::class, ['label' => 'Descripción del NPC:']);
    }
    public function configureOptions(OptionsResolver $resolver): void {
        $resolver->setDefaults(['data_class' => Npc::class]);
    }
}