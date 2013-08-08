<?php

// set config
if (file_exists(APP . DS . 'Config' . DS . 'hybridauth.php'))
    require_once(APP . DS . 'Config' . DS . 'hybridauth.php');
else
    require_once('hybridauth.php');
