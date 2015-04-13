<?php
/**
 * Mailer is dependent on PHPMailer 5.2.9
 * resource url https://github.com/PHPMailer/PHPMailer
 * @package libraries
 * @copyright (c) 2015, Keivn Yan
 */
class Mailer 
{
    /**
     * Instance of PHPMailer
     * @var type 
     */
    public $phpMailer;
    
    /**
     * constructor
     */
    public function __construct() 
    {
        require APPPATH . 'libraries/PHPMailer/PHPMailerAutoload.php';
        
        $this->phpMailer = new PHPMailer();
    }
    
    /**
     * 
     * @param string $arf
     * @return mixed
     */
    public function __get($index)
    {
        return $this->phpMailer->$index;
    }
    
    
    /**
     * 
     * @param string $index
     * @param mixed $value
     */
    public function __set($index, $value)
    {
        if(isset($this->phpMailer->$index)) {
            $this->phpMailer->$index = $value;
        }
    }
    
    /**
     * @param string $method_name
     * @param array  $arguments
     * @param mixed
     */
    public function __call($method_name, $arguments)
    {
        if(method_exists($this->phpMailer, $method_name)) {
            return call_user_func_array(array($this->phpMailer, $method_name), $arguments);
        }
    }
    
    
    /**
     * Send mail using SMTP
     * this function just supply some basic paramters for email , if you wanna set some 
     * sophisticated paramters such as 'cc', 'Bcc', 'replyTo', you can set these  in controller or model
     * like $this->mailer->cc = 'someaddress@example.com'
     * @param $address where the email is sent to
     * @param $subject email subject
     * @param $html_content
     * @param $debug   debug flag
     */
    public function smtp_send($address, $subject, $html_content, $debug = false)
    {
        $this->isSMTP();
        if($debug) {
            $this->SMTPDebug = 2;
            $this->Debugoutput = 'html';
        }
        $this->CharSet = 'utf-8';
        //Set the hostname of the smtp mail server
        $this->Host = "ssl://example@youradmin.com";
        //Set the SMTP port number - likely to be 25, 465 or 587
        $this->Port = 465;
        $this->SMTPAuth = true;
        $this->SMTPSecure = 'ssl';
        $this->Username = "your address";
        $this->Password = "your password";
        //Set who the message is to be sent from
        $this->setFrom('your email adress', 'your name');
        //Set who the message is to be sent to
        $this->addAddress($address);
        $this->Subject = $subject;
        $this->msgHTML($html_content);
        if (!$this->send()) {
            log_message('error', 'Mailer Error ' . $this->ErrorInfo);
            return false;
        } else {
            return true;
        }
    }
}