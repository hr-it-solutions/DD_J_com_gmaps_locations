<?php
/**
 * @version    1-1-0-1 // Y-m-d 2017-04-02
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
                <?php if($this->item->profileimage): ?>
                    <img class="span6" src="<?php echo JUri::base() . htmlspecialchars($this->item->profileimage, ENT_QUOTES, 'UTF-8'); ?>"
                         alt="<?php echo htmlspecialchars($this->item->title, ENT_QUOTES, 'UTF-8'); ?>">
                    <div class="clear"></div><br>
                <?php endif; ?>
					<strong><?php echo JText::_('COM_DD_GMAPS_LOCATIONS_ADDRESS'); ?>:</strong><br>
					<?php
                    echo htmlspecialchars($this->item->street, ENT_QUOTES, 'UTF-8') . '<br>' .
                         htmlspecialchars($this->item->zip, ENT_QUOTES, 'UTF-8')    . ' ' .
                         htmlspecialchars($this->item->location, ENT_QUOTES, 'UTF-8') . ', ' .
                         $this->item->federalstate ? htmlspecialchars($this->item->federalstate, ENT_QUOTES, 'UTF-8') . ', ' : ' ' .
                         JText::_($this->item->country) . '<br>';
					?>
                <?php if( $this->item->contact_person || $this->item->phone || $this->item->mobile || $this->item->fax): ?>
                    <br>
                    <strong><?php echo JText::_('COM_DD_GMAPS_LOCATIONS_CONTACT_DETAILS'); ?>:</strong>
	                <?php
                    echo $this->item->contact_person ? htmlspecialchars($this->item->contact_person, ENT_QUOTES, 'UTF-8') . '<br>':'' .
                         $this->item->phone   ? JText::_('COM_DD_GMAPS_LOCATIONS_CONTACT_PHONE')  . htmlspecialchars($this->item->phone, ENT_QUOTES, 'UTF-8')  . '<br>' : '' .
                         $this->item->mobile  ? JText::_('COM_DD_GMAPS_LOCATIONS_CONTACT_MOBILE') . htmlspecialchars($this->item->mobile, ENT_QUOTES, 'UTF-8') . '<br>' : '' .
                         $this->item->fax     ? JText::_('COM_DD_GMAPS_LOCATIONS_CONTACT_EMAIL')  . htmlspecialchars($this->item->fax, ENT_QUOTES, 'UTF-8')    . '<br>' : '' .
                         $this->item->email   ? JText::_('COM_DD_GMAPS_LOCATIONS_CONTACT_FAX')    . JHtml::_('email.cloak', $this->item->email) . '<br>' : '';
                    ?>
                <?php endif; ?>
                <?php if( $this->item->url): ?>
                    <strong><?php echo JText::_('COM_DD_GMAPS_LOCATIONS_WEBADDRESS'); ?>:</strong>
                    <?php echo $this->item->url ? htmlspecialchars($this->item->url, ENT_QUOTES, 'UTF-8') :''; ?>
                <?php endif; ?>
                </div>
				<div class="span6">
					<img src="<?php echo JUri::base() . htmlspecialchars($this->item->image, ENT_QUOTES, 'UTF-8'); ?>"
					     alt="<?php echo htmlspecialchars($this->item->title, ENT_QUOTES, 'UTF-8'); ?>">
                    <div class="clear"></div><br>
                    <a class="btn pull-right btn-primary" href="<?php echo JRoute::_($this->sef_rewrite ? $this->active_alias . '/' . $this->item->alias : 'index.php?option=com_dd_gmaps_locations&view=profile&profile_id=' . $this->item->id); ?>">
						<?php echo JText::_('COM_DD_GMAPS_LOCATIONS_PROFILE_PAGE'); ?>
                    </a>
				</div>
			</div>
			<div class="row-span">
				<hr>
				<p>
					<?php echo htmlspecialchars($this->item->description, ENT_QUOTES, 'UTF-8'); ?>
				</p>
			</div>
		</address>
		<div class="clear"></div>
	</div>
</div>

