<?php

// -----------------------------------------------------------------------------

function find_season($password)
{
    $handle = fopen("data/seasons.list","r");
    if( ! $handle ) return("wp");

    while( ($line = fgets($handle)) !== false ) {
        $tok = strtok($line, "\t"); // season password
        if( $tok == $password ){
            $tok = strtok("\t"); // season database
            fclose($handle);
            return($tok);
        }
    }

    fclose($handle);
    return("wp");
}

// -----------------------------------------------------------------------------

function get_season_title($season)
{
    $handle = fopen("data/seasons.list","r");
    if( ! $handle ) return("");

    while( ($line = fgets($handle)) !== false ) {
        $tok = strtok($line, "\t"); // season password
        $tok = strtok("\t"); // season database
        if( $tok == $season ){
            $tok = strtok("\t"); // season description
            fclose($handle);
            return($tok);
        }
    }

    fclose($handle);
    return("");
}

// -----------------------------------------------------------------------------

function find_play()
{
    if( ! isset($_SESSION['next']) ){
        $_SESSION['next'] = 0;
    }

    $next = $_SESSION['next'];

    $handle = fopen(sprintf("data/%s",$_SESSION['season']),"r");
    if( ! $handle ) return(-1);

    $curdate = new DateTime();

    $first_ok = -1;
    $valid_id = -1;
    while( ($line = fgets($handle)) !== false ) {
        $pid = strtok($line, "\t"); // play id
        $tok = strtok("\t"); // date
        $playdate = DateTime::createFromFormat('d-m-Y H:i',$tok);

        if( $playdate >= $curdate ){
            if( $first_ok == -1 ) $first_ok = $pid;
            $valid_id++;
            if( $valid_id == $next ){
                fclose($handle);
                return($pid);
            }
        }
    }

    fclose($handle);

    $_SESSION['next'] = 0;

    return($first_ok); // return to the beginning
}

// -----------------------------------------------------------------------------

function is_registered($season)
{
    $users = file(sprintf("data/%s.users",$season));
    
    foreach($users as $user) {
        if( strtolower($user) == strtolower($_POST['username']) ){
            $_SESSION['username'] = $user;
            return(true);
        }
    }

    return(false); 
}


// -----------------------------------------------------------------------------

function is_next()
{
    if( ! isset($_SESSION['next']) ){
        $_SESSION['next'] = 0;
    }

    $next = $_SESSION['next'];
    $next = $next + 1;

    $handle = fopen(sprintf("data/%s",$_SESSION['season']),"r");
    if( ! $handle ) return(false);

    $curdate = new DateTime();

    $first_ok = -1;
    $valid_id = -1;
    while( ($line = fgets($handle)) !== false ) {
        $pid = strtok($line, "\t"); // play id
        $tok = strtok("\t"); // date
        $playdate = DateTime::createFromFormat('d-m-Y H:i',$tok);

        if( $playdate >= $curdate ){
            if( $first_ok == -1 ) $first_ok = $pid;
            $valid_id++;
            if( $valid_id == $next ){
                fclose($handle);
                return(true);
            }
        }
    }

    fclose($handle);

    return(false); // return to the beginning
}

// -----------------------------------------------------------------------------

function get_play_time($play)
{
    $handle = fopen(sprintf("data/%s",$_SESSION['season']),"r");
    if( ! $handle ) return("n.a.");

    while( ($line = fgets($handle)) !== false ) {
        $pid = strtok($line, "\t"); // play id
        $tok = strtok("\t"); // date
        if( $pid == $play ){
            fclose($handle);
            return($tok);
        }
    }

    fclose($handle);
    return("n.a.");
}

// -----------------------------------------------------------------------------

function get_play_min_players($play)
{
    $handle = fopen(sprintf("data/%s",$_SESSION['season']),"r");
    if( ! $handle ) return("");

    while( ($line = fgets($handle)) !== false ) {
        $pid = strtok($line, "\t"); // play id
        $pd = strtok("\t"); // date
        if( $pid == $play ){
            $mu = strtok("\t"); // min number of players
            fclose($handle);
            return($mu);
        }
    }

    fclose($handle);
    return("");
}

// -----------------------------------------------------------------------------

function get_play_max_players($play)
{
    $handle = fopen(sprintf("data/%s",$_SESSION['season']),"r");
    if( ! $handle ) return("");

    while( ($line = fgets($handle)) !== false ) {
        $pid = strtok($line, "\t"); // play id
        $pd = strtok("\t"); // date
        if( $pid == $play ){
            $mu = strtok("\t"); // min number of players
            $mu = strtok("\t"); // max number of players
            fclose($handle);
            return($mu);
        }
    }

    fclose($handle);
    return("");
}

// -----------------------------------------------------------------------------

function get_play_players($play)
{
    global $attended,$excused;

    $attended = array();
    $excused = array();

    $dh = opendir(realpath("var"));
    if( ! $dh ) return(false);

    while (($file = readdir($dh)) !== false) {

        if( fnmatch(sprintf("%s.%s.*",$_SESSION['season'],$play),$file) ){
            $handle = fopen(sprintf("var/%s",$file),"r");
            fscanf($handle,"%d",$flag);
            fclose($handle);
            // extract user name
            strtok($file,"."); // season
            strtok(".");  // playid
            $user = strtok("."); // username

            if( $flag == -1 ){
                array_push($excused,$user);
            }
            if( $flag == 1 ){
                array_push($attended,$user);
            }
        }
    }

    closedir($dh);

    natcasesort($attended);
    natcasesort($excused);

    return(true);
}

// -----------------------------------------------------------------------------

function attend_play($play)
{
    $handle = fopen(sprintf("var/%s.%s.%s",$_SESSION['season'],$play,$_SESSION['username']),"w");
    if( $handle ){
        fprintf($handle,"%d",1);
        fclose($handle);
    }
}

// -----------------------------------------------------------------------------

function excuse_play($play)
{
    $handle = fopen(sprintf("var/%s.%s.%s",$_SESSION['season'],$play,$_SESSION['username']),"w");
    if( $handle ){
        fprintf($handle,"%d",-1);
        fclose($handle);
    }
}

// -----------------------------------------------------------------------------
?>