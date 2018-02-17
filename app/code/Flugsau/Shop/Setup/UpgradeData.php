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
    <block class="Flugsau\Shop\Block\Categories" name="category_tiles" template="Flugsau_Shop::html/category_tiles.phtml" />
    <block class="Magento\Framework\View\Element\Template" name="home_teaser" template="Flugsau_Shop::html/home_teaser.phtml" />
    <block class="Smartwave\Porto\Block\Template" name="home_instagram" template="Flugsau_Shop::html/instagramphotos.phtml">
        <arguments>
            <argument name="padding_item" xsi:type="string">15px</argument>
        </arguments>
    </block>
    <block class="Magefan\Blog\Block\Widget\Recent">
        <arguments>
            <argument name="title" xsi:type="string">News</argument>
            <argument name="number_of_posts" xsi:type="number">2</argument>
            <argument name="category_id" xsi:type="number">0</argument>
            <argument name="custom_template" xsi:type="string">Flugsau_Shop::html/home_news.phtml</argument>
        </arguments>
    </block>
    <referenceBlock name="main.content" remove="true" />
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
