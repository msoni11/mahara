{include file="header.tpl"}

    <p>{$instructions|clean_html|safe}</p>
    <div class="memberswrap"><div class="memberssearch">
    {if $membershiptypes}
    	<div class="membershiptypes">
        {foreach from=$membershiptypes item=item implode="&nbsp;|&nbsp;"}
            {if $item.link}
               <a href="{$item.link}">{$item.name}</a>
            {else}
               <strong>{$item.name}</strong>
            {/if}
        {/foreach}
        </div>
    {/if}
        <label>{str tag=search}:</label> {$form|safe}
    </div>
    <div class="cb"></div>
    {if $membershiptype}<h2>{str tag=pendingmembers section=group}</h2>{/if}
    <div id="results">
        <div id="membersearchresults" class="tablerenderer fullwidth listing twocolumn">
            {$results|safe}
        </div>
    </div>
    {$pagination|safe}
    </div>

{include file="footer.tpl"}
