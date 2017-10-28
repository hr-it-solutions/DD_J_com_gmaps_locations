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
                    <div  class="well">
                        <h2 class="module-title nav-header" style="border-bottom: 1px solid white;margin-bottom: 10px;">
                            <?php echo JText::_('COM_DD_GMAPS_LOCATIONS_EXTENSIONS_DESCRIPTION_TITLE')?>
                        </h2>
                        <p>
                            <?php echo JText::_('COM_DD_GMAPS_LOCATIONS_EXTENSIONS_DESCRIPTION'); ?>
                        </p>
                        <p class="alert-info" style="padding: 10px">
                            <?php echo JText::_('COM_DD_GMAPS_LOCATIONS_EXTENSIONS_DESCRIPTION_NOTE'); ?>
                        </p>
                        <p>
                            <small>
                                <?php echo JText::_('COM_DD_GMAPS_LOCATIONS_EXTENSIONS_DESCRIPTION_DISCLAIMER'); ?>
                            </small>
                        </p>
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
                                        <div class="span8">
                                            <strong class="row-title">
								                <?php echo $item->label; ?>
                                            </strong>
                                            <br>
							                <?php if ($item->installed == '1'): ?>
                                                <span class="badge badge-success"><?php echo JText::_('COM_DD_GMAPS_LOCATIONS_EXTENSIONS_BADGE_INSTALLED')?></span>
							                <?php endif; ?>
							                <?php if ($item->enabled == '1'): ?>
                                                <span class="badge badge-info"><?php echo JText::_('COM_DD_GMAPS_LOCATIONS_EXTENSIONS_BADGE_AKTIVE')?></span>
							                <?php endif; ?>
	                                        <?php if ($item->required == '1' && $item->installed != '1' && $item->enabled != '1'): ?>
                                                <span class="badge badge-important"><?php echo JText::_('COM_DD_GMAPS_LOCATIONS_EXTENSIONS_BADGE_REQUIRED')?></span>
	                                        <?php endif; ?>
                                        </div>
                                        <div class="span4">
							                <?php if($item->pkg == 'base'):?>
                                                <span class="badge badge-warning" style="float: right"><?php echo $item->pkg; ?></span>
							                <?php else: ?>
                                                <span class="badge" style="float: right"><?php echo $item->pkg; ?></span>
							                <?php endif; ?>
                                        </div>
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
                                        <div class="span8">
                                            <strong class="row-title">
						                        <?php echo $item->label; ?>
                                            </strong>
                                            <br>
					                        <?php if ($item->installed == '1'): ?>
                                                <span class="badge badge-success"><?php echo JText::_('COM_DD_GMAPS_LOCATIONS_EXTENSIONS_BADGE_INSTALLED')?></span>
					                        <?php endif; ?>
					                        <?php if ($item->enabled == '1'): ?>
                                                <span class="badge badge-info"><?php echo JText::_('COM_DD_GMAPS_LOCATIONS_EXTENSIONS_BADGE_AKTIVE')?></span>
					                        <?php endif; ?>
	                                        <?php if ($item->required == '1' && $item->installed != '1' && $item->enabled != '1'): ?>
                                                <span class="badge badge-important"><?php echo JText::_('COM_DD_GMAPS_LOCATIONS_EXTENSIONS_BADGE_REQUIRED')?></span>
	                                        <?php endif; ?>
                                        </div>
                                        <div class="span4">
	                                        <?php if($item->pkg == 'base'):?>
                                                <span class="badge badge-warning" style="float: right"><?php echo $item->pkg; ?></span>
	                                        <?php else: ?>
                                                <span class="badge" style="float: right"><?php echo $item->pkg; ?></span>
	                                        <?php endif; ?>
                                        </div>
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
                                        <div class="span8">
                                            <strong class="row-title">
						                        <?php echo $item->label; ?>
                                            </strong>
                                            <br>
					                        <?php if ($item->installed == '1'): ?>
                                                <span class="badge badge-success"><?php echo JText::_('COM_DD_GMAPS_LOCATIONS_EXTENSIONS_BADGE_INSTALLED')?></span>
					                        <?php endif; ?>
					                        <?php if ($item->enabled == '1'): ?>
                                                <span class="badge badge-info"><?php echo JText::_('COM_DD_GMAPS_LOCATIONS_EXTENSIONS_BADGE_AKTIVE')?></span>
					                        <?php endif; ?>
	                                        <?php if ($item->required == '1' && $item->installed != '1' && $item->enabled != '1'): ?>
                                                <span class="badge badge-important"><?php echo JText::_('COM_DD_GMAPS_LOCATIONS_EXTENSIONS_BADGE_REQUIRED')?></span>
	                                        <?php endif; ?>
                                        </div>
                                        <div class="span4">
	                                        <?php if($item->pkg == 'base'):?>
                                                <span class="badge badge-warning" style="float: right"><?php echo $item->pkg; ?></span>
	                                        <?php else: ?>
                                                <span class="badge" style="float: right"><?php echo $item->pkg; ?></span>
	                                        <?php endif; ?>
                                        </div>
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
