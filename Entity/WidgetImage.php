<?php
namespace Victoire\Widget\ImageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Victoire\Bundle\CoreBundle\Entity\Widget;
use Victoire\Bundle\CoreBundle\Annotations as VIC;
use Victoire\Bundle\PageBundle\Entity\BasePage;
use Victoire\Bundle\MediaBundle\Entity\Media;

/**
 * WidgetImage
 *
 * @ORM\Table("cms_widget_image")
 * @ORM\Entity
 */
class WidgetImage extends Widget
{
    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="\Victoire\Bundle\MediaBundle\Entity\Media")
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id", onDelete="CASCADE")
     *
     */
    protected $image;

    /**
     * @var string
     *
     * @ORM\Column(name="alt", type="string", length=255, nullable=true)
     * @VIC\ReceiverProperty("textable")
     */
    protected $alt;
    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     * @VIC\ReceiverProperty("textable")
     */
    protected $title;

    /**
     * @var string
     *
     * @ORM\Column(name="link_type", type="string", length=255)
     */
    protected $linkType;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     * @VIC\ReceiverProperty("imageable")
     */
    protected $url;

    /**
     * @ORM\ManyToOne(targetEntity="Victoire\Bundle\PageBundle\Entity\BasePage")
     * @ORM\JoinColumn(name="related_page_id", referencedColumnName="id", onDelete="cascade", nullable=true)
     */
    protected $relatedPage;

    /**
     * Set image
     *
     * @param string $image
     * @return WidgetImage
     */
    public function setImage(Media $image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }
    /**
     * Set alt
     *
     * @param string $alt
     * @return WidgetImage
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Get alt
     *
     * @return string
     */
    public function getAlt()
    {
        return $this->alt;
    }
    /**
     * Set title
     *
     * @param string $title
     * @return WidgetImage
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set linkType
     *
     * @param string $linkType
     * @return MenuItem
     */
    public function setlinkType($linkType)
    {
        $this->linkType = $linkType;

        return $this;
    }

    /**
     * Get linkType
     *
     * @return string
     */
    public function getlinkType()
    {
        return $this->linkType;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return MenuItem
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set related_page
     *
     * @param BasePage $relatedPage
     * @return Menu
     */
    public function setRelatedPage(BasePage $relatedPage = null)
    {
        $this->relatedPage = $relatedPage;

        return $this;
    }

    /**
     * Get related_page
     *
     * @return BasePage
     */
    public function getRelatedPage()
    {
        return $this->relatedPage;
    }

    /**
     * Get the url of the image
     *
     * @return string The url of the image
     */
    public function getImageUrl()
    {
        $url = null;

        $image = $this->getImage();

        if ($image !== null) {
            $url = $image->getUrl();
        }

        return $url;
    }
}
