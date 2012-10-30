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

    Currencies.ExchangeRateUpdaterView = {

        init: function() {
            var self = Currencies.ExchangeRateUpdaterView;

            self._initImportButton();

            self._initFormValidation();
            self._initFormSubmission();
        },

        _initImportButton: function() {
            var self = Currencies.ExchangeRateUpdaterView;

            $('#import-button').click(function() {
                self.updateImportButtonStatus(false);
                self.importLatestRates();
            });
        },

        _initFormValidation: function() {
            var self = Currencies.ExchangeRateUpdaterView;

            self.getCurrencies().find('input[name^="latest_rate["]').each(function(i, field) {
                var $field = $(field);

                addToValidateMoreThan(
                    'exchange-rate-updater',
                    $field.attr('name'),
                    'float',
                    false,
                    SUGAR.language.get(
                        'Currencies',
                        'LBL_EXCHANGE_RATE_UPDATER_LATEST_RATE_HAS_TO_BE_ABOVE_ZERO'
                    ),
                    0.000001
                );
            });
        },

        _initFormSubmission: function() {
            var self = Currencies.ExchangeRateUpdaterView

            self.getForm().submit(function() {
                var filledLatestRates = self.getFilledLatestRates();
                if (0 === filledLatestRates.length) {
                    Currencies.showMessageBox(
                        SUGAR.language.get('Currencies', 'LBL_MESSAGEBOX_ALERT'),
                        SUGAR.language.get('Currencies', 'LBL_EXCHANGE_RATE_UPDATER_NEEDS_AT_LEAST_ONE_LATEST_RATE')
                    );
                    return false;
                }

                return check_form('exchange-rate-updater');
            });
        },

        updateImportButtonStatus: function(enabled) {
            var $button = $('#import-button');

            if (enabled) {
                $button.removeAttr('disabled');
                return;
            }

            $button.attr('disabled', 'disabled');
        },

        importLatestRates: function() {
            var self = Currencies.ExchangeRateUpdaterView;

            clear_all_errors();
            Currencies.showMessageBox(
                SUGAR.language.get('Currencies', 'LBL_MESSAGEBOX_LOADING'),
                SUGAR.language.get('Currencies', 'LBL_EXCHANGE_RATE_UPDATER_IMPORT_LOADING'),
                false
            );

            var $source = $('#source');
            var jqxhr = Currencies.getLatestRates();

            jqxhr.done(function(data) {
                if (!data.success) {
                    Currencies.showMessageBox(
                        SUGAR.language.get('Currencies', 'LBL_MESSAGEBOX_ALERT'),
                        SUGAR.language.get('Currencies', 'LBL_EXCHANGE_RATE_UPDATER_IMPORT_FAILURE')
                    );

                    return;
                }

                var numPopulated = self.populateLatestRates(data.rates);
                if (0 < numPopulated) {
                    Currencies.hideMessageBox();
                    return;
                }

                Currencies.showMessageBox(
                    SUGAR.language.get('Currencies', 'LBL_MESSAGEBOX_ALERT'),
                    SUGAR.language.get('Currencies', 'LBL_EXCHANGE_RATE_UPDATER_IMPORT_FAILURE_NO_MATCHING_ISO4217')
                );
            });

            jqxhr.fail(function(jqxhr, textStatus) {
                Currencies.showMessageBox(
                    SUGAR.language.get('Currencies', 'LBL_MESSAGEBOX_ALERT'),
                    SUGAR.language.get('Currencies', 'LBL_EXCHANGE_RATE_UPDATER_IMPORT_FAILURE')
                );
            });

            jqxhr.always(function() {
                self.updateImportButtonStatus(true);
            });

            return jqxhr;
        },

        populateLatestRates: function(data) {
            var self = Currencies.ExchangeRateUpdaterView;

            var numPopulated = 0;
            $.each(data, function(iso4217, rate) {
                var $currency = self.getCurrencyByIso4217(iso4217);
                if (0 === $currency.length) {
                    return; // continue
                }

                $currency.find('input[name^="latest_rate["]').val(rate);
                numPopulated++;
            });

            return numPopulated;
        },

        getForm: function() {
            return $('#exchange-rate-updater');
        },

        getCurrencies: function() {
            var self = Currencies.ExchangeRateUpdaterView;

            return self.getForm().find('.currency');
        },

        getCurrencyByIso4217: function(iso4217) {
            var self = Currencies.ExchangeRateUpdaterView;

            return self.getCurrencies().find('.iso4217').filter(function() {
                return $(this).text() == iso4217;
            }).parent('.currency');
        },

        getFilledLatestRates: function() {
            var self = Currencies.ExchangeRateUpdaterView;

            return self.getCurrencies().find('input[name^="latest_rate["]:not(:text[value=""])');
        }

    };

    return Currencies;

})(Currencies || {});

$(function() {
    Currencies.ExchangeRateUpdaterView.init();
});
