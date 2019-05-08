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
 */

class Customweb_Twint_Stubs_Ch_Twint_Service_Merchant_V2_TWINTMerchantService extends Customweb_Soap_AbstractService {

	/**
	 * @var Customweb_Soap_IClient
	 */
	private $soapClient;
		
	/**
	 * @param Customweb_Twint_Stubs_Ch_Twint_Service_Merchant_Types_V2_RequestCheckInRequestElement $requestCheckInRequestElement
	 * @return Customweb_Twint_Stubs_Ch_Twint_Service_Merchant_Types_V2_RequestCheckInResponseElement
	 */ 
	public function requestCheckIn(Customweb_Twint_Stubs_Ch_Twint_Service_Merchant_Types_V2_RequestCheckInRequestElement $requestCheckInRequestElement){
		$data = func_get_args();
		if (count($data) > 0) {;
			$data = current($data);
		} else {;
			 throw new InvalidArgumentException();
		};
		$call = $this->createSoapCall("RequestCheckIn", $data, "Customweb_Twint_Stubs_Ch_Twint_Service_Merchant_Types_V2_RequestCheckInResponseElement", "RequestCheckIn");
		$call->setStyle(Customweb_Soap_ICall::STYLE_DOCUMENT);
		$call->setInputEncoding(Customweb_Soap_ICall::ENCODING_LITERAL);
		$call->setOutputEncoding(Customweb_Soap_ICall::ENCODING_LITERAL);
		$call->setSoapVersion(Customweb_Soap_ICall::SOAP_VERSION_11);
		$call->setLocationUrl($this->resolveLocation("http://service.twint.ch/merchant/v2"));
		$result = $this->getClient()->invokeOperation($call);
		return $result;
		
	}
		
	/**
	 * @param Customweb_Twint_Stubs_Ch_Twint_Service_Merchant_Types_V2_MonitorCheckInRequestElement $monitorCheckInRequestElement
	 * @return Customweb_Twint_Stubs_Ch_Twint_Service_Merchant_Types_V2_MonitorCheckInResponseElement
	 */ 
	public function monitorCheckIn(Customweb_Twint_Stubs_Ch_Twint_Service_Merchant_Types_V2_MonitorCheckInRequestElement $monitorCheckInRequestElement){
		$data = func_get_args();
		if (count($data) > 0) {;
			$data = current($data);
		} else {;
			 throw new InvalidArgumentException();
		};
		$call = $this->createSoapCall("MonitorCheckIn", $data, "Customweb_Twint_Stubs_Ch_Twint_Service_Merchant_Types_V2_MonitorCheckInResponseElement", "MonitorCheckIn");
		$call->setStyle(Customweb_Soap_ICall::STYLE_DOCUMENT);
		$call->setInputEncoding(Customweb_Soap_ICall::ENCODING_LITERAL);
		$call->setOutputEncoding(Customweb_Soap_ICall::ENCODING_LITERAL);
		$call->setSoapVersion(Customweb_Soap_ICall::SOAP_VERSION_11);
		$call->setLocationUrl($this->resolveLocation("http://service.twint.ch/merchant/v2"));
		$result = $this->getClient()->invokeOperation($call);
		return $result;
		
	}
		
	/**
	 * @param Customweb_Twint_Stubs_Ch_Twint_Service_Merchant_Types_V2_CancelCheckInRequestElement $cancelCheckInRequestElement
	 * @return Customweb_Twint_Stubs_Ch_Twint_Service_Merchant_Types_V2_CancelCheckInResponseElement
	 */ 
	public function cancelCheckIn(Customweb_Twint_Stubs_Ch_Twint_Service_Merchant_Types_V2_CancelCheckInRequestElement $cancelCheckInRequestElement){
		$data = func_get_args();
		if (count($data) > 0) {;
			$data = current($data);
		} else {;
			 throw new InvalidArgumentException();
		};
		$call = $this->createSoapCall("CancelCheckIn", $data, "Customweb_Twint_Stubs_Ch_Twint_Service_Merchant_Types_V2_CancelCheckInResponseElement", "CancelCheckIn");
		$call->setStyle(Customweb_Soap_ICall::STYLE_DOCUMENT);
		$call->setInputEncoding(Customweb_Soap_ICall::ENCODING_LITERAL);
		$call->setOutputEncoding(Customweb_Soap_ICall::ENCODING_LITERAL);
		$call->setSoapVersion(Customweb_Soap_ICall::SOAP_VERSION_11);
		$call->setLocationUrl($this->resolveLocation("http://service.twint.ch/merchant/v2"));
		$result = $this->getClient()->invokeOperation($call);
		return $result;
		
	}
		
