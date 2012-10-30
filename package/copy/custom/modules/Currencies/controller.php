<?php

/*
 * This file is part of the Currencies Exchange Rate Updater, a SugarCRM
 * package designed to ease the process of updating active currencies exchange
 * rates with the help of external data sources.
 *
 * Copyright (c) 2012 João Morais
 * http://github.com/jcsmorais/currencies-exchange-rate-updater
 *
 * For the full copyright and license information, please view the LICENSE.txt
 * file that was distributed with this source code.
 *
 * @license MIT
 *   See LICENSE.txt shipped with this package.
 */

require_once 'custom/modules/Currencies/ExchangeRateUpdater.php';

class CustomCurrenciesController extends SugarController
{

    public function preProcess()
    {
        global $current_user;
        $this->hasAccess = $current_user->isAdmin();
    }

    public function action_ExchangeRateUpdaterView()
    {
        $this->view = 'ExchangeRateUpdater';
    }

    public function action_GetLatestRates()
    {
        $this->view = 'ajax';

        try {
            $currencies = ExchangeRateUpdater::getCurrencies();
            if (0 === count($currencies)) {
                echo json_encode(array(
                    'success' => true,
                    'rates'   => array()
                ));
                return;
            }

            $settings = array(
                'appId'            => SugarConfig::getInstance()->get('open-exchange-rates-lib.appId'),
                'secureConnection' => SugarConfig::getInstance()->get('open-exchange-rates-lib.secureConnection', false),
                'defaultIso4217'   => SugarConfig::getInstance()->get('default_currency_iso4217')
            );

            $rates = ExchangeRateUpdater::getLatestRates(
                $settings
            );

            foreach ($rates as $iso4217 => $rate) {
                $rates[$iso4217] = format_number($rate, 10, 10);
            }

            echo json_encode(array(
                'success' => true,
                'rates'   => $rates
            ));
            return;

        } catch (Exception $e) {
            echo json_encode(array(
                'success'   => false,
                'errorCode' => $e->getCode(),
                'errorMsg'  => $e->getMessage()
            ));
            return;
        }
    }

    public function action_SaveLatestRates()
    {
        $this->view = 'ExchangeRateUpdater';

        try {
            $rates = !empty($_POST['latest_rate']) ? $_POST['latest_rate'] : array();

            foreach ($rates as $currencyId => $rate) {
                if (0 === strlen($rate)) {
                    unset($rates[$currencyId]);
                    continue;
                }

                $rates[$currencyId] = unformat_number($rate);
            }

            ExchangeRateUpdater::saveLatestRates($rates);

        } catch (Exception $e) {
            $this->errors = array($e->getMessage());
        }
    }

}
