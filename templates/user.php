<?php 
printf("<h1>Sezóna: %s</h1>\n",get_season_title($_SESSION['season']));
?>
<div id="player">
<?php 
    printf('<h2 class="player"><span>Hráč: %s</span><span><input class="flat" type="button" name="logout" value="Kalendář" onclick="do_action(\'play\');"/> <input class="flat" type="button" name="logout" value="Statistika" onclick="do_action(\'stat\');"/> <input class="flat" type="button" name="logout" value="Odhlásit se" onclick="do_action(\'logout\');"/></span></h2>',$_SESSION['username']);
?>
</div>
<div style="clear: both;"></div>