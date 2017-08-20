<table>
    <tr>
        <td>Hráč:</td>
        <td>Účast:</td>
    </tr>
<?php
    $users = file(sprintf("data/%s.users",$_SESSION['season']));
    
    foreach($users as $user) {
        $user = str_replace(array("\n"), '', $user);
        $natt = 0;
        printf("<tr>\n");
        printf("    <td>%s</td><td>%d</td>\n",$user,$natt);
        printf("</tr>\n");        
    }
?>
</table>
