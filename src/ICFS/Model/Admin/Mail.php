<?php
/**
 * Created by JetBrains PhpStorm.
 * User: txsl
 * Date: 04/01/2013
 * Time: 01:18
 * In here resides how we interact with the mail table, and SwiftMailer
 */

namespace ICFS\Model\Admin;

use Silex\Application;
use Silex\ServiceProviderInterface;

class Mail implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        $app['icfs.mail'] = $app->share(function ($app) {
            return new ICFSMail($app);
        });
    }

    public function boot(Application $app)
    {
        
    }
}

class ICFSMail
{
    var $app;

    function __construct($app)
    {
        $this->app = $app;
        //$loader = new \Silex\Provider\Twig_Loader_String();
        //$this->twig = new \Silex\Provider\Twig_Environment($loader);

    }

    public function insertMail($data)
    {
        $sql = "INSERT INTO `mail` (`from-address`, `from-name`, `subject`, `content`, `sender`, `sendtime`) VALUES (?, ?, ?, ?, ?, NOW())";
        $stmt = $this->app['db']->prepare($sql);
        $stmt->bindValue(1, $data['from-address']);
        $stmt->bindValue(2, $data['from-name']);
        $stmt->bindValue(3, $data['subject']);
        $stmt->bindValue(4, $data['content']);
        $stmt->bindValue(5, $data['sender']);
        $stmt->execute();
    }

    public function loadMailToSend()
    {
        return $this->app['db']->fetchAll("SELECT * FROM `mail` where `sent` = 0 AND `draft` = 0"); // Query to get unsent msgs. Will need to work with time in future

    }

    public function markAsSent($mid)
    {
        $this->app['db']->executeQuery("UPDATE `mail` SET `sent`=1 WHERE `mid`=?", array($mid));
    }

    private function merge_names($content, $merge)
    {
        return $this->twig->render($content, $merge);
    }

    private function merge_emails($subject, $content, $merge)
    {
        //Will make this work once the twig string loader is working...
        //$merged_content = $this->merge_names($content, $merge);
        $html_content = $this->app['twig']->render('ngap/mail-template.twig', array('content' => $content));
        $plain_content = strip_tags($content);
        //$subject = $this->twig->render($subject, $merge);
        return array('subject' => $subject,
                        'plain_content' => $plain_content,
                        'html_content' => $html_content
                        );
    }

    // merge is the data specific to each user which we are sending to.
    public function send_email($mailInfo, $to)
    {
        $merged_data = $this->merge_emails($mailInfo['subject'], $mailInfo['content'], $to);

        $message = \Swift_Message::newInstance()
                    ->setSubject($mailInfo['subject'])
                    ->setFrom(array($mailInfo['from-address'] => $mailInfo['from-name']))
                    ->setTo(array($to['email']))
                    ->setBody($merged_data['html_content'], 'text/html')
                    ->addPart($merged_data['plain_content'],'text/plain');

        $this->app['mailer']->send($message);
    }
    
}
