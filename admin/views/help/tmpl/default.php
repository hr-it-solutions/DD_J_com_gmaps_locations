<?php
/**
 * @package    DD_GMaps_Locations
 *
 * @author     HR IT-Solutions Florian Häusler <info@hr-it-solutions.com>
 * @copyright  Copyright (C) 2011 - 2017 Didldu e.K. | HR IT-Solutions
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 **/

defined('_JEXEC') or die;
?>
<div class="row-fluid">
	<?php if (!empty($this->sidebar)): ?>
	<div id="j-sidebar-container" class="span2">
	<?php echo $this->sidebar; ?>
	</div>
	<div id="j-main-container" class="span10">
	<?php else : ?>
	<div id="j-main-container" class="span12">
	<?php endif; ?>
		<div class="row-fluid">
            <div class="row-fluid">
                <div class="span12">
                    <div class="alert alert-info">
                        <h3>We are working on this! The help section comes with the next major update ;)</h3>
                    </div>
                </div>
            </div>

            <hr>
            <!-- Component Credits -->
            <div class="text-center">
                <p><small><?php echo nl2br(JText::sprintf('COM_DD_GMAPS_LOCATIONS_CREDITS', DD_GMaps_LocationsHelper::getComponentCoyright())); ?></small></p>
            </div>
		</div>
	</div>
</div>
