{include file="header.tpl"}

<h1>{str tag="noinstitutions" section="admin"}</h1>

<p>{str tag="noinstitutionsstatsdescription" section="admin"}</p>
{if $CANCREATEINST}
<div class="institutioneditbuttons">
<form action="{$WWWROOT}admin/users/institutions.php" method="post">
    <input type="submit" class="submit" name="add" value="{str tag="addinstitution" section="admin"}" id="admininstitution_add">
</form>
</div>
{/if}

{include file="footer.tpl"}
