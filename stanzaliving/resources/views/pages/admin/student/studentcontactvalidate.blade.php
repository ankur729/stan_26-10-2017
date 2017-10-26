
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
              <h3 class="box-title">Add New Student   </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
			
{!! Form::open(['url' => 'admin/contactvalidate','method' => 'post' ]) !!}

<div class="Login-header with-border   after-border">
   <h3 class="login-details">Parent Data</h3>
</div>

 <div class="box-body">
   <div class="col-xs-4 ">
    <div class="form-group">
       {!!Form::label('s_username', 'Parent Contact No.') !!}
  

    {!!     Form::text('contact', null,  ['class' => 'form-control', 'placeholder' => 'Contact No.', 'required' => 'required']) !!}

      <div class="form_error"></div>
       </div>
      </div>
    </div>

     <div class="col-xs-4 ">
       <div class="form-group"  >
    <button type="submit" class="btn btn-back " style="float: right;margin: 20px;">Validate</button>
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


<script> 
$(document).ready(function(){
  var c_id=$('.nation').val();

  $.ajax({
    type:'GET',
    cache: false,
    url:'findstates',
    data:{c_id:c_id},
     
    beforeSend:function(){
   
    },
    success:function(data){
  
    $('#state').html(data);


    }

});
});

$('.nation').change(function(){

    var c_id=$(this).val();
 
  $.ajax({
    type:'GET',
    cache: false,
    url:'findstates',
    data:{c_id:c_id},
     
    beforeSend:function(){
  
    },
    success:function(data){
  
    $('#state').html(data);


    }

});
});

$('#state').change(function(){

    var s_id=$(this).val();

  $.ajax({
    type:'GET',
    cache: false,
    url:'findcities',
    data:{s_id:s_id},
     
    beforeSend:function(){
 
    },
    success:function(data){
 
    $('#cities').html(data);


    }
});
});




$('.fname').change(function(){

   if (! $(this).val().match('^[a-zA-Z]{3,16}$') ) {
          alert("Do not add spaces or special chars");
          $(this).val('');
          $(this).focus();
          return false;
      } 
      else if($(this).val()==''){
           alert("Please enter valid name.");
          $(this).val('');
          $(this).focus();
          return false;
      }

});
$('.lname').change(function(){

   if (! $(this).val().match('^[a-zA-Z]{3,16}$') ) {
          alert("Do not add spaces or special chars");
          $(this).val('');
          $(this).focus();
          return false;
      } 
      else if($(this).val()==''){
           alert("Please enter valid name.");
          $(this).val('');
          $(this).focus();
          return false;
      }

});
$('#s_contact').change(function(){

   var num=$(this).val();
   var len=num.length;
   if(isNaN(num) || parseInt(len)!=10)
   {
     alert("Please enter 10 digit mobile number.");
          $(this).val('');
          $(this).focus();
          return false;
   }

});

$('#s_username').change(function(){
 var val=$(this).val();
    if (! $(this).val().match('^[a-z0-9_\.]{3,15}$') ) {
          alert("Invalid Username. \nMax Length:15.\nAllowed chars [a-z][0-9].\nNo Capitals.\nSpecial Chars Allowed:dot,underscore");
          $(this).val('');
          $(this).focus();
          return false;
      } 

});

$('#s_pincode').change(function(){

    if (! $(this).val().match('^[0-9_\.]{6}$') ) {
          alert("Please enter 6 digit integer pincode.");
          $(this).val('');
          $(this).focus();
          return false;
      } 

});


$('#s_password').change(function(){

    if (  $(this).val().length<4 || $(this).val().length>15)  {
          alert("Please select password between 4 to 15 in length.");
          $(this).val('');
          $(this).focus();
          return false;
      } 
   

});


$("#datepicker").datepicker({
    
      dateFormat: "yy-mm-dd",
      
      numberOfMonths: 1,
      changeMonth: true,
        changeYear: true,
      
    });
 $("#s_dob").datepicker({
     
      dateFormat: "yy-mm-dd",
       yearRange: '1980:2017',
      numberOfMonths: 1,
      changeMonth: true,
        changeYear: true
    });
$('#s_dob').change(function(){
  if(! $(this).val().match('^[0-9]{4}-[0-1][0-9]-[0-3][0-9]$') )
  {
    alert('Invalid Date Format');
    $(this).val(' ');
    $(this).focus();
  }
});

 $('#datepicker').change(function(){
  if(! $(this).val().match('^[0-9]{4}-[0-1][0-9]-[0-3][0-9]$') )
  {
    alert('Invalid Date Format');
    $(this).val(' ');
    $(this).focus();
  }
});


</script>
  



@endpush


