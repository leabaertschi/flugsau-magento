<?php
namespace Flugsau\Shop\Block;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Model\Category;

class ProductBanner extends \Magento\Framework\View\Element\Template
{
    /**
     * @var ProductRepositoryInterface
     */
    protected $productRepository;

    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;

    /**
     * @var \Magento\Catalog\Helper\Image
     */
    protected $imageHelper;

    /**
     * @param ProductRepositoryInterface|\Magento\Framework\Pricing\PriceCurrencyInterface $productRepository
     */
    public function __construct(
        \Magento\Catalog\Block\Product\Context $context,
        ProductRepositoryInterface $productRepository,
        \Magento\Catalog\Helper\Image $imageHelper,
        array $data = []
    ) {
        $this->productRepository = $productRepository;
        $this->imageHelper = $imageHelper;
        $this->_coreRegistry = $context->getRegistry();
        parent::__construct(
            $context,
            $data
        );
    }

    /**
     * Retrieve current product model
     *
     * @return \Magento\Catalog\Model\Product
     */
    public function getProduct()
    {
        if (!$this->_coreRegistry->registry('product') && $this->getProductId()) {
            $product = $this->productRepository->getById($this->getProductId());
            $this->_coreRegistry->register('product', $product);
        }
        return $this->_coreRegistry->registry('product');
    }

    /**
     * Check Product has URL
     *
     * @param \Magento\Catalog\Model\Product $product
     * @return bool
     */
    public function hasProductUrl($product)
    {
        if ($product->getVisibleInSiteVisibilities()) {
            return true;
        }
        if ($product->hasUrlDataObject()) {
            if (in_array($product->hasUrlDataObject()->getVisibility(), $product->getVisibleInSiteVisibilities())) {
                return true;
            }
        }

        return false;
    }

    /**
     * Retrieve Product URL using UrlDataObject
     *
     * @param \Magento\Catalog\Model\Product $product
     * @param array $additional the route params
     * @return string
     */
    public function getProductUrl($product, $additional = [])
    {
        if ($this->hasProductUrl($product)) {
            if (!isset($additional['_escape'])) {
                $additional['_escape'] = true;
            }
            return $product->getUrlModel()->getUrl($product, $additional);
        }

        return '#';
    }

    /**
     * @param \Magento\Catalog\Model\Product $product
     * return string
     */
    public function getImageUrl($product) {
        $image_url = $this->imageHelper->init($product, 'product_base_image')->getUrl();
        return $image_url;
    }
}
