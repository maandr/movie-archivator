{extends file="index.tpl"}

{block name=content}
  <table class="movie-list">
    <tr>
      <th></th>
      <th>Rating</th>
      <th>Title</th>
      <th>Year</th>
      <th>Director</th>
    </tr>
    {foreach from=$Movies item=Movie}
      <tr>
        <td><img src="{$PosterPath}{$Movie->movieId}.jpg" class="poster" /></td>
        <td><p class="rating">{$Movie->total|string_format:"%.2f"}</p></td>
        <td><a href="{$BaseUrl}movies/get/{$Movie->movieId}">{$Movie->title}</a></td>
        <td>{$Movie->year}</td>
        <td>{$Movie->director}</td>
      </tr>
    {/foreach}
  </table>
{/block}
