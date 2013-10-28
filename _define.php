<?php 
/***************************************************************
 *  This is 'LCE', a plugin for Dotclear 2                     *
 *                                                             *
 *  Copyright (c) 2013                                         *
 *  Pierre Van Glabeke, Bernard Le Roux.                       *
 *                                                             *
 *  This is an open source software, distributed under the GNU *
 *  General Public License (version 2) terms and  conditions.  *
 *                                                             *
 *  You should have received a copy of the GNU General Public  *
 *  License along with 'LCE' (see LICENCE.txt);                *
 *  if not, write to the Free Software Foundation, Inc.,       *
 *  59 Temple Place, Suite 330, Boston, MA  02111-1307  USA    *
***************************************************************/
if (!defined('DC_RC_PATH')) { 
	return; 
}
require_once dirname(__FILE__).'/ConstLCE.php';

$this->registerModule(
	/* Name */			ConstLCE::PLUGINNAME,
	/* Description*/	ConstLCE::NS,
	/* Author */		'Pierre Van Glabeke, Bernard Le Roux',
	/* Version */		ConstLCE::VERSION,
	/* Properties */
	array(
		'permissions' => 'admin',
		'type' => 'plugin',
		'dc_min' => '2.5',
		'support' => 'http://forum.dotclear.org/viewtopic.php?pid=323166#p323166',
		'details' => 'http://plugins.dotaddict.org/dc2/details/dcom'
	)
);
