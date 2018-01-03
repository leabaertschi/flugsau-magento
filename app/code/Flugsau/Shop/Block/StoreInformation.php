<?php
namespace Flugsau\Shop\Block;

class StoreInformation extends \Magento\Framework\View\Element\Template {
    protected $storeInfo;
    protected $storeManagerInterface;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Store\Model\Information $storeInfo,
        \Magento\Store\Model\StoreManagerInterface $storeManagerInterface,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->storeInfo = $storeInfo;
        $this->storeManagerInterface = $storeManagerInterface;
    }

    public function getPhoneNumber()
    {
        return $this->storeInfo->getStoreInformationObject($this->storeManagerInterface->getStore(null))->getPhone();
    }
}
