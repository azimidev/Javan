<div class="form-group">
	<label for="title" class="control-label col-sm-2">Title</label>
	<div class="col-sm-5">
		<input type="text" class="form-control" name="title" id="title" required placeholder="Title"
		       value="{{ old('title') }}">
		<span class="help-block text-info">Menu item title</span>
	</div>
</div>

<div class="form-group">
	<label for="description" class="control-label col-sm-2">Description</label>
	<div class="col-sm-5">
		<textarea name="description" class="form-control" id="description" rows="5" required
		          placeholder="Description">{{ old('description') }}</textarea>
		<span class="help-block text-info">Menu item description</span>
	</div>
</div>

<div class="form-group">
	<label for="price" class="control-label col-sm-2">Price</label>
	<div class="col-sm-5">
		<input type="number" class="form-control" name="price" id="price" placeholder="Price x 100" required
		       value="{{ old('price') }}">
		<span class="help-block text-info">Product price time 100 for example £1.50 MUST be entered 150</span>
	</div>
</div>

<div class="form-group">
	<label for="category" class="control-label col-sm-2">Category</label>
	<div class="col-sm-5">
		<select class="form-control" name="category" id="category" required>
			<option selected disabled>-- Choose One Category --</option>
			<option value="appetizer">Appetizer</option>
			<option value="main_course">Main Course</option>
			<option value="extra">Sides 7 Extras</option>
			<option value="beverage">Beverage</option>
			<option value="juice">Juice</option>
			<option value="dessert">Dessert</option>
		</select>
		<span class="help-block text-info">Choose a category</span>
	</div>
</div>

<div class="col-sm-offset-2">
	<button type="submit" class="btn btn-raised btn-primary">
		<i class="fa fa-pencil-square-o fa-lg"></i>
		Create
	</button>
</div>