<?php

$Cores->addRoute('/user','user/user');

$Cores->addRoute('/user/{id}/username/{username}','user/user@detail');


//run routing
$Cores->runRoute(BASE_DIR);


