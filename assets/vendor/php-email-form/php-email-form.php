<?php

class PHP_Email_Form {

  public $to;
  public $from_name;
  public $from_email;
  public $subject;
  public $messages = [];
  public $smtp = [];

  public function add_message($content, $label, $length = 0) {
    $this->messages[] = [
      'label' => $label,
      'content' => $content,
      'length' => $length
    ];
  }

  public function send() {
    $message_content = "";

    foreach ($this->messages as $message) {
      $message_content .= $message['label'] . ": " . $message['content'] . "\n";
    }

    $headers = 'From: ' . $this->from_name . ' <' . $this->from_email . ">\r\n" .
               'Reply-To: ' . $this->from_email . "\r\n" .
               'X-Mailer: PHP/' . phpversion();

    if(mail($this->to, $this->subject, $message_content, $headers)) {
      return 'OK';
    } else {
      return 'Email sending failed.';
    }
  }
}

?>
