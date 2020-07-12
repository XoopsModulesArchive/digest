<?php
// $Id: item.php,v 1.2 2004/09/19 22:25:28 phppp Exp $
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
// Credits: Wang Jue (alias wjue) http://www.wjue.org                        //
// ------------------------------------------------------------------------- //
include_once XOOPS_ROOT_PATH."/class/snoopy.php";

class Item
{
	var $url;
	var $charset;
	var $minlength;
	var $maxitems;
	var $offset;
	var $reg_exp;
	var $criteria;
	var $content;
	var $items = array();
    var $_FilterRegex = "click (here)* to (buy)*|all rights reserved|copyright|tous droits reserv|.+@.+\.|buy now|visit our sponsor|(your )*home page|document\.write\(";
    var $_linkCriteria = "";
    var $filterRegex='';
    var $linkCriteria='';
    var $TextLinkPairs;

	function Item()
	{
	}

	function setVar($var, $val)
	{
		$this->$var = $val;

		return true;
	}

	function getVar($var)
	{
		return $this->$var;
	}

	function validate()
	{
	    return $this->fetchContent();
	}

	function fetchItems()
	{
	    if (!$this->getVar('content')) $this->fetchContent();
	    if(!$this->_parse()) {
			//echo "<br />Item::fetchItems: parse error";
		    return false;
	    }
	    return $this->getVar('items');
	}

    function _getUrl()
    {
	    $url = $this->getVar('url');
	    $url = ( preg_match('|^http://(.*)|i', $url, $match) ) ? $url : 'http://'.$url;
	    return rawurldecode($url);
    }

    function _getParsedUrl()
    {
	    if(empty($this->_parsed_url)) $this->_parsed_url = parse_url($this->_getUrl());
		return $this->_parsed_url;
	}

    function _getTextFilter()
    {
        $textFilter = $this->_FilterRegex;
        $reg_exp=trim($this->getVar('reg_exp'));
        if($reg_exp) {
        	$reg_exp=rawurldecode($reg_exp);
        	if($textFilter) $delimiter='|';
        	else $delimiter='';
	        $textFilter .=$delimiter.$reg_exp;
        }
        return $textFilter;
    }

    function _getLinkCriteria()
    {
        $linkCriteria = $this->_linkCriteria;
        $criteria=trim($this->getVar('criteria'));
        if($criteria) {
        	$criteria=rawurldecode($criteria);
        	if($linkCriteria) $delimiter='|';
        	else $delimiter='';
	        $linkCriteria .=$delimiter.$criteria;
        }
        return $linkCriteria;
    }

    function _parse()
    {
	    $charset = $this->getVar('charset');
	    if(empty($charset)) $this->setVar('charset', $this->_getPageCharset());

	    if(!$this->_extractTextLinkPairs()) {
			//echo "<br />Item::_parse: _extractTextLinkPairs error";
		    return false;
	    }
	    if(!$this->_filterTextLinkPairs()) {
			//echo "<br />Item::_parse: _filterTextLinkPairs error";
		    return false;
	    }
	    return true;
    }

    Function _getPageCharset()
    {
        if (preg_match('|<meta.+?charset\s*=\s*([\'\"])?(.+?)[>\s\'\"]|i', $this->getVar('content'), $match)){
            return $match[2];
        }

		return false;
    }

    function _filterTextLinkPairs()
    {
        $j=0;
        $items = array();
        for($i = $this->getVar('offset'); $i < count($this->TextLinkPairs); $i++){
	        $pair = $this->TextLinkPairs[$i];
            if((strlen($pair['textlink'])>$this->getVar('minlength')) && ($j < ($this->getVar('maxitems')+$this->getVar('offset')))) {
	            $filteredPair = array();
                $filteredPair['title'] = $pair['textlink'] ;
                $filteredPair['url'] =rawurldecode($this->_getFullLink($pair['url']));
         		$items[] = $filteredPair;
                unset($filteredPair);
                $j++;
            }
        }
        if(count($items)>0){
	        $this->setVar('items', $items);
	        unset($items);
	        return true;
        }
        else return false;
    }

    function _extractTextLinkPairs()
    {
		$data = $this->getVar('content');
        $data = str_replace("\r\n", " ", $data);
        $data = str_replace("\n", " ", $data);
        $data = preg_replace("/\s+/", " ", $data);
        $data = preg_replace('/<script.+?script>/si','',$data);
        $data = preg_replace('/<!--.+?-->/','',$data);
        if(empty($data)) {
			//echo "<br/>No data";
	        return false;
        }

        preg_match_all("'<\s*a.+?href\s*=\s* ([\"\'])? (?(1) (.*?)\\1.*?>(.+?)</a>|(.*?) ([\s])? (?(5) .*?>(.+?)</a>|>(.+?)</a>))'isx",$data,$urlTextLinks);

        $i=0;
        foreach ($urlTextLinks[0] as $val)
        {
            $tempTX = $this->_TextFilter( trim(strip_tags($urlTextLinks[3][$i].$urlTextLinks[6][$i].$urlTextLinks[7][$i])) );
            $temp = explode(' ',trim($urlTextLinks[2][$i].$urlTextLinks[4][$i]));
            $tempLK = $this->_LinkSelect( $temp[0] );
            if (($tempTX) && ($tempLK)) {
        		$match = array();
                $match['url'] = $tempLK;
                $match['textlink'] = $tempTX;
				$this->TextLinkPairs[] = $match;
				unset($match);
            }
            $i++;
        }
        if(count($this->TextLinkPairs)>0) return true;
        else return false;
    }

