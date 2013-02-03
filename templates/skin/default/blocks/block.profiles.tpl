<!-- Fashion plugin -->
{if $oUserCurrent}

  <section class="block">
    <header class="block-header">
      <h3>Профили</h3>
    </header>
    <div class="block-content">
      <div class="js-block-profile-content" data-type="all">
      <ul class="profiles">
          {foreach from=$aProfiles key=Key item=Name}
            <li><a href="{router page='people'}{$Key}" class="{$Key}">{$Name}</a></li>
          {/foreach}
      </ul>
      </div>
    </div>
  </section>

{/if}
<!-- /Fashion plugin -->
