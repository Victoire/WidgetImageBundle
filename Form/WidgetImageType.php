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
                ->add('imageTheme', 'choice', [
                    'label'          => 'widget_image.form.theme.label',
                    'attr' => [
                        'data-refreshOnChange' => "true",
                    ],
                    'choices' => [
                        'default' => 'widget_image.form.default',
                        'cover' => 'widget_image.form.cover',
                        'popover' => 'widget_image.form.popover',
                    ],
                ])
            ;

            $builder->addEventListener(
                FormEvents::PRE_SET_DATA,
                function(FormEvent $event) {
                    self::manageRelativeFields($event->getForm(), $event->getData()->getImageTheme());
                }
            );

            $builder->get('imageTheme')->addEventListener(
                FormEvents::PRE_SUBMIT,
                function(FormEvent $event) {
                    self::manageRelativeFields($event->getForm()->getParent(), (string) $event->getData());
                }
            );


        }
        parent::buildForm($builder, $options);
    }

    protected function generateDefaultFields(FormInterface $form) {
        $form
            ->add('image', 'media', [
                'label' => 'widget_image.form.image.label',
            ])
            ->add('lazyLoad', null, [
                'label' => 'widget_image.form.lazyLoad.label',
            ])
            ->add('alt', null, [
                'label' => 'widget_image.form.alt.label',
            ])
            ->add('title', null, [
                'label' => 'widget_image.form.title.label',
            ])
            ->add('legend', null, [
                'label' => 'widget_image.form.legend.label',
            ])
            ->add('link', 'victoire_link', [
                'label'          => 'widget_image.form.lazyLoad.label',
                'vic_help_label' => 'widget_image.form.lazyLoad.help_label',
                'required'       => false,
            ])
            ->add('width', null, [
                'label' => 'widget_image.form.width.label',
                'vic_help_label' => 'widget_image.form.width.help_label',
            ])
            ->add('height', null, [
                'label' => 'widget_image.form.height.label',
                'vic_help_label' => 'widget_image.form.width.help_label',
            ])
            ->add('opacity', null, [
                'label' => 'widget_image.form.opacity.label',
                'vic_help_block' => 'widget_image.form.opacity.help_block'
            ])
        ;
    }

    protected function manageRelativeFields(FormInterface $form, $themeImage)
    {
        switch ($themeImage) {
            case 'cover':
                $form
                    ->remove('lazyLoad')
                    ->remove('alt')
                    ->remove('title')
                    ->remove('legend')
                    ->remove('link')
                    ->remove('width')
                    ->remove('popover')
                    ->remove('placement')
                ;
                break;
            case 'popover':
                self::generateDefaultFields($form);
                $form
                    ->add('title', null, [
                        'label' => 'widget_image.form.title.popover.label',
                    ])
                    ->add('popover', 'ckeditor', [
                        'label' => 'widget_image.from.popover.label',
                        'required' => false,
                    ])
                    ->add('placement', 'choice', [
                        'label' => 'widget_image.from.placement.label',
                        'required' => false,
                        'choices' => [
                            'bottom' => 'widget_image.from.placement.bottom',
                            'left' => 'widget_image.from.placement.left',
                            'right' => 'widget_image.from.placement.right',
                            'top' => 'widget_image.from.placement.top',
                        ],
                    ])
                ;
                break;
            default:
                self::generateDefaultFields($form);
                $form
                    ->remove('popover')
                    ->remove('placement')
                ;
                break;
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
