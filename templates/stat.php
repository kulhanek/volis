<table>
    <tr>
        <td>Hráč</td>
        <td>Účast</td>
    </tr>
<?php
    $users = file(sprintf("data/%s.users",$_SESSION['season']));
    
    $allnatt = 0;
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
                    $allnatt++;
                }
                fclose($handle1);
            }
        }
        
        fclose($handle);
        
        printf("<tr>\n");
        printf("    <td>%s</td><td>%d</td>\n",$user,$natt);
        printf("</tr>\n");        
    }
    
        printf("<tr>\n");
        printf("    <td>Celkem:</td><td>%d</td>\n",$allnatt);
        printf("</tr>\n");     
?>
</table>
