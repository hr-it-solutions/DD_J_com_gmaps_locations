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
        <address class="span6 location well">
            <div class="page-header">
                <strong>
                    <a href="<?php echo JRoute::_($this->sef_rewrite ? $this->active_alias . '/' . $item->alias : 'index.php?option=com_dd_gmaps_locations&view=profile&profile_id=' . $item->id); ?>">
                        <?php echo htmlspecialchars($item->title, ENT_QUOTES, 'UTF-8'); ?>
                    </a>
                </strong>
	            <?php // Show hits
	            if($this->params->get('show_hits')):?>
                    <span class="view-icon"></span>
                    <span class="views"><?php
	                    if($item->hits >= 1000){
		                    echo round($item->hits / 1000, 0) . 'k';
	                    } else {
		                    echo $item->hits;
	                    }
	                    ?></span>
	            <?php endif; ?>
	            <?php // Mark as new
	            $mark_as_new = (int) $this->params->get('mark_as_new', 0);
	            if( strtotime("-$mark_as_new days") < strtotime($item->created)):?>
                    <span class="label new"><?php echo JText::_('COM_DD_GMAPS_LOCATIONS_NEW'); ?></span>
	            <?php endif; ?>
	            <?php // Featured
	            if($item->featured != 0):?>
                <span class="label featured"><?php
		            if ($item->featured == 1){
			            echo JText::_('COM_DD_GMAPS_LOCATIONS_FEATURED');
		            } elseif($item->featured == 2){
			            echo htmlspecialchars($item->category_title, ENT_QUOTES, 'UTF-8');
		            }
		            ?></span>
	            <?php endif; ?>
            </div>
            <div class="row-col">
                <div class="span6">
                    <div class="page-header map_bar">
                        <a href="">
		                    <?php echo JText::_('COM_DD_GMAPS_LOCATIONS_DISCTANCE'); ?>
                        </a>
                    </div>
	                <?php echo htmlspecialchars($item->company, ENT_QUOTES, 'UTF-8'); ?><br>
	                <?php echo htmlspecialchars($item->street, ENT_QUOTES, 'UTF-8'); ?><br>
	                <?php echo htmlspecialchars($item->zip, ENT_QUOTES, 'UTF-8') . ' ' . htmlspecialchars($item->location, ENT_QUOTES, 'UTF-8'); ?><br>
	                <?php echo $item->federalstate ? htmlspecialchars($item->federalstate, ENT_QUOTES, 'UTF-8') . ', ' : ' '; ?>
	                <?php echo JText::_($item->country); ?>
                </div>
                <div class="span6">
                    <div class="page-header map_bar">
                        <a href="">
	                        <?php echo JText::_('COM_DD_GMAPS_LOCATIONS_SHOW_ON_MAP'); ?>
                        </a>
                    </div>
                    <img src="<?php echo JUri::base() . htmlspecialchars($item->image, ENT_QUOTES, 'UTF-8'); ?>"
                         alt="<?php echo htmlspecialchars($item->title, ENT_QUOTES, 'UTF-8'); ?>">
                </div>
            </div>

            <div class="row-fluid">
                <div class="span12">
                    <hr>
                    <a class="btn pull-right btn-primary" href="<?php echo JRoute::_($this->sef_rewrite ? $this->active_alias . '/' . $item->alias : 'index.php?option=com_dd_gmaps_locations&view=profile&profile_id=' . $item->id); ?>">
		                <?php echo JText::_('COM_DD_GMAPS_LOCATIONS_PROFILE_PAGE'); ?>
                    </a>
                    <p>
		                <?php echo htmlspecialchars($item->short_description, ENT_QUOTES, 'UTF-8'); ?>
                    </p>
                </div>
            </div>
        </address>
<?php
endforeach;?>
        <div class="clear"></div>
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
                excludeItems = '';

            function processAjax(val, attrVal){
                jQuery.ajax({
                    crossDomain: false,
                    type: "POST",
                    url: 'index.php?option=com_dd_gmaps_locations&task=getAjax&format=json',
                    data:  {data:{start:start,limit:limit,geolocate:geolocate,locationLatLng:locationLatLng,fullText:fullText,category:category,excludeItems:excludeItems}},
                    cache: false,
                    success: function (fetcheddata) {
                        var response = fetcheddata;

                        console.log(fetcheddata);
                    }
                });
            }

            jQuery('#load-more').click(function () {
                processAjax();
            })
        </script>

    </div>
</div>
