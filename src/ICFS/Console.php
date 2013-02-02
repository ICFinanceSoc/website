<?php
/**
 * Created by JetBrains PhpStorm.
 * User: txsl
 * Date: 05/01/2013
 * Time: 02:38
 */

namespace ICFS;

Use Symfony\Component\Console\Application as BaseApplication;

class Console extends BaseApplication
{
    protected $container;

    public function setContainer(\Pimple $container)
    {
        $this->container = $container;
    }

    public function getContainer()
    {
        return $this->container;
    }
}