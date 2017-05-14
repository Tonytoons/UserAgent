<?php
/* 
 * **********************************************
 * * Tonytoonsz     : class UserAgent           *
 * **********************************************
 * * since          : 2007                      *
 * * Developed By   : Tonytoons                 *
 * * E-mail         : Tonytoonsz@hotmail.com    *
 * * License        : Tonytoons                 *
 * * Update         : 2016-11-22                *
 * **********************************************
 */
namespace Application\Models;
class UserAgent
{
    protected $_userAgent;
    protected $_uaProf;
################################################################################ 
	function __construct($_userAgent=null)
    {
        $this->_userAgent = getenv('HTTP_USER_AGENT');
        $this->_uaProf    = $this->_getUaProf();
    }
################################################################################ 
    function getIt()
    {
    	$_userAgent = $this->_userAgent;
    	if(stripos($_SERVER['HTTP_USER_AGENT'],"iPod"))
    	{
    		$browser_version = '';
    		$browser = 'iPod';
    	}
		elseif (stripos($_SERVER['HTTP_USER_AGENT'],"iPhone"))
		{
			$browser_version = '';
    		$browser = 'iPhone';
		}
		elseif (stripos($_SERVER['HTTP_USER_AGENT'],"iPad"))
		{
			$browser_version = '';
    		$browser = 'iPad';
		}
		elseif (stripos($_SERVER['HTTP_USER_AGENT'],"Android"))
		{
			$browser_version = '';
    		$browser = 'Android';
		}
		else
		{
	    	if(preg_match('|BrowserNG/([0-9\.]+)|',$_userAgent,$matched)) 
			{
	        	$browser_version = $matched[1];
	        	$browser = 'Nokia';
			}
			elseif(preg_match('|BlackBerry([0-9\.]+)|',$_userAgent,$matched)) 
			{
	        	$browser_version = $matched[1];
	        	$browser = 'BlackBerry';
			}
			//webOS
			elseif (preg_match('|MSIE ([0-9].[0-9]{1,2})|',$_userAgent,$matched)) 
			{
	    		$browser_version = $matched[1];
	    		$browser = 'IE';
			} 
			elseif (preg_match( '|Opera/([0-9].+)|',$_userAgent,$matched)) 
			{
	    		$browser_version = $matched[1];
	    		$browser = 'Opera';
			} 
			elseif(preg_match('|Firefox/([0-9\.]+)|',$_userAgent,$matched)) 
			{
	        	$browser_version = $matched[1];
	        	$browser = 'Firefox';
			}
			elseif(preg_match('|Chrome/([0-9\.]+)|',$_userAgent,$matched)) 
			{
	        	$browser_version = $matched[1];
	        	$browser = 'Chrome';
			}
			else 
			{
	        	// browser not recognized!
	    		$browser_version = '';
	    		$browser = 'Other';
			}
		}
		$browser_main_version = '';
		if($browser_version)
		{
			$p = explode(".", $browser_version);
			if(@$p[0])
			{
				$browser_main_version = $p[0];
			}
			else
			{
				$browser_main_version = $browser_version;
			}
		}
		$data = array(
						'browser'         => $browser,
						'browser_version' => $browser_version,
						'browser_main_version' => $browser_main_version,
						'userAgent'       => $_userAgent,
					  	'uaProf'          => $this->_uaProf
					  );  //print_r($data);
		return $data;
    }
################################################################################ 
    protected function _getUaProf()
    {
        if( isset($_SERVER["HTTP_X_WAP_PROFILE"]) )
        {
            return $_SERVER["HTTP_X_WAP_PROFILE"];
        }
        elseif( isset($_SERVER["HTTP_PROFILE"]) )
        {
            return $_SERVER["HTTP_PROFILE"];
        }
        else
        {
            return false;
        }
    }
################################################################################ 
}
?>
