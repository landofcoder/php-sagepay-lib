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


/**
 * SagepayValidator, class which process all validation rules
 * and offers validation result and errors
 */
class SagepayValidator
{

    /**
     * Final result of validation
     *
     * @var boolean
     */
    private $_isValid = true;

    /**
     * List of errors
     *
     * @var string[]
     */
    private $_errors = array();

    /**
     * Constructor of SagepayValidator
     *
     * @param mixed $value  Value that will be validate
     * @param array $rules  List of validation rules
     */
    public function __construct($value, array $rules)
    {
        // Initialize rules
        foreach ($rules as $rule)
        {
            $params = isset($rule[1]) ? $rule[1] : array();
            array_unshift($params, $value);

            // Check if callable param is an array, if not use SagepayValid class
            if (is_array($rule[0]))
            {
                $validMethod = $rule[0];
            }
            else
            {
                $validMethod = array('SagepayValid', $rule[0]);
            }

            // Check for if validation passed
            $valid = FALSE;
            if (method_exists($validMethod[0], $validMethod[1]))
            {
                $valid = call_user_func_array($validMethod, $params);
            }
            
            if (!$valid)
            {
                $this->_errors[] = $validMethod[1];
                $this->_isValid = false;
                break;
            }
        }
    }

    /**
     * Get validation result
     *
     * @return boolean
     */
    public function isValid()
    {
        return $this->_isValid;
    }

    /**
     * Get validation errors as array
     *
     * @return string[]
     */
    public function getErrors()
    {
        return $this->_errors;
    }

}

