<?php

require_once 'custom/modules/Currencies/ExchangeRateUpdater.php';

class CurrenciesViewExchangeRateUpdater extends SugarView
{

    protected $_template = 'custom/modules/Currencies/tpls/ExchangeRateUpdater.tpl';

    protected function _processCurrencies()
    {
        $currencies = ExchangeRateUpdater::getCurrencies();
        $this->ss->assign('currencies', $currencies);
    }

    protected function _processJavascriptDependencies()
    {
        static $dependencies = array(
            'cache/include/javascript/sugar_grp_yui_widgets.js',
            'custom/modules/Currencies/javascript/Currencies.js',
            'custom/modules/Currencies/javascript/ExchangeRateUpdater.js'
        );
        foreach ($dependencies as $dependency) {
            echo sprintf(
                '<script type="text/javascript" src="%s"></script>',
                $dependency
            );
        }
    }

    public function preDisplay()
    {
        $this->_processJavascriptDependencies();
        $this->_processCurrencies();
    }

    public function display()
    {
        echo $this->ss->fetch($this->_template);
    }

}
