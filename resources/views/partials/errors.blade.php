@if (count($errors) > 0)
	<div class="alert alert-danger alert-dismissible" role="alert" style="border-radius: 4px; min-width: 200px;">
		<ul class="list-unstyled">
			@foreach ($errors->all() as $error)
				<li>
					<i class="fa fa-exclamation-circle"></i>
					{{ $error }}
				</li>
			@endforeach
		</ul>
	</div>
@endif

