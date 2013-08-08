<?php
App::uses('HybridauthAppController', 'Hybridauth.Controller');
/**
 * Endpoints Controller
 *
 */
class EndpointController extends HybridauthAppController {

    public $uses = array();
    
    public function index(){
        $this->layout = 'naked';
    }

}
