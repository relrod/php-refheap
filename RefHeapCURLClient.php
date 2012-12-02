<?php

final class RefHeapCURLClient {
  private $request;
  private $fields = array();
  private $url;
  private $paranoia = true;
  private $curl;
  private $status_code;
  private $result;

  public function __construct() {
    $this->curl = curl_init();
    curl_setopt($this->getCurl(), CURLOPT_RETURNTRANSFER, true);
  }

  public function setRequest($request) {
    $this->request = $request;
    curl_setopt($this->getCurl(), CURLOPT_CUSTOMREQUEST, $request);
    return $this;
  }

  public function setFields($fields) {
    $this->fields = $fields;
    curl_setopt($this->getCurl(), CURLOPT_POSTFIELDS, $fields);
    return $this;
  }

  public function setURL($url) {
    $this->url = $url;
    curl_setopt($this->getCurl(), CURLOPT_URL, $url);
    return $this;
  }

  public function setParanoia($paranoia) {
    $this->paranoia = $paranoia;
    curl_setopt($this->getCurl(), CURLOPT_SSL_VERIFYHOST, $paranoia);
    return $this;
  }

  private function setStatusCode($code) {
    $this->status_code = $code;
    return $this;
  }

  private function setResult($result) {
    $this->result = $result;
    return $this;
  }

  public function getRequest() {
    return $this->request;
  }

  public function getFields() {
    return $this->fields;
  }

  public function getURL() {
    return $this->url;
  }

  public function getParanoia() {
    return $this->paranoia;
  }

  public function getCurl() {
    return $this->curl;
  }

  public function getStatusCode() {
    return $this->status_code;
  }

  public function getResult() {
    return $this->result;
  }

  public function execute() {
    $result = curl_exec($this->getCurl());
    $this->setResult($result);
    curl_close($this->getCurl());
    return $this;
  }
}