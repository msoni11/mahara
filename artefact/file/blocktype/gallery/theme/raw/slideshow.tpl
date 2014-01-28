{if $images}
<div class="slideshow" id="slideshow{$instanceid}">
    <table class="images fullwidth">
    <tr>
    <td class="control">
        <span class="first hidden">&laquo;</span>
        <span class="prev disabled">&lsaquo;</span>
    </td>
    <td>
    {foreach from=$images item=image name=images}
        <a href="{$image.link}" target="_blank"><img src="{$image.source}" alt="{$image.title}" title="{$image.title}" style="max-width: {$width}px;{if !$dwoo.foreach.images.first} display:none;{/if}"></a>
    {/foreach}
    </td>
    <td class="control">
        <span class="next disabled">&rsaquo;</span>
        {*<span class="last">&raquo;</span>*}
    </td>
    </tr>
    </table>
</div>
<script type="text/javascript">
var slideshow{$instanceid} = new Slideshow({$instanceid}, {$count});
$j(function() {
    if (($j('#slideshow{$instanceid}').width() - 60) < {$width}) {
        // adjust max-width of images to fit within slider
        $j('#slideshow{$instanceid} img').each(function() {
            $j(this).css('max-width',$j('#slideshow{$instanceid}').width() - 60);
        });
    }
});
</script>
{else}
  {str tag=noimagesfound section=artefact.file}
{/if}