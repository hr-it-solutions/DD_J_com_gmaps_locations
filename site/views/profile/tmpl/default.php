<?php
/**
 * @package    DD_GMaps_Locations
 *
 * @author     HR-IT-Solutions Florian Häusler <info@hr-it-solutions.com>
 * @copyright  Copyright (C) 2011 - 2019 HR-IT-Solutions GmbH
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 **/

defined('_JEXEC') or die;

?>
<div class="dd_gmaps_locations profile well">
	<div class="row-fluid">
		<address class="span12 well">
			<div class="page-header">
				<h2>
					<?php echo $this->escape($this->item->title); ?>
				</h2>
				<?php // Show hits
                if($this->params->get('show_hits')):?>
                <span class="view-icon"></span>
				<span class="views"><?php
                    if($this->item->hits >= 1000){
	                    echo round($this->item->hits / 1000, 0) . 'k';
                    } else {
	                    echo $this->item->hits;
                    }
                    ?></span>
				<?php endif; ?>
                <?php // Mark as new
                $mark_as_new = (int) $this->params->get('mark_as_new', 0);
                if($mark_as_new AND strtotime("-$mark_as_new days") < strtotime($this->item->created)):?>
				<span class="label new"><?php echo JText::_('COM_DD_GMAPS_LOCATIONS_NEW'); ?></span>
                <?php endif; ?>
                <?php // Featured
                if($this->item->featured != 0):?>
				<span class="label featured"><?php
                    if ($this->item->featured == 1){
	                    echo JText::_('COM_DD_GMAPS_LOCATIONS_FEATURED');
                    } elseif($this->item->featured == 2){
	                    echo $this->escape($this->item->category_title);
                    }
				?></span>
                <?php endif; ?>
			</div>
			<div class="row-col">
				<div class="span6">
                <?php if($this->item->profileimage): ?>
                    <img class="span6" src="<?php echo JUri::base() . $this->escape($this->item->profileimage); ?>"
                         alt="<?php echo $this->escape($this->item->title); ?>">
                    <div class="clear"></div><br>
                <?php endif; ?>
                    <p>
                    <?php
                    if ($this->params->get('marker_in_entry') && $this->item->category_params && json_decode($this->item->category_params)->image): ?>
                        <img class="category_marker"
                             src="<?php echo $this->escape(str_replace('\\', '/', json_decode($this->item->category_params)->image)); ?>"
                             alt="<?php echo $this->escape(json_decode($this->item->category_params)->image_alt); ?>">
                    <?php endif; ?>
					<strong><?php echo JText::_('COM_DD_GMAPS_LOCATIONS_ADDRESS'); ?>:</strong><br>
					<?php
                    if($this->item->street != '' && $this->item->street != '⚑'):
	                    echo $this->escape($this->item->street) . '<br>';
                    endif;

					// Required adress block
					if (!in_array($this->item->zip, $this->emtpyFlag) && !in_array($this->item->location, $this->emtpyFlag)):
						echo $this->escape($this->item->zip) . ' ' . $this->escape($this->item->location) . ', ' . '<br>';
                    elseif (!in_array($this->item->zip, $this->emtpyFlag)):
						echo $this->escape($this->item->zip) . '<br>';
                    elseif (!in_array($this->item->location, $this->emtpyFlag)):
						echo $this->escape($this->item->location) . '<br>';
					endif;

					echo $this->item->federalstate ? $this->escape($this->item->federalstate) . ', ' : ' ';
					echo JText::_($this->item->country);
					?></p>
                <?php if( $this->item->contact_person || $this->item->phone || $this->item->mobile || $this->item->fax): ?>
                    <p>
                    <strong><?php echo JText::_('COM_DD_GMAPS_LOCATIONS_CONTACT_DETAILS'); ?>:</strong><br>
	                <?php
                    echo $this->item->contact_person ? $this->escape($this->item->contact_person) . '<br>':'';
                    echo $this->item->phone   ? JText::_('COM_DD_GMAPS_LOCATIONS_CONTACT_PHONE')  . ' ' . $this->escape($this->item->phone)  . '<br>' : '';
                    echo $this->item->mobile  ? JText::_('COM_DD_GMAPS_LOCATIONS_CONTACT_MOBILE') . ' ' . $this->escape($this->item->mobile) . '<br>' : '';
	                echo $this->item->fax     ? JText::_('COM_DD_GMAPS_LOCATIONS_CONTACT_FAX')  . ' ' . $this->escape($this->item->fax)    . '<br>' : '';
	                echo $this->item->email   ? JText::_('COM_DD_GMAPS_LOCATIONS_CONTACT_EMAIL')    . ' ' . JHtml::_('email.cloak', $this->escape($this->item->email) ). '<br>' : '';
                    ?></p>
                <?php endif; ?>
                <?php if( $this->item->url): ?>
                    <p>
                        <strong><?php echo JText::_('COM_DD_GMAPS_LOCATIONS_WEBADDRESS'); ?>:</strong>
                        <a href="<?php echo $this->escape($this->item->url); ?>"
                           title="<?php echo JText::_('COM_DD_GMAPS_LOCATIONS_WEBADDRESS') . ' ' . $this->escape($this->item->title); ?>">
                            <?php echo $this->escape($this->item->url); ?>
                        </a>
                    </p>
                <?php endif; ?>
                </div>
				<?php // Image ?>
				<div class="span6">
					<img src="<?php echo JUri::base() . $this->escape($this->item->image); ?>"
					     alt="<?php echo $this->escape($this->item->title); ?>">
				</div>
			</div>
        </address>
    </div>
    <div class="row-fluid">
        <div class="span12 well">

			<?php // Description ?>
            <div class="row-fluid">
                <div class="span12">
                    <hr>
	                <?php echo $this->item->description; ?>
                </div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>
