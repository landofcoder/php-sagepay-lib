<?php
/**
 * Landofcoder
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the venustheme.com license that is
 * available through the world-wide-web at this URL:
 * https://landofcoder.com/license
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category   Landofcoder
 * @package    Lof_SagepayLib
 * @copyright  Copyright (c) 2020 Landofcoder (https://landofcoder.com)
 * @license    https://landofcoder.com/LICENSE-1.0.html
 */

namespace Lof\SagepayLib\Classes;


class SagepayDiscount
{
    private $_description = '';

    private $_fixed = 0;

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->_description;
    }

    public function setDescription($description)
    {
        $this->_description = $description;
    }

    public function setFixed($fixed){
        $this->_fixed = $fixed;
    }

    public function getFixed(){
        return $this->_fixed;
    }

    /**
     * Create a DOMNode from property
     *
     * @param \DOMDocument $basket
     *
     * @return \DOMNode
     */
    public function asDomElement(\DOMDocument $basket)
    {
        $element = $basket->createElement('discount');
        $fixed = $basket->createElement('fixed', number_format($this->getFixed(), 2, ".", ""));
        $description = $basket->createElement('description', substr($this->getDescription(), 0, 100));
        $element->appendChild($fixed);
        $element->appendChild($description);
        return $element;
    }

}
