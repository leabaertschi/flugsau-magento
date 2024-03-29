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
*/

/**
 * @XmlType(name="string", namespace="http://www.w3.org/2001/XMLSchema")
 */ 
class Customweb_Twint_Stubs_Org_W3_XMLSchema_String implements Customweb_Xml_ISimpleType {
	
	/**
	 * @XmlTransient
	 * @var string
	 */
	private $__value = null;
	
	public function __construct() {
	}
	
	/**
	 * @return Customweb_Twint_Stubs_Org_W3_XMLSchema_String
	 */
	public static function _() {
		$i = new Customweb_Twint_Stubs_Org_W3_XMLSchema_String();
		return $i;
	}
	/**
	 * @return Customweb_Twint_Stubs_Org_W3_XMLSchema_String
	 */
	public function set($value) {
		$this->__value = $value;
		return $this;
	}
	/**
	 * @return string
	 */
	public function get() {
		return $this->__value;
	}
	public function __toString() {
		return (string)$this->__value;
	}
	
}