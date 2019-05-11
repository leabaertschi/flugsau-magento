<?php

namespace Flugsau\Shop\BannerSlider;

use Magento\Framework\View\Asset\Repository;
use Mageplaza\BannerSlider\Helper\Data;

class BannerTemplate extends \Mageplaza\BannerSlider\Model\Config\Source\Template {

    const PRODUCT = 'product.jpg';

    /**
     * @var Repository
     */
    private $_assetRepo;

    /**
     * Template constructor.
     * @param Repository $assetRepo
     */
    public function __construct(Repository $assetRepo)
    {
        $this->_assetRepo = $assetRepo;
    }

    /**
     * Retrieve option array with empty value
     *
     * @return string[]
     */
    public function toOptionArray()
    {
        $options = [
            [
                'value' => self::PRODUCT,
                'label' => 'Produkt Template'
            ]
        ];

        return $options;
    }

    /**
     * @return false|string
     */
    public function getTemplateHtml()
    {
        $templates = [
            self::PRODUCT => [
                'tpl' => <<<HTML
<div class="banner-product">
    {{block class="Magento\Catalog\Block\Product\View" product_id="124" template="Flugsau_Shop::html/product_banner.phtml"}}
</div>
HTML
            ,
                'var' => '{{imgName}}'
            ],
        ];

        return Data::jsonEncode($templates);
    }

    /**
     * @return false|string
     */
    public function getImageUrls()
    {
        $urls = [];
        foreach ($this->toOptionArray() as $template) {
            $urls[$template['value']] = $this->_assetRepo->getUrl('Flugsau_Shop::images/' . $template['value']);
        }

        return Data::jsonEncode($urls);
    }
}
