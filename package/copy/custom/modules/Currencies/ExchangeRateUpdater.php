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

class ExchangeRateUpdater {

    /**
     * Retrieve system active currencies, except the one used by Sugar as
     * default.
     *
     * @return array of Currencies.
     */
    public static function getCurrencies()
    {
        $defaultIso4217 = SugarConfig::getInstance()->get('default_currency_iso4217');

        $bean = BeanFactory::getBean('Currencies');

        $currencies = $bean->get_full_list(
            sprintf("%s.name",
                $bean->table_name
            ),
            sprintf("%s.status LIKE 'Active' AND %s.iso4217 NOT LIKE '%s'",
                $bean->table_name,
                $bean->table_name,
                $defaultIso4217
            )
        );

        return $currencies;
    }

    /**
     * Retrieve latest exchange rates.
     *
     * @param array $settings
     *   Supported values are:
     *   <ul>
     *     <li>'appId' string with Open Exchange Rates APP Id.</li>
     *     <li>'secureConnection' bool, true if latest rates should be retrieves
     *   through a secure connection..</li>
     *     <li>'defaultIso4217' string, iso4217 value of the default currency
     *   used by Sugar.</li>
     *   </ul>
     *
     * @return array of iso4217 values as keys and latest rates as values, who
     * match the iso4217 values of $currencies.
     */
    public static function getLatestRates(array $settings)
    {
        $rates = new \OpenExchangeRates\Rates\Latest(
            $settings['appId'],
            $settings['secureConnection']
        );

        $rates->fetch();

        if ($settings['defaultIso4217'] === $rates->getBase()) {
            return $rates->getRates();
        }

        $latestRates = array();
        foreach ($rates->getRates() as $iso4217 => $rate) {
            $rate *= ($rates->getBaseRate() / $rates->getRateByIso4217($settings['defaultIso4217']));
            $latestRates[$iso4217] = $rate;
        }

        return $latestRates;
    }

    /**
     * Save supplied rates.
     *
     * @param $rates array of iso4217 values as keys and latest rates as values.
     */
    public static function saveLatestRates(array $rates)
    {
        foreach ($rates as $currencyId => $rate) {
            $currency = BeanFactory::getBean('Currencies')->retrieve($currencyId);
            $currency->conversion_rate = $rate;
            $currency->save();
        }
    }

}
