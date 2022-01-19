<?php

namespace Codilar\Vendor\Controller\Adminhtml\Index;

use Magento\Framework\App\Action\Action;
use Codilar\Vendor\Model\VendorFactory as ModelFactory;
use Codilar\Vendor\Model\ResourceModel\Vendor as ResourceModel;
use Magento\Framework\App\Action\Context;

class Save extends Action
{
    /**
     * @var ModelFactory
     */
    protected $modelFactory;

    /**
     * @var ResourceModel
     */
    protected $resourceModel;

    public function __construct(
        Context $context,
        ModelFactory $modelFactory,
        ResourceModel $resourceModel
    )
    {
        parent::__construct($context);
        $this->modelFactory = $modelFactory;
        $this->resourceModel = $resourceModel;
    }

    public function execute()
    {
        $data = $this->getRequest()->getParams();
        $emptyEmp = $this->modelFactory->create();
        if(!empty($data['entity_id'])){
            $this->resourceModel->load($emptyEmp,$data['entity_id']);
        }
        $emptyEmp->setIsActive($data['is_active'] ?? null);
        $emptyEmp->setVendorName($data['vendor_name'] ?? null);
        $emptyEmp->setDescription($data['description'] ?? null);
        $emptyEmp->setWebsite($data['website'] ?? null);
       
        $this->resourceModel->save($emptyEmp);
        $this->messageManager->addSuccessMessage(__('%1 saved successfully', $emptyEmp->getVendorName()));
        return $this->resultRedirectFactory->create()->setPath('*/*/index');
    }
}
