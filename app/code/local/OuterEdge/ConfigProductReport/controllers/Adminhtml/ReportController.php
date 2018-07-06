<?php

class OuterEdge_ConfigProductReport_Adminhtml_ReportController extends Mage_Adminhtml_Controller_Action
{
    /**
     * This is to check the controller is authorises for logged in user.
     * @return bool
     */
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('report/products/configproductreport');
    }

    /**
     * Initialize the controller.
     * @return $this
     */
    protected function _initAction()
    {
        $this->loadLayout()
            ->_title($this->__('Outeredge'))
            ->_title($this->__('Configurable products without any associated products'))
            ->_setActiveMenu('Outeredge');
        return $this;
    }

    /**
     * Landing controller.
     *
     */
    public function configAction()
    {
        $this->_initAction()
            ->_addContent($this->getLayout()->createBlock('configproductreport/adminhtml_configproductreport'))
            ->renderLayout();
    }

    /**
     * Downloding the grid content in csv format.
     */
    public function exportCsvAction()
    {
        $fileName = 'configproductreport.csv';
        $content = $this->getLayout()->createBlock('configproductreport/adminhtml_configproductreport_grid')
            ->getCsv();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    /**
     * Downloding the grid content in Xml format.
     */
    public function exportXmlAction()
    {
        $fileName = 'configproductreport.xml';
        $content = $this->getLayout()->createBlock('configproductreport/adminhtml_configproductreport_grid')
            ->getXml();
        $this->_prepareDownloadResponse($fileName, $content);
    }
}