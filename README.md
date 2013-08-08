Hybridauth CakePHP Plugin
====================
v 1.0.0 for cakePHP 2.x

This plugin is a wrap of [http://hybridauth.sourceforge.net](https://github.com/hybridauth/hybridauth) project

Install
====================
1) clone this repo in your /app/Plugin

<pre><code>
$ cd your-repo/app/Plugin
$ git clone https://github.com/awallef/Hybridauth.git
</code></pre>

2) load the plugin in your bootstrap.php file

<pre><code>
CakePlugin::load('Hybridauth', array('bootstrap' => true, 'routes' => false));
</code></pre>

3) copy /app/Plugin/hybridauth/Config/hybridauth.php in your /app/Config/ folder and edit with your providers infos


Usage
====================
1) Set your Google Auth, Facebook Auth, Twitter Auth...

the retun url callback is:

<pre><code>
http://www.your-website.com/hybridauth/endpoint?hauth.done=Google // with Google for exemple
</code></pre>


2) It's a component with four methods acctually ;)

<pre><code>
// connection, pass a provider    
$this->Hybridauth->connect('Google');

// sign out
$this->Hybridauth->logout();

// get serialized array of acctual Hybridauth from provider...
$this->Hybridauth->getSessionData();

// pass a serialized array stored previously
$this->Hybridauth->restoreSessionData( $hybridauth_session_data );
    
</code></pre>

3) If you have a YoupiController for exemple it work like so:

<pre><code>
App::uses('AppController', 'Controller');

class YoupiController extends AppController {

    public $uses = array();
    
    public $components = array('Hybridauth.Hybridauth');
    
    public function check() {
       debug( $this->Hybridauth->getSessionData() );
    }

    public function test() {
        
        if( $this->Hybridauth->connect('Google') ){
            debug( $this->Hybridauth->user_profile ); // success
        }else{
            debug( $this->Hybridauth->error ); // error
        }
    }

}
</code></pre>

Debug
====================
you can set debug mode
<pre><code>
$this->Hybridauth->debug_mode = true;

// and pass a file to write in logs if u like ;)
$this->Hybridauth->debug_file = "log/me/somewhere/log.txt";
</code></pre>

Docs:
====================
You can find  complete documentation for HybridAuth Original project
at [http://hybridauth.sourceforge.net](http://hybridauth.sourceforge.net)