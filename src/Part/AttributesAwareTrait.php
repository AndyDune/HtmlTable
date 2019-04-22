<?php
/**
 *
 * @package andydune/html-table
 * @link  https://github.com/AndyDune/HtmlTable for the canonical source repository
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 * @author Andrey Ryzhov  <info@rznw.ru>
 * @copyright 2019 Andrey Ryzhov
 */


namespace AndyDune\HtmlTable\Part;


trait AttributesAwareTrait
{
    /**
     * @var array
     */
    protected $classes = [];

    protected $styles = [];

    protected $id = null;

    /**
     * @return string
     */
    public function getAttributeClassValue()
    {
        if (!$this->classes) {
            return '';
        }

        $attributesArray = array_reduce($this->classes, function($carry, $item) {
            $item = trim($item);
            if ($item) {
                $carry[] = $item;
            }
            return $carry;
        }, []);

        if ($attributesArray) {
            return implode(' ', $attributesArray);
        }
        return '';
    }

    /**
     * @return string
     */
    public function getAttributeStyleValue()
    {
        if (!$this->styles) {
            return '';
        }

        return implode('; ', $this->styles);
    }

    /**
     * @return array
     */
    public function getClasses()
    {
        return $this->classes;
    }

    /**
     * @param string $class
     * @return $this
     */
    public function addClass($class)
    {
        $this->classes[] = $class;
        return $this;
    }

    /**
     * @return array
     */
    public function getStyles()
    {
        return $this->styles;
    }

    /**
     * @param $style
     * @param string $valuePart
     * @return $this
     */
    public function addStyle($style, $valuePart = '')
    {
        $style = trim($style);
        if ($valuePart) {
            $this->styles[] = $style . ': ' . $valuePart;
        } else {
            $this->styles[] = $style;
        }
        return $this;
    }

    /**
     * @return null|string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }


}