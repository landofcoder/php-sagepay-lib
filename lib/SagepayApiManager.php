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
 * Factory to obtain an instance of any of the available APIs.
 */
class SagepayApiManager
{
    /**
     * Create instance of required integration type
     *
     * @param string           $type    Integration type
     * @param SagepaySettings  $config  Sagepay config instance
     *
     * @return SagepayAbstractApi
     */
    static public function create($type, SagepaySettings $config)
    {
        $integration = strtolower($type);
        $integrationApi = __NAMESPACE__ . "\\" . 'Sagepay' . ucfirst($integration) . 'Api';

        if (class_exists($integrationApi))
        {
            return new $integrationApi($config);
        }
        else
        {
            return NULL;
        }
    }

}
