<?php
/**
 * @package    DD_GMaps_Locations
 *
 * @author     HR IT-Solutions Florian Häusler <info@hr-it-solutions.com>
 * @copyright  Copyright (C) 2011 - 2017 Didldu e.K. | HR IT-Solutions
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 **/

defined('_JEXEC') or die;

JHtml::_('behavior.formvalidator');
JHtml::_('behavior.keepalive');
JHtml::_('formbehavior.chosen', '#jform_catid', null, array('disable_search_threshold' => 0));
JHtml::_('formbehavior.chosen', 'select');

JHtml::_('script', 'com_dd_gmaps_locations/admin.dd_gmaps_locations.min.js', array('version' => 'auto', 'relative' => true));

?>
<div id="dd_gmaps_locations-location" class="row-fluid dd_gmaps_locations">
<form action="<?php echo JRoute::_('index.php?option=com_dd_gmaps_locations&layout=edit&id=' . (int) $this->item->id); ?>"
      method="post" name="adminForm" id="adminForm" class="form-validate">
    <div class="row-fluid">
        <div class="span12">

            <div class="form-inline form-inline-header">
                <div class="control-group">
                    <div class="control-label">
						<?php echo $this->form->getLabel('title'); ?>
                    </div>
                    <div class="controls">
						<?php echo $this->form->getInput('title'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <div class="control-label">
						<?php echo $this->form->getLabel('alias'); ?>
                    </div>
                    <div class="controls">
						<?php echo $this->form->getInput('alias'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <div class="control-label">
						<?php echo $this->form->getLabel('id'); ?>
                    </div>
                    <div class="controls">
						<?php echo $this->form->getInput('id'); ?>
                    </div>
                </div>
            </div>

			<?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'general')); ?>
			<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'general', JText::_('COM_DD_GMAPS_LOCATIONS_NEW_LOCATION')); ?>
            <div class="row-fluid">
                <div class="span9">
                    <fieldset>
                        <div class="control-group">
                            <div class="control-label">
								<?php echo $this->form->getLabel('short_description'); ?>
                            </div>
                            <div class="controls">
								<?php echo $this->form->getInput('short_description'); ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="control-label">
								<?php echo $this->form->getLabel('description'); ?>
                            </div>
                            <div class="controls">
								<?php echo $this->form->getInput('description'); ?>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="span3">
					<?php echo JLayoutHelper::render('joomla.edit.global', $this); ?>

                </div>
            </div>
			<?php echo JHtml::_('bootstrap.endTab'); ?>
			<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'address', JText::_('COM_DD_GMAPS_LOCATIONS_LOCATION_ADDRESS')); ?>
            <div class="row-fluid form-horizontal-desktop">
                <div class="span3">
                    <div class="control-group">
                        <div class="control-label">
							<?php echo $this->form->getLabel('street'); ?>
                        </div>
                        <div class="controls">
							<?php echo $this->form->getInput('street'); ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="control-label">
							<?php echo $this->form->getLabel('location'); ?>
                        </div>
                        <div class="controls">
							<?php echo $this->form->getInput('location'); ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="control-label">
							<?php echo $this->form->getLabel('zip'); ?>
                        </div>
                        <div class="controls">
							<?php echo $this->form->getInput('zip'); ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="control-label">
							<?php echo $this->form->getLabel('country'); ?>
                        </div>
                        <div class="controls">
							<?php echo $this->form->getInput('country'); ?>
                            <div class="row-fluid">
                                <small>
									<?php
									if (JComponentHelper::getParams('com_dd_gmaps_locations')->get('countries_reduced_selection', 0))
									{
										echo JText::_('COM_DD_GMAPS_LOCATIONS_COMPONENT_COUNTRIES_SELECTION_REDUCED');
									}
									else
									{
										echo JText::_('COM_DD_GMAPS_LOCATIONS_COMPONENT_COUNTRIES_SELECTION_EXTENDED');
									}
									?>
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="control-label">
							<?php echo $this->form->getLabel('federalstate'); ?>
                        </div>
                        <div class="controls">
							<?php echo $this->form->getInput('federalstate'); ?>
                        </div>
                    </div>
                </div>
                <div class="span3">
                    <div class="control-group">
                        <div class="control-label">
							<?php echo $this->form->getLabel('latitude'); ?>
                        </div>
                        <div class="controls">
							<?php echo $this->form->getInput('latitude'); ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="control-label">
							<?php echo $this->form->getLabel('longitude'); ?>
                        </div>
                        <div class="controls">
							<?php echo $this->form->getInput('longitude'); ?>
                        </div>
                    </div>

                    <hr>
                    <div class="control-group">
                        <div class="control-label">
			                <?php echo $this->form->getLabel('ll_c'); ?>
                        </div>
                        <div class="controls">
			                <?php echo $this->form->getInput('ll_c'); ?>
                        </div>
                    </div>
                    <div id="ll_custom_enable">
                        <p><small><?php echo JText::_('COM_DD_GMAPS_LOCATIONS_FIELD_LATITUDE_LONGITUDE_CUSTOM_ENABLE_DESC')?></small></p>
                        <div class="control-group">
                            <div class="control-label">
			                    <?php echo $this->form->getLabel('latitude_c'); ?>
                            </div>
                            <div class="controls">
			                    <?php echo $this->form->getInput('latitude_c'); ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="control-label">
			                    <?php echo $this->form->getLabel('longitude_c'); ?>
                            </div>
                            <div class="controls">
			                    <?php echo $this->form->getInput('longitude_c'); ?>
                            </div>
                        </div>
                        <p><a href="javascript:void(0)"
                              class="btn btn-danger"
                              id="geoaddressclear">⚑ <?php echo JText::_('COM_DD_GMAPS_LOCATIONS_GEOHARDCODE_UNSET')?>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
			<?php echo JHtml::_('bootstrap.endTab'); ?>

			<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'images', JText::_('COM_DD_GMAPS_LOCATIONS_LOCATION_IMAGES')); ?>
            <div class="row-fluid form-horizontal-desktop">
                <div class="span9">
                    <div class="control-group">
                        <div class="control-label">
							<?php echo $this->form->getLabel('profileimage'); ?>
                        </div>
                        <div class="controls">
							<?php echo $this->form->getInput('profileimage'); ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="control-label">
							<?php echo $this->form->getLabel('image'); ?>
                        </div>
                        <div class="controls">
							<?php echo $this->form->getInput('image'); ?>
                        </div>
                    </div>
                </div>
            </div>
			<?php echo JHtml::_('bootstrap.endTab'); ?>

			<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'location-details', JText::_('COM_DD_GMAPS_LOCATIONS_LOCATION_DETAILS')); ?>
            <div class="row-fluid form-horizontal-desktop">
                <div class="span3">
                    <div class="control-group">
                        <div class="control-label">
							<?php echo $this->form->getLabel('company'); ?>
                        </div>
                        <div class="controls">
							<?php echo $this->form->getInput('company'); ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="control-label">
							<?php echo $this->form->getLabel('contact_person'); ?>
                        </div>
                        <div class="controls">
							<?php echo $this->form->getInput('contact_person'); ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="control-label">
							<?php echo $this->form->getLabel('url'); ?>
                        </div>
                        <div class="controls">
							<?php echo $this->form->getInput('url'); ?>
                        </div>
                    </div>
                </div>
                <div class="span3">
                    <div class="control-group">
                        <div class="control-label">
							<?php echo $this->form->getLabel('phone'); ?>
                        </div>
                        <div class="controls">
							<?php echo $this->form->getInput('phone'); ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="control-label">
							<?php echo $this->form->getLabel('mobile'); ?>
                        </div>
                        <div class="controls">
							<?php echo $this->form->getInput('mobile'); ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="control-label">
							<?php echo $this->form->getLabel('fax'); ?>
                        </div>
                        <div class="controls">
							<?php echo $this->form->getInput('fax'); ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="control-label">
							<?php echo $this->form->getLabel('email'); ?>
                        </div>
                        <div class="controls">
							<?php echo $this->form->getInput('email'); ?>
                        </div>
                    </div>
                </div>
            </div>
			<?php echo JHtml::_('bootstrap.endTab'); ?>

	        <?php if($this->params->get('ext_c_connect')): ?>
                <?php echo JHtml::_('bootstrap.addTab', 'myTab', 'location-thirparyconnect', JText::_('COM_DD_GMAPS_LOCATIONS_LOCATION_THIRDPARTYCONNECT')); ?>
                <div class="row-fluid form-horizontal-desktop">
                    <div class="span6">
                        <div class="control-group">
                            <div class="control-label">
                                <?php echo $this->form->getLabel('ext_c_id'); ?>
                            </div>
                            <div class="controls">
                                <?php echo $this->form->getInput('ext_c_id'); ?>
                            </div>
                        </div>

                        <div class="tab-description alert alert-info">
                            <span class="icon-info" aria-hidden="true"></span>
                            <?php echo JText::_('COM_DD_GMAPS_LOCATIONS_FIELD_EXT_C_ID_NOTE'); ?>
                        </div>

                    </div>
                </div>
                <?php echo JHtml::_('bootstrap.endTab');?>
	        <?php endif;?>

			<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'publishing', JText::_('COM_DD_GMAPS_LOCATIONS_LOCATION_PUBLISHING')); ?>
            <div class="row-fluid form-horizontal-desktop">
                <div class="span3">
                    <div class="control-group">
                        <div class="control-label">
			                <?php echo $this->form->getLabel('created'); ?>
                        </div>
                        <div class="controls">
			                <?php echo $this->form->getInput('created'); ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="control-label">
			                <?php echo $this->form->getLabel('published_up'); ?>
                        </div>
                        <div class="controls">
			                <?php echo $this->form->getInput('published_up'); ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="control-label">
			                <?php echo $this->form->getLabel('published_down'); ?>
                        </div>
                        <div class="controls">
			                <?php echo $this->form->getInput('published_down'); ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="control-label">
			                <?php echo $this->form->getLabel('hits'); ?>
                        </div>
                        <div class="controls">
			                <?php echo $this->form->getInput('hits'); ?>
                        </div>
                    </div>
                </div>
                <div class="span3">
                    <div class="control-group">
                        <div class="control-label">
                            <?php echo $this->form->getLabel('metadesc'); ?>
                        </div>
                        <div class="controls">
                            <?php echo $this->form->getInput('metadesc'); ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="control-label">
                            <?php echo $this->form->getLabel('metakey'); ?>
                        </div>
                        <div class="controls">
                            <?php echo $this->form->getInput('metakey'); ?>
                        </div>
                    </div>
                </div>
            </div>
			<?php echo JHtml::_('bootstrap.endTab'); ?>

			<?php echo JHtml::_('bootstrap.endTabSet'); ?>
            <input type="hidden" name="task" value=""/>
			<?php echo JHtml::_('form.token'); ?>
        </div>
    </div>
</form>
</div>
