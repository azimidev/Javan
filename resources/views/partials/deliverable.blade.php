<div class="panel panel-info">
	<div class="panel-heading">
		<p class="panel-title">
			Find if We Deliver in Your Area
		</p>
	</div>
	<div class="panel-body">
		<form action="{{ url('deliverable') }}" method="POST" role="form" class="form-inline" id="deliverable">
			<div class="center">
				<div class="form-group">
					<div class="input-group input-group-lg">
						<label class="sr-only" for="post_code"><i class="fa fa-envelope fa-fw fa-lg"></i></label>
						<input type="text" class="form-control input-lg" name="post_code" id="post_code"
						       placeholder="Enter Full Post Code" required minlength="2" maxlength="8" pattern="^(^\S)[\w\s\-]+">
						<div class="input-group-btn">
							<button type="submit" class="btn btn-raised btn-info">
								<i class="fa fa-search fa-fw fa-lg"></i>
							</button>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>