<?php
/**
*    Class IP Details
*    PHP class for looking into details of a IP address
*
*    @author Chetan <xtrmcoder@gmail.com>
*    @version 05 Sep 2009
*    @copyright GPL © 2009, Chetan Mendhe
*    @license http://creativecommons.org/licenses/by-nc-sa/3.0/ Released under a Creative Commons License
*    @modify taylorlpes.com, 06 Nov 2011
*/ 


class Ipdetails
{
	var $ip;
	var $CI;
  protected $api = "http://www.geoplugin.net/xml.gp?ip=";
	var $details;
	var $xml;
	var $curl;
	var $return_json = false;
	/**
    *    IP Details Construct
    *    @access public
    *    @param String $ip IP Address Of which the details are to be located.
    *    @return void
    */ 
	public function __construct($ipaddress = false)
	{
		$this->CI =& get_instance();
		
		if(is_array($ipaddress) && isset($ipaddress['json'])){
			$this->return_json = true;
			$this->api = "http://www.geoplugin.net/json.gp?ip=";
		}

		if($ipaddress){
			if(is_array($ipaddress)){
				$this->ip = $ipaddress['ip'];
			}else{
				$this->ip = $ipaddress;
			}

			$this->curl=curl_init();
			curl_setopt($this->curl, CURLOPT_URL, $this->api.$this->ip);
			curl_setopt($this->curl, CURLOPT_CONNECTTIMEOUT, 2);
			curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, 1);
		}
		
		
		return true;
	}
   	/** 
    * Scan for the details of the ip address
    * @access public
    * @return void
    */ 
    public function init($ipaddress){
    	if(is_array($ipaddress)){
			$this->ip = $ipaddress['ip'];
		}else{
			$this->ip = $ipaddress;
		}

		if(is_array($ipaddress) && isset($ipaddress['json'])){
			$this->return_json = true;
			$this->api = "http://www.geoplugin.net/json.gp?ip=";
		}

		$this->curl = curl_init();
		curl_setopt($this->curl, CURLOPT_URL, $this->api.$this->ip);
		curl_setopt($this->curl, CURLOPT_CONNECTTIMEOUT, 2);
		curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, 1);

		return $this;
    }
	public function scan()
	{
		if($this->return_json){
			$this->json = curl_exec($this->curl);
			$this->details = json_decode($this->json,true);
		}else{
			$this->xml = curl_exec($this->curl);
			preg_match_all('/<([a-zA-Z0-9].*)>(.*)<\/([a-zA-Z0-9].*?)>\n/',$this->xml,$detail);
			$this->details=null;
			$this->details=array();
			for($i=0;$i<=count($detail[1])-1;$i++)
			{
				$this->details[trim($detail[1][$i])]=$detail[2][$i];
			}
		}
		
		return $this;
	}
	
	
	/** 
    * To parse the values of the xml
    * @access private
    * @param String $field The field name of the xml 
    * @return void
    */
	private function parsexml($field)
	{
		preg_match('/<'.$field.'>(.*?)<\/'.$field.'>/',$this->xml,$output);
		return $output[1];
	}
	
	
	/** 
    * Export All the Details as an array
    * @access public
    * @return void
    */
	public function get_details_by_array()
	{
		return $this->details;
	}
	
	
	/** 
    * Export All the Details as xml
    * @access public
    * @return void
    */
    public function export($type = 'json')
	{
		$return = '';
		if($this->return_json){
			if($type == 'xml'){
				$return = new SimpleXMLElement('<?xml version="1.0" encoding="ISO-8859-1"?><xml/>');

				foreach ($this->details as $key => $value) {
					$return->addChild($key,$value);
				}
	
				$return = $return->asXML();
			}else{
				$return = json_encode($this->details);
			}
		}else{
			if($type == 'xml'){
				$return = $this->xml;
			}else{
				$return =  json_encode($this->details);
			}

		}
		return $return;
	}

	/** 
    * Export All the Details as json
    * @access public
    * @return void
    */
    public function export_json()
	{
		return json_encode($this->xml);
	}
	
	/** 
    * Return the Country Code of the given ip address
    * @access public
    * @return void
    */
	public function get_countrycode()
	{
		return (isset($this->details['geoplugin_countryCode']) ? $this->details['geoplugin_countryCode'] : '');
	}
	
	/** 
    * Return the Code3 of the given ip address
    * @access public
    * @return void
    */
	public function get_code3()
	{
		return (isset($this->details['Code3']) ? $this->details['Code3'] : '');
	}

	public function get_status()
	{
		return (isset($this->details['geoplugin_status']) ? $this->details['geoplugin_status'] : '');
	}
	
	/** 
    * Return the Country of the given ip address
    * @access public
    * @return void
    */
	public function get_country()
	{
		return (isset($this->details['geoplugin_countryName']) ? $this->details['geoplugin_countryName'] : '');
	}
	
	/** 
    * Return the Region of the given ip address
    * @access public
    * @return void
    */
	public function get_region()
	{
		return (isset($this->details['geoplugin_region']) ? $this->details['geoplugin_region'] : '');
	}
	
	/** 
    * Return the City of the given ip address
    * @access public
    * @return void
    */
	public function get_city()
	{
		return (isset($this->details['geoplugin_city']) ? $this->details['geoplugin_city'] : '');
	}
	
	/** 
    * Return the PostalCode of the given ip address
    * @access public
    * @return void
    */
	public function get_postalcode()
	{
		return (isset($this->details['PostalCode']) ? $this->details['PostalCode'] : '');
	}
	
	/** 
    * Return the Latitude of the given ip address
    * @access public
    * @return void
    */
	public function get_latitude()
	{
		return (isset($this->details['geoplugin_latitude']) ? $this->details['geoplugin_latitude'] : '');
	}
	
	/** 
    * Return the Longitude of the given ip address
    * @access public
    * @return void
    */
	public function get_longitude()
	{
		return (isset($this->details['geoplugin_longitude']) ? $this->details['geoplugin_longitude'] : '');
	}
	
	/** 
    * Return the DMAcode of the given ip address
    * @access public
    * @return void
    */
	public function get_dmacode()
	{
		return (isset($this->details['geoplugin_dmaCode']) ? $this->details['geoplugin_dmaCode'] : '');
	}
		
	/** 
    * Return the Areacode of the given ip address
    * @access public
    * @return void
    */
	public function get_areacode()
	{
		return (isset($this->details['geoplugin_areaCode']) ? $this->details['geoplugin_areaCode'] : '');
	}
  
  
  /**
  * Continente
  */
	public function get_continentcode()
	{
		return (isset($this->details['geoplugin_continentCode']) ? $this->details['geoplugin_continentCode'] : '');
	}    
    
  /**
  * region Code
  */
	public function get_regioncode()
	{
		return (isset($this->details['geoplugin_regionCode']) ? $this->details['geoplugin_regionCode'] : '');
	}      
    
    
  /**
  * region Name
  */
	public function get_regionname()
	{
		return (isset($this->details['geoplugin_regionName']) ? $this->details['geoplugin_regionName'] : '');
	} 
  
  
  /**
  * currency Code
  */
	public function get_currencycode()
	{
		return (isset($this->details['geoplugin_currencyCode']) ? $this->details['geoplugin_currencyCode'] : '');
	} 
  
  
  /**
  * currency Symbol
  */
	public function get_currencysymbol()
	{
		return (isset($this->details['geoplugin_currencySymbol']) ? $this->details['geoplugin_currencySymbol'] : '');
	} 
  
  
  /**
  * currency Converter
  */
	public function get_currencyconverter()
	{
		return (isset($this->details['geoplugin_currencyConverter']) ? $this->details['geoplugin_currencyConverter'] : '');
	} 
  
	
	/** 
    * To set new ip address
    * @access public
    * @return void
    */
    public function setip($ipaddress)
    {
    	$this->ip=$ipaddress;
    	return true;
    }
    
    /** 
    * To close the class
    * @access public
    * @return void
    */
    public function close()
    {
    	curl_close($this->curl);
    	return true;
    }
	
}