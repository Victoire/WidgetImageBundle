<?php

namespace Victoire\Widget\ImageBundle\Resolver;

use Victoire\Bundle\WidgetBundle\Model\Widget;
use Victoire\Bundle\WidgetBundle\Resolver\BaseWidgetContentResolver;
use Victoire\Widget\ButtonBundle\Entity\WidgetButton;

class WidgetImageContentResolver extends BaseWidgetContentResolver
{
    protected $twigResponsive;

    public function __construct($twigResponsive)
    {
        $this->twigResponsive = $twigResponsive;
    }

    /**
     * Get the static content of the widget.
     *
     * @param Widget $widget
     *
     * @return string
     */
    public function getWidgetStaticContent(Widget $widget)
    {
        $parameters = parent::getWidgetStaticContent($widget);
        return array_merge($parameters, ['victoire_twig_responsive' => $this->twigResponsive]);
    }

    /**
     * Get the business entity content.
     *
     * @param Widget $widget
     *
     * @return string
     */
    public function getWidgetBusinessEntityContent(Widget $widget)
    {
        $parameters = parent::getWidgetBusinessEntityContent($widget);
        return array_merge($parameters, ['victoire_twig_responsive' => $this->twigResponsive]);
    }

    /**
     * Get the content of the widget by the entity linked to it.
     *
     * @param Widget $widget
     *
     * @return string
     */
    public function getWidgetEntityContent(Widget $widget)
    {
        $parameters = parent::getWidgetEntityContent($widget);
        return array_merge($parameters, ['victoire_twig_responsive' => $this->twigResponsive]);
    }

    /**
     * Get the content of the widget for the query mode.
     *
     * @param Widget $widget
     *
     * @return string
     */
    public function getWidgetQueryContent(Widget $widget)
    {
        $parameters = parent::getWidgetQueryContent($widget);
        return array_merge($parameters, ['victoire_twig_responsive' => $this->twigResponsive]);
    }

}
