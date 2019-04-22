<?php
/**
 * @package andydune/html-table
 * @link  https://github.com/AndyDune/HtmlTable for the canonical source repository
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 * @author Andrey Ryzhov  <info@rznw.ru>
 * @copyright 2019 Andrey Ryzhov
 */

namespace AndyDune\HtmlTable\BuilderElement;


class HeadCell extends Cell
{
    protected $template =
        '<th#colspan:more:printf(\' colspan="%s"\')##rowspan:more:printf(\' rowspan="%s"\')##attributes:prefix(" ")#>#content#</th>';

}