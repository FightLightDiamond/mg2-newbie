<?php


namespace Casio\Contact\ViewModel;


use Magento\Contact\Helper\Data;

class UserDataProvider extends \Magento\Contact\ViewModel\UserDataProvider
{
    /**
     * @var Data
     */
    private $helper;

    /**
     * UserDataProvider constructor.
     * @param Data $helper
     */
    public function __construct(
        Data $helper
    ) {
        parent::__construct($helper);
        $this->helper = $helper;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->helper->getPostValue('title');
    }

    /**
     * Get first name
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->helper->getPostValue('first_name');
    }

    /**
     * Get last name
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->helper->getPostValue('last_name');
    }

    /**
     * Get confirmation email
     *
     * @return string
     */
    public function getConfirmationEmail()
    {
        return $this->helper->getPostValue('confirmation_email');
    }

    /**
     * Get confirmation email
     *
     * @return string
     */
    public function getAgreePolicy()
    {
        return $this->helper->getPostValue('agree_policy');
    }
}
