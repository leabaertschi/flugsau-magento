<?php
namespace Flugsau\Shop\Block;

class Categories extends \Magento\Framework\View\Element\Template {
    protected $categoryHelper;
    protected $categoryCollectionFactory;
    protected $categoryFactory;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Catalog\Helper\Category $categoryHelper,
        \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory $categoryCollectionFactory,
        \Magento\Catalog\Model\CategoryFactory $categoryFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->categoryHelper = $categoryHelper;
        $this->categoryCollectionFactory = $categoryCollectionFactory;
        $this->categoryFactory = $categoryFactory;
    }

    public function getCategoryModel($id)
    {
         $_category = $this->categoryFactory->create();
            $_category->load($id);
            return $_category;
    }

    public function getCategoryCollection()
    {
        $collection = $this->categoryCollectionFactory->create()
                      ->addAttributeToFilter('level', array('eq' => 3))
                      ->addAttributeToSelect('*');
        return $collection;
    }
}
