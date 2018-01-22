<?php
/**
 * @package    DD_GMaps_Locations
 *
 * @author     HR IT-Solutions Florian Häusler <info@hr-it-solutions.com>
 * @copyright  Copyright (C) 2011 - 2018 Didldu e.K. | HR IT-Solutions
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 **/

defined('_JEXEC') or die;

?>

<div class="span8">
    <strong class="row-title">
        <?php if ($this->item->installed == 1 && $this->item->type == 'plugin'):?>
            <a href="index.php?option=com_plugins&task=plugin.edit&extension_id=<?php echo (int) $this->item->extension_id; ?>" target="_blank"><?php echo $this->item->label . '&nbsp;'; ?><span class="icon-wrench"></span></a>
        <?php else: ?>
	        <?php echo $this->item->label; ?>
        <?php endif; ?>
    </strong>
    <br>
    <?php if ($this->item->installed == 1): ?>
        <span class="badge badge-success hasTip"
              title="<?php echo JText::_('COM_DD_GMAPS_LOCATIONS_EXTENSIONS_BADGE_INSTALLED_DESC'); ?>">
            <?php echo JText::_('COM_DD_GMAPS_LOCATIONS_EXTENSIONS_BADGE_INSTALLED')?>
        </span>
    <?php endif; ?>
    <?php if ($this->item->enabled == 1): ?>
        <span class="badge badge-info hasTip"
              title="<?php echo JText::_('COM_DD_GMAPS_LOCATIONS_EXTENSIONS_BADGE_AKTIVE_DESC'); ?>">
            <?php echo JText::_('COM_DD_GMAPS_LOCATIONS_EXTENSIONS_BADGE_AKTIVE')?>
        </span>
    <?php endif; ?>
    <?php if (($this->item->required == 1 && $this->item->installed != 1) || ($this->item->required == 1 && $this->item->enabled != 1)): ?>
        <span class="badge badge-important hasTip"
              title="<?php echo JText::_('COM_DD_GMAPS_LOCATIONS_EXTENSIONS_BADGE_REQUIRED_DESC'); ?>">
            <span class="icon-warning"></span> <?php echo JText::_('COM_DD_GMAPS_LOCATIONS_EXTENSIONS_BADGE_REQUIRED')?>
        </span>
    <?php endif; ?>
</div>
<div class="span4">
    <?php if($this->item->pkg == 'base'):?>
        <span class="badge badge-warning hasTip badge-pkg"
              title="<?php echo JText::_('COM_DD_GMAPS_LOCATIONS_EXTENSIONS_BADGE_PKG_DESC'); ?>">
            <?php echo $this->item->pkg; ?>
        </span>
    <?php else: ?>
        <span class="badge badge-inverse hasTip badge-pkg"
              title="<?php echo JText::_('COM_DD_GMAPS_LOCATIONS_EXTENSIONS_BADGE_PKG_DESC'); ?>">
            <?php echo $this->item->pkg; ?>
        </span>
    <?php endif; ?>
</div>
