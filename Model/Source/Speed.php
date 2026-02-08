<?php
/**
 * Copyright © 2026 Modestox (https://github.com/modestox). All rights reserved.
 * License: MIT
 */

declare(strict_types=1);

namespace Modestox\Marquee\Model\Source;

use Magento\Framework\Data\OptionSourceInterface;

class Speed implements OptionSourceInterface
{
    public function toOptionArray(): array
    {
        return [
            ['value' => 'slow', 'label' => __('Slow')],
            ['value' => 'medium', 'label' => __('Medium')],
            ['value' => 'fast', 'label' => __('Fast')]
        ];
    }
}
