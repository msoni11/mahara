{include file="header.tpl"}
{if $GROUP}
    <h2>{$PAGESUBHEADING}</h2>
{/if}
{$helptext|safe}
<div id="copyview">

 <div id="templatesearch" class="searchlist">

  <form class="searchquery" action="{$WWWROOT}view/choosetemplate.php" method="post">

    <span id="searchpages"><label>{str tag="searchviews" section="view"}:</label>
    <input type="text" name="viewquery" id="viewquery" class="query" value="{$views->query}">
    <button class="query-button" type="submit">{str tag="go"}</button></span>

    <input type="hidden" name="viewlimit" value="{$views->limit}">
    <input type="hidden" name="viewoffset" value="0">
    {if $views->group}<input type="hidden" name="group" value="{$views->group}">{/if}
    {if $views->institution}<input type="hidden" name="institution" value="{$views->institution}">{/if}

    <span id="searchowners"><label>{str tag="searchowners" section="view"}:</label>
    <input type="text" name="ownerquery" id="ownerquery" class="query" value="{$owners->query}">
    <button class="query-button" type="submit">{str tag="go"}</button></span>

  </form>
  <div id="templatesearch_table">{$views->html|safe}</div>
  {$views->pagination.html|safe}
 </div>

</div>
{include file="footer.tpl"}
