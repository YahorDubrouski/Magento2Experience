<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Data\Singleton;

use Magento\Framework\Exception\LocalizedException;

class AdvertisingBanner
{
    public const BANNERS_LIMIT = 10;

    /**
     * @var AdvertisingBanner[]
     */
    private array $bannerInstances = [];

    private int $number;

    private AdvertisingBannerFactory $bannerFactory;

    public function __construct(
        AdvertisingBannerFactory $bannerFactory,
        int $number = 0
    ) {
        $this->bannerFactory = $bannerFactory;
        $this->number = $number;
    }

    /**
     * @return AdvertisingBanner
     * @throws LocalizedException
     */
    public function createBannerInstance(): AdvertisingBanner
    {
        if (count($this->bannerInstances) === self::BANNERS_LIMIT) {
            throw new LocalizedException(__('Banners limit has been reached'));
        }

        $banner = $this->bannerFactory->create(['number' => count($this->bannerInstances) + 1]);
        $this->bannerInstances[] = $banner;

        return $banner;
    }

    public function getCurrentBannerInstances(): array
    {
        return $this->bannerInstances;
    }

    public function getNumber(): int
    {
        return $this->number;
    }
}