	/**
	 * @param Customweb_Twint_Stubs_Ch_Twint_Service_Merchant_Types_V2_StartOrderRequestElement $startOrderRequestElement
	 * @return Customweb_Twint_Stubs_Ch_Twint_Service_Merchant_Types_V2_StartOrderResponseElement
	 */ 
	public function startOrder(Customweb_Twint_Stubs_Ch_Twint_Service_Merchant_Types_V2_StartOrderRequestElement $startOrderRequestElement){
		$data = func_get_args();
		if (count($data) > 0) {;
			$data = current($data);
		} else {;
			 throw new InvalidArgumentException();
		};
		$call = $this->createSoapCall("StartOrder", $data, "Customweb_Twint_Stubs_Ch_Twint_Service_Merchant_Types_V2_StartOrderResponseElement", "StartOrder");
		$call->setStyle(Customweb_Soap_ICall::STYLE_DOCUMENT);
		$call->setInputEncoding(Customweb_Soap_ICall::ENCODING_LITERAL);
		$call->setOutputEncoding(Customweb_Soap_ICall::ENCODING_LITERAL);
		$call->setSoapVersion(Customweb_Soap_ICall::SOAP_VERSION_11);
		$call->setLocationUrl($this->resolveLocation("http://service.twint.ch/merchant/v2"));
		$result = $this->getClient()->invokeOperation($call);
		return $result;
		
	}
		
	/**
	 * @param Customweb_Twint_Stubs_Ch_Twint_Service_Merchant_Types_V2_MonitorOrderRequestElement $monitorOrderRequestElement
	 * @return Customweb_Twint_Stubs_Ch_Twint_Service_Merchant_Types_V2_MonitorOrderResponseElement
	 */ 
	public function monitorOrder(Customweb_Twint_Stubs_Ch_Twint_Service_Merchant_Types_V2_MonitorOrderRequestElement $monitorOrderRequestElement){
		$data = func_get_args();
		if (count($data) > 0) {;
			$data = current($data);
		} else {;
			 throw new InvalidArgumentException();
		};
		$call = $this->createSoapCall("MonitorOrder", $data, "Customweb_Twint_Stubs_Ch_Twint_Service_Merchant_Types_V2_MonitorOrderResponseElement", "MonitorOrder");
		$call->setStyle(Customweb_Soap_ICall::STYLE_DOCUMENT);
		$call->setInputEncoding(Customweb_Soap_ICall::ENCODING_LITERAL);
		$call->setOutputEncoding(Customweb_Soap_ICall::ENCODING_LITERAL);
		$call->setSoapVersion(Customweb_Soap_ICall::SOAP_VERSION_11);
		$call->setLocationUrl($this->resolveLocation("http://service.twint.ch/merchant/v2"));
		$result = $this->getClient()->invokeOperation($call);
		return $result;
		
	}
		
	/**
	 * @param Customweb_Twint_Stubs_Ch_Twint_Service_Merchant_Types_V2_ConfirmOrderRequestElement $confirmOrderRequestElement
	 * @return Customweb_Twint_Stubs_Ch_Twint_Service_Merchant_Types_V2_ConfirmOrderResponseElement
	 */ 
	public function confirmOrder(Customweb_Twint_Stubs_Ch_Twint_Service_Merchant_Types_V2_ConfirmOrderRequestElement $confirmOrderRequestElement){
		$data = func_get_args();
		if (count($data) > 0) {;
			$data = current($data);
		} else {;
			 throw new InvalidArgumentException();
		};
		$call = $this->createSoapCall("ConfirmOrder", $data, "Customweb_Twint_Stubs_Ch_Twint_Service_Merchant_Types_V2_ConfirmOrderResponseElement", "ConfirmOrder");
		$call->setStyle(Customweb_Soap_ICall::STYLE_DOCUMENT);
		$call->setInputEncoding(Customweb_Soap_ICall::ENCODING_LITERAL);
		$call->setOutputEncoding(Customweb_Soap_ICall::ENCODING_LITERAL);
		$call->setSoapVersion(Customweb_Soap_ICall::SOAP_VERSION_11);
		$call->setLocationUrl($this->resolveLocation("http://service.twint.ch/merchant/v2"));
		$result = $this->getClient()->invokeOperation($call);
		return $result;
		
	}
		
