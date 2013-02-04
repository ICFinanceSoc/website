#!/usr/bin/env php
<?php
/**
 * Created by JetBrains PhpStorm.
 * User: txsl
 * Date: 04/01/2013
 * Time: 02:36
 * To change this template use File | Settings | File Templates.
 */

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use ICFS\Model\Admin\Mail;

date_default_timezone_set("GMT");

require_once 'bootstrap.php';

$console = new Application('ICFS Console', '0.1');

$console->register('send-emails')
	->setDefinition( array(
	    )
	)
	->setDescription('Send emails which are due to be sent')
	->setHelp(<<<EOF
	The <info>swiftmailer:spool:send</info> command sends all emails from the spool.
	 
	<info>php bin/console.php send-email --message-limit=10 --time-limit=10</info>
	 
EOF
	)
	->setCode(
	    function (InputInterface $input, OutputInterface $output) use ($app) {
	        
	        $tosend = $app['icfs.mail']->loadMailToSend();
	        //var_dump($tosend);
	        if(empty($tosend))
	        {
	        	$output->writeln('Nothing to send');
	        	return;
	        }
	        foreach ($tosend as $mail) 
	        {
	        	$app['icfs.mail']->markAsSent($mail['mid']);
	        	$members = $app['icfs.members']->return_members();
	        	foreach ($members as $member)
	        	{
	        		$output->writeln('Sending email to '.$member['fname']);
	        		$app['icfs.mail']->send_email($mail, $member);
	        		if ($app['mailer.initialized']) 
                    {
                    	$output->writeln('flushing spool cache');
					    $app['swiftmailer.spooltransport']->getSpool()->flushQueue($app['swiftmailer.transport']);
					}
	        	}
	        }
	    }
	);

$console->run();
