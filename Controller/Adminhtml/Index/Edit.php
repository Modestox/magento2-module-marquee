<?php
/**
 * Copyright © 2026 Modestox (https://github.com/modestox). All rights reserved.
 * License: MIT
 */

declare(strict_types=1);

namespace Modestox\Marquee\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Edit extends Action
{
    public function __construct(
        Context $context,
        private readonly PageFactory $resultPageFactory,
    ) {
        parent::__construct($context);
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Modestox_Marquee::list');
        $id = $this->getRequest()->getParam('entity_id');
        $resultPage->getConfig()->getTitle()->prepend($id ? __('Edit Marquee') : __('New Marquee'));
        return $resultPage;
    }
}
