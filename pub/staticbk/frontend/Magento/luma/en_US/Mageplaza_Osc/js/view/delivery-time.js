/**
 * Mageplaza
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Mageplaza.com license that is
 * available through the world-wide-web at this URL:
 * https://www.mageplaza.com/LICENSE.txt
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    Mageplaza
 * @package     Mageplaza_Osc
 * @copyright   Copyright (c) 2016 Mageplaza (http://www.mageplaza.com/)
 * @license     https://www.mageplaza.com/LICENSE.txt
 */

define(
    [
        'jquery',
        'ko',
        'uiComponent',
        'mage/calendar',
        'Mageplaza_Osc/js/model/osc-data'
    ],
    function ($, ko, Component, calendar, oscData) {
        'use strict';
        var cacheKey   = 'deliveryTime';
        var dateFormat = window.checkoutConfig.oscConfig.deliveryTimeOptions.deliveryTimeFormat;
        var daysOff    = window.checkoutConfig.oscConfig.deliveryTimeOptions.deliveryTimeOff;
        return Component.extend({
            defaults: {
                template: 'Mageplaza_Osc/container/delivery-time'
            },
            deliveryTimeValue: ko.observable(),
            initialize: function () {
                this._super();
                ko.bindingHandlers.datepicker = {
                    init: function (element) {
                        var options = {
                            minDate: 0,
                            showButtonPanel: false,
                            dateFormat: dateFormat,
                            showOn: 'both',
                            buttonText: '',
                            beforeShowDay: function (date) {
                                if(!daysOff) return [true];
                                var daysOffToArray = daysOff.split(',');
                                $(daysOffToArray).each(function (index) {
                                    daysOffToArray[index] = parseInt(daysOffToArray[index]);
                                });
                                return daysOff.indexOf(date.getDay()) != -1 ? [false] : [true];
                            }
                        };
                        $(element).datetimepicker(options);
                    }
                };
                this.deliveryTimeValue(oscData.getData(cacheKey));
                this.deliveryTimeValue.subscribe(function (newValue) {
                    oscData.setData(cacheKey, newValue);
                });
                return this;
            }
        });
    }
);
