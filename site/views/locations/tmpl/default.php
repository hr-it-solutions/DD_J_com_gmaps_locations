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

foreach ($this->items as $item): ?>
<?php if ($i % 2 == 0): ?>
    </div>
    <div class="row-fluid">
<?php endif; ?>
        <address class="span6 location well">
            <div class="page-header">
                <strong>
                    <a href="<?php echo JRoute::_($this->sef_rewrite ? $this->active_alias . '/' . $item->alias : 'index.php?option=com_dd_gmaps_locations&view=profile&profile_id=' . $item->id); ?>">
                        <?php echo htmlspecialchars($item->title, ENT_QUOTES, 'UTF-8'); ?>
                    </a>
                </strong>
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
	                <?php echo htmlspecialchars($item->company, ENT_QUOTES, 'UTF-8'); ?><br>
	                <?php echo htmlspecialchars($item->street, ENT_QUOTES, 'UTF-8'); ?><br>
	                <?php echo htmlspecialchars($item->zip, ENT_QUOTES, 'UTF-8') . ' ' . htmlspecialchars($item->location, ENT_QUOTES, 'UTF-8'); ?><br>
	                <?php echo $item->federalstate ? htmlspecialchars($item->federalstate, ENT_QUOTES, 'UTF-8') . ', ' : ' '; ?>
	                <?php echo JText::_($item->country); ?>
                </div>
                <div class="span6">
                    <div class="page-header map_bar">
                        <a href="">
	                        <?php echo JText::_('COM_DD_GMAPS_LOCATIONS_SHOW_ON_MAP'); ?>
                        </a>
                    </div>
                    <img src="<?php echo JUri::base() . htmlspecialchars($item->image, ENT_QUOTES, 'UTF-8'); ?>"
                         alt="<?php echo htmlspecialchars($item->title, ENT_QUOTES, 'UTF-8'); ?>">
                </div>
            </div>

            <div class="row-span">
                <hr>
                <a class="btn pull-right btn-primary" href="<?php echo JRoute::_($this->sef_rewrite ? $this->active_alias . '/' . $item->alias : 'index.php?option=com_dd_gmaps_locations&view=profile&profile_id=' . $item->id); ?>">
	                <?php echo JText::_('COM_DD_GMAPS_LOCATIONS_PROFILE_PAGE'); ?>
                </a>
                <p>
                    <?php echo htmlspecialchars($item->short_description, ENT_QUOTES, 'UTF-8'); ?>
                    <?php echo htmlspecialchars($item->description, ENT_QUOTES, 'UTF-8'); ?>
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
