<?php
// $Id: admin.php,v 1.5 2004/09/20 22:37:50 phppp Exp $

if(defined('_AM_ISLOADED')) return;
else define('_AM_ISLOADED', 1);

// index.php
define("_AM_DIGEST_CONFIG", "��ժ������");
define("_AM_DIGEST_OK", "<font color='green'>OK</a>");
define("_AM_DIGEST_NOK", "<font color='red'>X</a>");
define("_AM_DIGEST_MODULE_OK", "<font color='green'>��������</a>");
define("_AM_DIGEST_MODULE_NOK", "<font color='red'>�޷�����</a>");
define("_AM_DIGEST_LANGCONV_OK", "<font color='green'>��Ч</a>, ����ת��charset");
define("_AM_DIGEST_LANGCONV_NOK", "<font color='red'>��Ч</a>, ֻ������ "._CHARSET);
define("_AM_DIGEST_CURL","CURL ����");
define("_AM_DIGEST_FSOCKOPEN","fsockopen ����");
define("_AM_DIGEST_ALLOW_URL_FOPEN","allow_url_fopen ����");
define("_AM_DIGEST_MODULE","ģ�鹦��");
define("_AM_DIGEST_ICONV","Iconv ģ��");
define("_AM_DIGEST_XCONV","Xconv ģ��");
define("_AM_DIGEST_LANGCONV","����ת������");
define("_AM_DIGEST_IMAGEPATH","ͼƬ·��");
define("_AM_DIGEST_UPDATEAPI","��ժ���º����ӿ�");
define("_AM_DIGEST_UPDATEAPI_DESC","������ļ���������, ��ֻ��ͨ��digestģ���µ�update.php�������ݸ���");
define("_AM_DIGEST_CREATE_IMAGEPATH","����ͼƬ�ļ���");
define("_AM_DIGEST_CREATE_APIFILE","���������ļ�");
define("_AM_DIGEST_CATEGORYLIST", "�������");
define("_AM_DIGEST_DIGESTLIST", "վ������");
define("_AM_DIGEST_UPDATE", "ˢ��");
define("_AM_DIGEST_EMPTY", "���");
define("_AM_DIGEST_DIGEST_ORDER", "վ������");
define("_AM_DIGEST_CATEGORY_ORDER", "�������");
define("_AM_DIGEST_DBUPDATED","���ݿ�������!");
define("_AM_DIGEST_MODIFYCATEGORY","�޸ķ���");
define("_AM_DIGEST_MODIFY","�޸�");
define("_AM_DIGEST_EDITSITE","�༭վ��");
define("_AM_DIGEST_NEWSITE","���վ��");
define("_AM_DIGEST_DELETECONFIRM","ȷ��ɾ��");
define("_AM_DIGEST_GENERALCONF","һ������");
define("_AM_DIGEST_SERVERSTATUS", "���������ü��");
define("_AM_DIGEST_CATEGORY_MANAGEMENT", "������");
define("_AM_DIGEST_IMPORT", "���ϵ���");
define("_AM_DIGEST_EXPORT", "���ϵ���");
define("_AM_DIGEST_IMPORTFILE", "�����ļ�");
define("_AM_DIGEST_EXPORTFILE", "��������ļ�");
define("_AM_DIGEST_SITE_MANAGEMENT", "վ�����");
define("_AM_DIGEST_ABOUT","���ڸ�ģ��");

// categoryform.inc.php
define("_AM_DIGEST_TITLE", "����");
define("_AM_DIGEST_ORDER", "˳��");
define("_AM_DIGEST_IMAGE_UPLOAD", "ͼƬLOGO�ϴ�");
define("_AM_DIGEST_ALLOWED_EXTENSIONS", "�������չ��");
define("_AM_DIGEST_IMAGE_SELECT", "ͼƬѡ��");
define("_AM_DIGEST_CANCEL", "ȡ��");

// digestform.inc.php
define("_AM_DIGEST_SITE", "վ������");
define("_AM_DIGEST_URL", "URL");
define("_AM_DIGEST_DESCRIPTION", "����");
define("_AM_DIGEST_CATEGORY", "���");
define("_AM_DIGEST_ONLINE", "����");
define("_AM_DIGEST_OFFSET", "offset");
define("_AM_DIGEST_MAXITEMS", "�����Ŀ");
define("_AM_DIGEST_MINLENGTH", "��Ч�������С����");
define("_AM_DIGEST_CHARSET", "��ҳ����");
define("_AM_DIGEST_CHARSET_INTER", "����ת��������");
define("_AM_DIGEST_UPDATETIME", "ˢ��Ƶ��");
define("_AM_DIGEST_REGEXP", "���ֹ��˵�������ʽ");
define("_AM_DIGEST_CRITERIA", "�ɽ������ӵı�׼");
define("_AM_DIGEST_FETCH", "ץȡ����");

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
