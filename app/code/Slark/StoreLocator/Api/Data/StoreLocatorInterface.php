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
    const IMAGE = "image";
    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param string $name
     */
    public function setName(string $name): StoreLocatorInterface;
    /**
     * @return string
     */
    public function getDesc(): string;

    /**
     * @param string $desc
     */
    public function setDesc(string $desc): StoreLocatorInterface;
    /**
     * @return string
     */
    public function getAddres(): string;

    /**
     * @param string $addres
     */
    public function setAddres(string $addres): StoreLocatorInterface;
    /**
     * @return string
     */
    public function getWork(): string;

    /**
     * @param string $work
     */
    public function setWork(string $work): StoreLocatorInterface;
    /**
     * @return string
     */
    public function getLongi(): string;

    /**
     * @param string $longi
     */
    public function setLongi(string $longi): StoreLocatorInterface;
    /**
     * @return string
     */
    public function getLati(): string;

    /**
     * @param string $lati
     */
    public function setLati(string $lati): StoreLocatorInterface;

    public function getImage(): string;
    /**
     * @return string $image
     */
    public function setImage(string $image) : StoreLocatorInterface;

    /**
     * @return string
     */
}
