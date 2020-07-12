<?php
// $Id: admin.php,v 1.5 2004/09/20 22:37:50 phppp Exp $

if(defined('_AM_ISLOADED')) return;
else define('_AM_ISLOADED', 1);

// index.php
define("_AM_DIGEST_CONFIG", "文摘区设置");
define("_AM_DIGEST_OK", "<font color='green'>OK</a>");
define("_AM_DIGEST_NOK", "<font color='red'>X</a>");
define("_AM_DIGEST_MODULE_OK", "<font color='green'>正常运行</a>");
define("_AM_DIGEST_MODULE_NOK", "<font color='red'>无法运行</a>");
define("_AM_DIGEST_LANGCONV_OK", "<font color='green'>有效</a>, 可以转换charset");
define("_AM_DIGEST_LANGCONV_NOK", "<font color='red'>无效</a>, 只能用于 "._CHARSET);
define("_AM_DIGEST_CURL","CURL 函数");
define("_AM_DIGEST_FSOCKOPEN","fsockopen 函数");
define("_AM_DIGEST_ALLOW_URL_FOPEN","allow_url_fopen 函数");
define("_AM_DIGEST_MODULE","模块功能");
define("_AM_DIGEST_ICONV","Iconv 模块");
define("_AM_DIGEST_XCONV","Xconv 模块");
define("_AM_DIGEST_LANGCONV","编码转换功能");
define("_AM_DIGEST_IMAGEPATH","图片路径");
define("_AM_DIGEST_UPDATEAPI","文摘更新函数接口");
define("_AM_DIGEST_UPDATEAPI_DESC","如果该文件不能生成, 则只能通过digest模块下的update.php进行内容更新");
define("_AM_DIGEST_CREATE_IMAGEPATH","重新图片文件夹");
define("_AM_DIGEST_CREATE_APIFILE","重新生成文件");
define("_AM_DIGEST_CATEGORYLIST", "类别设置");
define("_AM_DIGEST_DIGESTLIST", "站点设置");
define("_AM_DIGEST_UPDATE", "刷新");
define("_AM_DIGEST_EMPTY", "清空");
define("_AM_DIGEST_DIGEST_ORDER", "站点排序");
define("_AM_DIGEST_CATEGORY_ORDER", "类别排序");
define("_AM_DIGEST_DBUPDATED","数据库更新完成!");
define("_AM_DIGEST_MODIFYCATEGORY","修改分类");
define("_AM_DIGEST_MODIFY","修改");
define("_AM_DIGEST_EDITSITE","编辑站点");
define("_AM_DIGEST_NEWSITE","添加站点");
define("_AM_DIGEST_DELETECONFIRM","确认删除");
define("_AM_DIGEST_GENERALCONF","一般设置");
define("_AM_DIGEST_SERVERSTATUS", "服务器设置检测");
define("_AM_DIGEST_CATEGORY_MANAGEMENT", "类别管理");
define("_AM_DIGEST_IMPORT", "资料导入");
define("_AM_DIGEST_EXPORT", "资料导出");
define("_AM_DIGEST_IMPORTFILE", "导入文件");
define("_AM_DIGEST_EXPORTFILE", "点击导出文件");
define("_AM_DIGEST_SITE_MANAGEMENT", "站点管理");
define("_AM_DIGEST_ABOUT","关于该模块");

// categoryform.inc.php
define("_AM_DIGEST_TITLE", "标题");
define("_AM_DIGEST_ORDER", "顺序");
define("_AM_DIGEST_IMAGE_UPLOAD", "图片LOGO上传");
define("_AM_DIGEST_ALLOWED_EXTENSIONS", "允许的扩展名");
define("_AM_DIGEST_IMAGE_SELECT", "图片选择");
define("_AM_DIGEST_CANCEL", "取消");

// digestform.inc.php
define("_AM_DIGEST_SITE", "站点设置");
define("_AM_DIGEST_URL", "URL");
define("_AM_DIGEST_DESCRIPTION", "描述");
define("_AM_DIGEST_CATEGORY", "类别");
define("_AM_DIGEST_ONLINE", "在线");
define("_AM_DIGEST_OFFSET", "offset");
define("_AM_DIGEST_MAXITEMS", "最大条目");
define("_AM_DIGEST_MINLENGTH", "有效标题的最小长度");
define("_AM_DIGEST_CHARSET", "网页编码");
define("_AM_DIGEST_CHARSET_INTER", "编码转换过渡码");
define("_AM_DIGEST_UPDATETIME", "刷新频率");
define("_AM_DIGEST_REGEXP", "文字过滤的正则表达式");
define("_AM_DIGEST_CRITERIA", "可接受链接的标准");
define("_AM_DIGEST_FETCH", "抓取测试");

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
