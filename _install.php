<?php
/**
 * @brief LastCommentExtended, a plugin for Dotclear 2
 *
 * @package Dotclear
 * @subpackage Plugin
 *
 * @Pierre Van Glabeke, Bernard Le Roux and contributors
 *
 * @copyright GPL-2.0 https://www.gnu.org/licenses/gpl-2.0.html
 */
if (!defined('DC_CONTEXT_ADMIN')) { 
	return; 
}
require_once dirname(__FILE__).'/ConstLCE.php';

$currentVersion = dcCore::app()->getVersion( ConstLCE::NS);
 
if (version_compare( $currentVersion, ConstLCE::VERSION,'>=')) {
	return;
}
dcCore::app()->setVersion(ConstLCE::NS, ConstLCE::VERSION);
return true;
