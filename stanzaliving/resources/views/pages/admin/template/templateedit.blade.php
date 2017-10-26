



@extends('layouts.master.admin.index')


@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            @if (count($errors) > 0)
    <div class="alert alert-danger" id="errorMessage">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
              <div class="flash-message">
 @if(Session::has('message'))
    <div class="alert-box success" id="successMessage">
      <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message') }}</p>
    </div>
@endif
@if(Session::has('duplicate'))
    <div class="alert-box danger" id="successMessage">
      <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('duplicate') }}</p>
    </div>
@endif
  </div>
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title" style="margin-bottom:75px;">Edit Template  </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
			
       

{!! Form::open(['url' => 'admin/room/save','method' => 'post']) !!}




          
             <div class="box-body">
               <div class="col-xs-8">
                 <div class="form-group">
                  {!!Form::label('name', 'Template Name') !!}
  

    {!!     Form::text('name', null,  ['class' => 'form-control', 'placeholder' => 'Template Name']) !!}

          <div class="form_error"></div>
                 </div>
               </div>

               <div class="col-xs-8">
                 <div class="form-group">
                  {!!Form::label('name', 'Message') !!}
  

    {!!     Form::textarea('mail_body', null,  ['class' => 'form-control', 'placeholder' => 'Message','rows'=>5,'id'=>'mail_body']) !!}

          <div class="form_error"></div>
                 </div>
               </div>

                  <div class="col-xs-8">
                 <div class="form-group">
                 <br/><br/><br><br>
                  {!!Form::label('name', 'Variables') !!}

                  @foreach($templatekeys as $templatekey)
                 
                  <a href="{{$templatekey->variable_key}}" class="dynamic_variable_cc" style="padding-left: 10px;padding-right: 10px;">{{$templatekey->variable_name}}</a> 
            
                    @endforeach

          <div class="form_error"></div>
                 </div>
               </div>


                <div class="box-footer">
              <div class="col-md-12">
                <!--<button type="clear" class="btn btn-default">Cancel</button>-->
                      <a  href="{{url('admin/room/list')}}" class="btn btn-back " style="margin-bottom:65px;margin-left:-15px;">Back</a>
                <button type="submit" class="btn btn-success" style="margin-bottom:65px;">Edit Template</button>
              </div>
              </div>
         </div>

 
         

            {!! Form::close() !!}

          </div>
          <!-- /.box -->


        </div>
        <!--/.col (left) -->
        <!-- right column -->
      
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->




@endsection

@push('scripts')

<script type="text/javascript">
  $('.dynamic_variable_cc').click(function(e){
  

  e.preventDefault();
  var var_code=$(this).attr('href');
 
  
      var cursorPos = $('#mail_body').prop('selectionStart');
            var v = $('#mail_body').val();
            var textBefore = v.substring(0,  cursorPos );
            var textAfter  = v.substring( cursorPos, v.length );
            $('#mail_body').val( textBefore+ var_code +textAfter );


});
</script>
@endpush