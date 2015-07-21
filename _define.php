<?php 
/*
# This is 'LastCommentExtended', a plugin for Dotclear 2
# Copyright (c) 2013-2015
# Pierre Van Glabeke, Bernard Le Roux.
#
# This is an open source software, distributed under the GNU
# General Public License (version 2) terms and  conditions.
#
# You should have received a copy of the GNU General Public
# License along with 'LCE' (see LICENCE.txt);
# if not, write to the Free Software Foundation, Inc.,
# 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/
if (!defined('DC_RC_PATH')) { 
	return; 
}

$this->registerModule(
	/* Name */			'LastCommentExtended',
	/* Description*/	'Extensive list of latest comments posted',
	/* Author */		'Pierre Van Glabeke, Bernard Le Roux',
	/* Version */		'0.3.1',
	/* Properties */
	array(
		'permissions' => 'admin',
		'type' => 'plugin',
		'dc_min' => '2.7',
		'support' => 'http://forum.dotclear.org/viewtopic.php?pid=326232#p326232',
		'details' => 'https://github.com/brol/LastCommentExtended/wiki'
	)
);