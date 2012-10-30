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

if (!isset($job_strings)) {
    $job_strings = array();
}

$job_strings[] = 'currenciesExchangeRateUpdater';

function currenciesExchangeRateUpdater() {
    LoggerManager::getLogger()->debug('[Currencies Exchange Rate Updater] Scheduler fired job responsible for updating Currencies Exchange Rates.');

    require_once 'custom/modules/Currencies/ExchangeRateUpdater.php';
    $currencies = ExchangeRateUpdater::getCurrencies();

    if (0 === count($currencies)) {
        LoggerManager::getLogger()->debug(
            '[Currencies Exchange Rate Updater] No active currencies found.'
        );

        return true;
    }

    try {
        $settings = array(
            'appId'            => SugarConfig::getInstance()->get('open-exchange-rates-lib.appId'),
            'secureConnection' => SugarConfig::getInstance()->get('open-exchange-rates-lib.secureConnection', false),
            'defaultIso4217'   => SugarConfig::getInstance()->get('default_currency_iso4217')
        );

        $rates = ExchangeRateUpdater::getLatestRates(
            $settings
        );

        foreach ($currencies as $currency) {
            if (!isset($rates[$currency->iso4217])) {
                LoggerManager::getLogger()->debug(
                    sprintf("[Currencies Exchange Rate Updater] Skipping currency with iso4217 '%s', which isn't supported by service.",
                        $currency->iso4217
                    )
                );

                continue;
            }

            $currency->conversion_rate = $rates[$currency->iso4217];
            $currency->save();
        }

        return true;

    } catch (Exception $e) {
        LoggerManager::getLogger()->fatal(
            sprintf("[Currencies Exchange Rate Updater] Failed to update currencies conversion rates due to: %s",
                $e->getMessage()
            )
        );

        return false;
    }
}
