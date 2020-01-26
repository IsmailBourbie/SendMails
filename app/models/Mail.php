<?php

namespace App\Models;
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function

use App\Classes\File;
use App\Classes\Files\Attachment;
use App\Classes\Files\Html;
use App\Classes\Files\Image;
use App\Classes\Helper;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class Mail
{


    /**
     * Instance of PHPMailer class
     * @var object
     * @access private
     */
    private $mailer;

    /**
     * Array of sender information
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
     * Array of body information
     * @var array
     * @access private
     */
    private $body;

    /**
     * Array of attachments
     * @var array
     * @access private
     */
    private $attachments;

    /**
     * Constructor of Mail Class
     * @param array $recipients
     * @param array $body
     *
     */
    public function __construct($sender, $recipients, $body, $attachments)
    {
        $this->mailer = new PHPMailer(true);
        $this->checkRecipients($recipients);
        $this->sender = $sender;
        $this->body = $body;
        $this->attachments = $attachments;
    }


    /**
     * setup the configuration of the server
     * @param Array : configurations
     */
    public function setup_config(array $config)
    {
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
     * @param Array $recipients information stored as an array of email=>name
     * @param string $replyTo_email 
     * @param string $replyTo_name 
     */
    private function setup_recipients($email, $name)
    {
        if (trim($name) != "" && !is_null(trim($name))) {
            $this->mailer->addAddress($email, $name);     // Add a recipient
        } else {
            $this->mailer->addAddress($email);               // Name is optional
        }
    }

    /**
     * setup the mail Content
     */
    private function setup_content($body, $recipient)
    {
        $this->mailer->isHTML(true);                                  // Set email format to HTML
        $this->mailer->Subject = $body['subject'];
        $type                  = $body['type'];
        $messageContent        = $body['data'];
        $config                = $body['configuration'];
        $this->mailer->Body    = $this->setup_body(
            $type,
            $messageContent,
            $config,
            $recipient
        );
        $this->mailer->AltBody = 'This is the body in plain text for non-HTML mail clients';
    }

    /**
     * setup the body information
     * @param String $type; type of the mail (inline or file)
     * @param String $message: the content of the body
     * @param Array $config 
     * @return String $message
     */
    private function setup_body($type, $messageContent, $config, $recipient)
    {
        if ($type === 'inline') {
            $message = $messageContent;
        } else if ($type === 'file') {
            $file = 'workspace/' . $messageContent;
            $html = new Html($file);
            if ($html->isValid()) {
                $message = $html->content();
                $message = $this->setup_configuration(
                    $message,
                    $config,
                    $recipient
                );
            }
        }
        return $message;
    }

    /**
     * setup the configuration of mail if is it html file
     * @param Array $config
     * @param string $data
     */
    private function setup_configuration($message, $config, $recipient)
    {
        // setup images
        if ($config['images']['hasImages'] == 'true') {
            $this->setup_images($config['images']['path']);
        }

        $message = $this->setupReplacedText($message, $recipient, $config['replacedText']);

        return $message;
    }

    /**
     * replace keys with their values from json file
     * @param string $message
     * @param array $recipient
     * @return bool $message: after replace keys with values
     */
    private function setupReplacedText($message, $recipient, $config)
    {
        if ($config['hasReplacedText'] == 'true') {
            $keys = explode(',', $config['keys']);
            foreach ($keys as $replacedKey) {
                $search = "%" . $replacedKey . "%";
                $replace = $recipient[$replacedKey];
                $message = str_replace($search, $replace, $message);
            }
        }
        return $message;
    }

    public function setup_attachments()
    {
        $attachments = $this->attachments;

        if ($attachments['hasAttachments'] == 'true') {
            $dirPath = 'workspace/' . $attachments['attachmentsFiles'];
            $attachments = File::readFromDirectory($dirPath);
            array_map(function ($filename) use ($dirPath) {
                $path = $dirPath . '/' . $filename;
                $attachment =  new Attachment($path);
                if ($attachment->isValid()) {
                    $this->mailer->addAttachment(
                        $attachment->getFilepath(),
                        $attachment->getBasename()
                    );
                }
            }, $attachments);
        }
    }


    private function setup_images($path)
    {
        $dirPath = 'workspace/' . $path;
        $images = File::readFromDirectory($dirPath);
        array_map(function ($filename) use ($dirPath) {
            $path = $dirPath . '/' . $filename;
            $image =  new Image($path);
            if ($image->isValid()) {
                $this->mailer->AddEmbeddedImage(
                    $image->getFilepath(),
                    $image->getFilename(),
                    $image->getBasename()
                );
            }
        }, $images);
    }
    public function sendAll()
    {
        $tracing = [
            'not_sent' => [],
            'sent' => [],

        ];
        $this->mailer->setFrom($this->sender['email'], $this->sender['name']);
        $this->setup_attachments();
        foreach ($this->recipients as $recipient) {
            $email = $recipient['email'];
            $name = $recipient['name'];
            $this->setup_recipients($email, $name);
            $this->setup_content($this->body, $recipient);
            $tracing = $this->send($email, $name, $tracing);
            $this->mailer->ClearAddresses();
        }
        return $tracing;
    }

    private function send($email, $name, $tracing)
    {
        if (!$this->mailer->send()) {
            $tracing['not_sent'][] = [$email, $name];
        } else {
            $tracing['sent'][] = [$email, $name];
        }
        return $tracing;
    }

    /**
     * Check recipients if it's file or inline
     * @param array $recipients
     */
    private function checkRecipients(array $recipients)
    {
        if ($recipients['type'] === 'file') {
            $file = 'workspace/' . $recipients['data'];
            $this->recipients = json_decode(file_get_contents($file), true);
        } elseif ($recipients['type'] === 'inline') {
            $recipients = explode(',', $recipients['data']);
            $this->recipients = $this->formatRecipients($recipients);
        }
    }

    private function formatRecipients(array $recipients)
    {
        $formattedArray = [];
        foreach ($recipients as $recipient) {
            $formattedArray[] = [
                "email" => $recipient,
                "name" => NULL
            ];
        }
        return $formattedArray;
    }
}
