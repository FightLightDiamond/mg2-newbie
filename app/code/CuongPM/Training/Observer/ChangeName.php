<?php


namespace CuongPM\Training\Observer;

use Magento\Framework\Event\Observer;

class ChangeName implements \Magento\Framework\Event\ObserverInterface
{
    public function execute(Observer $observer)
    {
        $data = $observer->getData('name');
        $data->setData('name', '(Event - Observer)');
        $observer->setData('name', $data);
    }
}
