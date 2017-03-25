<?php
/**
 * @version    1-1-0-0 // Y-m-d 2017-02-25
 * @author     HR IT-Solutions Florian Häusler https://www.hr-it-solutions.com
 * @copyright  Copyright (C) 2011 - 2017 Didldu e.K. | HR IT-Solutions
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 **/

defined('_JEXEC') or die;

?>

<div class="dd_gmaps_locations locations well">
    <div class="row-fluid">
    <?php

$i = 0;
foreach ($this->items as $item):?>
<?php if($i % 2 == 0): ?>
    </div>
    <div class="row-fluid">
<?php endif; ?>
        <address class="span6 location well">
            <div class="page-header">
                <strong><a href="<?php echo JRoute::_('index.php?option=com_dd_gmaps_locations&view=profile&id=2')?>"><?php echo $item->title; ?></a></strong>
                <span class="view-icon"></span>
                <span class="views">10k</span>
                <span class="label new"><?php echo JText::_('COM_DD_GMAPS_LOCATIONS_NEW'); ?></span>
                <span class="label featured"><?php echo JText::_('COM_DD_GMAPS_LOCATIONS_FEATURED'); ?></span>
            </div>
            <div class="row-span">
                <div class="span6">
                    <div class="page-header map_bar">
                        <a href="">
		                    <?php echo JText::_('COM_DD_GMAPS_LOCATIONS_DISCTANCE'); ?>
                        </a>
                    </div>
                    <?php
                    echo $item->company . "<br>";
	                echo $item->street . "<br>";
	                echo $item->zip . ' ' . $item->location . "<br>";
	                echo $item->federalstate ? $item->federalstate . ', ' : ' ';
                    echo JText::_($item->country);
	                ?>
                </div>
                <div class="span6">
                    <div class="page-header map_bar">
                        <a href="">
	                        <?php echo JText::_('COM_DD_GMAPS_LOCATIONS_SHOW_ON_MAP'); ?>
                        </a>
                    </div>
                    <img src="<?php echo JUri::base() . $item->image; ?>"
                         alt="<?php echo $item->title; ?>">
                </div>
            </div>

            <div class="row-span">
                <hr>
                <a href="" class="btn pull-right btn-primary"><?php echo JText::_('COM_DD_GMAPS_LOCATIONS_PROFILE_PAGE'); ?></a>
                <p>
                    <?php echo $item->short_description; ?>
                    <?php echo $item->description; ?>
                </p>
            </div>
        </address>
<?php
++$i;
endforeach;?>

        <div class="clear"></div>

        <div class="load-more">
            <button class="btn"><?php echo JText::_('COM_DD_GMAPS_LOCATIONS_LOAD_MORE'); ?></button>
        </div>
    </div>
</div>
