<?php

namespace Victoire\ImageBundle\Widget\Manager;

use Victoire\Bundle\CoreBundle\Entity\Widget;

use Victoire\ImageBundle\Form\WidgetImageType;
use Victoire\ImageBundle\Entity\WidgetImage;
use Victoire\Bundle\CoreBundle\Widget\Managers\WidgetManagerInterface;
use Victoire\Bundle\CoreBundle\Widget\Managers\BaseWidgetManager;


/**
 * The widget image manager
 *
 * @author Thomas Beaujean
 *
 */
class WidgetImageManager extends BaseWidgetManager implements WidgetManagerInterface
{
    /**
     * Get the static content of the widget
     *
     * @param Widget $widget
     * @return string The static content
     *
     * @SuppressWarnings checkUnusedFunctionParameters
     */
    protected function getWidgetStaticContent(Widget $widget)
    {
        $url = $widget->getImageUrl();
        return $url;
    }

    /**
     * Get the business entity content
     * @param Widget $widget
     * @return Ambigous <string, unknown, \Victoire\Bundle\CoreBundle\Widget\Managers\mixed, mixed>
     *
     * @SuppressWarnings checkUnusedFunctionParameters
     */
    protected function getWidgetBusinessEntityContent(Widget $widget)
    {
        $entity = $widget->getEntity();

        $url = $entity->getImageUrl();
        return $url;
    }

    /**
     * Get the content of the widget by the entity linked to it
     *
     * @param Widget $widget
     *
     * @return string
     *
     * @SuppressWarnings checkUnusedFunctionParameters
     */
    protected function getWidgetEntityContent(Widget $widget)
    {
        $entity = $widget->getEntity();

        $url = $entity->getImageUrl();
        return $url;
    }

    /**
     * Get the content of the widget for the query mode
     *
     * @param Widget $widget
     *
     * @return string
     *
     * @SuppressWarnings checkUnusedFunctionParameters
     */
    protected function getWidgetQueryContent(Widget $widget)
    {
        return '';
    }

    /**
     * Get the widget name
     *
     * @return string
     */
    public function getWidgetName()
    {
        return 'image';
    }
}
