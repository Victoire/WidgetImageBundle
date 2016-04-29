<?php

namespace Victoire\Widget\ImageBundle\Form;

use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Victoire\Bundle\CoreBundle\Form\WidgetType;
use Victoire\Bundle\FormBundle\Form\Type\LinkType;
use Victoire\Bundle\MediaBundle\Form\Type\MediaType;
use Victoire\Bundle\WidgetBundle\Model\Widget;

/**
 * WidgetImage form type.
 */
class WidgetImageType extends WidgetType
{
    /**
     * define form fields.
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if ($options['mode'] === null || $options['mode'] === Widget::MODE_STATIC) {
            $builder
                ->add('image', MediaType::class, [
                    'label' => 'widget_image.form.image.label',
                ])
                ->add('lazyLoad', null, [
                    'label'          => 'widget_image.form.lazyLoad.label',
                    'vic_help_label' => 'widget_image.form.lazyLoad.help_label',
                ])
                ->add('alt', null, [
                    'label'    => 'widget_image.form.alt.label',
                    'required' => true,
                    'attr'     => ['placeholder' => 'widget_image.form.alt.placeholder'],
                ])
                ->add('legend', null, [
                    'label' => 'widget_image.form.legend.label',
                ])
                ->add('link', LinkType::class, [
                    'required'       => false,
                    'horizontal'     => true,
                ])
                ->add('hover', ChoiceType::class, [
                    'label'   => 'widget_image.form.hover.label',
                    'choices' => [
                        'widget_image.form.hover.choice.default.label' => 'default',
                        'widget_image.form.hover.choice.popover.label' => 'popover',
                        'widget_image.form.hover.choice.tooltip.label' => 'tooltip',
                    ],
                    'choices_as_values' => true,
                    'attr'              => [
                        'data-refreshOnChange' => 'true',
                    ],
                ]);

            $builder->addEventListener(
                FormEvents::PRE_SET_DATA,
                function (FormEvent $event) {
                    self::manageRelativeFields($event->getForm(), $event->getData()->getHover());
                }
            );

            $builder->get('hover')->addEventListener(
                FormEvents::PRE_SUBMIT,
                function (FormEvent $event) {
                    self::manageRelativeFields($event->getForm()->getParent(), (string) $event->getData());
                }
            );
        }
        parent::buildForm($builder, $options);
    }

    protected function manageRelativeFields(FormInterface $form, $hover)
    {
        $positionChoices = [
            'widget_image.form.placement.bottom' => 'bottom',
            'widget_image.form.placement.left'   => 'left',
            'widget_image.form.placement.right'  => 'right',
            'widget_image.form.placement.top'    => 'top',
        ];

        if ($hover == 'popover') {
            $form
                ->remove('tooltip')
                ->add('title', null, [
                    'label' => 'widget_image.form.title.popover.label',
                ])
                ->add('popover', CKEditorType::class, [
                    'label'    => 'widget_image.form.popover.label',
                    'required' => false,
                ])
                ->add('placement', ChoiceType::class, [
                    'label'             => 'widget_image.form.placement.label',
                    'choices'           => $positionChoices,
                    'choices_as_values' => true,
                ]);
        } elseif ($hover == 'tooltip') {
            $form
                ->remove('popover')
                ->add('title', null, [
                    'label' => 'widget_image.form.title.tooltip.label',
                ])
                ->add('placement', ChoiceType::class, [
                    'label'             => 'widget_image.form.placement.label',
                    'choices'           => $positionChoices,
                    'choices_as_values' => true,
                ]);
        } else {
            $form
                ->remove('popover')
                ->remove('tooltip')
                ->remove('placement')
                ->add('title', null, [
                    'label' => 'widget_image.form.title.label',
                ]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults(
            [
                'data_class'         => 'Victoire\Widget\ImageBundle\Entity\WidgetImage',
                'widget'             => 'Image',
                'translation_domain' => 'victoire',
            ]
        );
    }
}
