<?php 
printf("<h1>Sezóna: %s</h1>\n",get_season_title($_SESSION['season']));
?>
<div id="player">
<?php 
    printf('<h2 class="player"><span>Hráč: %s</span><input class="flat" type="button" name="logout" value="Odhlásit se" onclick="do_action(\'logout\');"/></h2>',$_SESSION['username']);
?>
</div>
<div style="clear: both;"></div>