	/**
	 * @param Customweb_Twint_Stubs_Ch_Twint_Service_Merchant_Types_V2_CancelOrderRequestElement $cancelOrderRequestElement
	 * @return Customweb_Twint_Stubs_Ch_Twint_Service_Merchant_Types_V2_CancelOrderResponseElement
	 */ 
	public function cancelOrder(Customweb_Twint_Stubs_Ch_Twint_Service_Merchant_Types_V2_CancelOrderRequestElement $cancelOrderRequestElement){
		$data = func_get_args();
		if (count($data) > 0) {;
			$data = current($data);
		} else {;
			 throw new InvalidArgumentException();
		};
		$call = $this->createSoapCall("CancelOrder", $data, "Customweb_Twint_Stubs_Ch_Twint_Service_Merchant_Types_V2_CancelOrderResponseElement", "CancelOrder");
		$call->setStyle(Customweb_Soap_ICall::STYLE_DOCUMENT);
		$call->setInputEncoding(Customweb_Soap_ICall::ENCODING_LITERAL);
		$call->setOutputEncoding(Customweb_Soap_ICall::ENCODING_LITERAL);
		$call->setSoapVersion(Customweb_Soap_ICall::SOAP_VERSION_11);
		$call->setLocationUrl($this->resolveLocation("http://service.twint.ch/merchant/v2"));
		$result = $this->getClient()->invokeOperation($call);
		return $result;
		
	}
		
	/**
	 * @param Customweb_Twint_Stubs_Ch_Twint_Service_Merchant_Types_V2_FindOrderRequestElement $findOrderRequestElement
	 * @return Customweb_Twint_Stubs_Ch_Twint_Service_Merchant_Types_V2_FindOrderResponseElement
	 */ 
	public function findOrder(Customweb_Twint_Stubs_Ch_Twint_Service_Merchant_Types_V2_FindOrderRequestElement $findOrderRequestElement){
		$data = func_get_args();
		if (count($data) > 0) {;
			$data = current($data);
		} else {;
			 throw new InvalidArgumentException();
		};
		$call = $this->createSoapCall("FindOrder", $data, "Customweb_Twint_Stubs_Ch_Twint_Service_Merchant_Types_V2_FindOrderResponseElement", "FindOrder");
		$call->setStyle(Customweb_Soap_ICall::STYLE_DOCUMENT);
		$call->setInputEncoding(Customweb_Soap_ICall::ENCODING_LITERAL);
		$call->setOutputEncoding(Customweb_Soap_ICall::ENCODING_LITERAL);
		$call->setSoapVersion(Customweb_Soap_ICall::SOAP_VERSION_11);
		$call->setLocationUrl($this->resolveLocation("http://service.twint.ch/merchant/v2"));
		$result = $this->getClient()->invokeOperation($call);
		return $result;
		
	}
		
	/**
	 * @param Customweb_Twint_Stubs_Ch_Twint_Service_Merchant_Types_V2_EnrollCashRegisterRequestElement $enrollCashRegisterRequestElement
	 * @return Customweb_Twint_Stubs_Ch_Twint_Service_Merchant_Types_V2_EnrollCashRegisterResponseElement
	 */ 
	public function enrollCashRegister(Customweb_Twint_Stubs_Ch_Twint_Service_Merchant_Types_V2_EnrollCashRegisterRequestElement $enrollCashRegisterRequestElement){
		$data = func_get_args();
		if (count($data) > 0) {;
			$data = current($data);
		} else {;
			 throw new InvalidArgumentException();
		};
		$call = $this->createSoapCall("EnrollCashRegister", $data, "Customweb_Twint_Stubs_Ch_Twint_Service_Merchant_Types_V2_EnrollCashRegisterResponseElement", "EnrollCashRegister");
		$call->setStyle(Customweb_Soap_ICall::STYLE_DOCUMENT);
		$call->setInputEncoding(Customweb_Soap_ICall::ENCODING_LITERAL);
		$call->setOutputEncoding(Customweb_Soap_ICall::ENCODING_LITERAL);
		$call->setSoapVersion(Customweb_Soap_ICall::SOAP_VERSION_11);
		$call->setLocationUrl($this->resolveLocation("http://service.twint.ch/merchant/v2"));
		$result = $this->getClient()->invokeOperation($call);
		return $result;
		
	}
		
