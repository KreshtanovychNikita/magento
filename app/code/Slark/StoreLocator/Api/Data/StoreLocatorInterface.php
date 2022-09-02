<?php

namespace Slark\StoreLocator\Api\Data;

interface StoreLocatorInterface
{
    const ID = 'store_id';
    const NAME = 'store_name';
    const DESC = 'description_store';
    const ADDRES = 'addres_store';
    const WORK = 'work_schedule';
    const LONGI = 'longitude';
    const LATI = 'latitude';
    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param string $name
     */
    public function setName(string $name): void;
    /**
     * @return string
     */
    public function getDesc(): string;

    /**
     * @param string $desc
     */
    public function setDesc(string $desc): void;
    /**
     * @return string
     */
    public function getAddres(): string;

    /**
     * @param string $addres
     */
    public function setAddres(string $addres): void;
    /**
     * @return string
     */
    public function getWork(): string;

    /**
     * @param string $work
     */
    public function setWork(string $work): void;
    /**
     * @return string
     */
    public function getLongi(): string;

    /**
     * @param string $longi
     */
    public function setLongi(string $longi): void;
    /**
     * @return string
     */
    public function getLati(): string;

    /**
     * @param string $lati
     */
    public function setLati(string $lati): void;
}
