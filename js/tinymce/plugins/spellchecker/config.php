<?php
/**
 * config.php
 *
 * @package MCManager.includes
 */
	// General settings
	$config['general.engine'] = 'GoogleSpell';
	//$config['general.engine'] = 'PSpell';
	//$config['general.engine'] = 'PSpellShell';
	//$config['general.remote_rpc_url'] = 'http://some.other.site/some/url/rpc.php';
	
	define('INTERNAL', 1);
	require_once(dirname(__FILE__).'/../../../../init.php');
	$aspellpath = get_config('pathtoaspell');
	if (file_exists($aspellpath) && is_executable($aspellpath)) {
		$config['general.engine'] = 'PSpellShell';
	}
	
	    // PSpell settings
	$config['PSpell.mode'] = 'PSPELL_FAST';
	$config['PSpell.spelling'] = "";
	$config['PSpell.jargon'] = "";
	$config['PSpell.encoding'] = "";

	// PSpellShell settings
	$config['PSpellShell.mode'] = 'PSPELL_FAST';
	$config['PSpellShell.aspell'] = $aspellpath;
	$config['PSpellShell.tmp'] = '/tmp';

	// Windows PSpellShell settings
	//$config['PSpellShell.aspell'] = '"c:\Program Files\Aspell\bin\aspell.exe"';
	//$config['PSpellShell.tmp'] = 'c:/temp';
?>
