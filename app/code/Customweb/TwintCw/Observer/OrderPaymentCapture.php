<?php
/**
 * You are allowed to use this API in your web application.
 *
 * Copyright (C) 2018 by customweb GmbH
 *
 * This program is licenced under the customweb software licence. With the
 * purchase or the installation of the software in your application you
 * accept the licence agreement. The allowed usage is outlined in the
 * customweb software licence which can be found under
 * http://www.sellxed.com/en/software-license-agreement
 *
 * Any modification or distribution is strictly forbidden. The license
 * grants you the installation in one application. For multiuse you will need
 * to purchase further licences at http://www.sellxed.com/shop.
 *
 * See the customweb software licence agreement for more details.
 *
 *
 * @category	Customweb
 * @package		Customweb_TwintCw
 *
 */

namespace Customweb\TwintCw\Observer;

use Magento\Framework\Event\ObserverInterface;

class OrderPaymentCapture implements ObserverInterface
{
	/**
	 * Core registry
	 *
	 * @var \Magento\Framework\Registry
	 */
	protected $_coreRegistry = null;

	/**
	 * @param \Magento\Framework\Registry $coreRegistry
	 * @param \Customweb\TwintCw\Model\Authorization\TransactionFactory $transactionFactory
	 */
	public function __construct(
			\Magento\Framework\Registry $coreRegistry
	) {
		$this->_coreRegistry = $coreRegistry;
	}

	public function execute(\Magento\Framework\Event\Observer $observer)
	{
		$this->_coreRegistry->unregister('twintcw_invoice');
		/* @var $order \Magento\Sales\Model\Order\Invoice */
		$invoice = $observer->getEvent()->getInvoice();
		$this->_coreRegistry->register('twintcw_invoice', $invoice);
	}
}