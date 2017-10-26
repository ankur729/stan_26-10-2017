
@extends('layouts.master.admin.index')

@section('styles')

@endsection

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
              <h3 class="box-title">View ContactUs Leads   </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
      
       

{!! Form::model($enquiry,['url' => 'admin/event/update','method' => 'put' ]) !!}


<!-- Login-Field -->
<div class="Login-bg">


<div class="Login-header with-border">
   <h3 class="login-details">Main Details</h3>
 </div>
     
       <div class="box-body">
       <div class="col-xs-6 ">
        <div class="form-group">
           {!!Form::label('e_name', 'Name') !!}
      

        {!!     Form::text('e_name', $enquiry->name,  ['class' => 'form-control', 'placeholder' => 'Event Name','disabled'=>'disabled']) !!}

          <div class="form_error"></div>
           </div>
          </div>
             <div class="col-xs-6 ">
        <div class="form-group">
           {!!Form::label('e_name', 'Email') !!}
      

        {!!     Form::text('e_name', $enquiry->email,  ['class' => 'form-control', 'placeholder' => 'Event Name','disabled'=>'disabled']) !!}

          <div class="form_error"></div>
           </div>
          </div>
        </div>



           <div class="box-body">
       <div class="col-xs-6 ">
        <div class="form-group">
           {!!Form::label('e_name', 'Contact') !!}
      

        {!!     Form::text('e_name', $enquiry->phone,  ['class' => 'form-control', 'placeholder' => 'Event Name','disabled'=>'disabled']) !!}

          <div class="form_error"></div>
           </div>
          </div>
             <div class="col-xs-6 ">
        <div class="form-group">
           {!!Form::label('e_name', 'Subject') !!}
      

        {!!     Form::text('e_name', $enquiry->subject,  ['class' => 'form-control', 'placeholder' => 'Event Name','disabled'=>'disabled']) !!}

          <div class="form_error"></div>
           </div>
          </div>
        </div>




            <div class="box-body">
       <div class="col-xs-10 ">
        <div class="form-group">
           {!!Form::label('e_name', 'Message') !!}
      

        {!!     Form::text('e_name', $enquiry->message,  ['class' => 'form-control', 'placeholder' => 'Event Name','disabled'=>'disabled']) !!}

          <div class="form_error"></div>
           </div>
          </div>
   
        </div>

        </div>

   </div>


      
<!-- OTHER DETAILS SECTION END-->

  <div class="box-body">
               <div class="col-xs-3">
                 <div class="form-group"> 
                 <br><br><br>


          <div class="form_error"></div>
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




@endpush


