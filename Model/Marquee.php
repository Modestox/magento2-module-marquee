<?php
/**
 * Copyright © 2026 Modestox (https://github.com/modestox). All rights reserved.
 * License: MIT
 */

declare(strict_types=1);

namespace Modestox\Marquee\Model;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\DataObject\IdentityInterface;

class Marquee extends AbstractModel implements IdentityInterface
{
    const CACHE_TAG = 'mdx_mq';

    protected $_cacheTag = self::CACHE_TAG;

    protected function _construct(): void
    {
        $this->_init(ResourceModel\Marquee::class);
    }

    public function getIdentities(): array
    {
        return [self::CACHE_TAG . '_' . $this->getId(), self::CACHE_TAG];
    }

    public function beforeSave()
    {
        foreach (['bg_color', 'text_color'] as $field) {
            $color = (string)$this->getData($field);
            if ($color) {
                $cleanColor = preg_replace('/[^#a-zA-Z0-9(),]/', '', $color);
                $this->setData($field, $cleanColor);
            }
        }

        $height = (string)$this->getData('height');
        if ($height) {
            $cleanHeight = preg_replace('/[^0-9a-zA-Z.%]/', '', $height);
            $this->setData('height', $cleanHeight);
        }

        return parent::beforeSave();
    }
}
