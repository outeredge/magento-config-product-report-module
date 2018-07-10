<?php

class OuterEdge_ConfigProductReport_Block_Adminhtml_Configproductreport extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    /**
     * OuterEdge_ConfigProductReport_Block_Adminhtml_Configproductreport constructor.
     */
    public function __construct()
    {
        $this->_blockGroup = 'configproductreport';
        $this->_controller = 'adminhtml_configproductreport';
        $this->_headerText = Mage::helper('configproductreport')->__('Config product report: config products without any associated product.');
        parent::__construct();
        $this->_removeButton('add');
    }

    /**
     * @return Mage_Core_Block_Abstract
     */
    protected function _prepareLayout()
    {
        $this->setChild('store_switcher',
            $this->getLayout()->createBlock('adminhtml/store_switcher')
                ->setUseConfirm(false)
                ->setSwitchUrl($this->getUrl('*/*/*', array('store' => null)))
                ->setTemplate('report/store/switcher.phtml')
        );
        return parent::_prepareLayout();
    }

    /**
     * Geting store switcher html.
     *
     * @return string
     */
    public function getStoreSwitcherHtml()
    {
        if (!Mage::app()->isSingleStoreMode()) {
            return $this->getChildHtml('store_switcher');
        }
        return '';
    }

    /**
     * @return string
     */
    public function getGridHtml()
    {
        return $this->getStoreSwitcherHtml() . parent::getGridHtml();
    }
}