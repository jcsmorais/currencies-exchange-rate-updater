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

$mod_strings['LNK_EXCHANGE_RATE_UPDATER'] = 'Currencies Exchange Rate Updater';

$mod_strings['LBL_LIST_CURRENT_RATE'] = 'Current Rate';
$mod_strings['LBL_LIST_LATEST_RATE'] = 'Latest Rate';

$mod_strings['LBL_EXCHANGE_RATE_UPDATER_LATEST_RATE_HAS_TO_BE_ABOVE_ZERO'] = 'Latest rate has to be above 0';
$mod_strings['LBL_EXCHANGE_RATE_UPDATER_NEEDS_AT_LEAST_ONE_LATEST_RATE'] = 'In order to proceed you need to define at least one latest rate.';
$mod_strings['LBL_EXCHANGE_RATE_UPDATER_IMPORT_LOADING'] = 'Importing exchange rates from external data source.';
$mod_strings['LBL_EXCHANGE_RATE_UPDATER_IMPORT_FAILURE'] = 'An error occurred while importing latest exchange rates, please review external data source settings and try again.';
$mod_strings['LBL_EXCHANGE_RATE_UPDATER_IMPORT_FAILURE_NO_MATCHING_ISO4217'] = "The external data source, doesn't have any currencies according to the ISO 4217 values registered in the system.";
$mod_strings['LBL_EXCHANGE_RATE_UPDATER_LATEST_RATE_HELP'] = "Latest rate values can be manually filled or imported from an external data source. In addition, only currencies with latest rate values above zero are updated, if some are left empty no changes are made.";
$mod_strings['LBL_EXCHANGE_RATE_UPDATER_NO_ACTIVE_CURRENCIES'] = 'Besides the base currency, there are no active currencies in the system.';

$mod_strings['LBL_EXCHANGE_RATE_UPDATER_IMPORT_BUTTON_KEY'] = 'I';
$mod_strings['LBL_EXCHANGE_RATE_UPDATER_IMPORT_BUTTON_LABEL'] = 'Import';
$mod_strings['LBL_EXCHANGE_RATE_UPDATER_IMPORT_BUTTON_TITLE'] = 'Import [Alt+I]';
$mod_strings['LBL_EXCHANGE_RATE_UPDATER_SAVE_BUTTON_KEY'] = 'S';
$mod_strings['LBL_EXCHANGE_RATE_UPDATER_SAVE_BUTTON_LABEL'] = 'Save';
$mod_strings['LBL_EXCHANGE_RATE_UPDATER_SAVE_BUTTON_TITLE'] = 'Save [Alt+S]';

$mod_strings['LBL_MESSAGEBOX_ALERT'] = 'Alert';
$mod_strings['LBL_MESSAGEBOX_LOADING'] = 'Loading...';
