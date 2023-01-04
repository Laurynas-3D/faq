<?php

if (!defined('_PS_VERSION_')) {
    exit;
}

class Lfaq extends Module
{
    protected $config_form = false;

    const CONTROLLER_FAQ = 'AdminLFaq';

    private $hooks = array(
        'displayFrontCategoryFaq',
        'displayHome',
        'header'
    );

    public function __construct()
    {
        $this->name = 'lfaq';
        $this->tab = 'others';
        $this->version = '1.0.0';
        $this->author = 'Laurynas Mažuolis';
        $this->need_instance = 0;
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('FAQ');
        $this->description = $this->l('Display questions and answers block in the landing page');
        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);

        $this->loadFiles();
    }

    public function install()
    {
        include(dirname(__FILE__) . '/sql/install.php');

        if (!parent::install()) {
            $this->_errors[] = $this->l('Could not install module');

            return false;
        }

        if (!$this->registerModuleHooks()) {
            $this->_errors[] = $this->l('Could not register module hooks');

            return false;
        }

        $this->demoData();

        return true;
    }

    public function uninstall()
    {
        include(dirname(__FILE__) . '/sql/uninstall.php');

        if (!parent::uninstall()) {
            $this->_errors[] = $this->l('Could not uninstall module');

            return false;
        }

        return true;
    }

    private function registerModuleHooks()
    {
        if (empty($this->hooks)) {
            return true;
        }

        foreach ($this->hooks as $hook) {
            if (!$this->registerHook($hook)) {
                return false;
            }
        }

        return true;
    }

    public function getContent()
    {
        Tools::redirectAdmin($this->context->link->getAdminLink(self::CONTROLLER_FAQ));
    }

    public function hookHeader()
    {
        $this->context->controller->addCSS($this->_path . '/views/css/front.css');
        $this->context->controller->addJS($this->_path . '/views/js/front.js');
    }

    private function loadFiles()
    {
        require_once(dirname(__FILE__) . '/lfaq.conf.php');

        $classes = glob(_LFAQ_CLASSES_DIR_ . '*.php');

        foreach ($classes as $class) {
            if ($class != _LFAQ_CLASSES_DIR_ . 'index.php') {
                require_once($class);
            }
        }
    }

    public function hookDisplayHome($params)
    {

        $faqs = LfaqQuestion::getFaq();

        if (empty($faqs)) {
            return;
        }
        $this->context->smarty->assign(array(
            'faqs' => $faqs,
        ));

        return $this->display(__FILE__, 'displayFaq.tpl');
    }

    private function demoData()
    {
        $questions = array(
            array(
                'q' => 'Kokio dydžio yra visata?',
                'a' => 'Manoma, kad stebimos visatos skersmuo yra apie 93 milijardai šviesmečių, joje yra daugiau nei 100 
              milijardų galaktikų. Tačiau tikrasis Visatos dydis nežinomas ir gali būti begalinis.'
            ),
            array(
                'q' => 'Ar tiesa, kad mes naudojame tik 10% savo smegenų?',
                'a' => 'Nėra jokių mokslinių įrodymų, patvirtinančių mintį, kad mes naudojame tik 10% savo smegenų. 
                Tiesą sakant, smegenų skenavimas parodė, kad visos smegenys yra aktyvios ir atlieka įvairias funkcijas, 
                net kai mes ilsimės.'
            ),
        );

        foreach ($questions as $qa) {
            $qaObj = new LfaqQuestion();
            $qaObj->question = $qa['q'];
            $qaObj->answer = $qa['a'];
            $qaObj->active = true;

            $qaObj->save();
        }
    }
}
