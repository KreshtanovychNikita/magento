<?php

namespace Mykyta\DataList\Api\Data;

interface DataListInterface
{
    const ID = 'entity_id';
    const TYPE = 'type';

    /**
     * @return string
     */
    public function getType(): string;

    /**
     * @param string $type
     */
    public function setType(string $type): void;
}
