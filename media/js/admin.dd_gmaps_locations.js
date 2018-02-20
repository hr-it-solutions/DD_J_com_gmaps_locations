/**
 * @package    DD_GMaps_Locations
 *
 * @author     HR IT-Solutions Florian Häusler <info@hr-it-solutions.com>
 * @copyright  Copyright (C) 2011 - 2018 Didldu e.K. | HR IT-Solutions
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 **/

;(function() {
    "use strict";

    document.addEventListener('DOMContentLoaded', function(){
        // Get the elements
        var elements = document.querySelectorAll('.select-link');

        for(var i = 0, l = elements.length; l>i; i++) {
            // Listen for click event
            elements[i].addEventListener('click', function (event) {
                event.preventDefault();
                var functionName = event.target.getAttribute('data-function');

                window.parent[functionName](event.target.getAttribute('data-id'),
                    event.target.getAttribute('data-title'), event.target.getAttribute('data-uri'));
            })
        }
    });

})();

var DD_GMaps_Locations = (function($, document, undefined) {

    var init = function() {

        // Switch latitude longitiode custom fields
        if($('#jform_ll_c0').is(':checked')){
            $('#ll_custom_enable').show();
        }

        $("label[for='jform_ll_c0']").on('click', function () {
            $('#ll_custom_enable').show();
        });
        $("label[for='jform_ll_c1']").on('click', function () {
            $('#ll_custom_enable').hide();
        });


        // GeoHard code address unset / flag
        var falg = '⚑';

        $('#geoaddressclear').on('click', function(){
            $('#jform_street').val(falg);
            $('#jform_location').val(falg);
            $('#jform_zip').val(falg);
        });

        // Unset Ext-C ID
        $('#extcclear').on('click', function(){
            $('#jform_ext_c_id').val('0');
        });

    };

    // init public method
    return {
        init:init
    };

}(jQuery, document, undefined));

(function($) {
    $(function()
    {
        DD_GMaps_Locations.init();
    });
})(jQuery);