<?php

namespace Slark\StoreLocator\Api;

interface LocatorInterface
{
    /**
     * @param string $address
     * @return mixed
     */
    public function getCord(string $address);
}
