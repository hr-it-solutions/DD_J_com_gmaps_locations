<?php
/**
 * @package    DD_GMaps_Locations
 *
 * @author     HR-IT-Solutions Florian Häusler <info@hr-it-solutions.com>
 * @copyright  Copyright (C) 2016 - 2018 HR-IT-Solutions GmbH
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 **/

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');

JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');

$user		= JFactory::getUser();
$userId		= $user->id;

$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
$trashed	= $this->state->get('filter.published') == -2;
$saveOrder	= $listOrder == 'f.ordering';

if ($saveOrder)
{
	$saveOrderingUrl = 'index.php?option=com_dd_gmaps_locations&task=locations.saveOrderAjax&tmpl=component';
	JHtml::_('sortablelist.sortable', 'fieldList', 'adminForm', strtolower($listDirn), $saveOrderingUrl);
}

?>
<script type="text/javascript">
    Joomla.orderTable = function()
    {
        table = document.getElementById("sortTable");
        direction = document.getElementById("directionTable");
        order = table.options[table.selectedIndex].value;
        if (order !== '<?php echo $listOrder; ?>')
        {
            dirn = 'asc';
        }
        else
        {
            dirn = direction.options[direction.selectedIndex].value;
        }
        Joomla.tableOrdering(order, dirn, '');
    }
</script>
<div id="dd_gmaps_locations-locations" class="row-fluid dd_gmaps_locations">
    <form action="<?php echo JRoute::_('index.php?option=com_dd_gmaps_locations&view=locations'); ?>" method="post" name="adminForm" id="adminForm">
	<?php if (!empty( $this->sidebar)) : ?>
    <div id="j-sidebar-container" class="span2">
		<?php echo $this->sidebar; ?>
    </div>
    <div id="j-main-container" class="span10">
    <?php else : ?>
    <div id="j-main-container">
        <?php endif; ?>

        <!-- Filter Bar -->
	    <?php echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this)); ?>

        <!-- Table -->
        <div class="clearfix"></div>

        <?php if (empty($this->items)) : ?>
            <div class="alert alert-no-items">
                <?php echo JText::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
            </div>
        <?php else : ?>
            <table class="table table-striped" id="articleList">
                <thead>
                <th width="1%" class="center hidden-phone">
                    <input type="checkbox" name="check-toggle" value=""
                           title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>"
                           onclick="Joomla.checkAll(this)" />
                </th>
                <th width="1%" style="min-width: 55px;" class="nowrap center">
                    <?php echo JHtml::_('searchtools.sort', 'JSTATUS', 'a.state', $listDirn, $listOrder); ?>
                </th>
                <th style="min-width: 100px" class="nowrap title">
                    <?php echo JHtml::_('searchtools.sort', 'JGLOBAL_TITLE', 'a.title', $listDirn, $listOrder); ?>
                </th>
                <th width="10%" class="nowrap">
                    <?php echo JHtml::_('searchtools.sort', 'COM_DD_GMAPS_LOCATIONS_HEADING_STREET', 'a.street', $listDirn, $listOrder); ?>
                </th>
                <th width="10%" class="nowrap">
                    <?php echo JHtml::_('searchtools.sort', 'COM_DD_GMAPS_LOCATIONS_HEADING_LOCATION', 'a.location', $listDirn, $listOrder); ?>
                </th>
                <th width="4%" class="nowrap">
                    <?php echo JHtml::_('searchtools.sort', 'COM_DD_GMAPS_LOCATIONS_HEADING_ZIP', 'a.zip', $listDirn, $listOrder); ?>
                </th>
                <th width="10%" class="nowrap">
                    <?php echo JHtml::_('searchtools.sort', 'COM_DD_GMAPS_LOCATIONS_HEADING_COUNTRY', 'a.country', $listDirn, $listOrder); ?>
                </th>
                <th width="10%" class="nowrap hidden-phone">
                    <?php echo JHtml::_('searchtools.sort', 'JCATEGORY', 'c.category_title', $listDirn, $listOrder); ?>
                </th>
                <th width="1%" class="nowrap hidden-phone">
                    <?php echo JHtml::_('searchtools.sort', 'JGRID_HEADING_ID', 'a.id', $listDirn, $listOrder); ?>
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
                    $canCheckin = $user->authorise('core.manage',     'com_checkin') || $item->checked_out == $user->get('id') || $item->checked_out == 0;
                    $canChange  = $user->authorise('core.edit.state', 'com_dd_gmaps_locations') && $canCheckin;
                    ?>
                    <tr class="row<?php echo $i % 2; ?>">
                        <td class="center hidden-phone">
                            <?php echo JHtml::_('grid.id', $i, $item->id); ?>
                        </td>
                        <td class="center">
                            <?php echo JHtml::_('jgrid.published', $item->state, $i, 'locations.', $canChange, 'cb', $item->publish_up, $item->publish_down); ?>
                        </td>
                        <td class="nowrap">
                            <a href="<?php echo JRoute::_('index.php?option=com_dd_gmaps_locations&task=location.edit&id=' . (int) $item->id);?> ">
                                <?php echo $this->escape($item->title);?>
	                            <?php if($item->ext_c_id != '0'):  ?>
                                <span class="badge badge-success"><?php echo JText::_('COM_DD_GMAPS_LOCATIONS_THIRDPARTY'); ?></span>
	                            <?php endif;  ?>

	                            <?php if($item->ll_c != '1'):  ?>
                                <span class="badge badge-warning"><?php echo JText::_('COM_DD_GMAPS_LOCATIONS_GEOHARDCODE_BADGE'); ?></span>
	                            <?php endif;  ?>

                            </a>
                        </td>
                        <td class="nowrap">
                            <?php if($item->street != '⚑'):  ?>
	                            <?php echo $this->escape($item->street); ?>
	                        <?php else: ?>
	                            <span class="badge"><?php echo JText::_('COM_DD_GMAPS_LOCATIONS_GEOHARDCODE_FLAG'); ?></span>
                            <?php endif;  ?>
                        </td>
                        <td class="nowrap">
	                        <?php if($item->location != '⚑'):  ?>
		                        <?php echo $this->escape($item->location); ?>
	                        <?php else: ?>
                                <span class="badge"><?php echo JText::_('COM_DD_GMAPS_LOCATIONS_GEOHARDCODE_FLAG'); ?></span>
	                        <?php endif;  ?>
                        </td>
                        <td class="nowrap">
	                        <?php if($item->zip != '⚑'):  ?>
		                        <?php echo $this->escape($item->zip); ?>
	                        <?php else: ?>
                                <span class="badge"><?php echo JText::_('COM_DD_GMAPS_LOCATIONS_GEOHARDCODE_FLAG'); ?></span>
	                        <?php endif;  ?>
                        </td>
                        <td class="nowrap">
                            <?php echo JText::_($this->escape($item->country)); ?>
                        </td>
                        <td class="nowrap hidden-phone">
                            <?php echo $this->escape($item->category_title); ?>
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
