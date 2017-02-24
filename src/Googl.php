<?php

namespace H2akim\Googl;

class Googl
{

    private $endpoint;
    private $api_key;
    private $ch;
    private $params;

    public function __construct($api_key, $endpoint = 'https://www.googleapis.com/urlshortener/v1/url') {
        $this->api_key = $api_key;
        $this->endpoint = $endpoint;
    }

    /**
     * Create short url (goo.gl) from url
     *
     * @param     array $data
     * @return    string JSON
     *              or stdClass if object object param is set to true
     */
    public function create(array $data = []) {
        $this->ch = curl_init($this->endpoint."?key=".$this->api_key);
        if (!array_key_exists('object', $data)) $data['object'] = false;
        $this->params = [ 'longUrl' => $data['longUrl'] ];
        $result = $this->sendRequest();
        return ($data['object']) ? json_decode($result) : $result;
    }

    /**
     * Show original url from short url (goo.gl)
     *
     * @param     array $data
     * @return    string JSON
     *              or stdClass if object param is set to true
     */
    public function expand(array $data = []) {
        $shortUrl = 'shortUrl='.$data['shortUrl'];
        $projection = (isset($data['projection']) && !is_null($data['projection'])) ? '&projection='.$data['projection'] : null;
        $requestUrl = $this->endpoint."?key=".$this->api_key.'&'.$shortUrl.$projection;
        if (!array_key_exists('object', $data)) $data['object'] = false;
        $this->ch = curl_init($requestUrl);
        $result = $this->sendRequest();
        return ($data['object']) ? json_decode($result) : $result;
    }

    /**
     * Send request using curl
     *
     * @return    string JSON
     */
     private function sendRequest() {
		curl_setopt($this->ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, Array('Content-Type: application/json'));
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, TRUE);
		if (count($this->params) > 0) {
			curl_setopt($this->ch, CURLOPT_POSTFIELDS, json_encode($this->params) );
		}
		$result = curl_exec($this->ch);
		curl_close($this->ch);
        return $result;
    }

}
