{extends file="index.tpl"}

{block name=content}

	<div class="movie-details">

		<img src="{$PosterPath}{$Movie->id}.jpg" class="poster" />

		<h1>{$Movie->title}</h1>

		<div class="total-rating">
			9.0
			<div class="total-rating-amount">12 ratings</div>
		</div>

		<table class="facts">
			<tr>
				<td  class="bold right">Year</td>
				<td><a href="{$ControllerName}/year/{$Movie->year}">{$Movie->year}</a></td>
			</tr>
			<tr>
				<td class="bold right">Genre</td>
				<td>{$Movie->genre}</td>
			</tr>
			<tr>
				<td class="bold right">Country</td>
				<td>{$Movie->country}</td>
			</tr>
			<tr>
				<td class="bold right">Runtime</td>
				<td><{$Movie->runtime}</td>
			</tr>
			<tr>
				<td class="bold right">Awards</td>
				<td>{$Movie->awards}</td>
			</tr>
			<tr>
				<td class="bold right">Director</td>
				<td>{$Movie->director}</td>
			</tr>
			<tr>
				<td class="bold right">Writer</td>
				<td>{$Movie->writer}</td>
			</tr>
			<tr>
				<td class="bold right">Cast</td>
				<td>{$Movie->cast}</td>
			</tr>
		</table>

		<div class="plot">
			<h2>Plot</h2>
			<p>{$Movie->plot|nl2br}</p>
		</div>

		<h2>Ratings</h2>

		<table class="ratings">
			<tr>
				<td  class="bold right">Plot</td>
				<td></td>
			</tr>
			<tr>
				<td  class="bold right">Message</td>
				<td></td>
			</tr>
			<tr>
				<td class="bold right">Characters</td>
				<td></td>
			</tr>
			<tr>
				<td class="bold right">Dialog</td>
				<td></td>
			</tr>
			<tr>
				<td class="bold right">Tention</td>
				<td></td>
			</tr>
			<tr>
				<td  class="bold right">Fun</td>
				<td></td>
			</tr>
			<tr>
				<td  class="bold right">Rewatch</td>
				<td></td>
			</tr>
			<tr>
				<td class="bold right">Acting</td>
				<td></td>
			</tr>
			<tr>
				<td class="bold right">Cinematography</td>
				<td></td>
			</tr>
			<tr>
				<td class="bold right">Editing</td>
				<td></td>
			</tr>
			<tr>
				<td class="bold right">Look</td>
				<td></td>
			</tr>
			<tr>
				<td class="bold right">Sound</td>
				<td></td>
			</tr>
			<tr>
				<td class="bold right">Score</td>
				<td></td>
			</tr>
		</table>

	</div>
{/block}
