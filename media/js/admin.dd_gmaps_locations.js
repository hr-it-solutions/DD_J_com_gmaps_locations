/**
 * @package    DD_GMaps_Locations
 *
 * @author     HR IT-Solutions Florian Häusler <info@hr-it-solutions.com>
 * @copyright  Copyright (C) 2011 - 2017 Didldu e.K. | HR IT-Solutions
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

                window.parent[functionName](event.target.getAttribute('data-id'), event.target.getAttribute('data-title'), event.target.getAttribute('data-uri'));
            })
        }
    });

})();

jQuery(function () {

    // Switch latitude longitiode custom fields
    if(jQuery('#jform_ll_c0').is(':checked')){
        jQuery('#ll_custom_enable').show();
    }

    jQuery("label[for='jform_ll_c0']").on('click', function () {
        jQuery('#ll_custom_enable').show();
    });
    jQuery("label[for='jform_ll_c1']").on('click', function () {
        jQuery('#ll_custom_enable').hide();
    });

});