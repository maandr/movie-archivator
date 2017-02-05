{extends file="index.tpl"}

{block name=content}
<form method="post" action="{$ControllerName}/update/{$Movie->id}" class="form-signin">

  <h2>{$Movie->title}</h2>

  <label>Title</label>
  <input type="text" name="title" value="{$Movie->title}" placeholder="Title" class="form-control" required autofocus />

  <label>Year</label>
  <input type="text" name="year" value="{$Movie->year}" placeholder="Year" class="form-control" required autofocus />

  <label>Director</label>
  <input type="text" name="director" value="{$Movie->director}" placeholder="Director" class="form-control" required autofocus />

  <label>Writer</label>
  <input type="text" name="writer" value="{$Movie->writer}" placeholder="Writer" class="form-control" required autofocus />

  <label>Cast</label>
  <input type="text" name="cast" value="{$Movie->cast}" placeholder="Cast" class="form-control" required autofocus />

  <label>Awards</label>
  <input type="text" name="awards" value="{$Movie->awards}" placeholder="Awards" class="form-control" required autofocus />

  <label>Runtime</label>
  <input type="text" name="runtime" value="{$Movie->runtime}" placeholder="Runtime" class="form-control" required autofocus />

  <label>Country</label>
  <input type="text" name="country" value="{$Movie->country}" placeholder="Country" class="form-control" required autofocus />

  <label>Genre</label>
  <input type="text" name="genre" value="{$Movie->genre}" placeholder="Genre" class="form-control" required autofocus />

  <label>Plot</label>
  <textarea name="plot">
    {$Movie->plot}
  </textarea>
  <br />

  <input type="submit" name="submit" value="Save" class="btn btn-primary btn-block" />
</form>
{/block}
