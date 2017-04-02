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
				<?php // Show hits
                if($this->params->get('show_hits')):?>
                <span class="view-icon"></span>
				<span class="views">10k</span>
				<?php endif; ?>
                <?php // Mark as new
                $mark_as_new = (int) $this->params->get('mark_as_new', 0);
                if( strtotime("-$mark_as_new days") < strtotime($this->item->created)):?>
				<span class="label new"><?php echo JText::_('COM_DD_GMAPS_LOCATIONS_NEW'); ?></span>
                <?php endif; ?>
                <?php // Featured
                if($this->item->featured != 0):?>
				<span class="label featured"><?php
                    if ($this->item->featured == 1){
	                    echo JText::_('COM_DD_GMAPS_LOCATIONS_FEATURED');
                    } elseif($this->item->featured == 2){
	                    echo htmlspecialchars($this->item->category_title, ENT_QUOTES, 'UTF-8');
                    }
				?></span>
                <?php endif; ?>
			</div>
			<div class="row-col">
				<div class="span6">
                <?php if($this->item->profileimage): ?>
                    <img class="span6" src="<?php echo JUri::base() . htmlspecialchars($this->item->profileimage, ENT_QUOTES, 'UTF-8'); ?>"
                         alt="<?php echo htmlspecialchars($this->item->title, ENT_QUOTES, 'UTF-8'); ?>">
                    <div class="clear"></div><br>
                <?php endif; ?>
                    <p>
					<strong><?php echo JText::_('COM_DD_GMAPS_LOCATIONS_ADDRESS'); ?>:</strong><br>
					<?php
                    echo htmlspecialchars($this->item->street, ENT_QUOTES, 'UTF-8') . '<br>';
					echo htmlspecialchars($this->item->zip, ENT_QUOTES, 'UTF-8')    . ' ';
                    echo htmlspecialchars($this->item->location, ENT_QUOTES, 'UTF-8') . ', ';
					echo $this->item->federalstate ? htmlspecialchars($this->item->federalstate, ENT_QUOTES, 'UTF-8') . ', ' : ' ';
					echo JText::_($this->item->country);
					?></p>
                <?php if( $this->item->contact_person || $this->item->phone || $this->item->mobile || $this->item->fax): ?>
                    <p>
                    <strong><?php echo JText::_('COM_DD_GMAPS_LOCATIONS_CONTACT_DETAILS'); ?>:</strong><br>
	                <?php
                    echo $this->item->contact_person ? htmlspecialchars($this->item->contact_person, ENT_QUOTES, 'UTF-8') . '<br>':'' .
                         $this->item->phone   ? JText::_('COM_DD_GMAPS_LOCATIONS_CONTACT_PHONE')  . ' ' . $this->item->phone  . '<br>' : '' .
                         $this->item->mobile  ? JText::_('COM_DD_GMAPS_LOCATIONS_CONTACT_MOBILE') . ' ' . $this->item->mobile . '<br>' : '' .
                         $this->item->fax     ? JText::_('COM_DD_GMAPS_LOCATIONS_CONTACT_FAX')  . ' ' . $this->item->fax    . '<br>' : '' .
                         $this->item->email   ? JText::_('COM_DD_GMAPS_LOCATIONS_CONTACT_EMAIL')    . ' ' . JHtml::_('email.cloak', $this->item->email) . '<br>' : '';
                    ?></p>
                <?php endif; ?>
                <?php if( $this->item->url): ?>
                    <p>
                    <strong><?php echo JText::_('COM_DD_GMAPS_LOCATIONS_WEBADDRESS'); ?>:</strong>
                    <?php echo $this->item->url ? htmlspecialchars($this->item->url, ENT_QUOTES, 'UTF-8') :''; ?></p>
                <?php endif; ?>
                </div>
				<div class="span6">
					<img src="<?php echo JUri::base() . htmlspecialchars($this->item->image, ENT_QUOTES, 'UTF-8'); ?>"
					     alt="<?php echo htmlspecialchars($this->item->title, ENT_QUOTES, 'UTF-8'); ?>">
				</div>
			</div>
			<div class="row-span">
				<hr>
				<?php echo $this->item->description; ?>
			</div>
		</address>
		<div class="clear"></div>
	</div>
</div>

