<div class="listrow">
    {if $USER->get('id') != $user->id}
    {if $user->messages && $listtype == 'admin'}
    <ul class="fr actionlist">
        <li class="messages">
            <a href="{$WWWROOT}user/sendmessage.php?id={$user->id}&returnto={$page}&inst={$inst}" id="btn-sendmessage" class="btn-message">
                {str tag='sendmessage' section='group'}
            </a>
        </li>
    </ul>
    {/if}
    {/if}
    <div class="peoplelistinfo">
      <div class="leftdiv" id="staffinfo_{$user->id}">
          <img src="{profile_icon_url user=$user maxwidth=40 maxheight=40}" alt="">
      </div>
      <div class="rightdiv">
        <h3 class="title">
          <a href="{profile_url($user)}">{$user->display_name}</a>
        </h3>
      </div>
    </div>
    <div class="cb"></div>
</div>
