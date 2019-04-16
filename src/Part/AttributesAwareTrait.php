<?php
/**
 * ----------------------------------------------
 * | Author: Andrey Ryzhov (Dune) <info@rznw.ru> |
 * | Site: www.rznw.ru                           |
 * | Phone: +7 (4912) 51-10-23                   |
 * | Date: 16.04.2019                            |
 * -----------------------------------------------
 *
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