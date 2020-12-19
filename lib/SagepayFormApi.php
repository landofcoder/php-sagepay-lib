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
 * The Sage Pay Form integration method API
 */
class SagepayFormApi extends SagepayAbstractApi
{

    /**
     * Integration method
     *
     * @var string
     */
    protected $integrationMethod = Constants::SAGEPAY_FORM;

    /**
     *
     * @param SagepaySettings $config
     */
    public function __construct(SagepaySettings $config)
    {
        parent::__construct($config);
        $this->mandatory = array(
            'VendorTxCode',
            'Amount',
            'Currency',
            'Description',
            'SuccessURL',
            'FailureURL',
            'BillingSurname',
            'BillingFirstnames',
            'BillingAddress1',
            'BillingCity',
            'BillingPostCode',
            'BillingCountry',
            'DeliverySurname',
            'DeliveryFirstnames',
            'DeliveryAddress1',
            'DeliveryCity',
            'DeliveryPostCode',
            'DeliveryCountry',
        );
    }

    /**
     * Return urlencoded string based on data
     *
     * @uses SagepayUtil::arrayToQueryString
     * @return string
     */
    public function getQueryData()
    {
        // Replace after implemeting right View content
        return SagepayUtil::arrayToQueryString($this->data);
    }

    /**
     * Generate values for payment.
     * Ensure that post data is setted to request with SagepayAbstractApi::setData()
     *
     * @see SagepayAbstractApi::createRequest()
     * @uses SagepayCommon::encryptedOrder
     * @return array The response from Sage Pay
     */
    public function createRequest()
    {
        $this->addConfiguredValues();
        return SagepayCommon::encryptedOrder($this);
    }

}

