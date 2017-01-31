{extends file="index.tpl"}

{block name=javascript}
	<script type="text/javascript" src="{$BaseUrl}app/views/movies/details.js"></script>
{/block}

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

		<div id="test"></div>

		<table class="ratings">
			<tr>
				<td class="bold right">Plot</td>
				<td>
					<fieldset class="rating">
						{assign var="category" value="plot"}
						{for $i=0 to 10}
							{assign var="full" value=10 - {$i}}
							{assign var="half" value={$full} - 0.5}
							<input type="radio" id="rating_{$category}_star{$i}" name="rating_{$category}" value="{$full}" onclick="rate({$User->id}, {$Movie->id}, '{$category}', {$full})" />
							<label class="full" for="rating_{$category}_star{$i}"></label>
							<input type="radio" id="rating_{$category}_star{$i}half" name="rating_{$category}" value="{$half}" onclick="rate({$User->id}, {$Movie->id}, '{$category}', {$half})" />
							<label class="half" for="rating_{$category}_star{$i}half"></label>
						{/for}
					</fieldset>
				</td>
			</tr>
			<tr>
				<td class="bold right">Message</td>
				<td>
					<fieldset class="rating">
						{assign var="category" value="message"}
						{for $i=0 to 10}
							{assign var="full" value=10 - {$i}}
							{assign var="half" value={$full} - 0.5}
							<input type="radio" id="rating_{$category}_star{$i}" name="rating_{$category}" value="{$full}" onclick="rate({$User->id}, {$Movie->id}, '{$category}', {$full})" />
							<label class="full" for="rating_{$category}_star{$i}"></label>
							<input type="radio" id="rating_{$category}_star{$i}half" name="rating_{$category}" value="{$half}" onclick="rate({$User->id}, {$Movie->id}, '{$category}', {$half})" />
							<label class="half" for="rating_{$category}_star{$i}half"></label>
						{/for}
					</fieldset>
				</td>
			</tr>
			<tr>
				<td class="bold right">Characters</td>
				<td>
					<fieldset class="rating">
						{assign var="category" value="characters"}
						{for $i=0 to 10}
							{assign var="full" value=10 - {$i}}
							{assign var="half" value={$full} - 0.5}
							<input type="radio" id="rating_{$category}_star{$i}" name="rating_{$category}" value="{$full}" onclick="rate({$User->id}, {$Movie->id}, '{$category}', {$full})" />
							<label class="full" for="rating_{$category}_star{$i}"></label>
							<input type="radio" id="rating_{$category}_star{$i}half" name="rating_{$category}" value="{$half}" onclick="rate({$User->id}, {$Movie->id}, '{$category}', {$half})" />
							<label class="half" for="rating_{$category}_star{$i}half"></label>
						{/for}
					</fieldset>
				</td>
			</tr>
			<tr>
				<td class="bold right">Dialog</td>
				<td>
					<fieldset class="rating">
						{assign var="category" value="dialog"}
						{for $i=0 to 10}
							{assign var="full" value=10 - {$i}}
							{assign var="half" value={$full} - 0.5}
							<input type="radio" id="rating_{$category}_star{$i}" name="rating_{$category}" value="{$full}" onclick="rate({$User->id}, {$Movie->id}, '{$category}', {$full})" />
							<label class="full" for="rating_{$category}_star{$i}"></label>
							<input type="radio" id="rating_{$category}_star{$i}half" name="rating_{$category}" value="{$half}" onclick="rate({$User->id}, {$Movie->id}, '{$category}', {$half})" />
							<label class="half" for="rating_{$category}_star{$i}half"></label>
						{/for}
					</fieldset>
				</td>
			</tr>
			<tr>
				<td class="bold right">Tention</td>
				<td>
					<fieldset class="rating">
						{assign var="category" value="tention"}
						{for $i=0 to 10}
							{assign var="full" value=10 - {$i}}
							{assign var="half" value={$full} - 0.5}
							<input type="radio" id="rating_{$category}_star{$i}" name="rating_{$category}" value="{$full}" onclick="rate({$User->id}, {$Movie->id}, '{$category}', {$full})" />
							<label class="full" for="rating_{$category}_star{$i}"></label>
							<input type="radio" id="rating_{$category}_star{$i}half" name="rating_{$category}" value="{$half}" onclick="rate({$User->id}, {$Movie->id}, '{$category}', {$half})" />
							<label class="half" for="rating_{$category}_star{$i}half"></label>
						{/for}
					</fieldset>
				</td>
			</tr>
			<tr>
				<td  class="bold right">Fun</td>
				<td>
					<fieldset class="rating">
						{assign var="category" value="fun"}
						{for $i=0 to 10}
							{assign var="full" value=10 - {$i}}
							{assign var="half" value={$full} - 0.5}
							<input type="radio" id="rating_{$category}_star{$i}" name="rating_{$category}" value="{$full}" onclick="rate({$User->id}, {$Movie->id}, '{$category}', {$full})" />
							<label class="full" for="rating_{$category}_star{$i}"></label>
							<input type="radio" id="rating_{$category}_star{$i}half" name="rating_{$category}" value="{$half}" onclick="rate({$User->id}, {$Movie->id}, '{$category}', {$half})" />
							<label class="half" for="rating_{$category}_star{$i}half"></label>
						{/for}
					</fieldset>
				</td>
			</tr>
			<tr>
				<td class="bold right">Rewatch</td>
				<td>
					<fieldset class="rating">
						{assign var="category" value="rewatch"}
						{for $i=0 to 10}
							{assign var="full" value=10 - {$i}}
							{assign var="half" value={$full} - 0.5}
							<input type="radio" id="rating_{$category}_star{$i}" name="rating_{$category}" value="{$full}" onclick="rate({$User->id}, {$Movie->id}, '{$category}', {$full})" />
							<label class="full" for="rating_{$category}_star{$i}"></label>
							<input type="radio" id="rating_{$category}_star{$i}half" name="rating_{$category}" value="{$half}" onclick="rate({$User->id}, {$Movie->id}, '{$category}', {$half})" />
							<label class="half" for="rating_{$category}_star{$i}half"></label>
						{/for}
					</fieldset>
				</td>
			</tr>
			<tr>
				<td class="bold right">Acting</td>
				<td>
					<fieldset class="rating">
						{assign var="category" value="acting"}
						{for $i=0 to 10}
							{assign var="full" value=10 - {$i}}
							{assign var="half" value={$full} - 0.5}
							<input type="radio" id="rating_{$category}_star{$i}" name="rating_{$category}" value="{$full}" onclick="rate({$User->id}, {$Movie->id}, '{$category}', {$full})" />
							<label class="full" for="rating_{$category}_star{$i}"></label>
							<input type="radio" id="rating_{$category}_star{$i}half" name="rating_{$category}" value="{$half}" onclick="rate({$User->id}, {$Movie->id}, '{$category}', {$half})" />
							<label class="half" for="rating_{$category}_star{$i}half"></label>
						{/for}
					</fieldset>
				</td>
			</tr>
			<tr>
				<td class="bold right">Cinematography</td>
				<td>
					<fieldset class="rating">
						{assign var="category" value="cinematography"}
						{for $i=0 to 10}
							{assign var="full" value=10 - {$i}}
							{assign var="half" value={$full} - 0.5}
							<input type="radio" id="rating_{$category}_star{$i}" name="rating_{$category}" value="{$full}" onclick="rate({$User->id}, {$Movie->id}, '{$category}', {$full})" />
							<label class="full" for="rating_{$category}_star{$i}"></label>
							<input type="radio" id="rating_{$category}_star{$i}half" name="rating_{$category}" value="{$half}" onclick="rate({$User->id}, {$Movie->id}, '{$category}', {$half})" />
							<label class="half" for="rating_{$category}_star{$i}half"></label>
						{/for}
					</fieldset>
				</td>
			</tr>
			<tr>
				<td class="bold right">Editing</td>
				<td>
					<fieldset class="rating">
						{assign var="category" value="editing"}
						{for $i=0 to 10}
							{assign var="full" value=10 - {$i}}
							{assign var="half" value={$full} - 0.5}
							<input type="radio" id="rating_{$category}_star{$i}" name="rating_{$category}" value="{$full}" onclick="rate({$User->id}, {$Movie->id}, '{$category}', {$full})" />
							<label class="full" for="rating_{$category}_star{$i}"></label>
							<input type="radio" id="rating_{$category}_star{$i}half" name="rating_{$category}" value="{$half}" onclick="rate({$User->id}, {$Movie->id}, '{$category}', {$half})" />
							<label class="half" for="rating_{$category}_star{$i}half"></label>
						{/for}
					</fieldset>
				</td>
			</tr>
			<tr>
				<td class="bold right">Look</td>
				<td>
					<fieldset class="rating">
						{assign var="category" value="look"}
						{for $i=0 to 10}
							{assign var="full" value=10 - {$i}}
							{assign var="half" value={$full} - 0.5}
							<input type="radio" id="rating_{$category}_star{$i}" name="rating_{$category}" value="{$full}" onclick="rate({$User->id}, {$Movie->id}, '{$category}', {$full})" />
							<label class="full" for="rating_{$category}_star{$i}"></label>
							<input type="radio" id="rating_{$category}_star{$i}half" name="rating_{$category}" value="{$half}" onclick="rate({$User->id}, {$Movie->id}, '{$category}', {$half})" />
							<label class="half" for="rating_{$category}_star{$i}half"></label>
						{/for}
					</fieldset>
				</td>
			</tr>
			<tr>
				<td class="bold right">Sound</td>
				<td>
					<fieldset class="rating">
						{assign var="category" value="sound"}
						{for $i=0 to 10}
							{assign var="full" value=10 - {$i}}
							{assign var="half" value={$full} - 0.5}
							<input type="radio" id="rating_{$category}_star{$i}" name="rating_{$category}" value="{$full}" onclick="rate({$User->id}, {$Movie->id}, '{$category}', {$full})" />
							<label class="full" for="rating_{$category}_star{$i}"></label>
							<input type="radio" id="rating_{$category}_star{$i}half" name="rating_{$category}" value="{$half}" onclick="rate({$User->id}, {$Movie->id}, '{$category}', {$half})" />
							<label class="half" for="rating_{$category}_star{$i}half"></label>
						{/for}
					</fieldset>
				</td>
			</tr>
			<tr>
				<td class="bold right">Score</td>
				<td>
					<fieldset class="rating">
						{assign var="category" value="score"}
						{for $i=0 to 10}
							{assign var="full" value=10 - {$i}}
							{assign var="half" value={$full} - 0.5}
							<input type="radio" id="rating_{$category}_star{$i}" name="rating_{$category}" value="{$full}" onclick="rate({$User->id}, {$Movie->id}, '{$category}', {$full})" />
							<label class="full" for="rating_{$category}_star{$i}"></label>
							<input type="radio" id="rating_{$category}_star{$i}half" name="rating_{$category}" value="{$half}" onclick="rate({$User->id}, {$Movie->id}, '{$category}', {$half})" />
							<label class="half" for="rating_{$category}_star{$i}half"></label>
						{/for}
					</fieldset>
				</td>
			</tr>
		</table>

	</div>
{/block}
