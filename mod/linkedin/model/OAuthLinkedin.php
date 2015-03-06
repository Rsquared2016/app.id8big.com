<?php

class OAuthLinkedin
{
    protected $consumer;
    protected $callbackUrl;
    protected $signatureMethod;
    protected $token;

    
    public function __construct($key, $secret, $callback = 'oob', $sig_method = 'OAuthSignatureMethod_HMAC_SHA1')
    {
        $this->consumer = new OAuthConsumer($key, $secret);
        $this->callbackUrl = $callback;
        $this->signatureMethod = new $sig_method();
    }


    /**
     * Perform an OAuth request and return the response string
     *
     * @param string $url The url to query
     * @param string $method HTTP method
     * @return mixed The response as a string or array
     */
    public function request($url, $method = 'GET')
    {
        $request = OAuthRequest::from_consumer_and_token(
                $this->consumer,
                $this->token,
                $method,
                $url
        );
        $request->sign_request($this->signatureMethod, $this->consumer, $this->token);
        $func = 'execute'.ucfirst(strtolower($method));
        if(!is_callable(array($this, $func)))
        {
            throw new Exception('Class OAuthLinkedin has no method to deal with http '.$method.' You can use GET or POST only');
        }
        return $this->$func($request);
    }


    /**
     * Gets an OAuth Request Token
     *
     * @return OAuthToken
     */
    public function getRequestToken()
    {
        $request = OAuthRequest::from_consumer_and_token(
                $this->consumer,
                null,
                'POST',
                'https://api.linkedin.com/uas/oauth/requestToken',
                array('oauth_callback' => $this->callbackUrl)
        );
        $request->sign_request($this->signatureMethod, $this->consumer, null);

        $response = $this->executePost($request, true);
        return new OAuthToken($response['oauth_token'], $response['oauth_token_secret']);
    }


    /**
     * Gets an OAuth Access Token to use making requests
     * @param OAuthToken $request_token The request token
     * @param string $verifier The verifier string
     */
    public function getAccessToken($request_token, $verifier)
    {
        $request = OAuthRequest::from_consumer_and_token(
                $this->consumer,
                $request_token,
                'POST',
                'https://api.linkedin.com/uas/oauth/accessToken',
                array('oauth_verifier' => $verifier)
        );

        $request->sign_request($this->signatureMethod, $this->consumer, $request_token);

        $response = $this->executePost($request, true);
        $this->token = new OAuthToken($response['oauth_token'], $response['oauth_token_secret']);
    }


    private function executePost($request, $as_array = false)
    {
        $ch = curl_init($request->get_normalized_http_url());
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $request->to_postdata());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);

        if(!$as_array) return $response;

        parse_str($response, $response_array);
        return $response_array;
    }


    private function executeGet($request, $as_array = false)
    {
        $ch = curl_init($request->to_url());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);

        if(!$as_array) return $response;

        parse_str($response, $response_array);
        return $response_array;
    }
}
