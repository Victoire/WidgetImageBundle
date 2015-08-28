<?php
namespace Victoire\Widget\ImageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Victoire\Bundle\WidgetBundle\Entity\Widget;
use Victoire\Bundle\CoreBundle\Annotations as VIC;
use Victoire\Bundle\PageBundle\Entity\Page;
use Victoire\Bundle\MediaBundle\Entity\Media;

/**
 * WidgetImage
 *
 * @ORM\Table("vic_widget_image")
 * @ORM\Entity
 */
class WidgetImage extends Widget
{
    use \Victoire\Bundle\WidgetBundle\Entity\Traits\LinkTrait;
    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="\Victoire\Bundle\MediaBundle\Entity\Media")
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * @VIC\ReceiverProperty("imageable")
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
     * @ORM\Column(name="legend", type="string", length=255, nullable=true)
     * @VIC\ReceiverProperty("textable")
     */
    protected $legend;

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
     * @ORM\Column(name="popover", type="text", nullable=true)
     * @VIC\ReceiverProperty("textable")
     */
    protected $popover;

    /**
     * @var string
     *
     * @ORM\Column(name="placement", type="string", length=255, nullable=true)
     */
    protected $placement = "bottom";

    /**
     * @var string
     *
     * @ORM\Column(name="width", type="string", length=255, nullable=true)
     */
    protected $width;

    /**
     * @var string
     *
     * @ORM\Column(name="height", type="string", length=255, nullable=true)
     */
    protected $height;

    /**
     * @ORM\Column(name="lazy_load", type="boolean", nullable=true)
     */
    protected $lazyLoad = true;

    /**
     * @var integer
     *
     * @ORM\Column(name="opacity", type="string", length=255, nullable=true)
     */
    protected $opacity;

    /**
     * @deprecated, this field is now "page"
     * we keep this field to avoid BC break
     *
     * @ORM\ManyToOne(targetEntity="Victoire\Bundle\PageBundle\Entity\Page")
     * @ORM\JoinColumn(name="related_page_id", referencedColumnName="id", onDelete="cascade", nullable=true)
     */
    protected $relatedPage;

    /**
     * @var string
     *
     * @ORM\Column(name="imageTheme", type="string", length=255, nullable=true)
     */
    protected $imageTheme;

    /**
     * Set image
     * @param string|Media $image
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
     * @param string $alt
     *
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
     * @param string $title
     *
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
     * Set popover
     * @param string $popover
     *
     * @return WidgetImage
     */
    public function setPopover($popover)
    {
        $this->popover = $popover;

        return $this;
    }

    /**
     * Get popover
     *
     * @return string
     */
    public function getPopover()
    {
        return $this->popover;
    }

    /**
     * Set legend
     * @param string $legend
     *
     * @return WidgetImage
     */
    public function setLegend($legend)
    {
        $this->legend = $legend;

        return $this;
    }

    /**
     * Get legend
     *
     * @return string
     */
    public function getLegend()
    {
        return $this->legend;
    }

    /**
     * Set linkType
     * @param string $linkType
     *
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
     * Set width
     * @param string $width
     *
     * @return MenuItem
     */
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * Get width
     *
     * @return string
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Set height
     * @param string $height
     *
     * @return MenuItem
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Get height
     *
     * @return string
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set url
     * @param string $url
     *
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
     *
     * @return Page
     */
    public function getRelatedPage()
    {
        return $this->relatedPage;
    }

    /**
     * Legacy support
     *
     * @return Page
     */
    public function getPage()
    {
        if ($this->relatedPage != null) {
            return $this->relatedPage;
        }

        return $this->page;
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

    /**
     * Get lazyLoad
     *
     * @return string
     */
    public function getLazyLoad()
    {
        return $this->lazyLoad;
    }

    /**
     * Set lazyLoad
     * @param string $lazyLoad
     *
     * @return $this
     */
    public function setLazyLoad($lazyLoad)
    {
        $this->lazyLoad = $lazyLoad;

        return $this;
    }

    /**
     * Get opacity
     *
     * @return string
     */
    public function getOpacity()
    {
        return $this->opacity;
    }

    /**
     * Set opacity
     *
     * @param string $opacity
     *
     * @return $this
     */
    public function setOpacity($opacity)
    {
        $this->opacity = $opacity;

        return $this;
    }

    /**
     * @return string
     */
    public function getImageTheme()
    {
        return $this->imageTheme;
    }

    /**
     * @param string $imageTheme
     * @return $this
     */
    public function setImageTheme($imageTheme)
    {
        $this->imageTheme = $imageTheme;

        return $this;
    }

    /**
     * @return string
     */
    public function getPlacement()
    {
        return $this->placement;
    }

    /**
     * @param string $placement
     * @return $this
     */
    public function setPlacement($placement)
    {
        $this->placement = $placement;

        return $this;
    }
}
