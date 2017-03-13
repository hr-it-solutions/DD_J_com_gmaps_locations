<?php
/**
 * @version    1-1-0-0 // Y-m-d 2017-03-13
 * @author     HR IT-Solutions Florian Häusler https://www.hr-it-solutions.com
 * @copyright  Copyright (C) 2011 - 2017 Didldu e.K. | HR IT-Solutions
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 **/

defined('_JEXEC') or die;

?>
<form action="<?php echo JRoute::_('index.php?option=com_location&layout=edit&id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="adminForm" class="form-validate">
	<div class="row-fluid">
		<div class="span10 form-horizontal">
			<fieldset>
				<?php echo JHtml::_('bootstrap.startPane', 'myTab', 'details', empty($this->item->id)) ? JText::_('COM_DD_GMAPS_LOCATIONS_NEW_LOCATION', true) : JText::sprintf('COM_DD_GMAPS_LOCATIONS_NEW_LOCATION', $this->item->id, true); ?>
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
						<?php echo $this->form->getLabel('catid'); ?>
                    </div>
                    <div class="controls">
						<?php echo $this->form->getInput('catid'); ?>
                    </div>
                </div>
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
						<?php echo $this->form->getLabel('url'); ?>
					</div>
					<div class="controls">
						<?php echo $this->form->getInput('url'); ?>
					</div>
				</div>
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
					</div>
				</div>
				<div class="control-group">
					<div class="control-label">
						<?php echo $this->form->getLabel('country'); ?>
					</div>
					<div class="controls">
						<?php echo $this->form->getInput('country'); ?>
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
				<div class="control-group">
					<div class="control-label">
						<?php echo $this->form->getLabel('description'); ?>
					</div>
					<div class="controls">
						<?php echo $this->form->getInput('description'); ?>
					</div>
				</div>
				<div class="control-group">
					<div class="control-label">
						<?php echo $this->form->getLabel('short_description'); ?>
					</div>
					<div class="controls">
						<?php echo $this->form->getInput('short_description'); ?>
					</div>
				</div>
				<?php echo JHtml::_('bootstrap.endPanel'); ?>

				<input type="hidden" name="task" value="" />
				<?php echo JHtml::_('form.token'); ?>

				<?php echo JHtml::_('bootstrap.endPane'); ?>
			</fieldset>
		</div>
	</div>
</form>
