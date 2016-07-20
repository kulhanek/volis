<div>
<?php 
    printf("<h2>Hra #%d</h2>\n<h2>",$play);
if( $_SESSION['next'] > 0 ){
    echo '<input class="flat" type="button" value="Předchozí" name="prev" onclick="do_action(\'prev\');"/>';
}
    printf(' %s ',get_play_time($play));
    echo '<input class="flat" type="button" value="Následující" name="next" onclick="do_action(\'next\');"/></h2>';
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
<div>
<?php
if( ! in_array($_SESSION['username'],$attended) ){
    echo '<input id="attend" class="flat" type="button" value="Přijdu" name="attend" onclick="do_action(\'attend\');"/>';
}
if( ! in_array($_SESSION['username'],$excused) ){
    echo '<input id="excuse" class="flat" type="button" value="Nepřijdu" name="excuse" onclick="do_action(\'excuse\');"/>';
}
?>
<div>
<div style="clear: both;"></div>
</div>