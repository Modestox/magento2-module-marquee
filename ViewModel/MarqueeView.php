<?php
/**
 * Copyright © 2026 Modestox (https://github.com/modestox). All rights reserved.
 * License: MIT
 */

declare(strict_types=1);

namespace Modestox\Marquee\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Modestox\Marquee\Model\ResourceModel\Marquee\Collection;
use Modestox\Marquee\Model\ResourceModel\Marquee\CollectionFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Stdlib\DateTime\DateTime;
use Magento\Framework\DB\Select;

/**
 * ViewModel for providing marquee data to the frontend templates.
 */
class MarqueeView implements ArgumentInterface
{
    /**
     * @param CollectionFactory $collectionFactory
     * @param StoreManagerInterface $storeManager
     * @param DateTime $dateTime
     */
    public function __construct(
        private readonly CollectionFactory $collectionFactory,
        private readonly StoreManagerInterface $storeManager,
        private readonly DateTime $dateTime
    ) {}

    /**
     * Get list of active marquees sorted by position.
     *
     * @return Collection
     */
    public function getActiveMarquees(): Collection
    {
        $currentDate = $this->dateTime->gmtDate();
        $storeId = (int)$this->storeManager->getStore()->getId();

        /** @var Collection $collection */
        $collection = $this->collectionFactory->create();

        $collection->addFieldToFilter('is_active', 1);

        // Optimized store filter for comma-separated values (finset)
        $collection->addFieldToFilter('store_id', [
            ['finset' => 0], // All Store Views
            ['finset' => $storeId]
        ]);

        // Date range filtering
        $collection->addFieldToFilter('start_time', [
            ['lteq' => $currentDate],
            ['null' => true]
        ]);

        $collection->addFieldToFilter('end_time', [
            ['gteq' => $currentDate],
            ['null' => true]
        ]);

        // Sorting by our new sort_order field (numerical order)
        $collection->setOrder('sort_order', Select::SQL_ASC);

        return $collection;
    }
}
