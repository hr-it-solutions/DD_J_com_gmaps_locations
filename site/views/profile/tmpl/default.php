<?php
/**
 * @version    1-1-0-0 // Y-m-d 2017-03-19
 * @author     HR IT-Solutions Florian Häusler https://www.hr-it-solutions.com
 * @copyright  Copyright (C) 2011 - 2017 Didldu e.K. | HR IT-Solutions
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 **/

defined('_JEXEC') or die;

?>
<div class="dd_gmaps_locations profile well">
	<div class="row-fluid">
		<address class="span12 well">
			<div class="page-header">
				<h2>
					<?php echo htmlspecialchars($this->item->title, ENT_QUOTES, 'UTF-8'); ?>
				</h2>
				<span class="view-icon"></span>
				<span class="views">10k</span>
				<span class="label new"><?php echo JText::_('COM_DD_GMAPS_LOCATIONS_NEW'); ?></span>
				<span class="label featured"><?php echo JText::_('COM_DD_GMAPS_LOCATIONS_FEATURED'); ?></span>
			</div>
			<div class="row-col">
				<div class="span6">
					<strong><?php echo JText::_('COM_DD_GMAPS_LOCATIONS_ADDRESS'); ?></strong><br>
					<?php echo htmlspecialchars($this->item->company, ENT_QUOTES, 'UTF-8'); ?><br>
					<?php echo htmlspecialchars($this->item->street, ENT_QUOTES, 'UTF-8'); ?><br>
					<?php echo htmlspecialchars($this->item->zip, ENT_QUOTES, 'UTF-8') . ' ' . htmlspecialchars($this->item->location, ENT_QUOTES, 'UTF-8'); ?><br>
					<?php echo $this->item->federalstate ? htmlspecialchars($this->item->federalstate, ENT_QUOTES, 'UTF-8') . ', ' : ' '; ?>
					<?php echo JText::_($this->item->country); ?>
				</div>
				<div class="span6">
					<img src="<?php echo JUri::base() . htmlspecialchars($this->item->image, ENT_QUOTES, 'UTF-8'); ?>"
					     alt="<?php echo htmlspecialchars($this->item->title, ENT_QUOTES, 'UTF-8'); ?>">
				</div>
			</div>

			<div class="row-span">
				<hr>
				<a class="btn pull-right btn-primary" href="<?php echo JRoute::_($this->sef_rewrite ? $this->active_alias . '/' . $this->item->alias : 'index.php?option=com_dd_gmaps_locations&view=profile&profile_id=' . $this->item->id); ?>">
					<?php echo JText::_('COM_DD_GMAPS_LOCATIONS_PROFILE_PAGE'); ?>
				</a>
				<p>
					<?php echo htmlspecialchars($this->item->description, ENT_QUOTES, 'UTF-8'); ?>
				</p>
			</div>
		</address>
		<div class="clear"></div>
	</div>
</div>

