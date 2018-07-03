<?php

class OuterEdge_ConfigProductReport_Block_Adminhtml_Configproductreport_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    /**
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getResourceModel('catalog/product_collection')
            ->addAttributeToFilter('type_id', array('eq' => 'configurable'))
            ->addAttributeToSelect('name');
        $collection->getSelect()->join(array('relation' => 'catalog_product_relation'), 'relation.parent_id = entity_id');
        $this->setCollection($collection);
        $this->getCollection()->getSelect()->group('entity_id');

        return parent::_prepareCollection();
    }

    /**
     * @return $this
     * @throws Exception
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'id',
            array(
                'header' => Mage::helper('configproductreport')->__('ID'),
                'sortable' => false,
                'width' => '60px',
                'index' => 'entity_id',
            )
        );
        $this->addColumn(
            'sku',
            array(
                'header' => Mage::helper('configproductreport')->__('Sku'),
                'width' => '200px',
                'sortable' => false,
                'index' => 'sku',
            )
        );
        $this->addColumn(
            'name',
            array(
                'header' => Mage::helper('configproductreport')->__('Name'),
                'index' => 'name',
                'sortable' => false,
            )
        );
        $this->addColumn('action',
            array(
                'header' => Mage::helper('configproductreport')->__('Action'),
                'width' => '50px',
                'type' => 'action',
                'getter' => 'getId',
                'actions' => array(
                    array(
                        'caption' => Mage::helper('configproductreport')->__('Edit'),
                        'url' => array(
                            'base' => '*/catalog_product/edit',
                            'params' => array('store' => $this->getRequest()->getParam('store'))
                        ),
                        'field' => 'id'
                    )
                ),
                'filter' => false,
                'sortable' => false,
                'index' => 'stores',
                'is_system' => true,
            ));

        $this->addExportType('*/*/exportCsv', Mage::helper('configproductreport')->__('CSV'));
        $this->addExportType('*/*/exportXml', Mage::helper('configproductreport')->__('Excel XML'));

        return parent::_prepareColumns();
    }
}