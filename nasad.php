<?php

require 'src/_zavadec.php';

(new Godric\GithubDeployment\GithubDeployment([
    'secret'    =>  $GLOBALS['CONFIG']['klicNasad'],
    'target'    =>  __DIR__,
]))->autorun();
