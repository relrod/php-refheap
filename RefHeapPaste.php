<?php

final class RefHeapPaste {
  private $user;
  private $lines;
  private $date;
  private $url;
  private $language;
  private $contents;
  private $private;
  private $fields = array();

  public static function fromResponse(array $fields) {
    $paste = RefHeapUtils::id(new RefHeapPaste())
      ->setUser($fields['user'])
      ->setLines($fields['lines'])
      ->setPrivate($fields['private'])
      ->setDate($fields['date'])
      ->setURL($fields['url'])
      ->setLanguage($fields['language'])
      ->setContents($fields['contents']);
    return $paste;
  }

  public function toRequestFields() {
    $fields = array(
      'language' => $this->getLanguage(),
      'private' => $this->getPrivate(),
      'contents' => $this->getContents(),
    ) + $this->getFields();

    return http_build_query($fields);
  }

  public function setUser($user) {
    $this->user = $user;
    return $this;
  }

  public function getUser() {
    return $this->user;
  }

  public function setLines($lines) {
    $this->lines = $lines;
    return $this;
  }

  public function getLines() {
    return $this->lines;
  }

  public function setPrivate($private) {
    if ($private === true) {
      $this->private = 'true';
    } else if ($private === false) {
      $this->private = 'false';
    } else {
      $this->private = $private;
    }
    return $this;
  }

  public function getPrivate() {
    return $this->private;
  }

  public function setDate($date) {
    $this->date = $date;
    return $this;
  }

  public function getDate() {
    return $this->date;
  }

  public function setURL($url) {
    $this->url = $url;
    return $this;
  }

  public function getURL() {
    return $this->url;
  }

  public function setLanguage($language) {
    $this->language = $language;
    return $this;
  }

  public function getLanguage() {
    return $this->language;
  }

  public function setContents($contents) {
    $this->contents = $contents;
    return $this;
  }

  public function getContents() {
    return $this->contents;
  }

  public function addField($key, $value) {
    $this->fields[$key] = $value;
    return $this;
  }

  public function getFields() {
    return $this->fields;
  }

  public function getFieldsString() {
    return http_build_query($this->fields);
  }
}