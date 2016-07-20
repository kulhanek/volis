<h1>Herní zápisník</h1>
<h2>Přihlášení</h2>
<p class="txt">Přezdívku volte libovolně dle svého vkusu (s omezením na velká a malé písmena a čísla). Nicméně se snažte, aby použitá přezdívka bylo snadno identifikovatelná spoluhráči. Také se snažte používat stejnou přezdívku v průběhu herní sezóny, odvozuje se od ní statistika vaši účasti. Heslo je stejné pro všechny hráče a pro herní sezónu a poskytne vám jej správce těchto stránek. Jedná se o záměr, který umožňuje měnit zápisy hráčů jinými hráči po předchozí domluvě či zapisování výpomocných hráčů.</p>
<?php
if( $season == "wp" ) {
    echo '<p class="error">Nesprávné heslo nebo přezdívka obsahovala nepovolené znaky!</p>';
}
?>
<div id="login">
<?php
$username = "";
if( isset($_GET['username']) ){
    $username = $_GET['username'];
}
if( preg_match("/[^A-Za-z0-9]/", $username) ) {
    $username = "";
}
printf("<input class=\"text\" type=\"text\" placeholder=\"Přezdívka\" name=\"username\" value=\"%s\"/>\n",$username);
?>
    <input class="text" type="password" placeholder="Heslo" name="skey"/>
    <input class="flat" type="button" name="login" value="Přihlásit se" onclick="do_action('login');"/>
</div>