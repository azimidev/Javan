<div class="form-group">
	<label for="name" class="control-label col-sm-2">Name</label>
	<div class="col-sm-5">
		<input type="text" class="form-control" name="name" id="name" placeholder="Name"
		       value="{{ old('name') ?? $user->name }}" pattern="[a-zA-Z\s]+">
		<span class="help-block text-primary">Your full name here</span>
	</div>
</div>

<div class="form-group">
	<label for="email" class="control-label col-sm-2">Email or Username</label>
	<div class="col-sm-5">
		<input type="email" class="form-control" name="email" id="email" placeholder="Email or Username"
		       value="{{ old('email') ?? $user->email }}">
		<span class="help-block text-primary">Enter email or username for login</span>
	</div>
</div>

<div class="form-group">
	<label for="password" class="control-label col-sm-2">Password</label>
	<div class="col-sm-5">
		<input type="password" class="form-control" name="password" id="password" placeholder="Password">
		<span class="help-block text-primary">Your password</span>
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
				<span class="help-block text-primary">Choose a role</span>
			</div>
		</div>
	@endif
@endcan

<div class="form-group">
	<label for="address" class="control-label col-sm-2">Address</label>
	<div class="col-sm-5">
		<input type="text" class="form-control" name="address" id="address" placeholder="Address"
		       value="{{ old('address') ?? $user->address }}" pattern="[\w\s\-,]+" required>
		<span class="help-block text-primary">First line of your address</span>
	</div>
</div>

<div class="form-group">
	<label for="city" class="control-label col-sm-2">City</label>
	<div class="col-sm-5">
		<input type="text" class="form-control" name="city" id="city" placeholder="City"
		       value="{{ old('city') ?? $user->city }}" pattern="[\w\s\-,]+" required>
		<span class="help-block text-primary">City you live</span>
	</div>
</div>

<div class="form-group">
	<label for="post_code" class="control-label col-sm-2">Post Code</label>
	<div class="col-sm-5">
		<input type="text" class="form-control" name="post_code" id="post_code" placeholder="Post Code"
		       value="{{ old('post_code') ?? $user->post_code }}" required
		       pattern="^((([a-pr-uwyzA-PR-UWYZ][a-hk-yA-HK-Y]?[0-9][0-9]?)|(([a-pr-uwyzA-PR-UWYZ][0-9][a-hjkstuwA-HJKSTUW])|([a-pr-uwyzA-PR-UWYZ][a-hk-yA-HK-Y][0-9][abehmnprv-yABEHMNPRV-Y]))) *[0-9][abd-hjlnp-uw-zABD-HJLNP-UW-Z]{2})$">
		<span class="help-block text-primary">Your post code</span>
	</div>
</div>

<div class="form-group">
	<label for="phone" class="control-label col-sm-2">Phone</label>
	<div class="col-sm-5">
		<input type="tel" class="form-control" name="phone" id="phone" placeholder="Phone"
		       value="{{ old('phone') ?? $user->phone }}" required
		       pattern="^(?:(?:\(?(?:0(?:0|11)\)?[\s-]?\(?|\+)44\)?[\s-]?(?:\(?0\)?[\s-]?)?)|(?:\(?0))(?:(?:\d{5}\)?[\s-]?\d{4,5})|(?:\d{4}\)?[\s-]?(?:\d{5}|\d{3}[\s-]?\d{3}))|(?:\d{3}\)?[\s-]?\d{3}[\s-]?\d{3,4})|(?:\d{2}\)?[\s-]?\d{4}[\s-]?\d{4}))(?:[\s-]?(?:x|ext\.?|#)\d{3,4})?$">
		<span class="help-block text-primary">Your phone or mobile number</span>
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
			{{ $submit_button ?? 'Create User' }}
		</button>
	</div>
</div>