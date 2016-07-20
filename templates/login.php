<div>
    <h1>Herní zápisník</h1>
    <h2>Přihlášení</h2>
    <p class="txt">Jméno hráče (přezdívku) volte libovolně dle svého vkusu. Nicméně se snažte, aby použité jméno bylo snadno identifikovatelné spoluhráči. Také se snažte používat stejné jméno v průběhu herní sezóny, odvozuje se od ní statistika vaši účasti. Heslo je stejné pro všechny hráče a pro herní sezónu a poskytne vám jej správce těchto stránek. Jedná se o záměr, který umožňuje měnit zápisy hráčů jinými hráči po předchozí domluvě či zapisování výpomocných hráčů.</p>
    <table>
<?php
    $username = "";
    if( isset($_POST['username']) ){
        $username = $_POST['username'];
    }
    printf("<tr><td>Hráč:</td><td><input type=\"text\" name=\"username\" value=\"%s\"/></td><td></td></tr>\n",$username);
?>
    <tr><td>Heslo:</td><td><input type="password" name="password"/></td>
<?php
    if( $season == "wp" ) {
        echo '<td>Nesprávné heslo!</td>';
    } else {
        echo '<td></td>';
    }
?>
    </tr>
    </table>
    <p><input type="button" name="login" value="Přihlásit se" onclick="do_action('login');"/></p>
</div>