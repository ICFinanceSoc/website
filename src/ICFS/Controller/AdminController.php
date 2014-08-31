<?php

namespace ICFS\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Silex\ControllerProviderInterface;
use ICFS\AdminServiceProvider;
use ICFS\Model\Admin\Mail;
use ICFS\Model\Page;
use ICFS\Model\Events;

class AdminController implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        $this->nav = new \ICFS\Model\Admin\Navigation($app);

        // creates a new controller based on the default route
        $this->controllers = $app['controllers_factory'];
        
        $this->adminLogin(); //Binds the login. These need to be done first, to avoid any accidental interferance!
        $this->adminPages(); //Pages are next..

        $this->redirects(); //Redirects are last!

        return $this->controllers; //Let's send our controller back to home.
    }

    private function allowed($permission = 0) //middleware to check admin login and permissions. Permission = 0 means all admins are allowed.
    {
        return function(Request $req, Application $app) use ($permission)
        {
            if ($app['icfs.user']->checkAdminLogin() !== true)
                return $app->redirect($app['url_generator']->generate('login'));
            elseif (!$app['icfs.user']->adminAllowed($permission))
                return new Response($app['twig']->render('ngap/no-permission'));
        };
    }


    /* ******************************************************
    ** ROUTE FUNCTIONS DEFINED HERE
    ** ****************************************************** */


    private function redirects() //make life easier to manage!
    {
        $this->controllers->get('/', function (Application $app) {
            return $app->redirect('home');
        })->bind('ngap');

        $this->controllers->get('sponsors/', function (Application $app) {
            return $app->redirect('list');
        })->bind('ngap.sponsors');
    }

    /* Binds the login and logout functions */
    private function adminLogin() {

        // Logs the user out via the AdminServiceProvider (ngap.admin)
        $this->controllers->get('/user/logout', function (Application $app) {
            $app['icfs.user']->logout();
            return $app->redirect($app['url_generator']->generate('login'));
        });

        // Checks if the user is logged out. If he is, show him login, else forward to ngap
        $this->controllers->get('/login', function (Application $app) {
            if ($app['icfs.user']->checkAdminLogin())
                return $app->redirect($app['url_generator']->generate('ngap'));
            return $app['twig']->render('ngap/login', array('error' => ''));
        })->bind('login');

        // Logic behind the login. Delegates actual login function to AdminServiceProvider
        $this->controllers->post('/login', function (Application $app) {
            if (($error = $app['icfs.user']->adminLogin()) === true)
                return $app->redirect($app['url_generator']->generate('ngap', array(), true));
            return $app['twig']->render('ngap/login', array('error' => $error, 'username' => $app['request']->get('username')) );
        });
    }





    /* Binds the admin pages function */
    private function adminPages()
    {
        $this->controllers->get('home', function (Application $app) {
            return $app['twig']->render('ngap/_skeleton', array('content' => $app['twig']->render('ngap/home')));
        })->before($this->allowed())->before($this->nav->fetch()); //->before($this->nav->make())
        




        /* ****************************************************** **
        ** UPLOADS
        ** ****************************************************** */

        $this->controllers->get('uploads/main', function(Application $app) {
            return $app['twig']->render('ngap/upload_main');
        })->before($this->allowed())->before($this->nav->fetch())->bind('ngap_uploads');

        $this->controllers->get('uploads/sponsors', function(Application $app) {
            return $app['twig']->render('ngap/upload_sponsors');
        })->before($this->allowed())->before($this->nav->fetch())->bind('ngap_uploads_sponsors');

        $this->controllers->match('uploads/json/main', function(Application $app) {
            $upload_handler = new \ICFS\Model\UploadHandler(array(
                'upload_dir' => dirname(dirname(dirname(__dir__))) .'/assets/uploads/',
                'upload_url'=> $app['url_generator']->generate('homepage', array(), true) . 'assets/uploads/',
                'script_url'=> $app['url_generator']->generate('ngap', array(), true) . 'uploads/json/main',
                'delete_type' => 'POST',
                'accept_file_types' => '/\.(gif|jpe?g|png)$/i'
                ));
            return "";
        })->before($this->allowed());

        $this->controllers->match('uploads/json/sponsors', function(Application $app) {
            $upload_handler = new \ICFS\Model\UploadHandler(array(
                'upload_dir' => dirname(dirname(dirname(__dir__))) .'/assets/uploads/sponsors/',
                'upload_url'=> $app['url_generator']->generate('homepage', array(), true) . 'assets/uploads/sponsors/',
                'script_url'=> $app['url_generator']->generate('ngap', array(), true) . 'uploads/json/sponsors',
                'delete_type' => 'POST',
                'accept_file_types' => '/\.(gif|jpe?g|png)$/i'
                ));
            return "";
        })->before($this->allowed());







        /* ****************************************************** **
        ** Events Tool
        ** ****************************************************** */

        $this->controllers->get('events/', function(Application $app) {
            return $app->redirect('list');
        });

        $this->controllers->get('events/attend', function(Application $app) {
            return $app->redirect('list');
        });

        $this->controllers->get('events/list', function(Application $app) {
            $events = new Events($app);

            return $app['twig']->render('ngap/event_list', array(
                'nextFive' => $events->filter("starttime > " . time(), "starttime asc", 5),
                'lastFive' => $events->filter("starttime < " . time() . " AND starttime > " . (time() - 31557600), "starttime desc", 5)
                ));
        })->before($this->allowed($this->nav->permission('pages')))->before($this->nav->fetch());


        $this->controllers->get('events/add', function (Application $app) {
            return $app['twig']->render('ngap/event_edit', array('title' => "Add New Event"));
        })->before($this->allowed($this->nav->permission('pages')))->before($this->nav->fetch());

        $this->controllers->get('events/{eventid}', function (Application $app, $eventid) {
            $events = new Events($app);
            if (!($event = $events->get($eventid)))
                return $app->abort(404, "Event with ID $eventid doesn't exist.");

            return $app['twig']->render('ngap/event_edit', array('title' => "Edit Event", 'data' => $event->data, 'save' => $app['request']->query->has("success")));
        })->before($this->allowed($this->nav->permission('pages')))->before($this->nav->fetch());

        $this->controllers->post('events/{eventid}', function (Application $app, $eventid) {
            $events = new Events($app);
            //check the data has been given:

            if (($time = strtotime(str_replace('/','.', $app['request']->get('event-date')) . " " . $app['request']->get('event-time-start'))) !== FALSE)
                $data['starttime'] = $time;
            else
                $error = "Start time is invalid";

            if (($time = strtotime(str_replace('/','.', $app['request']->get('event-date')) . " " . $app['request']->get('event-time-end'))) !== FALSE)
                $data['endtime'] = $time;
            else
                $error = "Start time is invalid";


            foreach (array('event-title', 'event-location', 'event-organiser', 'event-sponsorID', 'event-information') as $required) {
                $data[str_replace('event-', '', $required)] = $app['request']->get($required);
                if (strlen($app['request']->get($required)) < 3)
                    $error = "Field is not long enough: <b>$required</b>";
            }
            //if (time() > $data['starttime'] || time() > $data['endtime'])
            //    $error = "Event time cannot be in the past!";
            if (@$data['endtime'] < @$data['starttime'])
                $error = "Event cannot end before it starts!";

            $data['open'] = ($app['request']->get('event-enabled') == "on") ? '1' : '0';

            if (!isset($error)) {
                if ($eventid == "add") {
                    echo "CREATE";
                    $page = $events->create($data);
                } else {
                    $page = $events->get($eventid);
                    if ($page->exists) {
                        $page->update($data);
                    } else
                        $error = "Page ID doesn't exist. Deleted before created?";
                }
            }

            if (isset($error))
                return $app['twig']->render('ngap/event_edit', array('title' => ($eventid == "add") ? "Add New Event" : "Edit Event", 'data' => $data, 'error'=>@$error));
            return $app->redirect($app['url_generator']->generate('ngap', array(), true) . 'events/' . $page->id . '?success');

        })->before($this->allowed($this->nav->permission('pages')))->before($this->nav->fetch());






        /* ****************************************************** **
        ** Page Editor
        ** ****************************************************** */

        $this->controllers->get('pages/', function(Application $app) {
            return $app->redirect('add');
        });

        // GET - Add Page
        $this->controllers->get('pages/add', function (Application $app) {
            return $app['twig']->render('ngap/page_edit', array('title' => "Add New Page"));
        })->before($this->allowed($this->nav->permission('pages')))->before($this->nav->fetch());


        // GET - Edit Page
        $this->controllers->get('pages/{pageid}', function (Application $app, $pageid) {
            $page = new Page($app, $pageid);
            if (!$page->exists)
                return $app->abort(404, "Page $pageid doesn't exist.");

            if ($app['request']->query->has("delete")){
                $page->delete();
                return $app->redirect($app['url_generator']->generate('ngap'));
            }

            return $app['twig']->render('ngap/page_edit', array('data' => $page->data, 'save' => $app['request']->query->has("success")));
        })->before($this->allowed())->before($this->nav->fetch());

        // POST - Add and Edit Page
        $this->controllers->post('pages/{pageid}', function (Application $app, $pageid) {

            // Save our values to the data variable to pass to the Page Model.
            $data = array(
                'name' => $app['request']->get('page_url'),
                'title' => $app['request']->get('page_title'),
                'content' => $app['request']->get('page_content'), 
                'owner' => $app['icfs.user']->username
                );

            if (strlen($app['request']->get('page_title')) < 2 || strlen($app['request']->get('page_url')) < 2)
                $error = "Please make sure the title and url are long enough (2 characters)";
            elseif (strpos($app['request']->get('page_url'), '/')) {
                $error = "Please remove all forward slashes from the url";
            }
            else {
                if ($pageid == "add") {
                    if (!($page = Page::create($app, $data))) //$page will return false if the name is used already
                        $error = "Name is in use already - new page can't be made with an exisiting page name!";
                } else {
                    $page = new Page($app, $pageid);
                    if (!$page->exists)
                        $error = "Page doesn't exist... strange error (deleted while you were editing?)";
                    elseif (!$page->canRename($data['name'])) {
                        $error = "Name is in use already - you can't change a page name to an existing page name!";
                        $data = array_merge($page->data, $data); //this gives us the "Last edited" stuff
                    } else
                        $page->update($data); //all good, let's update!
                }
            }

            if (isset($error))
                return $app['twig']->render('ngap/page_edit', array('data' => $data, 'error' => @$error));
            return $app->redirect($app['url_generator']->generate('ngap', array(), true) . 'pages/' . $data['name'] . '?success');

            return $app->abort(404, "Page $pageid does not exist.");
        })->before($this->allowed())->before($this->nav->fetch());







        /* ****************************************************** **
        ** Mailer
        ** ****************************************************** */

        $this->controllers->get('mail/new', function (Application $app) {
            return $app['twig']->render('ngap/email_edit.twig', array('title' => "Create new email"));
        })->before($this->allowed($this->nav->permission('mail')))->before($this->nav->fetch());

        $this->controllers->post('mail/new', function (Application $app) {
            $data = array(
                'subject' => $app['request']->get('subject'),
                'from-address' => $app['request']->get('frm_adr'),
                'from-name' => $app['request']->get('frm_name'),
                'content' => $app['request']->get('email_content'),
                'sender' => $app['icfs.user']->username
            );
            $app['icfs.mail']->insertMail($data);
            return 'Your message has been added to the system and will be sent shortly';
        })->before($this->allowed($this->nav->permission('mail')))->before($this->nav->fetch());









        /* ****************************************************** **
        ** Members
        ** ****************************************************** */

        $this->controllers->get('members/list', function (Application $app) {
            $members = $app['icfs.members']->returnMembers();
            if(!(null === $deletedMember = $app['session']->get('deleted-member')))
            {
                $app['session']->remove('deleted-member');
                if($deletedMember)
                {
                    return $app['twig']->render('ngap/members_list', array('members' => $members, 'deleted' => $deletedMember, 'success' => true));
                }
                else
                {
                    return $app['twig']->render('ngap/members_list', array('members' => $members, 'success' => false));
                }
            }
            else
            {
                return $app['twig']->render('ngap/members_list', array('members' => $members));
            }
        })->before($this->allowed($this->nav->permission('pages')))->before($this->nav->fetch());;

        $this->controllers->get('members/delete/{uname}', function (Application $app, $uname) {
            if($result = $app['icfs.members']->deleteMember($uname, 'NGAP'))
            {
                $app['session']->set('deleted-member', $result);
            }
            else
            {
                $app['session']->set('deleted-member', false);
                
            }
            return $app->redirect($app['url_generator']->generate('ngap', array(), true) . 'members/list');
        })->before($this->allowed($this->nav->permission('pages')))->before($this->nav->fetch());;









        /* ****************************************************** **
        ** Sponsors
        ** ****************************************************** */

        $this->controllers->get('sponsors/list', function (Application $app) {
            return $app['twig']->render('ngap/sponsor_list', array('sponsors' => $app['db.em']->getRepository('\\ICFS\\Model\\Sponsors')->findAll()));
        })->before($this->allowed($this->nav->permission('pages')))->before($this->nav->fetch());

        // GET - Add Page
        $this->controllers->get('sponsors/edit/add', function (Application $app) {
            return $app['twig']->render('ngap/sponsor_edit', array('title' => "Add New Sponsor"));
        })->before($this->allowed($this->nav->permission('pages')))->before($this->nav->fetch());


        // GET - Edit Page
        $this->controllers->get('sponsors/edit/{sponsorid}', function (Application $app, $sponsorid) {
            if (!($sponsor = $app['db.em']->find('\\ICFS\\Model\\Sponsors', $sponsorid)))
                return $app->abort(404, "Sponsor $sponsorid doesn't exist.");
            return $app['twig']->render('ngap/sponsor_edit', array('data' => $sponsor, 'save' => $app['request']->query->has("success")));
        })->before($this->allowed())->before($this->nav->fetch());


        // POST - Pages
        $this->controllers->post('sponsors/edit/{sponsorid}', function (Application $app, $sponsorid) {
            if ($sponsorid == 'add')
                $sponsor = new \ICFS\Model\Sponsors();
            elseif (!($sponsor = $app['db.em']->find('\\ICFS\\Model\\Sponsors', $sponsorid)))
                return $app->abort(404, "Sponsor $sponsorid doesn't exist.");

            $data = array(
                'sid' => $sponsorid,
                'name' => $app['request']->get('sponsor_name'),
                'type' => ($app['request']->get('sponsor_type')) ? $app['request']->get('sponsor_type') : 4,
                'about' => $app['request']->get('sponsor_about'),
                'logo' => $app['request']->get('sponsor_logo'),
                'url' => $app['request']->get('sponsor_url')
            );

            if ($error = $sponsor->update($data))
                return $app['twig']->render('ngap/sponsor_edit', array('data' => $data, 'error' => @$error, 'save' => $app['request']->query->has("success")));

            $app['db.em']->persist($sponsor);
            $app['db.em']->flush();

            return $app->redirect($app['url_generator']->generate('ngap', array(), true) . 'sponsors/edit/' . $sponsor->getId() . '?success');           
        })->before($this->allowed($this->nav->permission('pages')))->before($this->nav->fetch());









        /* ****************************************************** **
        ** Team Management
        ** ****************************************************** */

        $this->controllers->get('team/', function (Application $app) {
            return $app->redirect($app['url_generator']->generate('ngap', array(), true) . 'team/' . (date('Y') - (date('m') < 8)));
        })->before($this->allowed())->before($this->nav->fetch());

        $this->controllers->get('team/{year}', function (Application $app, $year) {
            $team = new \ICFS\Model\ICFSTeam($app);
            $comittee = $team->getComittee($year);

            return $app['twig']->render('ngap/team_manager', array('selectyear' => $year, 'comittee' => $comittee));
        })->before($this->allowed())->before($this->nav->fetch());

        $this->controllers->post('team/{year}', function (Application $app, $year) {
            $team = new \ICFS\Model\ICFSTeam($app);

            if ($error = $team->updateFromPost($year))
                return $app['twig']->render('ngap/team_manager', array('selectyear' => $year, 'comittee' => $app['request']->request->get('comittee')));
            return $app->redirect($app['url_generator']->generate('ngap', array(), true) . 'team/' . $year);
        })->before($this->allowed())->before($this->nav->fetch());
    }
}









