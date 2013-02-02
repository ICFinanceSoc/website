<?php
/**
 * Created by JetBrains PhpStorm.
 * User: txsl
 * Date: 04/01/2013
 * Time: 01:18
 * In here resides how we interact with the mail table, and SwiftMailer
 */

namespace ICFS\Model\Admin;

class Mail
{
    var $app;

    function __construct($app)
    {
        $this->app = $app;
    }

    static public function insertMail($app, $data)
    {
        $sql = "INSERT INTO `mail` (`from-address`, `from-name`, `subject`, `content`, `sender`, `sendtime`) VALUES (?, ?, ?, ?, ?, NOW())";
        $stmt = $app['db']->prepare($sql);
        $stmt->bindValue(1, $data['from-address']);
        $stmt->bindValue(2, $data['from-name']);
        $stmt->bindValue(3, $data['subject']);
        $stmt->bindValue(4, $data['content']);
        $stmt->bindValue(5, $data['sender']);
        $stmt->execute();
    }

    function loadMailToSend()
    {
        $this->app['db']->fetchAll("SELECT * FROM `mail` where `sent` = 0 AND `draft` = 0"); // Query to get unsent msgs. Will need to work with time in future

    }

    function markAsSent($mid)
    {
        $this->app['db']->executeQuery("UPDATE `mail` SET `sent`=1 WHERE `mid`=?", array($mid));
    }
}