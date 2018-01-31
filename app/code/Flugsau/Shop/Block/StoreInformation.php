<?php
namespace Flugsau\Shop\Block;

class StoreInformation extends \Magento\Framework\View\Element\Template {
    protected $storeInfo;
    protected $storeManagerInterface;
    protected $storeInformationObject;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Store\Model\Information $storeInfo,
        \Magento\Store\Model\StoreManagerInterface $storeManagerInterface,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->storeInfo = $storeInfo;
        $this->storeManagerInterface = $storeManagerInterface;
        $this->storeInformationObject = $storeInfo->getStoreInformationObject($storeManagerInterface->getStore(null));
    }

    public function getPhoneNumber()
    {
        return $this->storeInformationObject->getPhone();
    }

    public function getAddress()
    {
        return "{$this->storeInformationObject->getName()}, "
        . "{$this->storeInformationObject->getData('street_line1')}, "
        . "{$this->storeInformationObject->getPostcode()} {$this->storeInformationObject->getCity()}, "
        . "{$this->storeInformationObject->getCountry()}";
    }

    public function getHours()
    {
        return $this->storeInformationObject->getHours();
    }
}
