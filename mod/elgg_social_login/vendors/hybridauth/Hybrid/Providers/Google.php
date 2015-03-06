<?php
/*!
* HybridAuth
* http://hybridauth.sourceforge.net | https://github.com/hybridauth/hybridauth
*  (c) 2009-2011 HybridAuth authors | hybridauth.sourceforge.net/licenses.html
*/

/**
 * Hybrid_Providers_Google provider adapter based on OAuth2 protocol
 * 
 * http://hybridauth.sourceforge.net/userguide/IDProvider_info_Google.html
 */
class Hybrid_Providers_Google extends Hybrid_Provider_Model_OAuth2
{
	// default permissions 
	public $scope = "https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email https://www.google.com/m8/feeds";

	/**
	* IDp wrappers initializer 
	*/
	function initialize() 
	{
		parent::initialize();

		// Provider api end-points
		$this->api->authorize_url  = "https://accounts.google.com/o/oauth2/auth";
		$this->api->token_url      = "https://accounts.google.com/o/oauth2/token";
		$this->api->token_info_url = "https://www.googleapis.com/oauth2/v1/tokeninfo";
	}

	/**
	* begin login step 
	*/
	function loginBegin()
	{
		Hybrid_Auth::redirect( $this->api->authorizeUrl( array( "scope" => $this->scope, "access_type" => "offline" ) ) ); 
	}

	/**
	* load the user profile from the IDp api client
	*/
	function getUserProfile()
	{
		// refresh tokens if needed
		$this->refreshToken();
		
		// ask google api for user infos
		$response = $this->api->api( "https://www.googleapis.com/oauth2/v1/userinfo" ); 

		if ( ! isset( $response->id ) || isset( $response->error ) ){
			throw new Exception( "User profile request failed! {$this->providerId} returned an invalide response.", 6 );
		}

		$this->user->profile->identifier    = @ $response->id;
		$this->user->profile->firstName     = @ $response->given_name;
		$this->user->profile->lastName      = @ $response->family_name;
		$this->user->profile->displayName   = @ $response->name;
		$this->user->profile->photoURL      = @ $response->picture;
		$this->user->profile->profileURL    = "https://profiles.google.com/" . $this->user->profile->identifier;
		$this->user->profile->gender        = @ $response->gender; 
		$this->user->profile->email         = @ $response->email;
		$this->user->profile->emailVerified = @ $response->email;
		$this->user->profile->language      = @ $response->locale;

		return $this->user->profile;
	}
	
	/**
	* load the user profile from the IDp api client
	*/
	function getUserContacts() {
		
		$contacts = array();
		$response = false;
		
		try{ 
			$accesstoken = $this->token('access_token');
			
			$xmlresponse= file_get_contents('https://www.google.com/m8/feeds/contacts/default/full?max-results=9999&oauth_token='.$accesstoken);
			
			if ($xmlresponse) {
				//reading xml using SimpleXML
				$xml= new SimpleXMLElement($xmlresponse);

				$xml->registerXPathNamespace('gd', 'http://schemas.google.com/g/2005');
				$xml->registerXPathNamespace('default', 'http://www.w3.org/2005/Atom');

				$result = $xml->xpath('//default:entry|//gd:email');

				if (is_array($result)) {
					for ($i = 0; $i < count($result); $i++) {
						if(isset($result[$i]->attributes()->address)) {
							$address = $result[$i]->attributes()->address;
							
							$uc = new Hybrid_User_Contact();
							
							$uc->identifier  = @ (string) $address;
							$uc->displayName = @ (string) $address;

							$contacts[] = $uc; 
						}
					}
					
					$response = TRUE;
				}
			}
		}
		catch( LinkedInException $e ){
			throw new Exception( "User contacts request failed! {$this->providerId} returned an error: $e" );
		}
		
		return $contacts;
	}
	
	function sendMessage($options = array()) {
		
		$response = false;
		
		try{
			$default = array(
				'from' => '',
				'recipients' => array(),
				'subject' => 'Subject',
				'body' => 'Body',
			);
			if (!is_array($options)) {
				$options = array($options);
			}
			$user = elgg_get_logged_in_user_entity();
			$url = social_import_contacts_get_invite_url($user);
			$options = array_merge($default, $options);
			$options['body'] .= '
					
'.$url;
			
			if (is_array($options['recipients']) && is_email_address($options['from'])) {
				foreach($options['recipients'] as $recipient) {
					$response = elgg_send_email($options['from'], $recipient, $options['subject'], $options['body']);
					if ($response) {
						$opt_annot = array(
							'guid' => $user->getGUID(),
							'annotation_names' => SOCIAL_IMPORT_CONTACTS_INVITED_CONTACTS . '_google',
							'annotation_values' => $recipient,
						);
						$annotations = elgg_get_annotations($opt_annot);
						if (!$annotations) {
							$user->annotate(
								SOCIAL_IMPORT_CONTACTS_INVITED_CONTACTS . '_google',
								$recipient,
								ACCESS_PRIVATE,
								$user->getGUID()
							);
						}
					}
				}
			}
		}
		catch( Exception $e ){
			throw new Exception( "Message request failed! {$this->providerId} returned an error: $e" );
		}
		
		if($response) {
			return true;
		}
		else {
			return false;
		}
		
	}
}
