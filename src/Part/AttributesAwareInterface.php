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


interface AttributesAwareInterface
{
    /**
     * @return string
     */
    public function getAttributeClassValue();

    /**
     * @return string
     */
    public function getAttributeStyleValue();

    /**
     * @return array
     */
    public function getClasses();

    /**
     * @param string $class
     * @return $this
     */
    public function addClass($class);

    /**
     * @return array
     */
    public function getStyles();

    /**
     * @param $style
     * @param string $valuePart
     * @return $this
     */
    public function addStyle($style, $valuePart = '');

    /**
     * @return null|string
     */
    public function getId();

    /**
     * @param string $id
     * @return $this
     */
    public function setId($id);

}