<?php
/**
 * Copyright © 2026 Modestox (https://github.com/modestox). All rights reserved.
 * License: MIT
 */

declare(strict_types=1);

namespace Modestox\Marquee\Block\Adminhtml\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class DeleteButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * @return array
     */
    public function getButtonData(): array
    {
        $data = [];
        $id = $this->context->getRequest()->getParam('entity_id');

        if ($id) {
            $data = [
                'label'      => __('Delete Marquee'),
                'class'      => 'delete',
                'on_click'   => 'deleteConfirm(\'' . __(
                        'Are you sure you want to do this?',
                    ) . '\', \'' . $this->getDeleteUrl() . '\', {"data": {}})',
                'sort_order' => 20,
            ];
        }
        return $data;
    }

    /**
     * @return string
     */
    public function getDeleteUrl(): string
    {
        return $this->getUrl('*/*/delete', ['entity_id' => $this->context->getRequest()->getParam('entity_id')]);
    }
}
