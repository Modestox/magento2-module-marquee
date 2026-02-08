<?php
/**
 * Copyright © 2026 Modestox (https://github.com/modestox). All rights reserved.
 * License: MIT
 */

declare(strict_types=1);

namespace Modestox\Marquee\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\App\Cache\TypeListInterface;
use Modestox\Marquee\Model\Marquee;

class CleanMarqueeCache implements ObserverInterface
{
    public function __construct(
        private readonly TypeListInterface $cacheTypeList
    ) {}

    public function execute(Observer $observer): void
    {
        $this->cacheTypeList->cleanType('full_page');
    }
}
