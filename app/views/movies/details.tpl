{extends file="index.tpl"}

{block name=javascript}
	<script type="text/javascript" src="{$BaseUrl}app/views/movies/details.js"></script>
{/block}

{block name=content}

	<div class="movie-details">

		<div class="col-md-4">
			<img src="{$PosterPath}{$Movie->id}.jpg" class="poster" />
		</div>
		<div class="col-md-8">
			<h1>{$Movie->title}</h1>

			<div id="total-rating" class="total-rating a-rating">
				<div class="total-rating-user">{$UserRating->total|string_format:"%.2f"}</div>
				<div class="total-rating-average">{$AverageRating->total|string_format:"%.2f"}</div>
				<div class="total-rating-amount">{$AverageRating->ratings} ratings</div>
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
					<td><a href="{$ControllerName}/director/{$Movie->director}">{$Movie->director}</a></td>
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
		</div>

		<h2>Ratings</h2>

		<div class="col-md-6">
			<table class="ratings">
				{assign var=categories value=['plot', 'meaning', 'characters', 'dialog', 'tention', 'fun', 'rewatch']}
				{foreach from=$categories item=category}
					<tr>
						<td class="bold right">{$category}</td>
						<td>
							<fieldset class="rating">
								{for $i=0 to 10}
									{assign var="full" value=10 - {$i}}
									{assign var="half" value={$full} - 0.5}
									<input type="radio" id="rating_{$category}_star{$i}" name="rating_{$category}" value="{$full}" onclick="rate({$User->id}, {$Movie->id}, '{$category}', {$full})" {if ($UserRating->{$category}) == $full}checked="checked"{/if} />
									<label class="full" for="rating_{$category}_star{$i}" title="{$full}"></label>
									<input type="radio" id="rating_{$category}_star{$i}half" name="rating_{$category}" value="{$half}" onclick="rate({$User->id}, {$Movie->id}, '{$category}', {$half})" {if ($UserRating->{$category}) == $half}checked="checked"{/if}  />
									<label class="half" for="rating_{$category}_star{$i}half" title="{$half}"></label>
								{/for}
							</fieldset>
						</td>
					</tr>
				{/foreach}
			</table>
		</div>

		<div class="col-md-6">
			<table class="ratings">
				{assign var=categories value=['acting', 'cinematography', 'editing', 'look', 'sound', 'score']}
				{foreach from=$categories item=category}
					<tr>
						<td class="bold right">{$category}</td>
						<td>
							<fieldset class="rating">
								{for $i=0 to 10}
									{assign var="full" value=10 - {$i}}
									{assign var="half" value={$full} - 0.5}
									<input type="radio" id="rating_{$category}_star{$i}" name="rating_{$category}" value="{$full}" onclick="rate({$User->id}, {$Movie->id}, '{$category}', {$full})" {if ($UserRating->{$category}) == $full}checked="checked"{/if} />
									<label class="full" for="rating_{$category}_star{$i}" title="{$full}"></label>
									<input type="radio" id="rating_{$category}_star{$i}half" name="rating_{$category}" value="{$half}" onclick="rate({$User->id}, {$Movie->id}, '{$category}', {$half})" {if ($UserRating->{$category}) == $half}checked="checked"{/if}  />
									<label class="half" for="rating_{$category}_star{$i}half" title="{$half}"></label>
								{/for}
							</fieldset>
						</td>
					</tr>
				{/foreach}
			</table>
		</div>

	</div>
{/block}
