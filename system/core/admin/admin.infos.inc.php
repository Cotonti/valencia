<?PHP
/**
 * Administration panel
 *
 * @package Cotonti
 * @version 0.0.3
 * @author Neocrome, Cotonti Team
 * @copyright Copyright (c) Cotonti Team 2008-2009
 * @license BSD
 */

if(!defined('SED_CODE') || !defined('SED_ADMIN')){die('Wrong URL.');}

list($usr['auth_read'], $usr['auth_write'], $usr['isadmin']) = sed_auth('admin', 'a');
sed_block($usr['auth_read']);

$t = new XTemplate(sed_skinfile('admin.infos.inc', false, true));

$adminpath[] = array (sed_url('admin', 'm=other'), $L['Other']);
$adminpath[] = array (sed_url('admin', 'm=infos'), $L['adm_infos']);
$adminhelp = $L['adm_help_versions'];

@error_reporting(0);

$t -> assign(array(
	"ADMIN_INFOS_PHPVER" => (function_exists('phpversion')) ? phpversion() : $L['adm_help_config'],
	"ADMIN_INFOS_ZENDVER" => (function_exists('zend_version')) ? zend_version() : $L['adm_help_config'],
	"ADMIN_INFOS_INTERFACE" => (function_exists('php_sapi_name')) ? php_sapi_name() : $L['adm_help_config'],
	"ADMIN_INFOS_OS" => (function_exists('php_uname')) ? php_uname() : $L['adm_help_config'],
	"ADMIN_INFOS_DATE" => date("Y-m-d H:i"),
	"ADMIN_INFOS_GMDATE" => gmdate("Y-m-d H:i"),
	"ADMIN_INFOS_GMTTIME" => $usr['gmttime'],
	"ADMIN_INFOS_USRTIME" => date($cfg['dateformat'], $sys['now_offset'] + $usr['timezone'] * 3600),
	"ADMIN_INFOS_TIMETEXT" => $usr['timetext']
));

$t -> parse("INFOS");
$adminmain = $t -> text("INFOS");

@error_reporting(7);

?>