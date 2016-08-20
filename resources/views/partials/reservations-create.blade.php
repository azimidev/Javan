<div class="form-group">
	<label for="date" class="control-label col-sm-2">Date</label>
	<div class="col-sm-5">
		<input class="datepicker form-control" type="text" name="date" id="date" placeholder="Date"
		       value="{{ date('Y-m-d') }}" pattern="[0-9\-]+"
		       data-date="{{ date('Y-m-d') }}" data-date-format="yyyy-mm-dd" required>
		<span class="help-block text-info">Your full date here</span>
	</div>
</div>

<div class="form-group">
	<label for="time" class="control-label col-sm-2">Time</label>
	<div class="col-sm-5">
		<select class="form-control" name="time" id="time" required>
			{!! select_times_of_day() !!}
		</select>
		<span class="help-block text-info">What time would you like to book ?</span>
	</div>
</div>

<div class="form-group">
	<label for="seats" class="control-label col-sm-2">Seats</label>
	<div class="col-sm-5">
		<input type="number" class="form-control" name="seats" id="seats" placeholder="Seats"
		       value="{{ old('seats') }}" min="1" max="25" required>
		<span class="help-block text-info">Please call us for more than 25 person</span>
	</div>
</div>

<div class="form-group">
	<div class="col-sm-offset-2">
		<button type="submit" class="btn btn-raised btn-success"
		        data-loading-text="One Moment... <i class='fa fa-spinner fa-pulse'></i>">
			<i class="fa fa-plus"></i>
			Make
		</button>
	</div>
</div>