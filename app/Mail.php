<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class Mail {

    
    /**
     * Instance of PHPMailer class
     * @var object
     * @access private
     */
    private $mailer;

     /**
      * Constructor of Mail Class
      * @param Array : configuration of the system
      *
      */
    public function __construct() {
        $this->mailer = new PHPMailer(true);
    }


    /**
     * setup the configuration of the server
     * @param Array : configurations
     */
    public function setup_config(Array $config) {        
        $this->mailer->isSMTP();                                            // Send using SMTP
        $this->mailer->Host       = $config['host'];                        // Set the SMTP server to send through
        $this->mailer->SMTPAuth   = true;                                   // Enable SMTP authentication
        $this->mailer->Username   = $config['username'];                    // SMTP username
        $this->mailer->Password   = $config['password'];                    // SMTP password
        $this->mailer->SMTPSecure = $config['SMTPSecure'];                  // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $this->mailer->Port       = $config['port'];
        $this->mailer->setFrom($config['setFrom_email'], $config['setFrom_name']);
    }

    /**
     * setup recipients of the mail
     * @param Array $recipients informations stord as an array of email=>name
     * @param string $repleyTo_email 
     * @param string $repleyTo_name 
     */
    public function setup_recipients (Array $recipients, Array $sender) {
        $recipients = $this->doSomthing($recipients);
        foreach($recipients as $email => $name){
            if(trim($name) != "") {
                $this->mailer->addAddress($email, $name);     // Add a recipient
            } else {
                $this->mailer->addAddress($email);               // Name is optional
            }
        }
        $this->mailer->addReplyTo($sender["email"], $sender["name"]);
    }

    /**
     * setup the mail Content
     * @
     */
    public function setup_content(Array $body) {    
        $this->mailer->isHTML($this->isHTML($body['data']));                                  // Set email format to HTML
        $this->mailer->Subject = $body['subject'];
        $this->mailer->Body    = $this->setup_body($body['data'], $body['configuration']);
        $this->mailer->AltBody = 'This is the body in plain text for non-HTML mail clients';
    }



}