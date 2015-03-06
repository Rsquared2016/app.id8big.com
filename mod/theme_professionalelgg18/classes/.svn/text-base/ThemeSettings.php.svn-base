<?php

/*
 * This class is used to set the settings of Jobs
 */

class ThemeSettings {

	const default_page = 'style';

	public function __construct() {
		
	}
	
	public static function getDefaultSelectedTab() {
		$tabs = self::getConfigPages();
		return current($tabs);
//		return 'settings';
	}

	public static function getDefaultSettingsPage($url = false) {
		$page = self::default_page;

		if ($url) {
			$url = elgg_get_site_url() . "admin/appearance/theme_professional?tab=";
			$page = $url . $page;
		}

		return $page;
	}

	public static function getConfigPages() {
		//$defined_pages = array('style', 'home', 'settings');
		$defined_pages = array('ping', 'settings', 'style', 'home', 'header_footer', 'site_forwarding');

		return $defined_pages;
	}

	public static function settingsPageExists($page) {
		$pages = self::getConfigPages();

		return in_array($page, $pages);
	}

	/**
	 * Return an array keys valus to replace the helpers texts
	 * 
	 * @return array
	 */
	public static function getUrlHelpers() {
		$helpers = array();

		$helpers['username'] = '[username]';
		$helpers['site_url'] = '[site_url]';

		return $helpers;
	}

	public static function getParsedUrl($value) {
		
		if (empty($value)) {
			return NULL;
		}
		
		$helpers = self::getUrlHelpers();

		$site = elgg_get_site_entity();
		$user = elgg_get_logged_in_user_entity();

		
		if ($user) {
			$value = str_replace($helpers['username'], $user->username, $value);
		} else {
			$value = str_replace($helpers['username'], '', $value);
		}
		
		$value = str_replace($helpers['site_url'], $site->url, $value);
		
		return $value;
	}
	
	
	public static function getEncodedUrl($value) {
		$site_url = elgg_get_site_url();
		$helpers = self::getUrlHelpers();
		
		return str_replace($site_url, $helpers['site_url'], $value);
	}

	
	public static function getForwardDefaultLoggedInURL() {
		return elgg_get_site_url().'activity';
	}
	
	/**
	 * Get the url when user is getting logged in to site
	 * 
	 * return string $url
	 */
	public static function getForwardLoggedInURL() {
		$forwarding_login_val = elgg_get_plugin_setting('forwarding_login', THEME_NAME);
		
		$url = self::getParsedUrl($forwarding_login_val);
		
		if ($url == NULL) {
			$url = self::getForwardDefaultLoggedInURL();
		}
		
		return $url;
	}
	
	
	public static function getForwardHomePageOutURL() {
		$forwarding_logo_off_val = elgg_get_plugin_setting('forwarding_logo_off', THEME_NAME);
		
		if (empty($forwarding_logo_off_val)) {
			$forwarding_logo_off_val = elgg_get_site_url();
		}
		
		$url = self::getParsedUrl($forwarding_logo_off_val);
		
		return $url;
	}
	
	public static function getForwardHomePageInURL() {
		$forwarding_logo_in_val = elgg_get_plugin_setting('forwarding_logo_in', THEME_NAME);
		
		if (empty($forwarding_logo_in_val)) {
			$forwarding_logo_in_val = self::getForwardDefaultLoggedInURL();
		}
		
		$url = self::getParsedUrl($forwarding_logo_in_val);
		
		return $url;
	}
	
	public static function customHomeEnabled($boolean = false) {
		$enabled = elgg_get_plugin_setting('home_html_enabled', THEME_NAME);
		
		if(is_null($enabled)) {
			$enabled = false;
		}

		if($boolean) {
			$enabled = ($enabled == 'yes') ? true: false;
		}
		
		return $enabled;
		
	}
	
	public static function getFaviconUrl() {
		//Default favicon
		$url_default = THEME_GRAPHICS_CUSTOM . "favico.ico";
		
		$url = elgg_get_plugin_setting('theme_favicon', THEME_NAME);
		
		if(!$url) {
			$url = $url_default;
		}
		
		return $url;
	}

}