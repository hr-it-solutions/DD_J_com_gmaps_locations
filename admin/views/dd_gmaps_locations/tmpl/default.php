<?php
/**
 * @version    1-1-0-0 // Y-m-d 2017-02-25
 * @author     HR IT-Solutions Florian Häusler https://www.hr-it-solutions.com
 * @copyright  Copyright (C) 2011 - 2017 Didldu e.K. | HR IT-Solutions
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 **/

defined('_JEXEC') or die;
?>

<div class="row-fluid">
	<?php if (!empty($this->sidebar)) : ?>
	<div id="j-sidebar-container" class="span2">
	<?php echo $this->sidebar; ?>
	</div>
	<div id="j-main-container" class="span10">
	<?php else : ?>
	<div id="j-main-container" class="span12">
	<?php endif; ?>
		<div class="row-fluid">

            <!-- Component Description -->
            <p><?php echo JText::_('COM_DD_GMAPS_LOCATIONS_XML_DESCRIPTION'); ?></p>

		</div>
	</div>
</div>