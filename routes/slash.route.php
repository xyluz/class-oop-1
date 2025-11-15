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


/** ==============
 * Post Requests
 * ===============
 */
//post('/login','actions/login.action.php'); //TODO: Explain and use controllers in actions.
//post('/register','actions/register.action.php'); //TODO: Explain and use controllers in actions.


/**
 * Middleware Handler
 */

post('/register','middlewares/request.middleware.php');
post('/login','middlewares/request.middleware.php');

/**
 * Error Pages
 */

get('/500','views/errors/500.php'); //TODO: Make this dynamic
any('/404','views/errors/404.php'); //TODO: Make this dynamic