<?php
/**
 *
 * PHP version >= 5.6
 *
 * @package andydune/html-table
 * @link  https://github.com/AndyDune/HtmlTable for the canonical source repository
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 * @author Andrey Ryzhov  <info@rznw.ru>
 * @copyright 2019 Andrey Ryzhov
 */


namespace AndyDune\HtmlTable\BuilderElement;


use AndyDune\HtmlTable\Part\AttributesAwareInterface;

class Attributes implements ElementInterface
{
    /**
     * @var AttributesAwareInterface
     */
    protected $attributesOwner;

    const ATTRIBUTE_ID_TEMPLATE = 'id="%s"';
    const ATTRIBUTE_CLASS_TEMPLATE = 'class="%s"';
    const ATTRIBUTE_STYLE_TEMPLATE = 'style="%s"';
    const ATTRIBUTE_DATA_TEMPLATE = 'data-%s="%s"';

    public function __construct(AttributesAwareInterface $attributesOwner)
    {
        $this->attributesOwner = $attributesOwner;
    }

    public function getHtml()
    {
        $attributes = [];

        if ($id = $this->attributesOwner->getId()) {
            $attributes[] = sprintf(self::ATTRIBUTE_ID_TEMPLATE, $id);
        }

        if ($class = $this->attributesOwner->getAttributeClassValue()) {
            $attributes[] = sprintf(self::ATTRIBUTE_CLASS_TEMPLATE, $class);
        }

        if ($style = $this->attributesOwner->getAttributeStyleValue()) {
            $attributes[] = sprintf(self::ATTRIBUTE_STYLE_TEMPLATE, $style);
        }

        return implode(' ', $attributes);
    }
}