<?php
// start session
session_start();

// page head and internal scripts
include('templates/lib.php');

// are we logged in?
$season = ""; // not initialized
if( ! (isset($_SESSION['username']) && isset($_SESSION['season'])) ) {
    // not yet logged in
    if( (!isset($_POST['username'])) || ($_POST['username'] == '') ) { 
        include('templates/head.html');
        include('templates/login.php');
        include('templates/tail.html');
        exit;
    } else {
        // find season
        $season = find_season($_POST['skey']);
        if( $season == "wp" ){ // not found
            include('templates/head.html');
            include('templates/login.php');
            include('templates/tail.html');
            exit;
        } else {
            if( is_registered($season) ){
                $_SESSION['season'] = $season;
            } else {
                $season = "wu";
                include('templates/head.html');
                include('templates/login.php');
                include('templates/tail.html');            
            }
        }
    }
}

// are we logged in?
if( isset($_SESSION['username']) && isset($_SESSION['season']) ) {
    // decode action
    switch ($_POST['action']) {
        case 'login':
            header("HTTP/1.1 303 See Other");
            header("Location: $_SERVER[HTTP_REFERER]");
            break;
        case 'logout':
            session_unset();
            session_destroy(); 
            header("HTTP/1.1 303 See Other");
            header("Location: $_SERVER[HTTP_REFERER]");
            break;
        case 'next':
            if( ! isset($_SESSION['next']) ){
                $_SESSION['next'] = 0;
            }
            $_SESSION['next']++;
            header("HTTP/1.1 303 See Other");
            header("Location: $_SERVER[HTTP_REFERER]");
            break;
        case 'prev':
            if( ! isset($_SESSION['next']) ){
                $_SESSION['next'] = 0;
            }
            if( $_SESSION['next'] > 0 ){
                $_SESSION['next']--;
            }
            header("HTTP/1.1 303 See Other");
            header("Location: $_SERVER[HTTP_REFERER]");
            break;
        case 'attend':
            $play = find_play();
            attend_play($play);
            header("HTTP/1.1 303 See Other");
            header("Location: $_SERVER[HTTP_REFERER]");
            break;
        case 'excuse':
            $play = find_play();
            excuse_play($play);
            header("HTTP/1.1 303 See Other");
            header("Location: $_SERVER[HTTP_REFERER]");
            break;
        case 'stat':
            include('templates/head.html');
            include('templates/user.php');
            include('templates/stat.php');
            include('templates/tail.html');
            break;            
        default:
            $play = find_play();
            include('templates/head.html');
            include('templates/user.php');
            include('templates/play.php');
            include('templates/tail.html');
            break;
    }
}


?>

