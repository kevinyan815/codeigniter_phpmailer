This example show you the code integrating PHPMailer into CodeIgniter Framework.

CodeIgniter's Email class and PHP's mail() function both based on local mail server,
and to some group it's a little bit complicated to build their own mail server, so 
maybe PHPMailer is a appropriate choice .

More detail about PHPMailer https://github.com/PHPMailer/PHPMailer


Simple example:

`//in controller or model, load this library
$this->load->library('Mailer');

$email = "address@example.com";
$subject = "This is subject";
$content_html = "&lt;div&gt;test code&lt;/div&gt;"

//send mail using smtp

//if you need set properties like 'cc', 'Bcc', 'replyTo'

//you can set it directly like

//$this->mailer->From ='';

//$this->mailer->cc = '';

//$this->mailer->replyTo ='';


$this->mailer->smtp_send($email, $subject, $content_html);`


Hope this code will help you.

