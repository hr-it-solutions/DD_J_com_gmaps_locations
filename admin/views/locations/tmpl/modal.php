<?php
/**
 * @package    DD_GMaps_Locations
 *
 * @author     HR-IT-Solutions Florian Häusler <info@hr-it-solutions.com>
 * @copyright  Copyright (C) 2016 - 2018 HR-IT-Solutions GmbH
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 **/

defined('_JEXEC') or die;

$app       = JFactory::getApplication();

if ($app->isSite()) {
	JSession::checkToken('get') or die(JText::_('JINVALID_TOKEN'));
}

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');

JHtml::_('behavior.core');
JHtml::_('behavior.polyfill', array('event'), 'lt IE 9');
JHtml::_('script', 'com_dd_gmaps_locations/admin.dd_gmaps_locations.min.js', array('version' => 'auto', 'relative' => true));

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

$function  = $app->input->getCmd('function', 'jSelectArticle');
$onclick   = $this->escape($function);
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
	<form action="<?php echo JRoute::_('index.php?option=com_dd_gmaps_locations&view=locations&layout=modal&tmpl=component&function=' . $function . '&' . JSession::getFormToken() . '=1'); ?>" method="post" name="adminForm" id="adminForm">
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
                    <th style="min-width: 100px" class="nowrap title">
                        <?php echo JHtml::_('searchtools.sort', 'JGLOBAL_TITLE', 'a.title', $listDirn, $listOrder); ?>
                    </th>
                    <th width="30%" class="nowrap hidden-phone">
                        <?php echo JHtml::_('searchtools.sort', 'JCATEGORY', 'c.category_title', $listDirn, $listOrder); ?>
                    </th>
                    <th width="1%" class="nowrap hidden-phone">
                        <?php echo JHtml::_('searchtools.sort', 'JGRID_HEADING_ID', 'a.id', $listDirn, $listOrder); ?>
                    </th>
                    </thead>
                    <tfoot>
                    <tr>
                        <td colspan="4">
                            <?php echo $this->pagination->getListFooter(); ?>
                        </td>
                    </tr>
                    </tfoot>
                    <tbody>
                    <?php foreach ($this->items as $i => $item): ?>
                        <tr class="row<?php echo $i % 2; ?>">
                            <td class="nowrap">
	                            <?php $attribs = 'data-function="' . $this->escape($onclick) . '"'
		                            . ' data-id="' . $item->id . '"'
		                            . ' data-title="' . $this->escape(addslashes($item->title)) . '"'
		                            . ' data-uri="' . $this->escape('index.php?option=com_dd_gmaps_locations&view=profile&id=' . (int) $item->id) . '"'
	                            ?>
                                <a class="select-link" href="javascript:void(0)" rel="nofollow" <?php echo $attribs; ?>>
		                            <?php echo $this->escape($item->title); ?>
                                </a>
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
        </div>
	</form>
</div>
