<?php
    $price=3710;
?>
<h3>Souhrn docházky</h3>
<table>
    <tr>
        <th>Hráč</th>
        <th>Účast</th>
        <th>Příspěvek</th>
    </tr>
<?php
    $users = file(sprintf("data/%s.users",$_SESSION['season']));
    
    $allnatt = 0;
    foreach($users as $user) {
        $user = str_replace(array("\n"), '', $user);
        
        $handle = fopen(sprintf("data/%s",$_SESSION['season']),"r");
        if( ! $handle ) break;

        while( ($line = fgets($handle)) !== false ) {        
            $pid = strtok($line, "\t"); // play id
            if( is_file(sprintf("var/%s.%d.%s",$_SESSION['season'],$pid,$user)) ){
                $handle1 = fopen(sprintf("var/%s.%d.%s",$_SESSION['season'],$pid,$user),"r");
                fscanf($handle1,"%d",$flag);
                if( $flag == 1 ){
                    $allnatt++;
                }
                fclose($handle1);
            }
        }
        
        fclose($handle);  
    }

    $

    $users = file(sprintf("data/%s.users",$_SESSION['season']));
    
    foreach($users as $user) {
        $user = str_replace(array("\n"), '', $user);
        $natt = 0;
        
        $handle = fopen(sprintf("data/%s",$_SESSION['season']),"r");
        if( ! $handle ) break;

        while( ($line = fgets($handle)) !== false ) {        
            $pid = strtok($line, "\t"); // play id
            if( is_file(sprintf("var/%s.%d.%s",$_SESSION['season'],$pid,$user)) ){
                $handle1 = fopen(sprintf("var/%s.%d.%s",$_SESSION['season'],$pid,$user),"r");
                fscanf($handle1,"%d",$flag);
                if( $flag == 1 ){
                    $natt++;
                }
                fclose($handle1);
            }
        }
        
        fclose($handle);
        
        printf("<tr>\n");
        printf("    <td>%s</td><td align=\"right\">%d</td><td align=\"right\">%d</td>\n",$user,$natt,$price*$natt/$allnatt);
        printf("</tr>\n");        
    }
    
        printf("<tr>\n");
        printf("    <td>Celkem:</td><td align=\"right\">%d</td><td align=\"right\">%d</td>\n",$allnatt,$price);
        printf("</tr>\n");     
?>
</table>

<h3>Podrobný výpis docházky</h3>
<table>
    <tr>
        <th>Hra</th>
        <th>Datum</th>
        <th>Účast</th>
    </tr>

<?php
        $handle = fopen(sprintf("data/%s",$_SESSION['season']),"r");
        if( $handle ) {

            while( ($line = fgets($handle)) !== false ) {        
                $pid = strtok($line, "\t"); // play id
                $tok = strtok("\t"); // date
                get_play_players($pid);
                
                printf("<tr>\n");
                printf("    <td>%d</td><td align=\"right\">%d</td><td align=\"right\">%d</td>\n",$pid,$tok,implode(", ",$attended));
                printf("</tr>\n");  
            }
            
            fclose($handle);
        }
?>
</table>
