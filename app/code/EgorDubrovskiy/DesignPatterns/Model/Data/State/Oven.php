<?php

declare(strict_types=1);

namespace EgorDubrovskiy\DesignPatterns\Model\Data\State;

use EgorDubrovskiy\DesignPatterns\Model\Data\State\OvenState\OvenColdState;
use EgorDubrovskiy\DesignPatterns\Model\Data\State\OvenState\OvenHotState;
use EgorDubrovskiy\DesignPatterns\Model\Data\State\OvenState\OvenReadyToWorkState;
use Magento\Framework\Exception\LocalizedException;

class Oven
{
    public const STATE_KEY_COLD = 'cold';
    public const STATE_KEY_HOT = 'hot';
    public const STATE_KEY_READY_TO_WORK = 'ready_to_work';

    private array $states;

    private OvenStateInterface $currentState;

    public function __construct(
        OvenColdState $ovenColdState,
        OvenHotState $ovenHotState,
        OvenReadyToWorkState $ovenReadyToWorkState
    ) {
        $this->states = [
            self::STATE_KEY_COLD => $ovenColdState,
            self::STATE_KEY_HOT => $ovenHotState,
            self::STATE_KEY_READY_TO_WORK => $ovenReadyToWorkState,
        ];
        $this->currentState = $ovenReadyToWorkState;
    }

    /**
     * @param string $stateKey
     * @return Oven
     * @throws LocalizedException
     */
    public function setStateByKey(string $stateKey): Oven
    {
        if (!isset($this->states[$stateKey])) {
            throw new LocalizedException(__('State does not exists'));
        }

        $this->currentState = $this->states[$stateKey];

        return $this;
    }

    /**
     * @return $this
     * @throws LocalizedException
     */
    public function bake(): Oven
    {
        $this->currentState->bake();

        return $this;
    }
}
