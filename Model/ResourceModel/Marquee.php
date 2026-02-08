<?php
/**
 * Copyright © 2026 Modestox (https://github.com/modestox). All rights reserved.
 * License: MIT
 */

declare(strict_types=1);

namespace Modestox\Marquee\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Marquee extends AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init('modestox_marquee', 'entity_id');
    }
}
