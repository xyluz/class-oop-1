<?php 

require ROOT_DIR ."/routes/router.php";


get('/','views/homepage.php');
get('/login','views/login.php');
get('/register','views/register.php');

post('/login','actions/login.php'); //TODO: Explain and use controllers in actions.

/**
 * Error Pages
 */

get('/500','views/errors/500.php'); //TODO: Make this dynamic
any('/404','views/errors/404.php'); //TODO: Make this dynamic