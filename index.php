<?php
// $Id: index.php,v 1.7 2004/09/29 18:50:29 phppp Exp $
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
include 'header.php';
include_once XOOPS_ROOT_PATH.'/modules/digest/include/functions.php';

$op = ( isset( $_GET['op'] ) )? $_GET['op']:'';
$digest_id = ( isset( $_GET['digest_id'] ) )?intval( $_GET['digest_id'] ):0;
$category_id = ( isset( $_GET['category_id'] ) )?intval( $_GET['category_id'] ):0;

$category_handler =& xoops_getmodulehandler('category', 'digest');
$digest_handler =& xoops_getmodulehandler('digest', 'digest');

if(!empty($digest_id))  {
	$digest = $digest_handler->get( $digest_id );
	$category_id = $digest->getVar('category_id');
}

if( "update" == $op){
	if(!empty($digest_id)) {
		$digest_handler->update( $digest, true );
		redirect_header( XOOPS_URL."/modules/digest/index.php?digest_id=".$digest_id."&#35;".$digest_id, 2, _MD_DIGEST_DBUPDATED );
	}else{
		$digest_handler->updateByCategory( $category_id );
		redirect_header( 'index.php?category_id='.$category_id, 2, _MD_DIGEST_DBUPDATED );
	}
}

$category_array=& $category_handler->getAll();
if(empty($category_id))foreach ($category_array as $category_id=>$category) {
	if($category_id) break;
}

$nav_tabs = array();
$category = array();
if(count($category_array)>0) foreach ($category_array as $id=>$cat) {
	$tab['title'] = $cat->getVar('title');
	if($category_id != $id) {
		$tab['link'] = XOOPS_URL."/modules/digest/index.php?category_id=".$id;
	}else{
		$category['title'] = '<a href="index.php?op=update&amp;category_id='.$category_id.'" title="'._MD_DIGEST_UPDATE.'">'.$cat->getVar('title').'</a>';
        $category['image']= ($cat->getVar('image'))? '<img src="'.XOOPS_URL.'/'.$xoopsModuleConfig['image_path'].'/'.$cat->getVar('image').'" alt="'.$cat->getVar('title').'" />':'';
	}
	$nav_tabs[] = $tab;
	unset($tab);
}

$digest_arr =& $digest_handler->getByCategory( $category_id );
$digests = array();
if(is_array($digest_arr) && count($digest_arr)>0){
    foreach( $digest_arr as $digest ){
	    $_digest=array();
        $_digest['digest_id']=$digest->getVar('digest_id');
        $_digest['url']=$digest->getVar('url');
        $_digest['description']=$digest->getVar('description');
        $_digest['title']=$digest->getVar('title');
        $_digest['image']= ($digest->getVar('image'))? '<img src="'.XOOPS_URL.'/'.$xoopsModuleConfig['image_path'].'/'.$digest->getVar('image').'" alt="'.$_digest['title'].'" />':'';
        $items = @$digest->getVar('items');
        if(is_array($items)&&count($items)>0){
	    	foreach( $items as $item ){
				$_title = xoops_substr($item['title'], 0, $xoopsModuleConfig['title_length'], "-");
				$_digest['items'][]='<a target="'.$_digest['title'].'" href="'.$item['url'].'" title="'.$item['title'].'">'.$_title.'</a>';
	    	}
    	}
        $_digest['update']='<a href="index.php?op=update&amp;digest_id='.$_digest['digest_id'].'" title="'._MD_DIGEST_LASTUPDATE.': '.digest_timeDiff(time()-$digest->getVar('lastupdate')).'">'._MD_DIGEST_UPDATE.'</a>';
        $digests[]=$_digest;
        unset($_digest);
    }
}

$footer = trim($xoopsModuleConfig['footer']);
$footer = ($footer)? $footer."<br />":"";
$footer .= "<a href='"._MD_DIGEST_FORHELP_URL."' title='".$xoopsModule->getVar('name').' v'.$xoopsModule->getInfo('version')." "._MD_DIGEST_FORHELP."' target='_blank'><img src='".XOOPS_URL."/modules/".$xoopsModule->getVar('dirname')."/images/digest.png' alt='".$xoopsModule->getVar('name').' v'.$xoopsModule->getInfo('version')." "._MD_DIGEST_FORHELP."' /></a>";

$custom = '';
if(!empty($xoopsModuleConfig['allow_custom'])){
	$custom = "<a href=\"custom.php?category_id=".$category_id."\" title='"._MD_DIGEST_CUSTOM."' target='_blank'>"._MD_DIGEST_CUSTOM."</a>";
}

$xoops_module_header = "<link rel='stylesheet' type='text/css' href='".XOOPS_URL."/modules/digest/include/digest.css' />";
$xoopsOption['template_main'] = 'digest_index.html';
include XOOPS_ROOT_PATH.'/header.php';
$xoopsTpl->assign('xoops_module_header', $xoops_module_header);
$xoopsTpl->assign('nav_tabs', $nav_tabs);
$xoopsTpl->assign('category', $category);
$xoopsTpl->assign('digests', $digests);
$xoopsTpl->assign('two_column', $xoopsModuleConfig['two_column']);
$xoopsTpl->assign('header', $xoopsModuleConfig['header']);
$xoopsTpl->assign('footer', $footer);
$xoopsTpl->assign('custom', $custom);

include_once XOOPS_ROOT_PATH.'/footer.php';
?>