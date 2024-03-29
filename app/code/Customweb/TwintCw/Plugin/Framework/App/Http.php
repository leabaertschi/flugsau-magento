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

namespace Customweb\TwintCw\Plugin\Framework\App;

class Http
{

	/**
	 * @var \Customweb\TwintCw\Model\Logging\Listener
	 */
	private $_loggingListener;

	/**
	 * @param \Customweb\TwintCw\Model\Logging\Listener $loggingListener
	 */
	public function __construct(
			\Customweb\TwintCw\Model\Logging\Listener $loggingListener
	) {
		$this->_loggingListener = $loggingListener;
	}

	/**
	 * @param \Magento\Framework\App\Http $subject
	 */
	public function beforeLaunch(\Magento\Framework\App\Http $subject)
	{
		$this->registerTranslationResolver();
		$this->registerLoggingListener();
	}

	private function registerTranslationResolver()
	{
		\Customweb_I18n_Translation::getInstance()->addResolver(new \Customweb\TwintCw\Model\TranslationResolver());
	}

	private function registerLoggingListener()
	{
		\Customweb_Core_Logger_Factory::addListener($this->_loggingListener);
	}

}