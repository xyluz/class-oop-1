<?php 

require ROOT_DIR ."/routes/router.php";


/**
 * ==============
 * Get Requests
 * ==============
 */

get('/','views/homepage.php');
get('/login','views/login.php');
get('/register','views/register.php');
get('/dashboard','views/dashboard.php');
get('/profile','views/profile.php');


/** ==============
 * Post Requests
 * ===============
 */
//post('/login','actions/login.action.php'); //TODO: Explain and use controllers in actions.
//post('/register','actions/register.action.php'); //TODO: Explain and use controllers in actions.


/**
 * Middleware Handler
 * TODO: Find a way to optimize this - so that we don't have to manually specify the URI.
 */

post('/register','middlewares/request.middleware.php');
post('/login','middlewares/request.middleware.php');
post('/profile','middlewares/request.middleware.php');

/**
 * Error Pages
 */

get('/500','views/500.php'); //TODO: Make this dynamic
any('/404','views/404.php'); //TODO: Make this dynamic