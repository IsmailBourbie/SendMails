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
    public function setup_recipients ($email, $name) {
            if(trim($name) != "") {
                $this->mailer->addAddress($email, $name);     // Add a recipient
            } else {
                $this->mailer->addAddress($email);               // Name is optional
            }
    }

    /**
     * setup the mail Content
     * @param Array $body
     */
    public function setup_content(Array $body) {
        // TODO: implement is_html() and setup_body() function 
        $this->mailer->isHTML($this->is_html($body['data']));                                  // Set email format to HTML
        $this->mailer->Subject = $body['subject'];
        $this->mailer->Body    = $this->setup_body($body['type'], $body['data'], $body['configuration']);
        $this->mailer->AltBody = 'This is the body in plain text for non-HTML mail clients';
    }

    /**
     * setup the body information
     * @param String $type; type of the mail (inline or file)
     * @param String $data: the content of the body
     * @param Array $config 
     * @return String $message
     */
    private function setup_body($type, $data, $config) {
        if($type === 'inline') {
            $message = $data;
        } else if($type === 'file') {
            $message = file_get_contents($data);
            $message = $this->setup_configuration($data, $config);
        }
        return $message;
    }

    /**
     * setup the configuration of mail if is it html file
     * @param Array $config
     * @param string $data
     */
    private function setup_configuration($data, $config) {
        // setup images
        if($config['hasImages'] == 'true') {
            $this->setup_images($config['images']);
        }

        // setup replacedText
        if($config['hasReplacedText'] == 'true') {
            $this->setup_keys($config['replacedKeys'], $data);
        }
    }

    public function send_mails($recipients, $body) {
        $recipients = $this->doSomthing($recipients);
        foreach($recipients as $email => $name) {
            $this->setup_recipients($email, $name);
            $this->setup_content($body);
            $this->send($email, $name);
            $this->mailer->ClearAddresses();
        }
    }

    private function send($email, $name) {
        $tracing = [];
        if(!$this->mailer->send()) {
            $tracing['not_sent'][] = [$email, $name];
        } else {
            $tracing['sent'][] = [$email, $name];
        }
    }



}