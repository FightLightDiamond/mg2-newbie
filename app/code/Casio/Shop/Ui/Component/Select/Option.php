<?php


namespace Casio\Shop\Ui\Component\Select;

use Magento\Framework\Option\ArrayInterface;

class Option implements ArrayInterface
{
    public function toOptionArray()
    {
        $result = [];
        foreach ($this->getOptions() as $value => $label) {
            $result[] = [
                'value' => $value,
                'label' => $label,
            ];
        }

        return $result;
    }

    public function getOptions()
    {
        return [

        ];
    }
}
