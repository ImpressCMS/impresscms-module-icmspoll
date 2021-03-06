<?php
/**
 * 'Icmspoll' is a poll module for ImpressCMS and iforum
 *
 * File: /blocks/icmspoll_single_result.php
 * 
 * block for displaying a single result
 * 
 * @copyright	Copyright QM-B (Steffen Flohrer) 2012
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
 * ----------------------------------------------------------------------------------------------------------
 * 				Icmspoll
 * @since		2.00
 * @author		QM-B <qm-b@hotmail.de>
 * @version		$Id$
 * @package		icmspoll
 *
 */

if (!defined("ICMS_ROOT_PATH")) die("ICMS root path not defined");
/**
 * display single result block
 */
function b_icmspoll_single_result_show($options) {
	global $icmspollConfig, $xoTheme;
	$moddir = basename(dirname(dirname(__FILE__)));
	include_once ICMS_ROOT_PATH . '/modules/' . $moddir . '/include/common.php';
	$polls_handler = icms_getModuleHandler("polls", ICMSPOLL_DIRNAME, "icmspoll");
	$options_handler = icms_getModuleHandler("options", ICMSPOLL_DIRNAME, "icmspoll");
	$pollObj = $polls_handler->get($options[0]);
	$block["icmspoll_singleresult"] = $pollObj->toArray();
	$block["options"] = $options_handler->getAllByPollId($options[0], "weight", "ASC");
	$block["icmspoll_url"] = ICMSPOLL_URL;
	$block["icmspoll_isAdmin"] = icms_userIsAdmin( ICMSPOLL_DIRNAME );
	$xoTheme->addStylesheet('/modules/' . ICMSPOLL_DIRNAME . '/module_icmspoll.css');
	return $block;
}

/**
 * edit recent result block
 */
function b_icmspoll_single_result_edit($options) {
	$moddir = basename(dirname(dirname(__FILE__)));
	include_once ICMS_ROOT_PATH . '/modules/' . $moddir . '/include/common.php';
	$polls_handler = icms_getModuleHandler("polls", ICMSPOLL_DIRNAME, "icmspoll");
	
	$polls = $polls_handler->getList();
	$selpoll = new icms_form_elements_Select('', 'options[0]', $options[0]);
	$selpoll->addOptionArray($polls);
	
	$form = '<table><tr>';
	$form .= '<td width="30%">' . _MB_ICMSPOLL_BLOCK_SELPOLL . '</td>';
	$form .= '<td>' . $selpoll->render() . '</td>';
	$form .= '</tr>';
	$form .= '</table>';
	return $form;
}