	/**
	 * @param Customweb_Twint_Stubs_Ch_Twint_Service_Merchant_Types_V2_CheckSystemStatusRequestElement $checkSystemStatusRequestElement
	 * @return Customweb_Twint_Stubs_Ch_Twint_Service_Merchant_Types_V2_CheckSystemStatusResponseElement
	 */ 
	public function checkSystemStatus(Customweb_Twint_Stubs_Ch_Twint_Service_Merchant_Types_V2_CheckSystemStatusRequestElement $checkSystemStatusRequestElement){
		$data = func_get_args();
		if (count($data) > 0) {;
			$data = current($data);
		} else {;
			 throw new InvalidArgumentException();
		};
		$call = $this->createSoapCall("CheckSystemStatus", $data, "Customweb_Twint_Stubs_Ch_Twint_Service_Merchant_Types_V2_CheckSystemStatusResponseElement", "CheckSystemStatus");
		$call->setStyle(Customweb_Soap_ICall::STYLE_DOCUMENT);
		$call->setInputEncoding(Customweb_Soap_ICall::ENCODING_LITERAL);
		$call->setOutputEncoding(Customweb_Soap_ICall::ENCODING_LITERAL);
		$call->setSoapVersion(Customweb_Soap_ICall::SOAP_VERSION_11);
		$call->setLocationUrl($this->resolveLocation("http://service.twint.ch/merchant/v2"));
		$result = $this->getClient()->invokeOperation($call);
		return $result;
		
	}
		
	/**
	 * @param Customweb_Twint_Stubs_Ch_Twint_Service_Merchant_Types_V2_GetCertificateValidityRequestElement $getCertificateValidityRequestElement
	 * @return Customweb_Twint_Stubs_Ch_Twint_Service_Merchant_Types_V2_GetCertificateValidityResponseElement
	 */ 
	public function getCertificateValidity(Customweb_Twint_Stubs_Ch_Twint_Service_Merchant_Types_V2_GetCertificateValidityRequestElement $getCertificateValidityRequestElement){
		$data = func_get_args();
		if (count($data) > 0) {;
			$data = current($data);
		} else {;
			 throw new InvalidArgumentException();
		};
		$call = $this->createSoapCall("GetCertificateValidity", $data, "Customweb_Twint_Stubs_Ch_Twint_Service_Merchant_Types_V2_GetCertificateValidityResponseElement", "GetCertificateValidity");
		$call->setStyle(Customweb_Soap_ICall::STYLE_DOCUMENT);
		$call->setInputEncoding(Customweb_Soap_ICall::ENCODING_LITERAL);
		$call->setOutputEncoding(Customweb_Soap_ICall::ENCODING_LITERAL);
		$call->setSoapVersion(Customweb_Soap_ICall::SOAP_VERSION_11);
		$call->setLocationUrl($this->resolveLocation("http://service.twint.ch/merchant/v2"));
		$result = $this->getClient()->invokeOperation($call);
		return $result;
		
	}
		
	/**
	 * @param Customweb_Twint_Stubs_Ch_Twint_Service_Merchant_Types_V2_RenewCertificateRequestElement $renewCertificateRequestElement
	 * @return Customweb_Twint_Stubs_Ch_Twint_Service_Merchant_Types_V2_RenewCertificateResponseElement
	 */ 
	public function renewCertificate(Customweb_Twint_Stubs_Ch_Twint_Service_Merchant_Types_V2_RenewCertificateRequestElement $renewCertificateRequestElement){
		$data = func_get_args();
		if (count($data) > 0) {;
			$data = current($data);
		} else {;
			 throw new InvalidArgumentException();
		};
		$call = $this->createSoapCall("RenewCertificate", $data, "Customweb_Twint_Stubs_Ch_Twint_Service_Merchant_Types_V2_RenewCertificateResponseElement", "RenewCertificate");
		$call->setStyle(Customweb_Soap_ICall::STYLE_DOCUMENT);
		$call->setInputEncoding(Customweb_Soap_ICall::ENCODING_LITERAL);
		$call->setOutputEncoding(Customweb_Soap_ICall::ENCODING_LITERAL);
		$call->setSoapVersion(Customweb_Soap_ICall::SOAP_VERSION_11);
		$call->setLocationUrl($this->resolveLocation("http://service.twint.ch/merchant/v2"));
		$result = $this->getClient()->invokeOperation($call);
		return $result;
		
	}
	
}