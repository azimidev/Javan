<div class="form-group">
	<label for="subject" class="control-label col-sm-2">Subject</label>
	<div class="col-sm-5">
		<input class="form-control" type="text" name="subject" id="subject" placeholder="Subject"
		       value="{{ old('subject') }}">
		<span class="help-block text-info">Post subject here</span>
	</div>
</div>

<div class="form-group">
	<label for="body" class="control-label col-sm-2">Body</label>
	<div class="col-sm-5">
		<textarea class="form-control" name="body" id="body" cols="30" rows="10"
		          placeholder="Body">{{ old('body') }}</textarea>
		<span class="help-block text-info">Text for blog post</span>
	</div>
</div>

<div class="form-group">
	<label for="visible" class="control-label col-sm-2"></label>
	<div class="togglebutton">
		<label>
			<input type="hidden" name="visible" value="0">
			<input name="visible" id="visible" type="checkbox" value="1">
			<label class="control-label">Visible ?</label>
		</label>
	</div>
</div>

<div class="form-group">
	<div class="col-sm-offset-2">
		<button type="submit" class="btn btn-raised btn-success">
			<i class="fa fa-plus"></i>
			Create
		</button>
		<a class="btn btn-danger btn-raised" href="{{ route('member.bookings') }}">Cancel</a>
	</div>
</div>