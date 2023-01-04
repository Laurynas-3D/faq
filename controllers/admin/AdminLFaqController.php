<?php

class AdminLFaqController extends ModuleAdminController
{
    public $bootstrap = true;

    public function __construct()
    {
        $this->className = 'LfaqQuestion';
        $this->table = 'lfaq';
        $this->identifier = 'id_lfaq';

        parent::__construct();
        $this->initList();
    }

    public function initContent()
    {
        if (in_array($this->display, array('edit', 'add'))) {
            $this->initForm();
        }

        parent::initContent();
    }

    private function initForm()
    {

        $this->fields_form = array(
            'legend' => array(
                'title' => $this->l('Landing Page FAQ'),
                'icon' => 'icon-edit',
            ),
            'input' => array(
                array(
                    'type' => 'switch',
                    'label' => $this->l('Active'),
                    'name' => 'active',
                    'values' => array(
                        array(
                            'id' => 'type_switch_on',
                            'value' => 1,
                        ),
                        array(
                            'id' => 'type_switch_off',
                            'value' => 0,
                        ),
                    ),
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Question'),
                    'name' => 'question',
                    'lang' => true,
                    'required' => true,
                ),
                array(
                    'type' => 'textarea',
                    'label' => $this->l('Answer'),
                    'name' => 'answer',
                    'rows' => 10,
                    'cols' => 62,
                    'class' => 'rte',
                    'autoload_rte' => true,
                    'required' => true,
                    'lang' => true,
                    'desc' => $this->l('Enter answer')
                ),
            ),
            'submit' => array(
                'title' => $this->l('Save')
            )
        );

    }

    private function initList()
    {
        $this->fields_list = array(
            'id_lfaq' => array(
                'title' => $this->l('ID'),
                'filter_key' => 'a!id_lfaq',
                'class' => 'fixed-width-sm',
                'align' => 'center'
            ),
            'active' => array(
                'title' => $this->l('Active'),
                'align' => 'center',
                'active' => 'status',
                'type' => 'bool',
                'class' => 'fixed-width-sm',
                'orderby' => false,
            ),
            'question' => array(
                'title' => $this->l('Question'),
                'align' => 'center',
                'filter_key' => 'lfl.question',
                'class' => 'fixed-width-m',
                'orderby' => false,
            ),
            'answer' => array(
                'title' => $this->l('Answer'),
                'align' => 'center',
                'filter_key' => 'lfl.answer',
                'class' => 'fixed-width-m',
                'orderby' => false,
            ),
        );

        $this->_select = 'lfl.question, lfl.answer, a.id_lfaq';

        $this->_join = '
            JOIN `' . _DB_PREFIX_ . 'lfaq_lang` AS lfl
                ON (
                    lfl.`id_lfaq` = a.`id_lfaq` AND 
                    lfl.`id_lang` = "' . (int)$this->context->language->id . '" AND
                    lfl.`id_shop` = "' . (int)$this->context->shop->id . '"
                )
            ';

        $this->actions = array('edit', 'delete');

        $this->bulk_actions = array(
            'delete' => array(
                'text' => $this->l('Delete selected'),
                'icon' => 'icon-trash',
                'confirm' => $this->l('Delete selected items?')
            )
        );
    }
}
