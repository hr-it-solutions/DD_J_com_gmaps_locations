<?php
/**
 * @package    DD_GMaps_Locations
 *
 * @author     HR-IT-Solutions Florian Häusler <info@hr-it-solutions.com>
 * @copyright  Copyright (C) 2011 - 2019 HR-IT-Solutions GmbH
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 **/

defined('_JEXEC') or die;

jimport('joomla.application.component.helper');

if (isset($this->params))
{
	$params = $this->params;
}
// AJAX request
else
{
	$app = JFactory::getApplication();
	$params = $app->getParams('com_dd_gmaps_locations');
}

$emtpyFlag = array('','⚑');

?>
<address class="span6 location well">
    <div class="page-header">
        <strong>
            <a href="<?php echo JRoute::_('index.php?option=com_dd_gmaps_locations&view=profile&id=' . (int) $item->id . ':' . htmlspecialchars($item->alias, ENT_QUOTES, 'UTF-8')); ?>">
				<?php echo htmlspecialchars($item->title, ENT_QUOTES, 'UTF-8'); ?>
            </a>
        </strong>
		<?php // Show hits
		if($params->get('show_hits')):?>
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
		$mark_as_new = (int) $params->get('mark_as_new', 0);
		if($mark_as_new AND strtotime("-$mark_as_new days") < strtotime($item->created)):?>
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
            </div>
            <?php
            if ($params->get('marker_in_entry') && $item->category_params && json_decode($item->category_params)->image): ?>
            <img class="category_marker"
                 src="<?php echo htmlspecialchars(str_replace('\\', '/', json_decode($item->category_params)->image)); ?>"
                 alt="<?php echo htmlspecialchars(json_decode($item->category_params)->image_alt); ?>">
	        <?php endif; ?>
			<?php echo htmlspecialchars($item->company, ENT_QUOTES, 'UTF-8'); ?><br>
	        <?php if(!in_array($item->street, $emtpyFlag)):?>
			    <?php echo htmlspecialchars($item->street, ENT_QUOTES, 'UTF-8'); ?><br>
	        <?php endif; ?>

	        <?php if(!in_array($item->zip, $emtpyFlag) && !in_array($item->location, $emtpyFlag)):?>
		        <?php echo htmlspecialchars($item->zip, ENT_QUOTES, 'UTF-8') . ' ' . htmlspecialchars($item->location, ENT_QUOTES, 'UTF-8') . ' '; ?><br>
	        <?php elseif(!in_array($item->zip, $emtpyFlag)):?>
		        <?php echo htmlspecialchars($item->zip, ENT_QUOTES, 'UTF-8'); ?><br>
	        <?php elseif(!in_array($item->location, $emtpyFlag)):?>
		        <?php echo htmlspecialchars($item->location, ENT_QUOTES, 'UTF-8'); ?><br>
	        <?php endif; ?>


			<?php echo $item->federalstate ? htmlspecialchars($item->federalstate, ENT_QUOTES, 'UTF-8') . ', ' : ' '; ?>
			<?php echo JText::_($item->country); ?>
        </div>
        <div class="span6">
            <div class="page-header map_bar">
	            <?php // Show on map button
	            if($params->get('show_on_map')):?>
                <a class="showOnMap" data-showonmap_action="<?php echo $params->get('show_on_map_action') ?>" id="showID<?php echo $i; ?>" href="javascript:void(0)" rel="nofollow" >
					<?php echo JText::_('COM_DD_GMAPS_LOCATIONS_SHOW_ON_MAP'); ?>
                </a>
	            <?php endif; ?>
            </div>
            <img src="<?php echo JUri::base() . htmlspecialchars($item->image, ENT_QUOTES, 'UTF-8'); ?>"
                 alt="<?php echo htmlspecialchars($item->title, ENT_QUOTES, 'UTF-8'); ?>">
        </div>
    </div>

    <div class="row-fluid">
        <div class="span12">
            <hr>
            <a class="btn pull-right" href="<?php echo JRoute::_('index.php?option=com_dd_gmaps_locations&view=profile&id=' . (int) $item->id . ':' . htmlspecialchars($item->alias, ENT_QUOTES, 'UTF-8')); ?>">
				<?php echo JText::_('COM_DD_GMAPS_LOCATIONS_PROFILE_PAGE'); ?>
            </a>
            <p>
				<?php echo htmlspecialchars($item->short_description, ENT_QUOTES, 'UTF-8'); ?>
            </p>
        </div>
    </div>
</address>
