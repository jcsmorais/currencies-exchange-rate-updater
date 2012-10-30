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

var Currencies = (function(Currencies) {

    Currencies.getLatestRates = function() {
        var jqxhr = $.ajax({
            url: 'index.php',
            type: 'POST',
            dataType: 'json',
            data: {
                module: 'Currencies',
                action: 'GetLatestRates'
            }
        });

        return jqxhr;
    };

    Currencies.showMessageBox = function(title, message, close) {
        if ('undefined' === typeof close) {
            close = true;
        }

        YAHOO.SUGAR.MessageBox.show({
            title: title,
            msg: message,
            close: close
        });
    };

    Currencies.hideMessageBox = function() {
        YAHOO.SUGAR.MessageBox.hide();
    };

    return Currencies;

})(Currencies || {});
