{extends file="index.tpl"}

{block name=content}
	<h2>Ergebnisse</h2>

  {foreach from=$Movies item=Movie}
    <div class="search-result">
      <a href="{$ControllerName}/load/{$Movie->imdbID}">
        <!-- <img src="{$Movie->Poster}" /> -->
        <h3>{$Movie->Title} ({$Movie->Year})</h3>
      </a>
    </div>
  {/foreach}
{/block}
