<div id="play">
<?php 
    printf("<h2>Hra #%d</h2>\n<h2>",$play);
if( $_SESSION['next'] > 0 ){
    echo '<input class="material-icons" type="button" value="&#xE5C4;" name="prev" onclick="do_action(\'prev\');"/>';
}
    printf(' | %s | ',get_play_time($play));
    echo '<input class="material-icons" type="button" value="&#xE5C8;" name="next" onclick="do_action(\'next\');"/></h2>';
?>
</div>

<?php
    get_play_players($play);
?>

<table>
    <tr>
        <td>Přijde:</td>
        <td>
<?php
    echo count($attended);
?>
        </td>
        <td>
<?php
    echo implode(",",$attended);
?>
        </td>
    </tr>
    <tr>
        <td>Nepřijde:</td>
        <td>
<?php
    echo count($excused);
?>
        </td>
        <td>
<?php
    echo implode(",",$excused);
?>
        </td>
    </tr>
</table>
<div id="attendance">
<?php
if( ! in_array($_SESSION['username'],$attended) ){
    echo '<input class="attend flat" type="button" value="Přijdu" name="attend" onclick="do_action(\'attend\');"/>';
}
if( ! in_array($_SESSION['username'],$excused) ){
    echo '<input class="excuse flat" type="button" value="Nepřijdu" name="excuse" onclick="do_action(\'excuse\');"/>';
}
?>
<div>
<div style="clear: both;"></div>
</div>