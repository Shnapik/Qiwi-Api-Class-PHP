<?php
class Qiwi {
    private $_phone;
    private $_token;
    private $_url;
 
    function __construct($phone, $token) {
        $this->_phone = $phone;
        $this->_token = $token;
        $this->_url   = 'https://edge.qiwi.com/';
    }
    private function sendRequest($method, array $content = [], $post = false) {
        $ch = curl_init();
        if ($post) {
            curl_setopt($ch, CURLOPT_URL, $this->_url . $method);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($content));
        } else {
            curl_setopt($ch, CURLOPT_URL, $this->_url . $method . '/?' . http_build_query($content));
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept: application/json',
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->_token,
            'Host: edge.qiwi.com'
        ]); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result, 1);
    }
    public function getAccount(Array $params = []) {
        return $this->sendRequest('person-profile/v1/profile/current', $params);
    }
    public function getPaymentsHistory(Array $params = []) {
        return $this->sendRequest('payment-history/v2/persons/' . $this->_phone . '/payments', $params);
    }
    public function getPaymentsStats(Array $params = []) {
        return $this->sendRequest('payment-history/v2/persons/' . $this->_phone . '/payments/total', $params);
    }
    public function getTxn($txnId, Array $params = []) {
        return $this->sendRequest('payment-history/v2/transactions/' . $txnId .'/', $params);
    }
    public function getCheck($txnId, Array $params = []) {
	return $this->sendRequest('payment-history/v1/transactions/' . $txnId .'/cheque/file', $params);
    } 
    public function getBalance() {
        return $this->sendRequest('funding-sources/v2/persons/' . $this->_phone . '/accounts');
    }
    public function getTax($providerId) {
        return $this->sendRequest('sinap/providers/'. $providerId .'/form');
    } 
    public function sendMoneyToQiwi(Array $params = []) {
        return $this->sendRequest('sinap/api/v2/terms/99/payments', $params, 1);
    }
    public function sendMoneyToProvider($providerId, Array $params = []) {
        return $this->sendRequest('sinap/api/v2/terms/'. $providerId .'/payments', $params, 1);
    }
    public function sendMoneyToOther(Array $params = []) {
        return $this->sendRequest('sinap/api/v2/terms/1717/payments', $params, 1);
    }
}
?>
