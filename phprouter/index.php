<?php
declare(strict_types=1);
$yourpath = dirname($_SERVER['SCRIPT_NAME']). '/';
$lifetime = 0;
session_set_cookie_params($lifetime,$yourpath);
session_start();
session_regenerate_id();

define('Canary',True);
$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];
# Next 2 lines not needed if you have document root
$basedir = "/mwatchman6/phprouter";
$request = substr($request,strlen($basedir));

#cut off the ?query string if this is a get
$qmarkloc = strpos($request,"?");
if ($qmarkloc !== false )
{
    # probably not needed
    # $querystring = substr($request, $qmarkloc);
    $request = substr($request,0,$qmarkloc);
}

#cut off additional "path variables" if there are any
$pathvarloc = strpos($request,'/',1);
if ($pathvarloc !== false)
{
    $pathvars = ltrim(substr($request,$pathvarloc),'/');
    $request = substr($request,0,$pathvarloc);
    echo "$pathvars";
}


if ($method === 'GET')
{
	switch ($request)
	{
		case '/' :
		case '' :
			require __DIR__ . '/views/index.php';
			break;
		case '/about' :
			require __DIR__ . '/views/about.php';
			break;
		case '/login' :
			require __DIR__ . '/views/login.php';
			break;
		case '/useradmin' :
			require __DIR__ . '/views/useradmin.php';
			break;
        case '/procform' :
			require __DIR__ . '/views/procform.php';
			break;
		case '/showform' :
			require __DIR__ . '/views/showform.php';
			break;
		case '/createuser' :
			require __DIR__ . '/views/newuserform.php';
			break;
		case '/search' :
			require __DIR__ . '/views/search.php';
			break;
		default:
			http_response_code(404);
			require __DIR__ . '/views/404.php';
			break;
	}
}
elseif ($method === 'POST')
{
	//echo "This is a POST REQUEST";
	switch ($request)
	{
		case '/proclogin':
			require __DIR__ . '/views/proclogin.php';
			//echo $_POST['username'];
			break;
		case '/procnewuser':
			require __DIR__ . '/views/procnewuser.php';
			break;
		default:
		http_response_code(404);
		require __DIR__ . '/views/404.php';
		break;
	}

}
else
{
	echo "Can not deal with HEAD PUT DELETE methods";
}

?>
