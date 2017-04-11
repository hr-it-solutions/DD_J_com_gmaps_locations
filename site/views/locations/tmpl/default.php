<?php
/**
 * @version    1-1-0-1 // Y-m-d 2017-04-02
 * @author     HR IT-Solutions Florian Häusler https://www.hr-it-solutions.com
 * @copyright  Copyright (C) 2011 - 2017 Didldu e.K. | HR IT-Solutions
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 **/

defined('_JEXEC') or die;

?>
<div class="dd_gmaps_locations locations well">
    <div class="row-fluid">
    <?php
foreach ($this->items as $i => $item): ?>
<?php if ($i % 2 == 0): ?>
    </div>
    <div class="row-fluid">
<?php endif; ?>
        <?php include JPATH_COMPONENT . '/views/locations/tmpl/default_items.php'; ?>
<?php
endforeach;?>
        <div id="prependAjax" class="clear"></div>
        <div class="load-more">
            <button id="load-more" class="btn"><?php echo JText::_('COM_DD_GMAPS_LOCATIONS_LOAD_MORE'); ?></button>
        </div>

        <script language="javascript" type="text/javascript">

            var start = <?php echo (int) $this->params->get('items_to_list', 6); ?>,
                limit = <?php echo (int) $this->params->get('items_more', 4); ?>,
                geolocate = 'geolocate',
                locationLatLng = '00',
                fullText = '',
                category = '',
                excludeItems = '',
                activeAlias = '<?php echo $this->active_alias; ?>';

            function processAjax(val, attrVal){
                jQuery.ajax({
                    crossDomain: false,
                    type: "POST",
                    url: 'index.php?option=com_dd_gmaps_locations&task=getAjax&format=json',
                    data:  {data:{start:start,limit:limit,geolocate:geolocate,locationLatLng:locationLatLng,fullText:fullText,category:category,excludeItems:excludeItems,activeAlias:activeAlias}},
                    dataType: "json",
                    cache: false
                })

                .done(function(data, textStatus, jqXHR){

                    start += start;
                    jQuery("#prependAjax").prepend(data.html);

                })
                .fail(function(jqXHR, textStatus, errorThrown){
                    console.log("Ajax problem: " + textStatus + ". " + errorThrown);
                });
            }

            jQuery('#load-more').click(function () {
                processAjax();
            })
        </script>

    </div>
</div>