    function _TextFilter($mystring)
    {
        if (preg_match('/'.$this->_getTextFilter().'/i', $mystring, $match))  $mystring= "";
        return $mystring;
    }

    function _LinkSelect($string)
    {
	    $linkCriteria = $this->_getLinkCriteria();
        if ( $linkCriteria && !preg_match('/'.$linkCriteria.'/i', $string, $found) ) $string = '';
        return $string;
    }

    function _getFullLink($link)
    {
        $url = $this->_getParsedUrl();
        if (preg_match('/^http:/i', $link, $match)) {
            return $link;
        } elseif (preg_match('/^\//i', $link, $match)) {
            return $url['scheme'].'://'.$url['host'].$link;
        } else {
            return ($this->_basedirFromUrl().$link);
        }
    }

    function _basedirFromUrl()
    {
        $parsed = $this->_getParsedUrl();
        $basedir = '';
        $basedir = (!empty($parsed['scheme'])) ? $parsed['scheme'].':'.((strtolower($parsed['scheme']) == 'mailto') ? '':'//'): '';
        $basedir .= (!empty($parsed['user'])) ? $parsed['user'].((!empty($parsed['pass']))? ':'.$parsed['pass']:'').'@':'';
        $basedir .= (!empty($parsed['host'])) ? $parsed['host'] : '';
        $basedir .= (!empty($parsed['port'])) ? ':'.$parsed['port'] : '';
        if ( !empty($parsed['path']) ) {
            if (  (preg_match('|(.*)/$|', $parsed['path'], $match)) ) {
                $basedir .= $parsed['path'];
            } elseif ( preg_match('/(.*\/).*?\..*?/i', $parsed['path'], $match) ) {
                $basedir .= $match[1];
            }elseif ( empty($parsed['query']) ) {
                $basedir .= $parsed['path'].'/';
            } elseif ( preg_match('/(.*\/).*?/i', $parsed['path'], $match) ) {
                $basedir .= $match[1];
            }
        }else{
        	$basedir .= '/';
    	}
        return $basedir;
    }

    function fetchContent()
    {
	    if($this->_fetchCURL()) return true;
		//echo "<br/>CURL failed";
	    if($this->_fetchSnoopy()) return true;
		//echo "<br/>Snoopy failed";
		if($this->_fetchFopen()) return true;
		//echo "<br/>fopen failed";
	   	return false;
    }

	function _fetchSnoopy()
	{
		$snoopy = new Snoopy;
		$data = "";
		if (@$snoopy->fetch($this->_getUrl())){
        	$data = (is_array($snoopy->results))?implode("\n",$snoopy->results):$snoopy->results;
			//echo "<br/>Snoopy fetched:$data";
    	}
		if($data) {
			$this->setVar('content', $data);
			return true;
		}
		return false;
    }

    function _fetchCURL()
    {
	    if (!function_exists('curl_init') ) return false;
        $ch = curl_init();    // initialize curl handle
        curl_setopt($ch, CURLOPT_URL, $this->_getUrl()); // set url to post to
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);// allow redirects
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); // return into a variable
        curl_setopt($ch, CURLOPT_TIMEOUT, 30); // times out after 31s
        $data = curl_exec($ch); // run the whole process
        $this->setVar('url', curl_getinfo($ch, CURLINFO_EFFECTIVE_URL));
        curl_close($ch);
		//echo "<br/>CURL data:<pre>";print_r($data); echo "</pre>";
		if($data) {
			$this->setVar('content', $data);
			return true;
		}
		return false;
    }

    function _fetchFopen()
    {
    	if(!$fp = @fopen ($this->_getUrl(), 'r')) return false;
        $data = "";
        while (!feof($fp)) {
            $data .= fgets ($fp, 1024);
        }
        fclose($fp);
		if($data) {
			$this->setVar('content', $data);
			return true;
		}
        return false;
    }
}

class DigestItemHandler extends XoopsObjectHandler
{
    function &get($url) {
	    $item = new Item();
	    $item -> setVar('url', $url);
	    if($item->validate()) return $item;
	    return false;
    }

    function destroy($item)
    {
	    /*
	     * Any further actions?
	     *
	     */
	    unset($item);
	    return true;
    }
}
?>