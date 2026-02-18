<?php
declare(strict_types=1);

namespace FoundationCommerce\RumvisionTracking\ViewModel;

use FoundationCommerce\RumvisionTracking\Model\Config;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class TrackingScript implements ArgumentInterface
{
    private Config $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    public function isEnabled(): bool
    {
        return $this->config->isEnabled() && !empty($this->config->getSiteId()) && $this->getSiteId() && $this->getDomainName();
    }

    public function getSiteId(): string
    {
        return $this->config->getSiteId();
    }

    public function getDomainName(): string
    {
        return $this->config->getDomainName();
    }
}
