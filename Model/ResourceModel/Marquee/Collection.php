<?php
/**
 * Copyright © 2026 Modestox (https://github.com/modestox). All rights reserved.
 * License: MIT
 */

declare(strict_types=1);

namespace Modestox\Marquee\Model\ResourceModel\Marquee;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Modestox\Marquee\Model\Marquee as Model;
use Modestox\Marquee\Model\ResourceModel\Marquee as ResourceModel;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'entity_id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
