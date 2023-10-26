<?php

class EverveAPI {
    private $api_key;
    private $base_url = 'https://api.everve.net/v3/';
    private $format = 'json';

    public function __construct($api_key) {
        $this->api_key = $api_key;
    }

    private function make_request($endpoint, $params = []) {
        $params['api_key'] = $this->api_key;
        $params['format'] = $this->format;
        $url = $this->base_url . $endpoint . '?' . http_build_query($params);
        $response = file_get_contents($url);
        return json_decode($response, true);
    }

    public function get_user() {
        return $this->make_request('user');
    }

    public function get_socials() {
        return $this->make_request('socials');
    }

    public function get_categories($id = null) {
        $endpoint = $id ? "categories/{$id}" : 'categories';
        return $this->make_request($endpoint);
    }

    public function create_order($params) {
        return $this->make_request('orders', $params);
    }

    public function get_orders($id = null) {
        $endpoint = $id ? "orders/{$id}" : 'orders';
        return $this->make_request($endpoint);
    }

    public function update_order($id, $params) {
        $params['id'] = $id;
        return $this->make_request("orders/{$id}", $params);
    }

    public function delete_order($id) {
        return $this->make_request("orders/{$id}", ['_method' => 'DELETE']);
    }
}

// EXAMPLE:
//$api = new EverveAPI('your_api_key_here');
//$user_info = $api->get_user();
//print_r($user_info);
