<?php
namespace Flugsau\Shop\Setup;

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * @codeCoverageIgnore
 */
class UpgradeData implements UpgradeDataInterface
{
    /**
     * @var \Magento\Cms\Model\PageFactory
     */
    protected $_pageFactory;

    /**
     * Construct
     *
     * @param \Magento\Cms\Model\PageFactory $pageFactory
     */
    public function __construct(
        \Magento\Cms\Model\PageFactory $pageFactory
    ) {
        $this->_pageFactory = $pageFactory;
    }

    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '1.0.1') < 0) {

            $layoutXml = <<<XML
<referenceContainer name="page.top">
    <block class="Magento\Framework\View\Element\Template" name="home_cover" template="Flugsau_Shop::html/home_cover.phtml" before="-" />
</referenceContainer>
XML;

            $page = $this->_pageFactory->create();
            $page->setTitle('Flugsau Home')
                ->setIdentifier('flugsau-home-page')
                ->setIsActive(true)
                ->setPageLayout('1column')
                ->setStores(array(0))
                ->setLayoutUpdateXml($layoutXml)
                ->save();
        }

        $setup->endSetup();
    }
}
