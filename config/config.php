<?php

Config::set('site_name','MODULE');

Config::set('languages', array('ru','ua'));

// Routes. Route name => method prefix

Config::set('routes', array (
    'default' => '',
    'admin' => 'admin_',
));

Config::set('default_route', 'default');
Config::set('default_language', 'ua');
Config::set('default_controller', 'pages');
Config::set('default_action', 'index');
Config::set('db.host', 'localhost');
Config::set('db.user', 'root');
Config::set('db.password', '');
Config::set('db.db_name', 'news');

Config::set('salt','jd7sj3sdkd964he7e');