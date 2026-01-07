<?php
namespace Flugsau\Shop\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Store\Model\StoreCookieManager;

class StoreCookieObserver implements ObserverInterface
{
    protected $request;
    protected $storeManager;
    protected $storeCookieManager;

    public function __construct(
        \Magento\Framework\App\Request\Http $request,
        StoreManagerInterface $storeManager,
        StoreCookieManager $storeCookieManager
    ) {
        $this->request = $request;
        $this->storeManager = $storeManager;
        $this->storeCookieManager = $storeCookieManager;
    }

    public function execute(Observer $observer)
    {
        // avoid interfering with POST switcher redirects
        if ($this->request->isPost()) {
            return;
        }

        $storeCode = $this->request->getParam('___store');
        if ($storeCode) {
            try {
                $store = $this->storeManager->getStore($storeCode);
                // Persist store cookie
                $this->storeCookieManager->setStoreCookie($store);
            } catch (\Magento\Framework\Exception\NoSuchEntityException $e) {
                // Invalid store code, ignore
            }
        }
    }
}
