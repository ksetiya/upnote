	
		<div class="form-group">
			{!! Form::label('title', 'Title:') !!}
			{!! Form::text('title', null, ['class' => 'form-control']) !!}
			
		</div>
		
		<div class="form-group">
			{!! Form::label('body', 'Body:') !!}
			{!! Form::textarea('body', null, ['class' => 'form-control']) !!}
		</div>
		
		<div class="form-group">
			{!! Form::label('coverpic', 'Link to cover picture:') !!}
			{!! Form::text('coverpic', null, ['class' => 'form-control']) !!}
		</div>
		
		<div class="form-group">
			{!! Form::label('tags', 'Tags:') !!}
			{!! Form::text('tags', null, ['class' => 'form-control']) !!}
		</div>
		
		<div class="form-group">
			{!! Form::label('category', 'Category:') !!}
			{!! Form::select('category', array(
				'health' => 'Health',
				'relationships' => 'Relationships',
				'depression' => 'Depression',
				'school' => 'School',
				'light' => 'Lighthearted',
				'misc' => 'Miscellaneous'
				
				)); !!}
		</div>
		
		<div class="form-group">
			{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
		</div>