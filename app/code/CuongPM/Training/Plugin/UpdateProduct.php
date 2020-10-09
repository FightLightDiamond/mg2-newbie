<?php


namespace CuongPM\Training\Plugin;

use Magento\Framework\Event\ManagerInterface as EventManager;

class UpdateProduct
{
    /**
     * @var EventManager
     */
    private $eventManager;

    /*
     * @param \Magento\Framework\Event\ManagerInterface as EventManager
     */
    public function __construct(EventManager $eventManager)
    {
        $this->eventManager = $eventManager;
    }

    public function beforeGetPrice(\Magento\Catalog\Model\Product $subject)
    {
        $price = [$subject->getPriceModel()->getPrice($subject) * 2];

        return $price;
    }

    public function aroundGetPrice(\Magento\Catalog\Model\Product $subject, callable $proceed)
    {
        return 20000;
    }

    public function afterGetName(\Magento\Catalog\Model\Product $subject, $result)
    {
        $result .= " (Plugin)";
//        $this->eventManager->dispatch("cuongpm_training_before_save", ['name' => $result]);
        return $result;
    }
}
