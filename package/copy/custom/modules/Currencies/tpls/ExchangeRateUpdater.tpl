{*
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
*}

{if !$currencies|@count}
    {assign var='disabledFormElement' value=' disabled="disabled"'}
{/if}
<div class="moduleTitle">
    <h2>
        {$MOD.LNK_EXCHANGE_RATE_UPDATER}
    </h2>
</div>
<div class="clear"></div>
<form name="exchange-rate-updater" id="exchange-rate-updater" method="POST">
    <table class="list view" cellspacing="0" cellpadding="0" border="0" width="100%">
        <tbody>
            <tr>
                <th scope="col">{$MOD.LBL_LIST_NAME}</th>
                <th scope="col">{$MOD.LBL_LIST_ISO4217}</th>
                <th scope="col">{$MOD.LBL_LIST_SYMBOL}</th>
                <th scope="col">{$MOD.LBL_LIST_CURRENT_RATE}</th>
                <th scope="col">{$MOD.LBL_LIST_LATEST_RATE}{sugar_help text=$MOD.LBL_EXCHANGE_RATE_UPDATER_LATEST_RATE_HELP}</th>
                <th scope="col"></th>
            </tr>
            {if $currencies|@count}
            {foreach from=$currencies key=key item=currency}
                {if $key is odd}
                {assign var='rowColor' value='oddListRowS1'}
                {else}
                {assign var='rowColor' value='evenListRowS1'}
                {/if}
                <tr class="{$rowColor} currency" height="20">
                <td class="name" scope="row">{$currency->name}</td>
                <td class="iso4217" scope="row">{$currency->iso4217}</td>
                <td class="symbol" scope="row">{$currency->symbol}</td>
                <td class="conversion_rate" scope="row">{sugar_number_format var=$currency->conversion_rate precision=10}</td>
                <td class="latest_rate" scope="row"><input type="text" name="latest_rate[{$currency->id}]" /></td>
                <td scope="row"></td>
                </tr>
            {/foreach}
            {else}
            <tr>
                <td colspan="6">{$MOD.LBL_EXCHANGE_RATE_UPDATER_NO_ACTIVE_CURRENCIES}</td>
            </tr>
            {/if}
            <tr class="pagination">
                <td colspan="6">
                    <table class="paginationTable" cellspacing="0" cellpadding="0" border="0" width="100%">
                        <tfoot>
                            <tr>
                                <td>
                                    <input type="button" id="import-button" class="button" value="{$MOD.LBL_EXCHANGE_RATE_UPDATER_IMPORT_BUTTON_LABEL}" title="{$MOD.LBL_EXCHANGE_RATE_UPDATER_IMPORT_BUTTON_TITLE}" accesskey="{$MOD.LBL_EXCHANGE_RATE_UPDATER_IMPORT_BUTTON_KEY}"{$disabledFormElement} />
                                    <input type="submit" id="save-button" class="button" value="{$MOD.LBL_EXCHANGE_RATE_UPDATER_SAVE_BUTTON_LABEL}" title="{$MOD.LBL_EXCHANGE_RATE_UPDATER_SAVE_BUTTON_TITLE}" accesskey="{$MOD.LBL_EXCHANGE_RATE_UPDATER_SAVE_BUTTON_KEY}"{$disabledFormElement} />
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <input type="hidden" name="module" value="Currencies" />
    <input type="hidden" name="action" value="SaveLatestRates" />
</form>
