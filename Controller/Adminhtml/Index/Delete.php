<?php
/**
 * Copyright © 2026 Modestox (https://github.com/modestox). All rights reserved.
 * License: MIT
 */

declare(strict_types=1);

namespace Modestox\Marquee\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Modestox\Marquee\Model\MarqueeFactory;

class Delete extends Action
{
    public function __construct(
        Context $context,
        private readonly MarqueeFactory $marqueeFactory
    ) {
        parent::__construct($context);
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('entity_id');
        if ($id) {
            try {
                $model = $this->marqueeFactory->create();
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccessMessage(__('Record deleted.'));
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            }
        }
        return $this->resultRedirectFactory->create()->setPath('*/*/');
    }
}
