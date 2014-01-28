<?php
/**
 *
 * @package    mahara
 * @subpackage auth-internal
 * @author     Catalyst IT Ltd
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL version 3 or later
 * @copyright  For copyright information on Mahara, please see the README file distributed with this software.
 *
 */

function xmldb_auth_internal_upgrade($oldversion=0) {
    if ($oldversion < 2007062900) {

        $auth_instance = new stdClass();
        $auth_instance->instancename='internal';
        $auth_instance->priority='1';
        $auth_instance->institution='mahara';
        $auth_instance->authname='internal';
        $auth_instance->id = insert_record('auth_instance',$auth_instance, 'id', true);

        if (empty($auth_instance->id)) {
            return false;
        }

        $table = new XMLDBTable('usr');
        $key   = new XMLDBKey("authinstancefk");
        $key->setAttributes(XMLDB_KEY_FOREIGN, array('authinstance'), 'auth_instance', array('id'));
        add_key($table, $key);

        return true;
    }

    return true;
}
