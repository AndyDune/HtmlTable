<?php
/**
 * ----------------------------------------------
 * | Author: Andrey Ryzhov (Dune) <info@rznw.ru> |
 * | Site: www.rznw.ru                           |
 * | Phone: +7 (4912) 51-10-23                   |
 * | Date: 19.04.2019                            |
 * -----------------------------------------------
 *
 */


namespace AndyDune\HtmlTable\BuilderElement;


class Head extends Row
{
    protected $buildCellClass = HeadCell::class;
}