<?php
// $Id: admin.php,v 1.5 2004/09/20 22:37:34 phppp Exp $

if(defined('_AM_ISLOADED')) return;
else define('_AM_ISLOADED', 1);

// index.php
define("_AM_DIGEST_CONFIG","Digest Configuration");
define("_AM_DIGEST_OK","<font color='green'>OK</a>");
define("_AM_DIGEST_NOK","<font color='red'>X</a>");
define("_AM_DIGEST_MODULE_OK","<font color='green'>READY</a> to use");
define("_AM_DIGEST_MODULE_NOK","can <font color='red'>NOT</a> take action");
define("_AM_DIGEST_LANGCONV_OK","<font color='green'>AVAILABLE</a>, work for any charset");
define("_AM_DIGEST_LANGCONV_NOK","<font color='red'>NOT</a> available, only work for "._CHARSET);
define("_AM_DIGEST_CURL","CURL extension");
define("_AM_DIGEST_FSOCKOPEN","fsockopen function");
define("_AM_DIGEST_ALLOW_URL_FOPEN","allow_url_fopen");
define("_AM_DIGEST_MODULE","Module");
define("_AM_DIGEST_ICONV","Iconv module");
define("_AM_DIGEST_XCONV","Xconv module");
define("_AM_DIGEST_LANGCONV","Language conversion");
define("_AM_DIGEST_IMAGEPATH","Image path");
define("_AM_DIGEST_UPDATEAPI","Update API");
define("_AM_DIGEST_UPDATEAPI_DESC","If the API file can not be created, items can only be updated through the update.php in the digest module");
define("_AM_DIGEST_CREATE_IMAGEPATH","Create image folder");
define("_AM_DIGEST_CREATE_APIFILE","Create API file");
define("_AM_DIGEST_CATEGORYLIST", "Category list");
define("_AM_DIGEST_DIGESTLIST", "Site list");
define("_AM_DIGEST_UPDATE", "Update");
define("_AM_DIGEST_EMPTY", "Empty");
define("_AM_DIGEST_DIGEST_ORDER", "Re-order sites");
define("_AM_DIGEST_CATEGORY_ORDER", "Re-order categories");
define("_AM_DIGEST_DBUPDATED","Database Updated Successfully!");
define("_AM_DIGEST_MODIFYCATEGORY","modify Category");
define("_AM_DIGEST_MODIFY","Modify");
define("_AM_DIGEST_EDITSITE","Edit Site");
define("_AM_DIGEST_NEWSITE","Add new site");
define("_AM_DIGEST_DELETECONFIRM","Confirm delete");
define("_AM_DIGEST_GENERALCONF","General Configuration");
define("_AM_DIGEST_SERVERSTATUS","Server status detection");
define("_AM_DIGEST_CATEGORY_MANAGEMENT", "Category management");
define("_AM_DIGEST_IMPORT", "Import DB");
define("_AM_DIGEST_EXPORT", "Export DB");
define("_AM_DIGEST_IMPORTFILE", "Import from file");
define("_AM_DIGEST_EXPORTFILE", "click to download the EXPORT FILE");
define("_AM_DIGEST_SITE_MANAGEMENT", "Site management");
define("_AM_DIGEST_ABOUT","About Digest");

// categoryform.inc.php
define("_AM_DIGEST_TITLE","Title");
define("_AM_DIGEST_ORDER", "Order");
define("_AM_DIGEST_IMAGE_UPLOAD", "Upload LOGO");
define("_AM_DIGEST_ALLOWED_EXTENSIONS", "Allowed extensions");
define("_AM_DIGEST_IMAGE_SELECT", "Select from existing images");
define("_AM_DIGEST_CANCEL","Cancel");

// digestform.inc.php
define("_AM_DIGEST_SITE", "Site configuration");
define("_AM_DIGEST_URL", "URL");
define("_AM_DIGEST_DESCRIPTION", "Description");
define("_AM_DIGEST_CATEGORY", "Category");
define("_AM_DIGEST_ONLINE", "Online");
define("_AM_DIGEST_OFFSET", "Offset");
define("_AM_DIGEST_MAXITEMS", "Maximum items to fetch");
define("_AM_DIGEST_MINLENGTH", "Minmum length of valid title");
define("_AM_DIGEST_CHARSET", "Charset of the webpage");
define("_AM_DIGEST_CHARSET_INTER", "Intermediate encoding for conversion");
define("_AM_DIGEST_UPDATETIME", "Update time");
define("_AM_DIGEST_REGEXP", "Regexp for text filtering");
define("_AM_DIGEST_CRITERIA", "Criteria for acceptable links");
define("_AM_DIGEST_FETCH", "Fetch It!");

// about.php
define('_AM_DIGEST_RELEASE', "Release Date ");
define('_AM_DIGEST_AUTHOR_INFO', "Developer Information");
define('_AM_DIGEST_AUTHOR_NAME', "Developer");
define('_AM_DIGEST_AUTHOR_WEBSITE', "Developer website");
define('_AM_DIGEST_AUTHOR_EMAIL', "Developer email");
define('_AM_DIGEST_AUTHOR_CREDITS', "Credits");

define('_AM_DIGEST_MODULE_INFO', "Module Development Information");
define('_AM_DIGEST_MODULE_STATUS', "Development Status");
define('_AM_DIGEST_MODULE_DEMO', "Demo Site");
define('_AM_DIGEST_MODULE_SUPPORT', "Official support site");
define('_AM_DIGEST_AUTHOR_TRANSLATOR', "Translator");
define('_AM_DIGEST_AUTHOR_ACK', "Acknowledgement");
define('_AM_DIGEST_AUTHOR_TODO', "TODO list");
define('_AM_DIGEST_AUTHOR_BUGFIX', "Bug fix history");
define('_AM_DIGEST_MODULE_README', "Readme");
?>