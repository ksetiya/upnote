	    <div class="form-group">
			{!! Form::text('title', null, ['placeholder' => 'Title', 'class' => 'story-form-title story-form-input form-control']) !!}
			
		</div>
		
		<div class="form-group">
		 	{!! Form::textarea('body', null, ['placeholder' => 'Tell us your story... (try to keep it short and sweet)', 'class' => 'story-form-body story-form-input form-control']) !!}
		</div>
		
	<!--	 <div class="form-group">
			<h3>{!! Form::label('coverpic', 'Upload a cover picture (max. 2MB)') !!}</h3>
		
			{!! Form::text('coverpic', null, ['class' => 'form-control']) !!}
		</div>-->
		
		<div class="fileinput fileinput-new" data-provides="fileinput">
			<h3>{!! Form::label('coverpic', 'Cover Image', ['class' => 'story-form-label', 'id'=>'coverpic']) !!}	<small>(max. 500kb, ideal size: 560px by 420px)</small></h3>
		  <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 280px; height: 110px;"></div>
		  <div>
		    <span class="btn btn-default btn-file">
		    	<span class="fileinput-new">Select image</span>
		    	<span class="fileinput-exists">Change</span>
		   			{!! Form::file('coverpic') !!}
		   			<input type="file" name="..."></span>
		   		<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
		   	
		   		
		  </div>
		</div>

        
		
		<div class="form-group">
			<h3>{!! Form::label('tag_list', 'Tags', ['class' => 'story-form-label']) !!}</h3>
		
			{!! Form::select('tag_list[]', $tags, null, ['class' => 'story-form-tags story-form-input form-control', 'id'=>'tag_list', 'multiple']) !!}
		</div>
		
	<!--	<div class="form-group">
			<h3>	{!! Form::label('category', 'Category', ['class' => 'story-form-label']) !!}	</h3>
			{!! Form::select('category', array(
				''    => 'Select a category',
				'health' => 'Health',
				'relationships' => 'Relationships',
				'depression' => 'Depression',
				'school' => 'School',
				'light' => 'Lighthearted',
				'misc' => 'Miscellaneous'
				
				)); !!}
		</div>
		-->
		
		<div class="form-group">
			<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="text-center">
				{!! Form::button($submitButtonText, ['type'=>'submit', 'class' => 'btn btn-lg btn-primary animateBtn']) !!}
				</div>
				</div>
			</div>
		</div>
		
	
		
         @section('footer')
	<script type="text/javascript">
			
			$(document).ready(function () {
				$("button[type=submit], .animateBtn").click(function () {
					$(this).addClass("m-progress");
				})	
			});
	</script>
	
	<script type="text/javascript">
	 	
		$('#tag_list').select2({
		    placeholder: "Select or add tags",
		    tags: true,
		    tokenSeparators: [",", " "],
		    createTag: function(newTag) {
		        return {
		            id: 'new:' + newTag.term,
		            text: newTag.term
		        };
		    }
		});
	</script>

@stop