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
$GLOBALS['core']->addBehavior('initWidgets',array('adminLCE','initWidget'));

class adminLCE
{
	private static function adjustDefaults(&$p)
	{
		
		if (!is_array($p)) {
			$r = array();
		} else {
			$r = $p;
		}
		
		$p = array();
		$p['homeonly'] = empty($r['homeonly'])
			? false
			: true;
		$p['c_limit'] = isset($r['c_limit'])
			? abs((integer) $r['c_limit'])
			: ConstLCE::C_LIMIT;
		$p['t_limit'] = isset($r['t_limit'])
			? abs((integer) $r['t_limit'])
			: ConstLCE::T_LIMIT;
		$p['co_limit'] = !empty($r['co_limit'])
			? abs((integer) $r['co_limit'])
			: 80;
		$p['title'] = isset($r['title'])
			? (string) $r['title']
			: __('Last comments');
		$p['stringformat'] = !empty($r['stringformat'])
			? (string) $r['stringformat']
			: '<a href="%5$s" title="%4$s">%2$s - %3$s<br/>%1$s</a>';
		
		$settingSystem = $GLOBALS['core']->blog->settings->system;
		
		$p['dateformat'] = !empty($r['dateformat'])
			? (string) $r['dateformat']
			: $settingSystem->date_format.','.
			  $settingSystem->time_format;
	}
	
	private static function truncate($str,$maxlength,$html=true)
	{
		// On rend la chaîne lisible
		if ($html) {
			$str = html::decodeEntities(html::clean($str));
		}
		
		// On coupe la chaîne si elle est trop longue
		if (mb_strlen($str) > $maxlength) {
			$str = text::cutString($str,$maxlength).'…';
		}
		
		// On encode la chaîne pour pouvoir l'insérer dans un document HTML
		return html::escapeHTML($str);
	}
	
	public static function showWidget($w)
	{
		$homeonly = (int)$w->homeonly;
		$urlType = (string)$GLOBALS['core']->url->type;
		if (($homeonly === 1 && $urlType !== 'default') ||
			($homeonly === 2 && $urlType === 'default')) {
			return;
		}
		
		$p = array( 't_limit' => $w->t_limit,
			'c_limit' => $w->c_limit,
			'co_limit' => $w->co_limit,
			'title' => $w->title,
			'stringformat' => $w->stringformat,
			'dateformat' => $w->dateformat);
		
		adminLCE::adjustDefaults($p);
		
		$title = $class = $divE = $divB = '';
		if ( $p['title']) {
			$title = '<h2>'.html::escapeHTML($p['title']).'</h2>';
		}
		if ( $w->class) {
			$class = html::escapeHTML( $w->class);
		}
		if ( $w->content_only) {
			$divB = '<div class="lastcomments '.$class.'">';
			$divE = '</div>';
		}

		return $divB . $title . self::show($p) . $divE;
	}
	
	public static function initWidget($w)
	{
		$p = array();
		adminLCE::adjustDefaults($p);
		
		$w->create('lastcomments_lce',__('Last comments with LCE plugin'),
			array('adminLCE','showWidget'));
		$lce = $w->lastcomments_lce;
		$lce->setting('title',
			__('Title:'),$p['title']);
		$lce->setting('c_limit',
			__('Comments limit:'),$p['c_limit']);
		$lce->setting('t_limit',
			__('Title lenght limit:'),$p['t_limit']);
		$lce->setting('co_limit',
			__('Comment lenght limit:'),$p['co_limit']);
		$lce->setting('dateformat',
			__('Date format (leave empty to use default blog format):'),$p['dateformat']);
		$lce->setting('stringformat',
			__('String format (%1$s = date ; %2$s = title ; %3$s = author ; %4$s = content of the comment ; %5$s = comment URL):'),
			$p['stringformat']);
		$lce->setting('homeonly',__('Display on:'),0,'combo',
			array(
				__('All pages') => 0,
				__('Home page only') => 1,
				__('Except on home page') => 2
				)
		);
		$lce->setting('content_only',__('Content only'),0,'check');
		$lce->setting('class',__('CSS class:'),'');
	
	}
	
	public static function showTpl($attr)
	{
		adminLCE::adjustDefaults($attr);
		
		return '<?php echo publicLCE::show(unserialize(\''.
			 addcslashes(serialize($attr),'\'\\').'\')); ?>';
	}
	
	public static function show( $p)
	{
		$rs = $GLOBALS['core']->blog->getComments( 
				array( 'limit' => $p['c_limit'], 'order' => 'comment_dt desc'));
		
		if ($rs->isEmpty()) {
			return;
		}
		
		$url = $date = $title = $author = $comment = '';
		$s_url = strpos($p['stringformat'],'%5$s') === false ? false : true;
		$s_date = strpos($p['stringformat'],'%1$s') === false ? false : true;
		$s_title = strpos($p['stringformat'],'%2$s') === false ? false : true;
		$s_author = strpos($p['stringformat'],'%3$s') === false ? false : true;
		$s_comment = strpos($p['stringformat'],'%4$s') === false ? false : true;
		
		$res = array();
		while ($rs->fetch())
		{
			if ($s_url) {
				$url = $rs->getPostURL().'#c'.$rs->comment_id;
			}
			if ($s_date) {
				$date = $rs->getTime( $p['dateformat']);
			}
			if ($s_title) {
				$title = self::truncate( $rs->post_title, $p['t_limit'], false);
			}
			if ($s_author) {
				$author = html::escapeHTML($rs->comment_author);
			}
			if ($s_comment) {
				$comment = self::truncate($rs->comment_content, $p['co_limit']);
			}
			$res[] = sprintf( $p['stringformat'], $date, $title, $author, $comment, $url) ;
		}
		return'<ul><li>'.implode('</li><li>', $res).'</li></ul>';
	}
}
