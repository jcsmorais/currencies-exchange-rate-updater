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

global $manifest;
global $installdefs;

$manifest = array(
    'acceptable_sugar_flavors' => array(
        'CE',
        'PRO',
        'CORP',
        'ENT',
        'ULT'
    ),
    'acceptable_sugar_versions' => array(
        'regex_matches' => array(
            '6\.[3-9]\.[0-9]'
        )
    ),
    'author' => 'João Morais',
    'description' => 'Currencies Exchange Rate Updater is a SugarCRM package designed to ease the process of updating active currencies exchange rates with the help of external data sources.',
    'dependencies' => array(
        array(
            'id_name' => 'oer',
            'version' => '0.0.1'
        )
    ),
    'is_uninstallable' => true,
    'name' => 'Currencies Exchange Rate Updater',
    'published_date' => '2012-10-30',
    'type' => 'module',
    'version' => '0.0.1'
);

$installdefs = array(
    'id' => 'ceru',
    'administration' => array(
        array(
            'from' => '<basepath>/extensions/modules/Administration/Administration/ExchangeRateUpdater.php',
        )
    ),
    'copy' => array(
        array(
            'from' => '<basepath>/copy/custom/modules/Currencies',
            'to' => 'custom/modules/Currencies'
        )
    ),
    'language' => array(
        array(
            'from' => '<basepath>/extensions/modules/Administration/language/en_us.ExchangeRateUpdater.php',
            'to_module' => 'Administration',
            'language' => 'en_us'
        ),
        array(
            'from' => '<basepath>/extensions/modules/Administration/language/pt_PT.ExchangeRateUpdater.php',
            'to_module' => 'Administration',
            'language' => 'pt_PT'
        ),
        array(
            'from' => '<basepath>/extensions/modules/Currencies/language/en_us.ExchangeRateUpdater.php',
            'to_module' => 'Currencies',
            'language' => 'en_us'
        ),
        array(
            'from' => '<basepath>/extensions/modules/Currencies/language/pt_PT.ExchangeRateUpdater.php',
            'to_module' => 'Currencies',
            'language' => 'pt_PT'
        ),
        array(
            'from' => '<basepath>/extensions/modules/Schedulers/language/en_us.ExchangeRateUpdater.php',
            'to_module' => 'Schedulers',
            'language' => 'en_us'
        ),
        array(
            'from' => '<basepath>/extensions/modules/Schedulers/language/en_PT.ExchangeRateUpdater.php',
            'to_module' => 'Schedulers',
            'language' => 'pt_PT'
        )
    ),
    'scheduledefs' => array(
        array(
            'from' => '<basepath>/extensions/modules/Schedulers/ScheduledTasks/ExchangeRateUpdater.php',
        )
    )
);
