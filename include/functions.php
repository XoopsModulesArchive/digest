<?php
// $Id: functions.php,v 1.5 2004/09/20 22:36:31 phppp Exp $
//  ------------------------------------------------------------------------ //
//                        DIGEST for XOOPS                                   //
//             Copyright (c) 2004 Xoops China Community                      //
//                    <http://www.xoops.org.cn/>                             //
//  ------------------------------------------------------------------------ //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
//                                                                           //
//  You may not change or alter any portion of this comment or credits       //
//  of supporting developers from this source code or any supporting         //
//  source code which is considered copyrighted (c) material of the          //
//  original comment or credit authors.                                      //
//                                                                           //
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  along with this program; if not, write to the Free Software              //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
//  ------------------------------------------------------------------------ //
// Author: D.J.(phppp) php_pp@hotmail.com                                    //
// URL: http://www.xoops.org.cn                                              //
// ------------------------------------------------------------------------- //
include XOOPS_ROOT_PATH.'/modules/digest/include/vars.php';
/*
if ( file_exists( XOOPS_ROOT_PATH."/modules/digest/language/" . $xoopsConfig['language'] . "/main.php" ) ) {
    include_once(XOOPS_ROOT_PATH."/modules/digest/language/" . $xoopsConfig['language'] . "/main.php");
}elseif ( file_exists( XOOPS_ROOT_PATH."/modules/digest/language/english/main.php" ) ) {
    include_once(XOOPS_ROOT_PATH."/modules/digest/language/english/main.php");
}
*/
function digest_export($digests)
{
	$export_file = DIGEST_EXPORT_FILE;
	if(!$fp = fopen($export_file,'w')) {
		//echo "<br> the update file can not be created";
		return false;
	}

	$digest_handler =& xoops_getmodulehandler('digest', 'digest');
	if(is_array($digests) && in_array(0,$digests)) {
		$_digests = & $digest_handler->getByCategory(0, '', false);
	}
	elseif(is_array($digests) && count($digests)>0) $_digests = & $digest_handler->getByIds($digests, '', false);
	else {
		$_digests = & $digest_handler->get(intval($digests));
		$_digests = empty($_digest)?false:array($_digest);
	}
    $file_content  = "; database file created on ".date("Y-m-d H:i:s")." for ".XOOPS_URL."\n";
    $file_content .= "; For any question, contact http://xoops.org.cn\n\n";
 	if ( count( $_digests ) > 0 ) foreach($_digests as $digest){
        $file_content .= "[".$digest->getVar('digest_id')."]\n";
	    $file_content .= "title = \"".$digest->getVar('title')."\"\n";
	    $file_content .= "description = \"".$digest->getVar('description')."\"\n";
	    $file_content .= "url = \"".$digest->getVar('url')."\"\n";
	    $file_content .= "image = \"".$digest->getVar('image')."\"\n";
	    $file_content .= "offset = ".$digest->getVar('offset')."\n";
	    $file_content .= "maxitems = ".$digest->getVar('maxitems')."\n";
	    $file_content .= "minlength = ".$digest->getVar('minlength')."\n";
	    $file_content .= "charset = \"".$digest->getVar('charset')."\"\n";
	    $file_content .= "charset_inter = \"".$digest->getVar('charset_inter')."\"\n";
	    $file_content .= "updatetime = ".$digest->getVar('updatetime')."\n";
	    $file_content .= "reg_exp = \"".$digest->getVar('reg_exp')."\"\n";
	    $file_content .= "criteria = \"".$digest->getVar('criteria')."\"\n";
	    $file_content .= "\n";
	    unset($digest);
	}
    fputs($fp,$file_content);
    fclose($fp);
	return str_replace(XOOPS_ROOT_PATH, XOOPS_URL, $export_file);
}

function digest_import($import_file, $category)
{
	if(!is_readable($import_file)) {
		echo "<br />the imported file can not be read".$import_file;
		return false;
	}
	$digest = parse_ini_file($import_file, true);
	$digest_handler =& xoops_getmodulehandler('digest', 'digest');
 	if(empty( $digest )) return false;
 	foreach($digest as $_digest){
    	$dig = $digest_handler->create();
    	$dig->setVar("category_id", intval($category));
	    $dig->setVar("title", $_digest['title']);
	    $dig->setVar("description", $_digest['description']);
	    $dig->setVar("url", $_digest['url']);
	    $dig->setVar("image", $_digest['image']);
	    $dig->setVar("offset", intval($_digest['offset']));
	    $dig->setVar("maxitems", intval($_digest['maxitems']));
	    $dig->setVar("minlength", intval($_digest['minlength']));
	    $dig->setVar("charset", $_digest['charset']);
	    $dig->setVar("charset_inter", $_digest['charset_inter']);
	    $dig->setVar("updatetime", intval($_digest['updatetime']));
	    $dig->setVar("reg_exp", $_digest['reg_exp']);
	    $dig->setVar("criteria", $_digest['criteria']);
	    $dig->setVar("online", 1);
	    $digest_handler->insert($dig);
	}
	return true;
}

