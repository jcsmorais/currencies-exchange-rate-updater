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

$admin_option_defs = array();
$admin_option_defs['Administration']['ExchangeRateUpdater'] = array(
    'Currencies',
    'LBL_EXCHANGE_RATE_UPDATER_TITLE',
    'LBL_EXCHANGE_RATE_UPDATER_DESCRIPTION',
    'index.php?module=Currencies&action=ExchangeRateUpdaterView'
);

$admin_group_header[] = array(
    'LBL_EXCHANGE_RATE_UPDATER_HEADER',
    '',
    false,
    $admin_option_defs,
    'LBL_EXCHANGE_RATE_UPDATER_BODY'
);
