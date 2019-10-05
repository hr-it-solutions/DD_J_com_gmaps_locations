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
<div class="dd_gmaps_locations categories well">
<div class="row-fluid">
	<?php foreach ($this->items as $i => $item): ?>
	<?php if ($i % 3 == 0){ echo '</div><div class="row-fluid">'; } ?>
    <div class="span4 category well">
        <h5 class="pull-left"><?php echo $this->escape($item->title); ?></h5>
	    <?php if($this->params->get('count_items')):?>
        <span class="badge pull-right"><?php echo $item->count; ?></span>
        <hr class="clear">
        <?php endif; ?>
        <img src="<?php echo json_decode($item->params)->image; ?>" alt="<?php echo json_decode($item->params)->image_alt; ?>">
        <hr>
        <div class="category-desc">
            <?php echo $item->description; ?>
        </div>
        <form name="categories_<?php echo $item->id; ?>" action="<?php echo JRoute::_('index.php?option=com_dd_gmaps_locations&view=locations'); ?>" method="post" role="search">
            <input type="hidden" name="category_filter" value="<?php echo $item->id; ?>">
            <button class="btn" type="submit"><?php echo $this->escape($item->title); ?></button>
        </form>
    </div>
<?php endforeach;?>
</div>
</div>
