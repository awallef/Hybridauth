<?php

Configure::write('Hybridauth', array(
    // openid providers
    "OpenID" => array(
        "enabled" => false
    ),
    "Yahoo" => array(
        "enabled" => false,
        "keys" => array("id" => "", "secret" => ""),
    ),
    "AOL" => array(
        "enabled" => false
    ),
    "Google" => array(
        "enabled" => false,
        "keys" => array("id" => "","secret" => ""),
    ),
    "Facebook" => array(
        "enabled" => false,
        "keys" => array("id" => "", "secret" => ""),
    ),
    "Twitter" => array(
        "enabled" => false,
        "keys" => array("key" => "", "secret" => "")
    ),
    // windows live
    "Live" => array(
        "enabled" => false,
        "keys" => array("id" => "", "secret" => "")
    ),
    "MySpace" => array(
        "enabled" => false,
        "keys" => array("key" => "", "secret" => "")
    ),
    "LinkedIn" => array(
        "enabled" => false,
        "keys" => array("key" => "", "secret" => "")
    ),
    "Foursquare" => array(
        "enabled" => false,
        "keys" => array("id" => "", "secret" => "")
    ),
));