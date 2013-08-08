<?php

/**
 * CakePHP HybridauthComponent
 * @author mike
 */
class HybridauthComponent extends Component {

    public $hybridauth = null;
    public $adapter = null;
    public $user_profile = null;
    public $error = "no error so far";
    public $provider = null;
    public $debug_mode = false;
    public $debug_file = "";

    protected function init(){
        App::import('Hybridauth.Vendor', 'hybridauth/Hybrid/Auth');
        $config = array(
            "base_url" => Router::url("/hybridauth/endpoint", true),
            "providers" => Configure::read('Hybridauth'),
            "debug_mode" => $this->debug_mode,
            "debug_file" => $this->debug_file,
        );
        $this->hybridauth = new Hybrid_Auth( $config );
    }
    
    /**
     * get serialized array of acctual Hybridauth from provider...
     * 
     * @return string
     */
    public function getSessionData(){
        if( !$this->hybridauth ) $this->init ();
        return $this->hybridauth->getSessionData();
    }
    
    /**
     * 
     * @param string $hybridauth_session_data pass a serialized array stored previously
     */
    public function restoreSessionData( $hybridauth_session_data ){
        if( !$this->hybridauth ) $this->init ();
        $hybridauth->restoreSessionData( $hybridauth_session_data );
    }
    
    /**
     * logs you out
     */
    public function logout(){
        if( !$this->hybridauth ) $this->init ();
        $this->adapter->logout();
    }
    
    /**
     * connects to a provider
     * 
     * 
     * @param string $provider pass Google, Facebook etc...
     * @return boolean wether you have been logged in or not
     */
    public function connect($provider) {
        
        if( !$this->hybridauth ) $this->init ();
        
        $this->provider = $provider;

        try {
            
            // try to authenticate the selected $provider
            $this->adapter = $this->hybridauth->authenticate($this->provider);
            
            // grab the user profile
            $this->user_profile = $this->adapter->getUserProfile();
            
            return true;
            
        } catch (Exception $e) {
            // Display the recived error
            switch ($e->getCode()) {
                case 0 : $this->error = "Unspecified error.";
                    break;
                case 1 : $this->error = "Hybriauth configuration error.";
                    break;
                case 2 : $this->error = "Provider not properly configured.";
                    break;
                case 3 : $this->error = "Unknown or disabled provider.";
                    break;
                case 4 : $this->error = "Missing provider application credentials.";
                    break;
                case 5 : $this->error = "Authentification failed. The user has canceled the authentication or the provider refused the connection.";
                    break;
                case 6 : $this->error = "User profile request failed. Most likely the user is not connected to the provider and he should to authenticate again.";
                    $this->adapter->logout();
                    break;
                case 7 : $this->error = "User not connected to the provider.";
                    $this->adapter->logout();
                    break;
            }

            // well, basically your should not display this to the end user, just give him a hint and move on..
            if( $this->debug_mode ){
                $this->error .= "<br /><br /><b>Original error message:</b> " . $e->getMessage();
                $this->error .= "<hr /><pre>Trace:<br />" . $e->getTraceAsString() . "</pre>"; 
            }
            

            return false;
        }
    }

}
