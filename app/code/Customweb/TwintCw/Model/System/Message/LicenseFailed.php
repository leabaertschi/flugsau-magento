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

namespace Customweb\TwintCw\Model\System\Message;

class LicenseFailed implements \Magento\Framework\Notification\MessageInterface
{
	/**
	 * Retrieve unique message identity
     *
     * @return string
     */
    public function getIdentity()
    {
        return md5('twintcw-license');
    }

    /**
     * Check whether
     *
     * @return bool
     */
        public function isDisplayed()
    {
		
		$arguments = null;
		return \Customweb_Licensing_TwintCw_License::run('rlk8vr7b01iln85o', $this, $arguments);
	}

	final public function call_b2o9t4gdpcrttr3i() {
		$arguments = func_get_args();
		$method = $arguments[0];
		$call = $arguments[1];
		$parameters = array_slice($arguments, 2);
		if ($call == 's') {
			return call_user_func_array(array(get_class($this), $method), $parameters);
		}
		else {
			return call_user_func_array(array($this, $method), $parameters);
		}
		
		
	}

    /**
     * Retrieve message text
     *
     * @return string
     */
        public function getText()
    {
		
		$arguments = null;
		return \Customweb_Licensing_TwintCw_License::run('mc8lfmussscptqqe', $this, $arguments);
	}

	final public function call_ot2sokdlr3ms4o41() {
		$arguments = func_get_args();
		$method = $arguments[0];
		$call = $arguments[1];
		$parameters = array_slice($arguments, 2);
		if ($call == 's') {
			return call_user_func_array(array(get_class($this), $method), $parameters);
		}
		else {
			return call_user_func_array(array($this, $method), $parameters);
		}
		
		
	}

    /**
     * Retrieve message severity
     *
     * @return int
     */
    public function getSeverity()
    {
        return \Magento\Framework\Notification\MessageInterface::SEVERITY_CRITICAL;
    }
}
####licenseEncrypt####