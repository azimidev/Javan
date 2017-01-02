<div class="form-group">
	<label for="title" class="control-label col-sm-2">Title</label>
	<div class="col-sm-10">
		<input type="text" class="form-control" name="title" id="title" placeholder="Title"
		       value="{{ $products->title }}">
		<span class="help-block text-info">Product title</span>
	</div>
</div>

<div class="form-group">
	<label for="description" class="control-label col-sm-2">Description</label>
	<div class="col-sm-10">
		<textarea name="description" class="form-control" id="description" rows="5" required
		          placeholder="Description">{{ $products->description }}</textarea>
		<span class="help-block text-info">Menu item description</span>
	</div>
</div>

<div class="form-group">
	<label for="price" class="control-label col-sm-2">Price</label>
	<div class="col-sm-10">
		<input type="number" class="form-control" name="price" id="price" placeholder="Price x 100" required
		       value="{{ $products->price }}">
		<span class="help-block text-info">Product price in pence for example £1.50 MUST be entered 150 pence</span>
	</div>
</div>

<div class="form-group">
	<label for="category" class="control-label col-sm-2">Category</label>
	<div class="col-sm-10">
		<select class="form-control" name="category" id="category">
			<option {{ $products->hasCategory('appetizer') ? 'selected' : '' }} value="appetizer">Appetizer</option>
			<option {{ $products->hasCategory('main_course') ? 'selected' : '' }} value="main_course">Main Course</option>
			<option {{ $products->hasCategory('extra') ? 'selected' : '' }} value="extra">Sides & Extras</option>
			<option {{ $products->hasCategory('beverage') ? 'selected' : '' }} value="beverage">Beverage</option>
			<option {{ $products->hasCategory('juice') ? 'selected' : '' }} value="juice">Juice</option>
			<option {{ $products->hasCategory('dessert') ? 'selected' : '' }} value="dessert">Dessert</option>
		</select>
		<span class="help-block text-info">Choose a category</span>
	</div>
</div>

<div class="form-group">
	<label for="available" class="control-label col-sm-2"></label>
	<div class="togglebutton">
		<label>
			<input type="hidden" name="available" value="0">
			<input name="available" id="available" type="checkbox" {{ $products->available ? 'checked' : '' }} value="1">
			<label class="control-label">Available ?</label>
		</label>
	</div>
</div>

<div class="form-group">
	<div class="col-sm-offset-2">
		<a href="{{ route('products.index') }}" class="btn btn-raised btn-primary">
			<i class="fa fa-arrow-left"></i> Back
		</a>
		<button type="submit" class="btn btn-raised btn-primary">
			<i class="fa fa-pencil-square-o"></i>
			Update
		</button>
	</div>
</div>