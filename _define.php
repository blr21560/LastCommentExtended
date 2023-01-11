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
if (!defined('DC_RC_PATH')) {
    return;
}

$this->registerModule(
    'LastCommentExtended',
    'Extensive list of latest comments posted',
    'Pierre Van Glabeke, Bernard Le Roux and contributors',
    '1.0-dev',
    [
        'requires'    => [['core', '2.24']],
        'permissions' => dcCore::app()->auth->makePermissions([
            dcAuth::PERMISSION_ADMIN,
        ]),
        'type'        => 'plugin',
        'support'     => 'http://forum.dotclear.org/viewtopic.php?pid=326232#p326232',
        'details'     => 'https://plugins.dotaddict.org/dc2/details/' . basename(__DIR__),
    ]
);
