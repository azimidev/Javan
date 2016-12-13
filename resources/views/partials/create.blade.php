<div class="form-group">
	<label for="name" class="control-label col-sm-2">Name</label>
	<div class="col-sm-5">
		<input type="text" class="form-control" name="name" id="name" placeholder="Name" value="{{ old('name') }}">
		<span class="help-block text-primary">Your full name here</span>
	</div>
</div>

<div class="form-group">
	<label for="email" class="control-label col-sm-2">Email or Username</label>
	<div class="col-sm-5">
		<input type="text" class="form-control" name="email" id="email" placeholder="Email or Username" value="{{ old('email') }}">
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

<div class="form-group">
	<label for="role" class="control-label col-sm-2">Role</label>
	<div class="col-sm-5">
		<select class="form-control" name="role" id="role">
			<option value="admin">Admin</option>
			<option value="manager">Manager</option>
			<option selected value="member">Member</option>
		</select>
		<span class="help-block text-primary">Choose a role</span>
	</div>
</div>

<div class="form-group">
	<label for="address" class="control-label col-sm-2">Address</label>
	<div class="col-sm-5">
		<input type="text" class="form-control" name="address" id="address" placeholder="Address" value="{{ old('address') }}">
		<span class="help-block text-primary">First line of your address</span>
	</div>
</div>

<div class="form-group">
	<label for="city" class="control-label col-sm-2">City</label>
	<div class="col-sm-5">
		<input type="text" class="form-control" name="city" id="city" placeholder="City" value="{{ old('city') }}">
		<span class="help-block text-primary">City you live</span>
	</div>
</div>

<div class="form-group">
	<label for="post_code" class="control-label col-sm-2">Post Code</label>
	<div class="col-sm-5">
		<input type="text" class="form-control" name="post_code" id="post_code" placeholder="Post Code" value="{{ old('post_code') }}">
		<span class="help-block text-primary">Your post code</span>
	</div>
</div>

<div class="form-group">
	<label for="phone" class="control-label col-sm-2">Phone</label>
	<div class="col-sm-5">
		<input type="text" class="form-control" name="phone" id="phone" placeholder="Phone" value="{{ old('phone') }}">
		<span class="help-block text-primary">Your phone or mobile number</span>
	</div>
</div>

<div class="form-group">
	<label for="active" class="control-label col-sm-2"></label>
	<div class="togglebutton">
		<label>
			<input type="hidden" name="active" value="0">
			<input name="active" id="active" type="checkbox" value="1">
			<label class="control-label">Active ?</label>
		</label>
	</div>
</div>

<div class="col-sm-offset-2">
	<button type="submit" class="btn btn-raised btn-primary">
		<i class="fa fa-pencil-square-o fa-lg"></i>
		Create
	</button>
</div>