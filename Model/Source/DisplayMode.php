<?php
/**
 * Copyright © 2026 Modestox (https://github.com/modestox). All rights reserved.
 * License: MIT
 */

declare(strict_types=1);

namespace Modestox\Marquee\Model\Source;

use Magento\Framework\Data\OptionSourceInterface;

class DisplayMode implements OptionSourceInterface
{
    public function toOptionArray(): array
    {
        return [
            ['value' => 'under_menu', 'label' => __('Under Main Menu')],
            ['value' => 'sticky_top', 'label' => __('Sticky Top')],
            ['value' => 'sticky_bottom', 'label' => __('Sticky Bottom')],
            ['value' => 'checkout_only', 'label' => __('Checkout Page Only')]
        ];
    }
}
