<div class="form-group">
	<label for="name" class="control-label col-sm-2">Name</label>
	<div class="col-sm-5">
		<input type="text" class="form-control" name="name" id="name" placeholder="Name"
		       value="{{ $user->name }}" pattern="[a-zA-Z\s]+">
		<span class="help-block text-info">Your full name here</span>
	</div>
</div>

<div class="form-group">
	<label for="email" class="control-label col-sm-2">Email</label>
	<div class="col-sm-5">
		<input type="email" class="form-control" name="email" id="email" placeholder="Email"
		       value="{{ $user->email }}">
		<span class="help-block text-info">Your email address is vert important</span>
	</div>
</div>

@can('admin', $user)
	@if ($user != auth()->user())
		<div class="form-group">
			<label for="role" class="control-label col-sm-2">Role</label>
			<div class="col-sm-5">
				<select class="form-control" name="role" id="role">
					<option {{ $user->hasRole('admin') ? 'selected' : '' }} value="admin">Admin</option>
					<option {{ $user->hasRole('manager') ? 'selected' : '' }} value="manager">Manager</option>
					<option {{ $user->hasRole('member') ? 'selected' : '' }} value="member">Member</option>
				</select>
				<span class="help-block text-info">Choose a role</span>
			</div>
		</div>
	@endif
@endcan

<div class="form-group">
	<label for="address" class="control-label col-sm-2">Address</label>
	<div class="col-sm-5">
		<input type="text" class="form-control" name="address" id="address" placeholder="Address"
		       value="{{ $user->address }}" pattern="[\w\s\-]+">
		<span class="help-block text-info">First line of your address</span>
	</div>
</div>

<div class="form-group">
	<label for="city" class="control-label col-sm-2">City</label>
	<div class="col-sm-5">
		<input type="text" class="form-control" name="city" id="city" placeholder="City"
		       value="{{ $user->city }}" pattern="[\w\s\-,]+">
		<span class="help-block text-info">City you live</span>
	</div>
</div>

<div class="form-group">
	<label for="post_code" class="control-label col-sm-2">Post Code</label>
	<div class="col-sm-5">
		<input type="text" class="form-control" name="post_code" id="post_code" placeholder="Post Code"
		       value="{{ $user->post_code }}" pattern="[\w\s\-]+">
		<span class="help-block text-info">Your post code</span>
	</div>
</div>

<div class="form-group">
	<label for="phone" class="control-label col-sm-2">Phone</label>
	<div class="col-sm-5">
		<input type="tel" class="form-control" name="phone" id="phone" placeholder="Phone"
		       value="{{ $user->phone }}">
		<span class="help-block text-info">Your phone or mobile number</span>
	</div>
</div>

@can('admin', $user)
	@unless ($user->isSelf())
		<div class="form-group">
			<label for="active" class="control-label col-sm-2"></label>
			<div class="togglebutton">
				<label>
					<input type="hidden" name="active" value="0">
					<input name="active" id="active" type="checkbox" {{ $user->active ? 'checked' : '' }} value="1">
					<label class="control-label">Active ?</label>
				</label>
			</div>
		</div>
	@endunless
@endcan
<div class="form-group">
	<div class="col-sm-offset-2">
		<button type="submit" class="btn btn-raised btn-primary">
			<i class="fa fa-pencil-square-o"></i>
			Update
		</button>
	</div>
</div>