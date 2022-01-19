<?php

namespace Codilar\Vendor\Block;

use Magento\Framework\View\Element\Template;

class Vendor extends Template
{
    /**
     * @var \Magento\Catalog\Model\ProductFactory
     */
    protected $productFactory;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Catalog\Model\ProductFactory $productFactory,
        array $data = []
    ) {
        $this->productFactory = $productFactory;
        parent::__construct($context, $data);
    }
    public function getVendorName()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();

        $productBlock = $objectManager->create('\Magento\Catalog\Block\Product\View\AbstractView');
        $product = $productBlock->getProduct();
        $value =$product->getResource()->getAttribute('vendor')->getFrontend()->getValue($product);
        return $value;
  
    }
    public function getAttrOptIdByLabel()
    {
        $attrCode='vendor';
        $optLabel=$this->getVendorname();
        $product = $this->productFactory->create();
        $isAttrExist = $product->getResource()->getAttribute($attrCode); // Add here your attribute code
        $optId = '';
        if ($isAttrExist && $isAttrExist->usesSource()) {
            $optId = $isAttrExist->getSource()->getOptionId($optLabel);
        }
        return $optId;
    }

    public function getVendorUrl()
    {
    
        return $this->getUrl('vendor/vendor/index');
  
    }
}
