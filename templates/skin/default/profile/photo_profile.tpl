{foreach from=$oUserCurrent->getProfile()->getFieldsViewsData() item=Value key=Name}
{assign var="sProfileFieldName" value=$aLang.plugin.fashion.$Name}
{if $sProfileFieldName}
        <tr>
          <td class="cell-label">{$sProfileFieldName}:</td>
          <td>{$Value}</td>
        </tr>
{/if}
{/foreach}