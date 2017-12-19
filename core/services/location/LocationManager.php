<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 18.12.17
 * Time: 10:56
 */

namespace core\services\location;


use core\readModels\WarehouseReadRepository;
use core\services\location\storage\StorageInterface;
use Yii;
//TODO need to do over this class
class LocationManager
{
    public $warehouseId;

    private $warehouses;
    private $storage;

    public function __construct(StorageInterface $storage)
    {
        $this->warehouses = new WarehouseReadRepository();
        $this->storage = $storage;

        $this->run();
    }

    public function run()
    {
        //TODO need created auto calculate user location from his IP
        $this->setDefaultWarehouse();
    }

    public function setDefaultWarehouse()
    {
        $warehouse = $this->warehouses->findDefault();

        $this->storage->save('warehouseId', $warehouse->id);
        $this->warehouseId = $warehouse->id;
    }

    public function getWarehouseId()
    {
        return $this->storage->load('warehouseId');
    }

}