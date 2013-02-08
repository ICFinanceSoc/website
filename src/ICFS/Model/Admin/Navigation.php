<?php
/* 
 * This is the user handler. Extends to also use NGAP!
 * Login, Logout and logging is handled by this
*/

namespace ICFS\Model\Admin;

use Silex\Application;

class Navigation
{
    public function __construct(Application $app)
    {
        $this->pages = array(
            'user' => array(
                'generate' => function($name) use ($app) {
                    $name['name'] = "Hello, " . $app['icfs.user']->name['first'];
                    $name['type'] = "holder";
                    $name['class'] = "user";
                    $name['subpages'] = array(
                        'info1' => array(
                            'name' => $app['icfs.user']->name['full'],
                            'type' => 'holder'),
                        'info2' => array(
                            'name' => 'Logging: ' . $app['icfs.user']->username,
                            'type' => 'holder'),
                        'info3' => array(
                            'name' => 'Admin: ' . $app['icfs.user']->admin,
                            'type' => 'holder'),
                        'logout' => array(
                            'name' => 'Logout',
                            'class' => 'logout',
                            'type' => 'link')
                        );
                    return $name;
                }),
            'home' => array(
                'name' => 'Home',
                'type' => 'link'
            ),
            'members' => array(
                'name' => 'Members »',
                'type'  =>  'holder',
                'subpages' => array(
                    'list' => array(
                        'name' => 'Member List',
                        'type' => 'link'),
                )
            ),
            'mail' => array(
                'name' => 'Messaging System »',
                'type' => 'holder',
                'subpages' => array(
                    'new' =>array(
                        'name' => 'New E-mail',
                        'type' => 'link'
                    )
                )
            ),
            'events' => array(
                'name' => 'Events »',
                'type'  =>  'holder',
                'subpages' => array(
                    'attend' => array(
                        'name' => 'Complete Attendance',
                        'type' => 'link'),
                    'list' => array(
                        'name' => 'Event List',
                        'type' => 'link'),
                    'add' => array(
                        'name' => 'Add Event',
                        'class' => 'navli-green',
                        'type' => 'link')
                )
            ),
            'sponsors' => array(
                'name'  =>  'Sponsors' ,
                'type'  =>  'link'  
            ),
            'team' => array(
                'name'  =>  'ICFS Team' ,
                'type'  =>  'link'  
            ),
            'pages' => array(
                'name' => 'Page Manager »',
                'type'  =>  'holder',
                'permission' => 0,
                'generate' => function ($name) use ($app) {
                    $cmspages = $app['db']->fetchAll("SELECT name,title FROM pages_content");


                    foreach ( $cmspages as $key=>$value )  { //generate the sub-pages for the 'pages' page. Pageception!
                        $name['subpages'][$value['name']] = array(
                            'name' => $value['title'],
                            'type' => 'link'
                            );
                    }
                    $name['subpages']['add'] = array(
                            'name' => 'Add New Page',
                            'class' => 'navli-green',
                            'type' => 'link'
                        );

                    return $name;
                }
            ),
            'settings' => array(
                'name' => 'NGAP Settings »',
                'type'  =>  'holder',
                'subpages' => array(
                    'access' => array(
                        'name' => 'Ngap Access',
                        'type' => 'link',
                        'permission' => 0)
                )
            ),
            'uploads' => array(
                'name' => 'Uploads',
                'type' => 'link'


            )

        );
    }

    //gets the permissions for a page. Currently subpage permissions doesnt work!
    public function permission($page, $subpage = null)
    {
        if ($subpage != null)
            if (isset($this->pages[$page]['subpages'][$subpage]['permission']))
                return $this->pages[$page]['subpages'][$subpage]['permission'];
        if (isset($this->pages[$page]['permission']))
            return $this->pages[$page]['permission'];
        return 0;
    }

    public function fetch() //makes a a closure (un-executed function) for silex to execute before a page is rended. This makes the Twig global to generate the navigation bar.
    {
        $pages = $this->pages; //we cant pass $this-> variables as use()
        return function (\Symfony\Component\HttpFoundation\Request $req, Application $app) use ($pages) {
            foreach ($pages as $key=>$value)
            {
                if ($app['icfs.user']->adminAllowed( (isset($value['permission'])) ? $value['permission'] : 0 )) {
                    if (isset($value['generate']))
                        $navigation[$key] = $value['generate']($pages[$key]);
                    else
                        $navigation[$key] = $pages[$key];

                    if (isset($navigation[$key]['subpages']))
                    {
                        foreach ($navigation[$key]['subpages'] as $subkey=>$subvalue)
                        {
                            if (!$app['icfs.user']->adminAllowed( (isset($subvalue['permission'])) ? $subvalue['permission'] : 0 )) {
                                echo $navigation[$key]['subpages'][$subkey];
                                unset($navigation[$key]['subpages'][$subkey]);
                            }
                        }
                    }

                }
            }

            $app['twig']->addGlobal('ngap_nav', $navigation);
        };
    }
}

