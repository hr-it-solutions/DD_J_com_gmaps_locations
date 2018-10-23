<?php
/**
 * @package    DD_GMaps_Locations
 *
 * @author     HR-IT-Solutions Florian Häusler <info@hr-it-solutions.com>
 * @copyright  Copyright (C) 2011 - 2018 HR-IT-Solutions GmbH
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
                    <div class="well well-small"><h2 class="module-title nav-header"><?php echo JText::_('COM_DD_GMAPS_LOCATIONS_STATS'); ?></h2>
                        <div class="row-striped">
                            <?php
                            foreach ($this->items[0] as $key => $item): ?>
                            <div class="row-fluid">
                                <div class="span8">
                                    <strong class="row-title">
                                       <?php echo JText::_($key); ?>
                                    </strong>
                                </div>
                                <div class="span4">
                                    <?php echo $item; ?>
                                </div>
                            </div>
                           <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Module Positions -->
			<?php
			$modules = JModuleHelper::getModules('dd_gmaps_locations');

			if (count($modules))
			{
				$modules = array_chunk($modules, 2);

				foreach ($modules as $modulegroup) :
					echo '<div class="row-fluid">';

					foreach ($modulegroup as $module) :
						echo '<div class="span12">';
						echo JModuleHelper::renderModule($module);
						echo '</div>';
					endforeach;

					echo '</div>';

				endforeach;
			}
			else
			{
				echo '<div class="alert alert-info">';
				echo JText::sprintf('COM_DD_GMAPS_LOCATIONS_POSITION_DESCRIPTION', 'dd_gmaps_locations');
				echo '</div>';
			}
			?>
            <hr>
            <!-- Component Description -->
            <div class="text-center">
                <p><?php echo JText::_('COM_DD_GMAPS_LOCATIONS_XML_DESCRIPTION'); ?></p>
            </div>

            <!-- Component Version Info -->
            <div class="alert alert-success text-center">
                <?php echo JText::sprintf('COM_DD_GMAPS_LOCATIONS_VERSION', DD_GMaps_LocationsHelper::getComponentVersion()); ?>
            </div>

            <hr>
            <!-- Component Credits -->
            <div class="text-center">
                <p><small><?php echo nl2br(JText::sprintf('COM_DD_GMAPS_LOCATIONS_CREDITS', DD_GMaps_LocationsHelper::getComponentCoyright())); ?></small></p>
            </div>
		</div>
	</div>
</div>
