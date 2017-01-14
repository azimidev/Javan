@if ( ! route('post.create'))
<div class="form-group">
	<label for="slug" class="control-label col-sm-2">Slug</label>
	<div class="col-sm-10">
		<input class="form-control" type="text" name="slug" id="slug"
		       placeholder="Leave slug blank if you are creating post"
		       value="{{ $post->slug }}">
		<span class="help-block text-info">Your post slug here</span>
	</div>
</div>
@endif

<div class="form-group">
	<label for="subject" class="control-label col-sm-2">Subject Title</label>
	<div class="col-sm-10">
		<input class="form-control" type="text" name="subject" id="subject" placeholder="Subject Title"
		       value="{{ old('subject') ?? $post->subject }}">
		<span class="help-block text-info">Your post subject here</span>
	</div>
</div>

<div class="form-group">
	<label for="body" class="control-label col-sm-2">Body</label>
	<div class="col-sm-10">
		<textarea class="form-control" name="body" id="body" cols="30" rows="30">{{ old('body') ?? $post->body }}</textarea>
		<span class="help-block text-info">The body of the post</span>
	</div>
</div>

<div class="form-group">
	<label for="visible" class="control-label col-sm-2"></label>
	<div class="togglebutton">
		<label>
			<input type="hidden" name="visible" value="0">
			<input name="visible" id="visible" type="checkbox" {{ $post->visible ? 'checked' : '' }} value="1">
			<label class="control-label">Visible ?</label>
		</label>
	</div>
</div>

<div class="form-group">
	<div class="col-sm-offset-2">
		<a class="btn btn-danger btn-raised" href="{{ route('post.index') }}">
			<i class="fa fa-ban"></i>
			Cancel
		</a>
		<button type="submit" class="btn btn-raised btn-success">
			<i class="fa fa-pencil-square-o fa-lg"></i>
			{{ $submit_button ?? 'Create Post' }}
		</button>
	</div>
</div>