<h1>Herní zápisník</h1>
<h2>Přihlášení</h2>
<p class="txt">Přezdívku přiděluje správce systému, protože se od ní odvozuje statistika vaši účasti. Heslo je stejné pro všechny hráče a pro herní sezónu a poskytne vám jej správce těchto stránek.</p>
<p class="txt"><b>Uzávěrka je každé pondělí v 10:00</b>, pokud nebude přihlášený minimální počet hráčů, tak se nebude hrát. Pokud nás bude více, bude se střídat. Půjčíme více balonů na pinkání mimo hřiště.</p>
<p class="txt"><b>Registrované přezdívky jsou (bez diakritiky)</b>: Petr, AlesS, Jarda, AlesR, Simeon, Zdenek, Pavel, Matej, Rene, Zbynek, Hanka</p>
<?php
if( $season == "wp" ) {
    echo '<p class="error">Nesprávné heslo!</p>';
}
if( $season == "wu" ) {
    echo '<p class="error">Nesprávná přezdívka!</p>';
}
?>
<div id="login">
<?php
$username = "";
if( isset($_POST['username']) ){
    $username = $_POST['username'];
}
if( preg_match("/[^A-Za-z0-9]/", $username) ) {
    $username = "";
}
printf("<input class=\"text\" type=\"text\" placeholder=\"Přezdívka\" name=\"username\" value=\"%s\"",$username);
?>
onkeydown="javascript:if (event.keyCode == 13) document.getElementById('password').focus();" />
    <input id="password" class="text" type="password" placeholder="Heslo" name="skey" onkeydown="javascript:if (event.keyCode == 13) do_action('login');"/>
    <input class="flat" type="button" name="login" value="Přihlásit se" onclick="do_action('login');"/>
</div>