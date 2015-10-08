<?php

namespace Victoire\Widget\ImageBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Victoire\Bundle\CoreBundle\Form\WidgetType;
use Victoire\Bundle\WidgetBundle\Model\Widget;

/**
 * WidgetImage form type
 */
class WidgetImageType extends WidgetType
{
    /**
     * define form fields
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if ($options['mode'] === null || $options['mode'] === Widget::MODE_STATIC) {
            $builder
                ->add('image', 'media', [
                    'label' => 'widget_image.form.image.label',
                ])
                ->add('lazyLoad', null, [
                    'label' => 'widget_image.form.lazyLoad.label',
                    'vic_help_label' => 'widget_image.form.lazyLoad.help_label',
                ])
                ->add('alt', null, [
                    'label' => 'widget_image.form.alt.label',
                    'required' => true,
                    'attr'  => ['placeholder' => 'widget_image.form.alt.placeholder'],
                ])
                ->add('legend', null, [
                    'label' => 'widget_image.form.legend.label',
                ])
                ->add('link', 'victoire_link', [
                    'required'       => false,
                    'horizontal'     => true,
                ])
                ->add('hover', 'choice', [
                    'label' => 'widget_image.form.hover.label',
                    'attr'  => array(
                    'data-refreshOnChange' => "true",
                    ),
                    'choices'       => array(
                        'default' => 'widget_image.form.hover.choice.default.label',
                        'popover' => 'widget_image.form.hover.choice.popover.label',
                        'tooltip' => 'widget_image.form.hover.choice.tooltip.label',
                    ),
                ])
            ;

            $builder->addEventListener(
                FormEvents::PRE_SET_DATA,
                function(FormEvent $event) {
                    self::manageRelativeFields($event->getForm(), $event->getData()->getHover());
                }
            );

            $builder->get('hover')->addEventListener(
                FormEvents::PRE_SUBMIT,
                function(FormEvent $event) {
                    self::manageRelativeFields($event->getForm()->getParent(), (string) $event->getData());
                }
            );


        }
        parent::buildForm($builder, $options);
    }


    protected function manageRelativeFields(FormInterface $form, $hover)
    {
        if ($hover == 'popover') {
            $form
                ->remove('tooltip')
                ->add('title', null, [
                    'label' => 'widget_image.form.title.popover.label',
                ])
                ->add('popover', 'ckeditor', [
                    'label' => 'widget_image.form.popover.label',
                    'required' => false,
                ])
                ->add('placement', 'choice', [
                    'label' => 'widget_image.form.placement.label',
                    'choices' => [
                        'bottom' => 'widget_image.form.placement.bottom',
                        'left' => 'widget_image.form.placement.left',
                        'right' => 'widget_image.form.placement.right',
                        'top' => 'widget_image.form.placement.top',
                    ],
                ])
            ;
        }
        else if ($hover == 'tooltip') {
            $form
                ->remove('popover')
                ->add('title', null, [
                    'label' => 'widget_image.form.title.tooltip.label',
                ])
                ->add('placement', 'choice', [
                    'label' => 'widget_image.form.placement.label',
                    'choices' => [
                        'bottom' => 'widget_image.form.placement.bottom',
                        'left' => 'widget_image.form.placement.left',
                        'right' => 'widget_image.form.placement.right',
                        'top' => 'widget_image.form.placement.top',
                    ],
                ])
            ;
        }
        else {
            $form
                ->remove('popover')
                ->remove('tooltip')
                ->remove('placement')
                ->add('title', null, [
                    'label' => 'widget_image.form.title.label',
                ])
            ;
        }
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);

        $resolver->setDefaults(
            array(
                'data_class'         => 'Victoire\Widget\ImageBundle\Entity\WidgetImage',
                'widget'             => 'Image',
                'translation_domain' => 'victoire',
            )
        );
    }

    /**
     * get form name
     *
     * @return string The name of the form
     */
    public function getName()
    {
        return 'victoire_widget_form_image';
    }
}
