<?php
/**
 *
 * @package    mahara
 * @subpackage artefact-resume
 * @author     Catalyst IT Ltd
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL version 3 or later
 * @copyright  For copyright information on Mahara, please see the README file distributed with this software.
 *
 */

define('INTERNAL', true);
define('MENUITEM', 'content/resume');
define('SECTION_PLUGINTYPE', 'artefact');
define('SECTION_PLUGINNAME', 'resume');
define('SECTION_PAGE', 'index');
define('RESUME_SUBPAGE', 'achievements');

require_once(dirname(dirname(dirname(__FILE__))) . '/init.php');
define('TITLE', get_string('resume', 'artefact.resume'));
require_once('pieforms/pieform.php');
safe_require('artefact', 'resume');

$compositetypes = array(
    'certification',
    'book',
    'membership'
);
$inlinejs = ArtefactTypeResumeComposite::get_js($compositetypes);
$compositeforms = ArtefactTypeResumeComposite::get_forms($compositetypes);

$smarty = smarty(array('tablerenderer'));
$smarty->assign('compositeforms', $compositeforms);
$smarty->assign('INLINEJAVASCRIPT', $inlinejs);
$smarty->assign('PAGEHEADING', TITLE);
$smarty->assign('SUBPAGENAV', PluginArtefactResume::submenu_items());
$smarty->display('artefact:resume:achievements.tpl');
