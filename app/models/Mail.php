<?php

namespace App\Models;
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function

use App\Classes\Helper;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class Mail {

    
    /**
     * Instance of PHPMailer class
     * @var object
     * @access private
     */
    private $mailer;

    /**
     * Array of recipients
     * @var array
     * @access private
     */
    private $sender;

    /**
     * Array of recipients
     * @var array
     * @access private
     */
    private $recipients;

    /**
     * Array of recipients
     * @var array
     * @access private
     */
    private $body;

     /**
      * Constructor of Mail Class
      * @param array $recipients
      * @param array $body
      *
      */
    public function __construct($recipients, $body, $sender, $attachements) {
        $this->mailer = new PHPMailer(true);
        $this->checkRecipients($recipients);
        $this->sender = $sender;
        $this->body = $body;
        $this->attachements = $attachements;
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
    }

    /**
     * setup recipients of the mail
     * @param Array $recipients informations stord as an array of email=>name
     * @param string $repleyTo_email 
     * @param string $repleyTo_name 
     */
    private function setup_recipients ($email, $name) {
            if(trim($name) != "" && !is_null(trim($name))) {
                $this->mailer->addAddress($email, $name);     // Add a recipient
            } else {
                $this->mailer->addAddress($email);               // Name is optional
            }
    }

    /**
     * setup the mail Content
     */
    private function setup_content($body, $recipient) {
        $this->mailer->isHTML(true);                                  // Set email format to HTML
        $this->mailer->Subject = $body['subject'];
        $this->mailer->Body    = $this->setup_body($body['type'], $body['data'], $body['configuration'], $recipient);
        $this->mailer->AltBody = 'This is the body in plain text for non-HTML mail clients';
    }

    /**
     * setup the body information
     * @param String $type; type of the mail (inline or file)
     * @param String $message: the content of the body
     * @param Array $config 
     * @return String $message
     */
    private function setup_body($type, $data, $config, $recipient) {
        if($type === 'inline') {
            $message = $data;
        } else if($type === 'file') {
            $file = 'workspace/' . $data;
            $message = file_get_contents($file);
            $message = $this->setup_configuration($message, $config, $recipient);
        }
        return $message;
    }

    /**
     * setup the configuration of mail if is it html file
     * @param Array $config
     * @param string $data
     */
    private function setup_configuration($message, $config, $recipient) {
        // setup images
        if($config['hasImages'] == 'true') {
            // $this->setup_images($config['images']);
        }

        $message = $this->setupReplacedText($message, $recipient, $config['replacedKeys'], $config['hasReplacedText']);

        return $message;
    }

    /**
     * replace keys with their values from json file
     * @param string $message
     * @param array $recipient
     * @param string $replacedKeys : has all the keys separated with ','
     * @param strinf $hasReplacedText: by default is false
     * @return bool $message: after relace keys with values
     */
    private function setupReplacedText($message, $recipient, $replacedKeys, $hasReplacedText = 'false') {
        if($hasReplacedText == 'true') {
            $replacedKeys = explode(',', $replacedKeys);
            foreach($replacedKeys as $replacedKey) {
                $search = "%".$replacedKey."%";
                $replace = $recipient[$replacedKey];
                $message = str_replace($search, $replace, $message);
            }            
        }
        return $message;
    }

    public function setup_attachements() {        
        $attachements = $this->attachements;

        if($attachements['hasAttachements'] == 'true') {
            $attachementsFiles = $attachements['attachementsFiles'];
            $folder = implode('/', explode('/', $attachementsFiles, -1));
            $folder = $folder !== "" ? $folder . "/" : "";
            $parts = explode('/', $attachementsFiles);
            $files = explode(',', end($parts));        
            foreach($files as $file) {
                $path = 'workspace/' . $folder.''.$file;
                if(Helper::validAttachements($path)) {
                    $this->mailer->addAttachment($path, $file);       
                }
            }
        }
    }


    public function setup_images($dir) 
    {
        $dir = 'workspace/' . $dir;
        $files = array_diff(scandir($dir), array('.', '..'));
        foreach($files as $key => $file) {
            $path = $dir .'/'. $file;
            if(Helper::validImage($path))
            {
                $files_parts = pathinfo($path);
                $name = $files_parts['basename'];
                $cid = $files_parts['filename'];

                die(var_dump($name));
                $this->mailer->AddEmbeddedImage($path, $cid, $name);
            }
            die(var_dump("ss"));
        }
        die();
    }
    public function sendAll() {
        $tracing = [
            'not_sent' => [],
            'sent' => [],

        ];        
        $this->mailer->setFrom($this->sender['email'], $this->sender['name']);
        $this->setup_attachements();
        foreach($this->recipients as $recipient) {
            $email = $recipient['email'];
            $name = $recipient['name'];
            $this->setup_recipients($email, $name);
            $this->setup_content($this->body, $recipient);
            $tracing = $this->send($email, $name, $tracing);
            $this->mailer->ClearAddresses();
        }
        return $tracing;
    }

    private function send($email, $name, $tracing) {
        if(!$this->mailer->send()) {
            $tracing['not_sent'][] = [$email, $name];
        } else {
            $tracing['sent'][] = [$email, $name];
        }
        return $tracing;
    }

    /**
     * Check reciptions if it's file or inline
     * @param array $recipients
     */
    private function checkRecipients(Array $recipients) {
        if($recipients['type'] === 'file') {
            $file = 'workspace/' . $recipients['data'];
            $this->recipients = json_decode(file_get_contents($file), true);
        } elseif($recipients['type'] === 'inline') {
            $recipients = explode(',', $recipients['data']);
            $this->recipients = $this->formatRecipients($recipients);
        }
    }

    private function formatRecipients(Array $recipients) {
        $formattedArray = [];
        foreach($recipients as $recipient) {                
            $formattedArray[] = [
                "email" => $recipient,
                "name" => NULL
            ];
        }
        return $formattedArray;
    }

}