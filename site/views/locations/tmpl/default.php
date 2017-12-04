<?php
/**
 * @package    DD_GMaps_Locations
 *
 * @author     HR IT-Solutions Florian Häusler <info@hr-it-solutions.com>
 * @copyright  Copyright (C) 2011 - 2017 Didldu e.K. | HR IT-Solutions
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 **/

defined('_JEXEC') or die;

?>
<div class="dd_gmaps_locations locations well">
<div class="row-fluid">
<?php if (empty($this->items)): ?>
    <div class="alert alert-info center">
       <?php echo JText::_('COM_DD_GMAPS_LOCATIONS_NO_RESULT'); ?>
    </div>
<?php endif; ?>

<?php
foreach ($this->items as $i => $item):
    ?>
<?php if ($i % 2 == 0): ?>
</div>
<div class="row-fluid">
<?php endif; ?>

<?php if (JFile::exists($this->overridePath)): ?>
    <?php include $this->overridePath; ?>
<?php else: ?>
    <?php include JPATH_COMPONENT . '/views/locations/tmpl/default_items.php'; ?>
<?php endif; ?>

<?php
endforeach;?>
    <div id="InserBefore" class="clear"></div>
    <div class="load-more">
        <button id="load-more" class="btn"><?php echo JText::_('COM_DD_GMAPS_LOCATIONS_LOAD_MORE'); ?></button>
    </div>

    <script language="javascript" type="text/javascript">

        var start = <?php echo (int) $this->params->get('items_to_list', 6); ?>,
            limit = <?php echo (int) $this->params->get('items_more', 4); ?>,
            geolocate = '<?php echo $this->app->input->get('geolocate', '', 'STRING'); ?>',
            locationLatLng = '<?php echo $this->app->input->get('locationLatLng', 0, 'STRING'); ?>',
            fulltext_search = '<?php echo $this->app->input->get('fulltext_search', '', 'STRING'); ?>',
            category_filter = '<?php echo $this->app->input->get('category_filter', '', 'STRING'); ?>',
            federalstate_filter = '<?php echo $this->app->input->get('federalstate_filter', '', 'STRING'); ?>',
            activeAlias = '<?php echo $this->active_alias; ?>';

        jQuery('#load-more').click(function () {
            processAjax();
        });

        checkNextItems();
    </script>

</div>
</div>
