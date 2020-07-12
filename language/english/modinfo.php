<?php
// $Id: modinfo.php,v 1.2 2004/09/08 22:47:47 phppp Exp $

// The name of this module
define('_MI_DIGEST_NAME','Web Digest');
define('_MI_DIGEST_DESC','Displaying HTML content from other sites');

// Names of blocks for this module (Not all module has blocks)
define('_MI_DIGEST_BLOCK_LIST','Recent digest');
define('_MI_DIGEST_BLOCK_LIST_DESC','For new digest items');
define('_MI_DIGEST_BLOCK_SCROLL','Scroll digest');
define('_MI_DIGEST_BLOCK_SCROLL_DESC','In a scroll way');

// Names of admin menu items
define('_MI_DIGEST_CATEGORY_MANAGER', 'Category Management');
define('_MI_DIGEST_SITE_MANAGER', 'Site Management');
define('_MI_DIGEST_ABOUT', 'About the Module');

// config items

define('_MI_DIGEST_TITLELENGTH', 'Length of Title');
define('_MI_DIGEST_TITLELENGTH_DESC', 'The max length of item titles for displaying');

define('_MI_DIGEST_TWOCOLUMN', 'Two columns');
define('_MI_DIGEST_TWOCOLUMN_DESC', '');

define('_MI_DIGEST_ALLOWSUBMIT', 'Allow users to submit sites');
define('_MI_DIGEST_ALLOWSUBMIT_DESC', '');

define('_MI_DIGEST_AUTOAPPROVE', 'Auto approve');
define('_MI_DIGEST_AUTOAPPROVE_DESC', 'Without check by moderators');

define('_MI_DIGEST_ALLOWUPLOAD','User upload');
define('_MI_DIGEST_ALLOWUPLOAD_DESC', 'As logo');

define('_MI_DIGEST_ALLOWEXTENSION', 'Allowed image extensions');
define('_MI_DIGEST_ALLOWEXTENSION_DESC', '');

define('_MI_DIGEST_IMAGEPATH', 'Path to image folder');
define('_MI_DIGEST_IMAGEPATH_DESC', '');

define('_MI_DIGEST_ALLOWCUSTOM', 'Allow users to make digest test');
define('_MI_DIGEST_ALLOWCUSTOM_DESC', '');

define('_MI_DIGEST_HEADER', 'Page Header');
define('_MI_DIGEST_HEADER_DESC', 'HTML tags are allowed');

define('_MI_DIGEST_FOOTER', 'Page Footer');
define('_MI_DIGEST_FOOTER_DESC', 'HTML tags are allowed');
?>
