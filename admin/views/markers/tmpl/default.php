<?php
/**
 * @package    DD_GMaps_Locations
 *
 * @author     HR IT-Solutions Florian Häusler <info@hr-it-solutions.com>
 * @copyright  Copyright (C) 2011 - 2018 Didldu e.K. | HR IT-Solutions
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 **/

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');

JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');

?>

<div id="dd_gmaps_locations-markers" class="row-fluid dd_gmaps_locations">

    <form action="<?php echo JRoute::_('index.php?option=com_dd_gmaps_locations&view=markers'); ?>" method="post" name="adminForm" id="adminForm">
	<?php if (!empty( $this->sidebar)) : ?>
    <div id="j-sidebar-container" class="span2">
		<?php echo $this->sidebar; ?>
    </div>
    <div id="j-main-container" class="span10">
    <?php else : ?>
    <div id="j-main-container">
        <?php endif; ?>

        <div class="alert alert-info">
            <?php echo JText::_('COM_DD_GMAPS_LOCATIONS_MARKER_NOTICE'); ?>
        </div>

        <!-- Filter Bar -->
        <div id="filter-bar" class="btn-toolbar">
            <div class="filter-search btn-group pull-left">
                <label for="filter_search" class="element-invisible"><?php echo JText::_('COM_DD_GMAPS_LOCATIONS_SEARCH');?></label>
                <input type="text" name="filter_search" id="filter_search" placeholder="<?php echo JText::_('COM_DD_GMAPS_LOCATIONS_SEARCH'); ?>" value="<?php echo $this->escape($this->state->get('filter.search')); ?>" title="<?php echo JText::_('COM_DD_GMAPS_LOCATIONS_SEARCH'); ?>" />
            </div>
            <div class="btn-group pull-left">
                <button class="btn hasTooltip" type="submit" title="<?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?>"><i class="icon-search"></i></button>
                <button class="btn hasTooltip" type="button" title="<?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?>" onclick="document.getElementById('filter_search').value='';this.form.submit();"><i class="icon-remove"></i></button>
            </div>

            <div class="btn-group pull-right hidden-phone">
                <label for="limit" class="element-invisible"><?php echo JText::_('JFIELD_PLG_SEARCH_SEARCHLIMIT_DESC');?></label>
                <?php echo $this->pagination->getLimitBox(); ?>
            </div>

        </div>

        <!-- Table -->
        <div class="clearfix"></div>

        <?php if (empty($this->items)) : ?>
            <div class="alert alert-no-items">
                <?php echo JText::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
            </div>
        <?php else : ?>
            <table class="table table-striped" id="articleList">
                <thead>
                <th style="min-width: 100px" width="10%" class="nowrap title">
                    <?php echo JText::_('COM_DD_GMAPS_LOCATIONS_HEADING_MARKER_TITEL'); ?>
                </th>
                <th style="min-width: 100px" width="40%" class="nowrap">
                    <?php echo JText::_('COM_DD_GMAPS_LOCATIONS_HEADING_MARKER_IMAGE'); ?>
                </th>
                <th width="1%" class="nowrap hidden-phone">
                    <?php echo JText::_('JGRID_HEADING_ID'); ?>
                </th>
                </thead>
                <tfoot>
                <tr>
                    <td colspan="10">
                        <?php echo $this->pagination->getListFooter(); ?>
                    </td>
                </tr>
                </tfoot>
                <tbody>
                <?php foreach ($this->items as $i => $item):
                    ?>
                    <tr class="row<?php echo $i % 2; ?>">
                        <td class="nowrap">
                            <a href="<?php echo JRoute::_('index.php?option=com_categories&task=category.edit&id=' . (int) $item->id . '&extension=com_dd_gmaps_locations#attrib-basic');?> ">
                                <?php echo $this->escape($item->title);?>
                            </a>
                        </td>
                        <td class="nowrap">
                            <?php $params = json_decode($item->params); ?>
                            <img width="20"
                                 src="<?php echo JUri::root() . $params->image; ?>"
                                 alt="<?php echo $params->image_alt; ?>">
                        </td>
                        <td class="nowrap hidden-phone">
                            <?php echo (int) $item->id; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

        <input type="hidden" name="task" value="" />
        <input type="hidden" name="boxchecked" value="0" />
        <?php echo JHtml::_('form.token'); ?>

        <!-- Component Credits -->
        <div class="row-fluid">
            <hr>
            <div class="text-center">
                <p><small><?php echo nl2br(JText::sprintf('COM_DD_GMAPS_LOCATIONS_CREDITS', DD_GMaps_LocationsHelper::getComponentCoyright())); ?></small></p>
            </div>
        </div>
    </div>
</form>
</div>
