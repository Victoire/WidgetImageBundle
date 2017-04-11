<?php

namespace Victoire\Widget\ImageBundle\Tests\Context;

use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Knp\FriendlyContexts\Context\RawMinkContext;

class WidgetContext extends RawMinkContext
{
    /**
     * @Then /^I should see an image with url "(.+)" and alternative text "(.+)"$/
     */
    public function iShouldSeeBackgroundImageWithRelativeUrl($url, $alt)
    {
        $page = $this->getSession()->getPage();

        $img = $page->findAll('xpath', sprintf(
            'descendant-or-self::img[contains(@src, "%s") and @alt="%s"]',
            $url,
            $alt
        ));

        if (count($img) < 1) {
            throw new \RuntimeException('Image with url "'.$url.'" and alternative text "'.$url.'" could not be found.');
        }
    }
}
