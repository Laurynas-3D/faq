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
        $this->toolbar_title = "FAQ";

        $this->initOptions();
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
                    'type' => 'select',
                    'label' => $this->l('Shop'),
                    'name' => 'id_shop',
                    'options' => array(
                        'query' => Shop::getShops(false),
                        'id' => 'id_shop',
                        'name' => 'name',
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
            'shop_name' => array(
                'title' => $this->l('Shop'),
                'class' => 'fixed-width-sm',
                'orderby' => true,
            ),
            'question' => array(
                'title' => $this->l('Question'),
                'align' => 'center',
                'filter_key' => 'lfl.question',
                'class' => 'fixed-width-xxl',
                'orderby' => false,
                'search' => false,
            ),
            'answer' => array(
                'title' => $this->l('Answer'),
                'align' => 'center',
                'filter_key' => 'lfl.answer',
                'class' => 'fixed-width-xxxl',
                'orderby' => false,
                'search' => false,
            ),
        );

        $this->_select = 'lfl.question, lfl.answer, a.id_lfaq, s.name as shop_name';

        $this->_join = '
            JOIN `' . _DB_PREFIX_ . 'lfaq_lang` AS lfl
                ON (
                    lfl.`id_lfaq` = a.`id_lfaq` AND 
                    lfl.`id_lang` = "' . (int)$this->context->language->id . '" AND
                    lfl.`id_shop` = "' . (int)$this->context->shop->id . '"
                )
            JOIN `' . _DB_PREFIX_ . 'shop` AS s
                ON (lfl.`id_shop` = s.`id_shop`)
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

    private function initOptions()
    {
        $this->fields_options = array(
            'general' => array(
                'title' => $this->l('Settings'),
                'fields' => array(
                    'LFAQ_TITLE_ACTIVE' => array(
                        'title' => $this->l('Show FAQ Title'),
                        'type' => 'bool',
                    ),
                    'LFAQ_TITLE' => array(
                        'title' => $this->l('Show FAQ Title'),
                        'type' => 'textLang',
                        'class' => 'input fixed-width-md',
                    ),
                ),
                'submit' => array('title' => $this->l('Save')),
            ),
        );
    }

}
