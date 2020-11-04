<?php


namespace Casio\Contact\Block;


class ContactForm extends \Magento\Contact\Block\ContactForm
{
    /**
     * Returns action url for contact form
     *
     * @return string
     */
    public function getFormAction()
    {
        return $this->getUrl('casio_contact/index/post', ['_secure' => true]);
    }
}
