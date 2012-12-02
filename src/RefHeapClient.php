<?php

/**
 * Our gateway to <strike>the universe</strike> RefHeap.
 */
final class RefHeapClient {
  private $username;
  private $token;
  private $url = 'https://refheap.com/api';
  private $paranoia;

  /**
   * Set the username associated with transactions this client makes.
   *
   * @task setter
   */
  public function setUsername($username) {
    $this->username = $username;
    return $this;
  }

  /**
   * Get the username associated with this client.
   *
   * @task getter
   */
  public function getUsername() {
    return $this->username;
  }

  /**
   * Set the token associated with transactions this client makes.
   *
   * @task setter
   */
  public function setToken($token) {
    $this->token = $token;
    return $this;
  }

  /**
   * Get the token associated with this client.
   *
   * @task getter
   */
  public function getToken() {
    return $this->token;
  }

  /**
   * Set the server URL associated with transactions this client makes.
   *
   * @task setter
   */
  public function setURL($url) {
    $this->url = $url;
    return $this;
  }

  /**
   * Get the server URL associated with this client.
   *
   * @task getter
   */
  public function getURL() {
    return $this->url;
  }

  /**
   * Set how much we should worry about valid SSL certificates.
   *
   * @task setter
   */
  public function setParanoia($paranoia) {
    $this->paranoia = $paranoia;
    return $this;
  }

  /**
   * Get how much we should worry about valid SSL certificates.
   *
   * @task getter
   */
  public function getParanoia() {
    return $this->paranoia;
  }

  /**
   * Paste text.
   *
   * Returns the RefHeapPaste, modified to include the ID and URL.
   *
   * Throws on getting any response except 200 back.
   *
   * @param RefHeapPaste The paste to send to the server.
   * @return RefHeapPaste
   */
  public function paste(RefHeapPaste $paste) {
    $fields = $paste
      ->addField('token', $this->getToken())
      ->addField('username', $this->getUsername())
      ->toRequestFields();

    $result = RefHeapUtils::id(new RefHeapCURLClient())
      ->setRequest('POST')
      ->setURL($this->getURL().'/paste')
      ->setFields($fields)
      ->setParanoia($this->getParanoia())
      ->execute()
      ->getResult();

    $json = json_decode($result, true);
    return RefHeapPaste::fromResponse($json);
  }

  /**
   * Fetch pasted text.
   *
   * @param int The ID of the paste to fetch.
   * @return RefHeapPaste
   */
  public function fetch($id) {
    $result = RefHeapUtils::id(new RefHeapCURLClient())
      ->setRequest('GET')
      ->setURL($this->URL().'/paste/'.$id)
      ->setParanoia($this->getParanoia)
      ->execute()
      ->getResult();

    $json = json_decode($result, true);
    return RefHeapPaste::fromResponse($json);
  }

  /**
   * Edit pasted text.
   *
   * @param RefHeapPaste The edited RefHeapPaste.
   * @return RefHeapPaste
   */
  public function edit(RefHeapPaste $paste) {
    $fields = $paste
      ->addField('token', $this->getToken())
      ->addField('username', $this->getUsername())
      ->toRequestFields();

    $result = RefHeapUtils::id(new RefHeapCURLClient())
      ->setRequest('POST')
      ->setURL($this->URL().'/paste/'.$paste->getID())
      ->setFields($fields)
      ->setParanoia($this->getParanoia)
      ->execute();

    $json = json_decode($result, true);
    return RefHeapPaste::fromResponse($json);
  }

  /**
   * Delete pasted text.
   *
   * TODO: Return response code.
   *
   * @param int The ID of the paste.
   * @return int
   */
  public function delete($id) {
    $fields = $paste
      ->addField('token', $this->getToken())
      ->addField('username', $this->getUsername())
      ->getFieldsString();

    $result = RefHeapUtils::id(new RefHeapCURLClient())
      ->setRequest('DELETE')
      ->setURL($this->URL().'/paste/'.$paste->getID())
      ->setParanoia($this->getParanoia)
      ->execute()
      ->getResult();
  }


  /**
   * Fork pasted text.
   *
   * @param int The ID of the source paste.
   * @return RefHeapPaste
   */
  public function fork($id) {
    $fields = $paste
      ->addField('token', $this->getToken())
      ->addField('username', $this->getUsername())
      ->getFieldsString();

    $result = RefHeapUtils::id(new RefHeapCURLClient())
      ->setRequest('POST')
      ->setURL($this->URL().'/paste/'.$paste->getID().'/fork')
      ->setFields($fields)
      ->setParanoia($this->getParanoia)
      ->execute()
      ->getResult();

    $json = json_decode($result, true);
    return RefHeapPaste::fromResponse($json);
  }

  /**
   * Highlight pasted text.
   *
   * @param int The ID of the paste.
   * @return string
   */
  public function highlight($id) {
    $result = RefHeapUtils::id(new RefHeapCURLClient())
      ->setRequest('GET')
      ->setURL($this->URL().'/paste/'.$paste->getID().'/highlight')
      ->setParanoia($this->getParanoia)
      ->execute()
      ->getResult();
    return $result;
  }
}