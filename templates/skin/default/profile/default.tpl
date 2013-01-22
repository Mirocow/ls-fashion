<h2 class="header-table">{$aLang.plugin.fashion.title}</h2>

<table class="table table-profile-info">

  {foreach from=$aPofileFields item=Value key=Name}
  {assign var="sProfileFieldName" value=$aLang.plugin.fashion.$Name}
  {if $sProfileFieldName && $Value}

          <tr>
            <td class="cell-label">{$sProfileFieldName}:</td>
            <td>{$Value}</td>
          </tr>

  {/if}
  {/foreach}

</table>