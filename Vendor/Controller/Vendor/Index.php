<?php

namespace Codilar\Vendor\Controller\Vendor;


use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\View\Result\PageFactory;
use Codilar\Vendor\Helper\Data;


class Index extends Action
{
    /**
     * @var PageFactory
     */
    protected $pageFactory;

    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        Data $enableData
    )
    {
        parent::__construct($context);
        $this->pageFactory = $pageFactory;
        $this->enableData=$enableData;
    }

    public function execute()
    {
        if($this->enableData->isEnable()){
            return $this->pageFactory->create();
        }
        else{
            return $this->resultRedirectFactory->create()->setPath('cms/noroute/index');
        }
    }


}
