<?php
// start session
session_start();

// page head and internal scripts
include('templates/head.html');
include('templates/lib.php');

// are we logged in?
$season = ""; // not initialized
if( ! (isset($_SESSION['username']) && isset($_SESSION['season'])) ) {
    // not yet logged in
    if( (!isset($_GET['username'])) || ($_GET['username'] == '') ) { 
        include('templates/login.php');
    } else {
        // find season
        $season = find_season($_GET['skey']);
        if( $season == "wp" ){ // not found
            include('templates/login.php');
        } else {
            $_SESSION['username'] = $_GET['username'];
            $_SESSION['season'] = $season;
        }
    }
}

// are we logged in?
if( isset($_SESSION['username']) && isset($_SESSION['season']) ) {
    // decode action
    switch ($_GET['action']) {
        case 'logout':
            session_unset();
            session_destroy(); 
            include('templates/login.php');
            break;
        case 'next':
            if( ! isset($_SESSION['next']) ){
                $_SESSION['next'] = 0;
            }
            $_SESSION['next']++;
            $play = find_play();
            include('templates/user.php');
            include('templates/play.php');
            break;
        case 'prev':
            if( ! isset($_SESSION['next']) ){
                $_SESSION['next'] = 0;
            }
            if( $_SESSION['next'] > 0 ){
                $_SESSION['next']--;
            }
            $play = find_play();
            include('templates/user.php');
            include('templates/play.php');
            break;
        case 'attend':
            $play = find_play();
            attend_play($play);
            include('templates/user.php');
            include('templates/play.php');
            break;
        case 'excuse':
            $play = find_play();
            excuse_play($play);
            include('templates/user.php');
            include('templates/play.php');
            break;
        default:
            $play = find_play();
            include('templates/user.php');
            include('templates/play.php');
            break;
    }
}

include('templates/tail.html');
?>

