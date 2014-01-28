<?php
/**
 *
 * @package    mahara
 * @subpackage blocktype-groupviews
 * @author     Liip AG
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL version 3 or later
 * @copyright  For copyright information on Mahara, please see the README file distributed with this software.
 * @copyright  (C) 2010 Liip AG, http://www.liip.ch
 *
 */

defined('INTERNAL') || die();

require_once('group.php');
class PluginBlocktypeGroupViews extends SystemBlocktype {

    public static function get_title() {
        return get_string('title', 'blocktype.groupviews');
    }

    public static function get_description() {
        return get_string('description', 'blocktype.groupviews');
    }

    public static function single_only() {
        return false;
    }

    public static function get_categories() {
        return array('general');
    }

    public static function get_viewtypes() {
        return array('grouphomepage');
    }

    public static function hide_title_on_empty_content() {
        return true;
    }

    public static function render_instance(BlockInstance $instance, $editing=false) {
        $configdata = $instance->get('configdata');
        if (!isset($configdata['showgroupviews'])) {
            // If not set, use default
            $configdata['showgroupviews'] = 1;
        }
        if (!isset($configdata['showsharedviews'])) {
            $configdata['showsharedviews'] = 1;
        }
        $groupid = $instance->get_view()->get('group');
        if (!$groupid) {
            return '';
        }

        $data = self::get_data($groupid);

        $dwoo = smarty_core();
        $dwoo->assign('group', $data['group']);
        $dwoo->assign('groupid', $data['group']->id);
        if (!empty($configdata['showgroupviews']) && isset($data['groupviews'])) {
            $dwoo->assign('groupviews', $data['groupviews']->data);
        }
        if (!empty($configdata['showsharedviews']) && isset($data['sharedviews'])) {
            $dwoo->assign('sharedviews', $data['sharedviews']->data);
        }
        if (isset($data['allsubmitted'])) {
            $dwoo->assign('allsubmitted', $data['allsubmitted']);
        }
        if (isset($data['mysubmitted'])) {
            $dwoo->assign('mysubmitted', $data['mysubmitted']);
        }
        if (!$editing && isset($data['group_view_submission_form'])) {
            $dwoo->assign('group_view_submission_form', $data['group_view_submission_form']);
        }

        return $dwoo->fetch('blocktype:groupviews:groupviews.tpl');
    }

    public static function has_instance_config() {
        return true;
    }

    public static function instance_config_form($instance) {
        $configdata = $instance->get('configdata');
        return array(
            'showgroupviews' => array(
                'type' => 'radio',
                'description' => get_string('displaygroupviewsdesc', 'blocktype.groupviews'),
                'title' => get_string('displaygroupviews', 'blocktype.groupviews'),
                'options' => array(
                    1 => get_string('yes'),
                    0 => get_string('no'),
                ),
                'separator' => '<br>',
                'defaultvalue' => isset($configdata['showgroupviews']) ? $configdata['showgroupviews'] : 1,
            ),
            'showsharedviews' => array(
                'type' => 'radio',
                'title' => get_string('displaysharedviews', 'blocktype.groupviews'),
                'description' => get_string('displaysharedviewsdesc', 'blocktype.groupviews'),
                'options' => array(
                    1 => get_string('yes'),
                    0 => get_string('no'),
                ),
                'separator' => '<br>',
                'defaultvalue' => isset($configdata['showsharedviews']) ? $configdata['showsharedviews'] : 1,
            ),
        );
    }

    public static function default_copy_type() {
        return 'shallow';
    }

    protected static function get_data($groupid) {
        global $USER;

        if(!defined('GROUP')) {
            define('GROUP', $groupid);
        }
        // get the currently requested group
        $group = group_current_group();
        $role = group_user_access($group->id);
        if ($role) {
            // Get all views created in the group
            $sort = array(array('column' => 'type=\'grouphomepage\'', 'desc' => true));
            $data['groupviews'] = View::view_search(null, null, (object) array('group' => $group->id), null, null, 0, true, $sort);
            foreach ($data['groupviews']->data as &$view) {
                if (isset($view['template']) && $view['template']) {
                    $view['form'] = pieform(create_view_form(null, null, $view['id']));
                }
            }

            // For group members, display a list of views that others have
            // shared to the group
            $data['sharedviews'] = View::get_sharedviews_data(null, 0, $group->id);
            foreach ($data['sharedviews']->data as &$view) {
                if (isset($view['template']) && $view['template']) {
                    $view['form'] = pieform(create_view_form($group, null, $view->id));
                }
            }

            if (group_user_can_assess_submitted_views($group->id, $USER->get('id'))) {
                // Display a list of views submitted to the group
                list($collections, $views) = View::get_views_and_collections(null, null, null, null, false, $group->id);
                $data['allsubmitted'] = array_merge(array_values($collections), array_values($views));
            }
        }

        if ($group->submittableto) {
            require_once('pieforms/pieform.php');
            // A user can submit more than one view to the same group, but no view can be
            // submitted to more than one group.

            // Display a list of views this user has submitted to this group, and a submission
            // form containing drop-down of their unsubmitted views.

            list($collections, $views) = View::get_views_and_collections($USER->get('id'), null, null, null, false, $group->id);
            $data['mysubmitted'] = array_merge(array_values($collections), array_values($views));

            $data['group_view_submission_form'] = group_view_submission_form($group->id);
        }
        $data['group'] = $group;
        return $data;
    }

    public static function get_instance_title() {
        return get_string('title', 'blocktype.groupviews');
    }
}
