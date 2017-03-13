<?php
/**
 * @version    1-1-0-0 // Y-m-d 2017-03-08
 * @author     HR IT-Solutions Florian Häusler https://www.hr-it-solutions.com
 * @copyright  Copyright (C) 2011 - 2017 Didldu e.K. | HR IT-Solutions
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 **/

defined('_JEXEC') or die;

$listOrder = '';
$listDirn = '';

?>
<div id="dd_gmaps_locations-locations" class="row-fluid dd_gmaps_locations">
    <form action="<?php echo JRoute::_('index.php?option=com_dd_gmaps_locations&view=locations'); ?>" method="post" name="adminForm" id="adminForm">
        <?php if (!empty($this->sidebar)):?>
        <div id="j-sidebar-container" class="span2">
        <?php echo $this->sidebar; ?>
        </div>
        <div id="j-main-container" class="span10">
        <?php else: ?>
        <div id="j-main-container" class="span12">
        <?php endif; ?>
            <div class="clearfix"></div>
            <table class="table table-striped" id="dd_gmaps_locationsList">
                <thead>
                    <th width="1%" class="center hidden-phone">
                        <input type="checkbox" name="check-toggle" value=""
                               title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>"
                               onclick="Joomla.checkAll(this)" />
                    </th>
                    <th style="min-width: 100px" class="nowrap title">
                        <?php echo JHtml::_('grid.sort', 'JGLOBAL_TITLE', 'a.title', $listDirn, $listOrder); ?>
                    </th>
                    <th style="min-width: 100px" width="12%" class="nowrap">
	                    <?php echo JHtml::_('grid.sort', 'COM_DD_GMAPS_LOCATIONS_HEADING_COMPANY', 'a.company', $listDirn, $listOrder); ?>
                    </th>
                    <th width="10%" class="nowrap hidden-phone">
	                    <?php echo JHtml::_('grid.sort', 'COM_DD_GMAPS_LOCATIONS_HEADING_CONTACT_PERSON', 'a.contact_person', $listDirn, $listOrder); ?>
                    </th>
                    <th width="6%" class="nowrap hidden-phone">
	                    <?php echo JHtml::_('grid.sort', 'COM_DD_GMAPS_LOCATIONS_HEADING_PHONE', 'a.phone', $listDirn, $listOrder); ?>
                    </th>
                    <th width="10%" class="nowrap hidden-phone">
	                    <?php echo JHtml::_('grid.sort', 'COM_DD_GMAPS_LOCATIONS_HEADING_EMAIL', 'a.email', $listDirn, $listOrder); ?>
                    </th>
                    <th width="10%" class="nowrap">
	                    <?php echo JHtml::_('grid.sort', 'COM_DD_GMAPS_LOCATIONS_HEADING_STREET', 'a.street', $listDirn, $listOrder); ?>
                    </th>
                    <th width="10%" class="nowrap">
	                    <?php echo JHtml::_('grid.sort', 'COM_DD_GMAPS_LOCATIONS_HEADING_LOCATION', 'a.location', $listDirn, $listOrder); ?>
                    </th>
                    <th width="4%" class="nowrap">
	                    <?php echo JHtml::_('grid.sort', 'COM_DD_GMAPS_LOCATIONS_HEADING_ZIP', 'a.zip', $listDirn, $listOrder); ?>
                    </th>
                    <th width="10%" class="nowrap">
	                    <?php echo JHtml::_('grid.sort', 'COM_DD_GMAPS_LOCATIONS_HEADING_COUNTRY', 'a.country', $listDirn, $listOrder); ?>
                    </th>
                    <th width="10%" class="nowrap hidden-phone">
	                    <?php echo JHtml::_('grid.sort', 'JCATEGORY', 'c.category_title', $listDirn, $listOrder); ?>
                    </th>
                    <th width="1%" class="nowrap hidden-phone">
	                    <?php echo JHtml::_('grid.sort', 'JGRID_HEADING_ID', 'a.id', $listDirn, $listOrder); ?>
                    </th>
                </thead>
                <tbody>
                <?php foreach ($this->items as $i => $item): ?>
                    <tr class="row<?php echo $i % 2; ?>">
                        <td class="center hidden-phone">
                            <?php echo JHtml::_('grid.id', $i, $item->id); ?>
                        </td>
                        <td class="nowrap">
                            <a href="<?php echo JRoute::_('index.php?option=com_dd_gmaps_locations&task=location.edit&id=' . (int) $item->id);?> ">
                                <?php echo $this->escape($item->title);?>
                            </a>
                        </td>
                        <td class="nowrap">
	                        <?php echo $this->escape($item->company); ?>
                        </td>
                        <td class="nowrap hidden-phone">
		                    <?php echo $this->escape($item->contact_person); ?>
                        </td>
                        <td class="nowrap hidden-phone">
		                    <?php echo $this->escape($item->phone); ?>
                        </td>
                        <td class="nowrap hidden-phone">
		                    <?php echo $this->escape($item->email); ?>
                        </td>
                        <td class="nowrap">
		                    <?php echo $this->escape($item->street); ?>
                        </td>
                        <td class="nowrap">
		                    <?php echo $this->escape($item->location); ?>
                        </td>
                        <td class="nowrap">
		                    <?php echo $this->escape($item->zip); ?>
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

            <input type="hidden" name="task" value="" />
            <input type="hidden" name="boxckecked" value="0" />
            <input type="hidden" name="filter_order" value="<?php echo $listDirn; ?>">
            <input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>">

            <div class="row-fluid">

                <hr>
                <!-- Component Credits -->
                <div class="text-center">
                    <p><small><?php echo nl2br(JText::sprintf('COM_DD_GMAPS_LOCATIONS_CREDITS', DD_GMaps_LocationsHelper::getComponentCoyright())); ?></small></p>
                </div>
            </div>
        </div>
    </form>
</div>