<fieldset>{if !$hidetitle}<legend class="resumeh3">{str tag='educationhistory' section='artefact.resume'}
{if $controls}
    {contextualhelp plugintype='artefact' pluginname='resume' section='addeducationhistory'}
{/if}
</legend>{/if}
<table id="educationhistorylist{$suffix}" class="tablerenderer resumefive resumecomposite fullwidth">
    <thead>
        <tr>
            {if $controls}<th class="resumecontrols"></th>{/if}
            <th class="resumedate">{str tag='startdate' section='artefact.resume'}</th>
            <th class="resumedate">{str tag='enddate' section='artefact.resume'}</th>
            <th>{str tag='qualification' section='artefact.resume'}</th>
            <th class="resumeattachments center"><img src="{theme_url filename="images/attachment.png"}" title="{str tag=Attachments section=artefact.resume}" /></th>
            {if $controls}<th class="resumecontrols"></th>{/if}
        </tr>
    </thead>
    <tbody>
        {foreach from=$rows item=row}
        <tr class="{cycle values='r0,r0,r1,r1'} expandable-head">
            {if $controls}<td class="buttonscell"></td>{/if}
            <td class="toggle">{$row->startdate}</td>
            <td>{$row->enddate}</td>
            <td>{$row->qualification}</td>
            <td class="center">{$row->clipcount}</td>
            {if $controls}<td class="buttonscell"></td>{/if}
        </tr>
        <tr class="{cycle values='r0,r0,r1,r1'} expandable-body">
            {if $controls}<td class="buttonscell"></td>{/if}
            <td colspan="4"><div class="compositedesc">{$row->qualdescription}</div>
            {if $row->attachments}
            <table class="cb attachments fullwidth">
                <tbody>
                    <tr><th colspan="2">{str tag='attachedfiles' section='artefact.blog'}:</th></tr>
                    {foreach from=$row->attachments item=item}
                    <tr class="{cycle values='r0,r1'}">
                        {if $icons}<td class="iconcell"><img src="{$item->iconpath}" alt=""></td>{/if}
                        <td><a href="{$item->viewpath}">{$item->title}</a> ({$item->size}) - <strong><a href="{$item->downloadpath}">{str tag=Download section=artefact.file}</a></strong>
                        <br>{$item->description}</td>
                    </tr>
                    {/foreach}
                </tbody>
            </table>
            {/if}
            </td>
            {if $controls}<td class="buttonscell"></td>{/if}
        </tr>
        {/foreach}
    </tbody>
</table>
{if $controls}
<div>
    <div id="educationhistoryform" class="hidden">{$compositeforms.educationhistory|safe}</div>
    <button id="addeducationhistorybutton" class="cancel" onclick="toggleCompositeForm('educationhistory');">{str tag='add'}</button>
</div>
{/if}
{if $license}
<div class="resumelicense">
{$license|safe}
</div>
{/if}
</fieldset>