function xoops_module_install_digest(&$module)
{
	digest_createUpdateApi($module);
	return true;
}

function digest_createUpdateApi(&$module)
{
	global $xoopsConfig;
	$file_update = DIGEST_API_FILE;
	digest_mkdir(dirname($file_update));
	if(!$fp = @fopen($file_update,'w')) {
		//echo "<br> the update file can not be created";
		return false;
	}

    $update_url = XOOPS_URL."/modules/".$module->getVar('dirname')."/update.php";
    if(ini_get('allow_url_fopen')){
		$file_content = "\ninclude(\"".$update_url."\");";
	}elseif (function_exists('curl_init')){
        $file_content = "\n	\$ch = curl_init();";
	    $file_content .= "\n	curl_setopt(\$ch, CURLOPT_URL, \"$update_url\");";
	    $file_content .= "\n	curl_setopt(\$ch, CURLOPT_TIMEOUT, 30);";
	    $file_content .= "\n	\$data = curl_exec(\$ch);";
	    $file_content .= "\n	curl_close(\$ch);";
    }elseif(function_exists('fsockopen')){
		$URI_PARTS = parse_url($update_url);
		$host = $URI_PARTS["host"];
		$path = $URI_PARTS["path"];
		if ($path=="") $path = "/";
		if ($socket = fsockopen($host, 80)) {
	        $file_content = "\n	\$socket = fsockopen(\"".$host."\", 80);";
			$file_content .= "\n	fputs(\$socket, \"GET $path HTTP/1.0\\r\\n\");";
			$file_content .= "\n	fputs(\$socket, \"Host: $host\\r\\n\");";
			$file_content .= "\n	fputs(\$socket, \"User-Agent: Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)\\r\\n\");";
			$file_content .= "\n	fputs(\$socket, \"\\r\\n\");";
			$file_content .= "\n	while (!feof(\$socket)) {\$file = fgets(\$socket, 10000);}";
			$file_content .= "\n	fclose(\$socket);";
		}else{
			return false;
		}
    }else{
	    return false;
    }

    fputs($fp,"<?php".$file_content."\n?>");
    fclose($fp);
    return true;
}


function xoops_module_update_digest(&$module)
{
	$file_update = XOOPS_ROOT_PATH.'/modules/digest/update.php';
	if(!touch($file_update)) return false;
	if(!$fp = fopen($file_update,'w')) return false;
	$file_content = "
	<?php\n
	include '".XOOPS_ROOT_PATH."/mainfile.php';\n
	ob_start();\n
	echo \"\\nDigest@".$xoopsConfig['sitename']." @ \"\.date('Y-m-d H:i:s',time());\n
	\$digest_handler =& xoops_getmodulehandler('digest', 'digest');\n
	\$digest_handler->update();\n
	\$msg = ob_get_contents(); \n
	ob_end_clean();\n
	echo \$msg;\n
	?>
	";
	return true;
}

function digest_timeDiff($timediff)
{
	$timediff = intval($timediff);
	$td = 0;

	if ($timediff < 120){
		eval("\$output = _MD_DIGEST_1_MINUTE_AGO;");
	}elseif ($timediff < 3600){
		eval("\$output = _MD_DIGEST_MINUTES_AGO;");
		$td = intval($timediff / 60);
	}else if ($timediff < 7200){
		eval("\$output = _MD_DIGEST_1_HOUR_AGO;");
	}else if ($timediff < 86400){
		eval("\$output = _MD_DIGEST_HOURS_AGO;");
		$td = intval($timediff / 3600);
	}else if ($timediff < 172800){
		eval("\$output = _MD_DIGEST_1_DAY_AGO;");
	}else if ($timediff < 604800){
		eval("\$output = _MD_DIGEST_DAYS_AGO;");
		$td = intval($timediff / 86400);
	}else if ($timediff < 1209600){
		eval("\$output = _MD_DIGEST_1_WEEK_AGO;");
	}else{
		eval("\$output = _MD_DIGEST_WEEKS_AGO;");
		$td = intval($timediff / 604900);
	}
	return  sprintf( $output, $td);
}

/*
 * From NewBB 2.0 Project
 *
 */
function digest_mkdir($target)
{
	// http://www.php.net/manual/en/function.mkdir.php
	// saint at corenova.com
	// bart at cdasites dot com
	if (is_dir($target)||empty($target)) return true; // best case check first
	if (file_exists($target) && !is_dir($target)) return false;
	if (digest_mkdir(substr($target,0,strrpos($target,'/'))))
	  if (!file_exists($target)) return mkdir($target); // crawl back up & create dir tree
	return true;
}
?>