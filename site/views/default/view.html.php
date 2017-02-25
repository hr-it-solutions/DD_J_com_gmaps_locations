<?php
/**
 * @version    1-1-0-0 // Y-m-d 2017-02-25
 * @author     HR IT-Solutions Florian Häusler https://www.hr-it-solutions.com
 * @copyright  Copyright (C) 2011 - 2017 Didldu e.K. | HR IT-Solutions
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 **/

defined('_JEXEC') or die;

class DD_Maps_LocationsViewDefault extends JViewLegacy {
    protected $items;
    function display($tpl = null)
    {
        $this->items = $this->get('items');
        return parent::display($tpl);
    }
}