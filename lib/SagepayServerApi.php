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
 * The Sage Pay Server integration method API
 */
final class SagepayServerApi extends SagepayAbstractApi
{

    /**
     * The Server URL for integration methods
     *
     * @var string
     */
    private $_vpsServerUrl;

    /**
     * Integration method
     *
     * @var string
     */
    protected $integrationMethod = Constants::SAGEPAY_SERVER;

    /**
     * Constructor for SagepayServerApi
     *
     * @param SagepaySettings $config
     */
    public function __construct(SagepaySettings $config)
    {
        parent::__construct($config);
        $this->_vpsServerUrl = $config->getPurchaseUrl('server');
        $this->mandatory = array(
            'VPSProtocol',
            'TxType',
            'Vendor',
            'VendorTxCode',
            'Amount',
            'Currency',
            'Description',
            'NotificationURL',
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
            'StoreToken'
        );
    }

    /**
     * Generate values for payment.
     * Ensure that post data is setted to request with SagepayAbstractApi::setData()
     *
     * @see SagepayAbstractApi::createRequest()
     * @return array The response from Sage Pay
     */
    public function createRequest()
    {
        $this->data = SagepayCommon::encryptedOrder($this);
        $this->addConfiguredValues();
        $this->checkMandatoryFields();

        $ttl = $this->config->getRequestTimeout();
        $caCert = $this->config->getCaCertPath();
        return SagepayCommon::requestPost($this->_vpsServerUrl, $this->data, $ttl, $caCert);
    }

    /**
     * @see SagepayAbstractApi::getQueryData()
     * @return null
     */
    public function getQueryData()
    {
        return null;
    }

    /**
     * Get vpsServerUrl
     *
     * @return type
     */
    public function getVpsServerUrl()
    {
        return $this->_vpsServerUrl;
    }

    /**
     * Set vpsServerUrl
     *
     * @uses SagepayValid::url Validate URL field
     * @param type $vpsServerUrl
     */
    public function setVpsServerUrl($vpsServerUrl)
    {
        if (SagepayValid::url($vpsServerUrl))
        {
            $this->_vpsServerUrl = $vpsServerUrl;
        }
    }

}

