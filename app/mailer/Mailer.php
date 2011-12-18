<?php
/**
 * 
 * 
 * 
 */
class Mailer {
	
	private 
      $name
    , $sender
    , $recipient
    , $subject
    , $message
    , $headers
    , $template = 'default.php';


	public function __construct($n, $s, $r, $sb, $m, $t = null) {
	  
	  $this->name = $n;
	  $this->sender = $s;
		$this->recipient = $r;
		$this->subject = $sb;
		$this->message = $m;
    
    if ($t) {
      $this->template = $t;
    }
    
		$this->headers();
    
	}
  

	/**
   * 
   */
	public function send() {
	  
    return mail(
        $this->recipient
      , $this->subject
      , $this->mail_body()
      , $this->headers
    );
        
	}
  
  
  /**
   * 
   */
  public static function validate () {
    
    $atIndex = strrpos($this->sender, "@");
    
    if (is_bool($atIndex) && !$atIndex) {
      return false;
    }
      
    $domain = substr($this->sender, $atIndex+1);
    $local = substr($this->sender, 0, $atIndex);
    $localLen = strlen($local);
    $domainLen = strlen($domain);
    
    if ($localLen < 1 || $localLen > 64) {
      return false; // local part length exceeded
    }
  
    if ($domainLen < 1 || $domainLen > 255) {
      return false; // domain part length exceeded
    }
    
    if ($local[0] === '.' || $local[$localLen-1] === '.') {
      return false; // local part starts or ends with '.'
    }
    
    if (preg_match('/\\.\\./', $local)) {
      return false; // local part has two consecutive dots
    }
    
    if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain)) {
      return false; // character not valid in domain part
    }
    
    if (preg_match('/\\.\\./', $domain)) {
      return false; // domain part has two consecutive dots
    }
    
    if (
      !preg_match(
          '/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/'
        , str_replace("\\\\","",$local)
      ) && 
      !preg_match(
          '/^"(\\\\"|[^"])+"$/'
        , str_replace("\\\\","",$local)
      )
    ) {
      // character not valid in local part unless local part is quoted
      return false;
    }
    
    if (!(checkdnsrr($domain,"MX") || checkdnsrr($domain,"A"))) {
      return false; // domain not found in DNS
    }

    return true;
      
  }

   
  // :Private
   
  // create message headers
  private function headers() {
    
    $this->headers = "From: " . $this->sender . "\r\n";
    $this->headers .= "MIME-Version: 1.0\r\n";
    $this->headers .= "Content-Type: text/html; charset=\"iso-8859-1\"\r\n";
    
  }
  
  // build the mail body
  private function mail_body() {
    
    if (is_file('mail-body.php')) {
      
      ob_start();
      include $this->template;
      return ob_get_clean();
      
      return $contents;
    
    }
    
    throw new Exception("Failed to load email template" . $this->template);
    
  }

}
