<?php
// $Id: categoryform.inc.php,v 1.1 2004/09/08 22:46:01 phppp Exp $
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

include_once(XOOPS_ROOT_PATH."/class/xoopsformloader.php");
$sform = new XoopsThemeForm(_AM_DIGEST_CATEGORY, "categoryform", xoops_getenv('PHP_SELF'));
$sform->setExtra('enctype="multipart/form-data"');

$sform->addElement(new XoopsFormText(_AM_DIGEST_TITLE, 'title', 50, 255, $title), true);
$sform->addElement(new XoopsFormText(_AM_DIGEST_ORDER, 'category_order', 20, 20, $category_order), false);

if(!empty($xoopsModuleConfig['image_path'])){
	$image_option_tray = new XoopsFormElementTray(_AM_DIGEST_IMAGE_UPLOAD, '<br />');
	if (!empty($xoopsModuleConfig['allow_upload']) || (is_object($xoopsUser) && $xoopsUser->isAdmin())) {
		$image_option_tray->addElement(new XoopsFormFile('', 'userfile',''));
		$image_option_tray->addElement(new XoopsFormLabel(_AM_DIGEST_ALLOWED_EXTENSIONS, str_replace('|',', ', $xoopsModuleConfig['allowed_extension'])));
	}
	$sform->addElement($image_option_tray);
	unset($image_tray);
	unset($image_option_tray);

	$image_option_tray = new XoopsFormElementTray(_AM_DIGEST_IMAGE_SELECT, '<br />');
	$image_array =& XoopsLists::getImgListAsArray(XOOPS_ROOT_PATH . '/'. $xoopsModuleConfig['image_path'].'/');
	array_unshift($image_array, _NONE);
	$image_select = new XoopsFormSelect('', 'image', $image);
	$image_select->addOptionArray($image_array);
	$image_select->setExtra("onchange='showImgSelected(\"img\", \"image\", \"/".$xoopsModuleConfig['image_path']."/\", \"\", \"" . XOOPS_URL . "\")'");
	$image_tray = new XoopsFormElementTray('', '&nbsp;');
	$image_tray->addElement($image_select);
	if (!empty($image) && is_file(XOOPS_ROOT_PATH . '/' .$xoopsModuleConfig['image_path']."/" . $image)){
	    $image_tray->addElement(new XoopsFormLabel('', "<div style='padding: 8px;'><img src='" . XOOPS_URL . '/' .$xoopsModuleConfig['image_path']."/" . $image . "' name='img' id='img' alt='' /></div>"));
	}else{
	    $image_tray->addElement(new XoopsFormLabel('', "<div style='padding: 8px;'><img src='" . XOOPS_URL . "/images/blank.gif' name='img' id='img' alt='' /></div>"));
	}
	$image_option_tray->addElement($image_tray);
	$sform->addElement($image_option_tray);
}

if(!empty($category_id)) $sform->addElement(new XoopsFormHidden('category_id', $category_id));
$op = empty($op)?'categorySave':$op;
$sform->addElement(new XoopsFormHidden('op', $op));

$button_tray = new XoopsFormElementTray('', '');
$button_tray->addElement(new XoopsFormButton('', 'submit', _SUBMIT, 'submit'));
$button_tray->addElement(new XoopsFormButton('', '', _AM_DIGEST_CANCEL, 'button'));
$sform->addElement($button_tray);

$sform->display();
?>
