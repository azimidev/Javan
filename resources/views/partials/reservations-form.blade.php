<div class="form-group">
	<label for="date" class="control-label col-sm-2">Date</label>
	<div class="col-sm-5">
		<input class="datepicker form-control" type="text" name="date" id="date" placeholder="Date"
		       value="{{ old('date') ?? $reservations->date->format('Y-m-d') }}"
		       data-date="{{ date('Y-m-d') }}" data-date-format="yyyy-mm-dd" required>
		<span class="help-block text-primary">Your full date here</span>
	</div>
</div>

<div class="form-group">
	<label for="time" class="control-label col-sm-2">Time</label>
	<div class="col-sm-5">
		<select class="form-control" name="time" id="time" required>
			<option value="{{ old('time') ?? $reservations->time }}">{{ $reservations->time }}</option>
			{!! select_times_of_day() !!}
		</select>
		<span class="help-block text-primary">What time would you like to book ?</span>
	</div>
</div>

<div class="form-group">

	<label for="seats" class="control-label col-sm-2">Seats</label>
	<div class="col-sm-5">
		<input type="number" class="form-control" name="seats" id="seats" placeholder="Seats"
		       value="{{ old('seats') ?? $reservations->seats }}"  min="1" max="25" required>
		<span class="help-block text-primary">How many seats ?</span>
	</div>
</div>

<div class="form-group">
	<div class="col-sm-offset-2">
		<button type="submit" class="btn btn-raised btn-success">
			<i class="fa fa-pencil-square-o fa-lg"></i>
			{{ $submit_button ?? 'Book' }}
		</button>
		<a class="btn btn-danger btn-raised" href="{{ route('member.reservations') }}">Cancel</a>
	</div>
</div>