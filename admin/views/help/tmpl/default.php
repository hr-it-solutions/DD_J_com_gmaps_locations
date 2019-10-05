<?php
/**
 * @package    DD_GMaps_Locations
 *
 * @author     HR-IT-Solutions Florian Häusler <info@hr-it-solutions.com>
 * @copyright  Copyright (C) 2011 - 2019 HR-IT-Solutions GmbH
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
                        <p class="alert-info"><?php echo JText::_('COM_DD_GMAPS_LOCATIONS_EXTENSIONS_DESCRIPTION_NOTE'); ?>                        </p>
                        <p><small><?php echo JText::_('COM_DD_GMAPS_LOCATIONS_EXTENSIONS_DESCRIPTION_DISCLAIMER'); ?></small></p>
                    </div>
                </div>
            </div>

            <div class="row-fluid">
                <div class="span6">
                    <div class="well well-small">
                        <h2 class="module-title nav-header">
                            <?php echo JText::_('COM_DD_GMAPS_LOCATIONS_EXTENSIONS_HELP'); ?>
                        </h2>
                        <p><?php echo JText::_('COM_DD_GMAPS_LOCATIONS_EXTENSIONS_HELP_DESC'); ?></p>
                        <ol>
                            <li><?php echo JText::_('COM_DD_GMAPS_LOCATIONS_EXTENSIONS_HELP_DESC_REQUIREMENTS_A'); ?></li>
                            <li><?php echo JText::_('COM_DD_GMAPS_LOCATIONS_EXTENSIONS_HELP_DESC_REQUIREMENTS_B'); ?></li>
                            <li><?php echo JText::_('COM_DD_GMAPS_LOCATIONS_EXTENSIONS_HELP_DESC_REQUIREMENTS_C'); ?></li>
                        </ol>
                        <p><?php echo JText::_('COM_DD_GMAPS_LOCATIONS_EXTENSIONS_HELP_DESC_ND'); ?></p>
                        <a class="btn btn-small"
                           href="https://www.hr-it-solutions.com/<?php echo JText::_('COM_DD_GMAPS_LOCATIONS_EXTENSIONS_HELP_CONTACT_LINK'); ?>"
                           target="_blank"><span class="icon-support"></span> <?php echo JText::_('COM_DD_GMAPS_LOCATIONS_EXTENSIONS_HELP_REQUEST'); ?></a>
                    </div>
                </div>

                <div class="span6">
                    <div class="well well-small">
                        <h2 class="module-title nav-header">
	                        <?php echo JText::_('COM_DD_GMAPS_LOCATIONS_EXTENSIONS_DOCUMENTATION'); ?>
                        </h2>
                        <a class="btn btn-wide btn-success"
                           href="http://demo.hr-it-solutions.com/documentation-gmaps-locations"
                           target="_blank"><?php echo JText::_('COM_DD_GMAPS_LOCATIONS_EXTENSIONS_DOCUMENTATION_PAGE'); ?></a>
                    </div>
                </div>
            </div>

            <div class="well alert alert-warning" style="display: none">
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

            <div class="alert alert-info text-center">
                <h4><?php echo JText::_('COM_DD_GMAPS_LOCATIONS_VERSION_GET_PRO'); ?></h4>
            </div>

            <hr>
            <!-- Component Credits -->
            <div class="text-center">
                <p><small><?php echo nl2br(JText::sprintf('COM_DD_GMAPS_LOCATIONS_CREDITS', DD_GMaps_LocationsHelper::getComponentCoyright())); ?></small></p>
            </div>
		</div>
	</div>
</div>
