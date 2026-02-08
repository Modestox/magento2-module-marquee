<?php
/**
 * Copyright © 2026 Modestox (https://github.com/modestox). All rights reserved.
 * License: MIT
 */

declare(strict_types=1);

namespace Modestox\Marquee\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Modestox\Marquee\Model\ResourceModel\Marquee\CollectionFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Stdlib\DateTime\DateTime;
use Magento\Framework\DataObject\IdentityInterface;

class Marquee extends Template implements IdentityInterface
{
    /**
     * @param Context $context
     * @param CollectionFactory $collectionFactory
     * @param StoreManagerInterface $storeManager
     * @param DateTime $dateTime
     * @param array $data
     */
    public function __construct(
        Context $context,
        private readonly CollectionFactory $collectionFactory,
        private readonly StoreManagerInterface $storeManager,
        private readonly DateTime $dateTime,
        array $data = [],
    ) {
        parent::__construct($context, $data);
    }

    /**
     * @return string[]
     */
    public function getIdentities(): array
    {
        $identities = [\Modestox\Marquee\Model\Marquee::CACHE_TAG];

        foreach ($this->getMarquees() as $item) {
            $identities = array_merge($identities, $item->getIdentities());
        }

        return $identities;
    }

    /**
     * @return \Modestox\Marquee\Model\ResourceModel\Marquee\Collection
     */
    public function getMarquees()
    {
        $currentStoreId = $this->storeManager->getStore()->getId();
        $currentTime = $this->dateTime->gmtDate(); // Magento хранит время в БД в UTC

        $collection = $this->collectionFactory->create();
        $collection->addFieldToFilter('is_active', 1);

        $collection->addFieldToFilter('store_id', [
            ['finset' => 0],
            ['finset' => $currentStoreId],
        ]);

        $collection->addFieldToFilter('start_time', ['lteq' => $currentTime]);
        $collection->addFilterToMap('end_time', 'main_table.end_time');
        $collection->getSelect()->where(
            "end_time >= ? OR end_time IS NULL",
            $currentTime,
        );

        $collection->setOrder('sort_order', \Magento\Framework\DB\Select::SQL_ASC);

        return $collection;
    }
}
