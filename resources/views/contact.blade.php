@extends('app')

@section('content')
<div class="col-md-8 col-md-offset-2">
    @if(Session::has('flashmessage'))
        <p class="alert alert-info"><i class="fa fa-envelope"></i> {{ Session::get('flashmessage') }}</p>
     @endif
    <div class="page-header">
        <h1>Send us a message</h1>
    </div>
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>


    {!! Form::open(array('route' => 'contact', 'class' => 'form')) !!}
    
    <div class="form-group">
        {!! Form::label('Your Name') !!}
        {!! Form::text('name', null, 
            array('required', 
                  'class'=>'form-control', 
                  'placeholder'=>'Your name')) !!}
    </div>
    
    <div class="form-group">
        {!! Form::label('Your E-mail Address') !!}
        {!! Form::text('email', null, 
            array('required', 
                  'class'=>'form-control', 
                  'placeholder'=>'Your e-mail address')) !!}
    </div>
    
    <div class="form-group">
        {!! Form::label('Your Message') !!}
        {!! Form::textarea('message', null, 
            array('required', 
                  'class'=>'form-control', 
                  'placeholder'=>'Your message')) !!}
    </div>
    
    <div class="form-group">
        {!! Form::submit('Contact Us!', 
          array('class'=>'btn btn-primary')) !!}
    </div>
    {!! Form::close() !!}
</div>
@stop