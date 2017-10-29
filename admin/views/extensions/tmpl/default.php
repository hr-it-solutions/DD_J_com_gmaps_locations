<?php
/**
 * @package    DD_GMaps_Locations
 *
 * @author     HR IT-Solutions Florian Häusler <info@hr-it-solutions.com>
 * @copyright  Copyright (C) 2011 - 2017 Didldu e.K. | HR IT-Solutions
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 **/

defined('_JEXEC') or die;

JHTML::_('behavior.tooltip');
?>
<div class="row-fluid" id="dd_gmaps_locations-location">
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
                    <div class="well extensions-info">
                        <h2 class="module-title nav-header"><?php echo JText::_('COM_DD_GMAPS_LOCATIONS_EXTENSIONS_DESCRIPTION_TITLE')?></h2>
                        <p><?php echo JText::_('COM_DD_GMAPS_LOCATIONS_EXTENSIONS_DESCRIPTION'); ?></p>
                        <p class="alert-info"><?php echo JText::_('COM_DD_GMAPS_LOCATIONS_EXTENSIONS_DESCRIPTION_NOTE'); ?>                        </p>
                        <p><small><?php echo JText::_('COM_DD_GMAPS_LOCATIONS_EXTENSIONS_DESCRIPTION_DISCLAIMER'); ?></small></p>
                    </div>
                </div>
            </div>

            <div class="row-fluid">
                <div class="span6">
                    <div class="well well-small">
                        <h2 class="module-title nav-header">
			                <?php echo JText::_('COM_DD_GMAPS_LOCATIONS_EXTENSIONS_COMPONENTS'); ?>
                        </h2>
                        <div class="row-striped">
			                <?php foreach ($this->items as $item): ?>
				                <?php if ($item->type === 'component'): ?>
                                    <div class="row-fluid">
	                                    <?php $this->item = $item; ?>
	                                    <?php echo $this->loadTemplate('extlist'); ?>
                                    </div>
				                <?php endif; ?>
			                <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="well well-small">
                        <h2 class="module-title nav-header">
                            <?php echo JText::_('COM_DD_GMAPS_LOCATIONS_EXTENSIONS_MODULES'); ?>
                        </h2>
                        <div class="row-striped">
	                        <?php foreach ($this->items as $item): ?>
		                        <?php if ($item->type === 'module'): ?>
                                    <div class="row-fluid">
	                                    <?php $this->item = $item; ?>
	                                    <?php echo $this->loadTemplate('extlist'); ?>
                                    </div>
		                        <?php endif; ?>
	                        <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <div class="span6">
                    <div class="well well-small">
                        <h2 class="module-title nav-header">
                            <?php echo JText::_('COM_DD_GMAPS_LOCATIONS_EXTENSIONS_PLUGINS'); ?>
                        </h2>
                        <div class="row-striped">
	                        <?php foreach ($this->items as $item): ?>
		                        <?php if ($item->type === 'plugin'): ?>
                                    <div class="row-fluid">
				                        <?php $this->item = $item; ?>
				                        <?php echo $this->loadTemplate('extlist'); ?>
                                    </div>
		                        <?php endif; ?>
	                        <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="well alert alert-warning">
                <h2 class="module-title nav-header" style="color: #830">
		            <?php echo JText::_('COM_DD_GMAPS_LOCATIONS_EXTENSIONS_UPDATESERVER_TITLE')?>
                </h2>
                <p>
	                <?php echo JText::_('COM_DD_GMAPS_LOCATIONS_EXTENSIONS_UPDATESERVER_NOTE'); ?>
                </p>

                <button onclick="location.href='index.php?option=com_installer&amp;view=update';" class="btn btn-small">
                    <span class="icon-new-tab-2" aria-hidden="true"></span>
		            <?php echo JText::_('COM_DD_GMAPS_LOCATIONS_EXTENSIONS_UPDATE_PAGE'); ?>
                </button>
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
