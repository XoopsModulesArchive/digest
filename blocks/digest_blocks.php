<?php
// $Id: digest.php,v 1.2 2004/09/08 22:46:20 phppp Exp $
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
// URL: http://xoops.org.cn                                                  //
// ------------------------------------------------------------------------- //

include_once XOOPS_ROOT_PATH.'/modules/digest/include/functions.php';

function b_digest_show($options)
{
    static $digest_arrary;
    $block = array();

	if(!isset($digest_arrary)){
		$digest_handler =& xoops_getmodulehandler('digest', 'digest');
	    $digest_arrary =& $digest_handler->getByCategory();
    }
	if(count($digest_arrary)==0){
		$block['items'] = null;
		return $block;
	}

    $total_items = 1;
    $total_ok = false;
	foreach ( $digest_arrary as $digest_id => $digest ) {
		$title = $digest->getVar('title');
		$description = $digest->getVar('description');
    	$digest_title ='<a href="'.XOOPS_URL.'/modules/digest/index.php?category_id='.$digest->getVar('category_id').'#'.$digest_id.'" title="'.$description.'">'.$title.'</a>';
		$lastupdate = digest_timeDiff(time()-$digest->getVar('lastupdate'));
        $items = @$digest->getVar('items');
        $i=1;
  		if(is_array($items)&&count($items)>0){
	    	foreach( $items as $item ){
	        	$_title=$item['title'];
				$_title = xoops_substr($_title,0, $options[3]-strlen($title),"-");
	        	$_title = '<a href="'.XOOPS_URL.'/modules/digest/index.php?category_id='.$digest->getVar('category_id').'#'.$digest_id.'" title="'.$lastupdate.'">'.$_title.'</a>';
	        	$block['items'][]= '['.$digest_title.']'.$_title;
	        	$i++;
	        	$total_items++;
	        	if($options[1]>0 && $i>$options[1]) break;
	        	if($options[2]>0 && $total_items>$options[2]) {
    				$total_ok = true;
		        	break;
	        	}
	    	}
    	}
    	if($total_ok) break;
	}
	if(strtolower($options[0]) == 'scroll'){
		$block['scrolldelay'] = $options[4];
		$block['scrollamount'] = $options[5];
	}else{
		$block['columns'] = $options[4];
	}

  	return $block;
}

function b_digest_edit($options) {
    $form = "<input type='hidden' name='options[0]' value='".$options[0]."' />";
    $form .= _MB_DIGEST_ITEM_DIGEST."&nbsp;<input type='text' name='options[1]' value='".$options[1]."' size = '20'/><br />";
    $form .= _MB_DIGEST_ITEM_TOTAL."&nbsp;<input type='text' name='options[2]' value='".$options[2]."' size = '20'/><br />";
    $form .= _MB_DIGEST_TITLELENGTH."&nbsp;<input type='text' name='options[3]' value='".$options[3]."' size = '20'/><br />";
	if(strtolower($options[0]) == 'scroll'){
    	$form .= _MB_DIGEST_SCROLL_DELAY."&nbsp;<input type='text' name='options[4]' value='".$options[4]."' size = '20'/><br />";
    	$form .= _MB_DIGEST_SCROLL_AMOUNT."&nbsp;<input type='text' name='options[5]' value='".$options[5]."' size = '20'/><br />";
	}else{
    	$form .= _MB_DIGEST_COLUMNS."&nbsp;<input type='text' name='options[4]' value='".$options[4]."' size = '20'/><br />";
	}
    return $form;
}
?>