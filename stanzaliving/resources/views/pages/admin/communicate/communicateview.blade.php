



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
              <h3 class="box-title">View Vox Populi </h3>
            </div>
            <!-- /.box-header -->


{!! Form::model($messages,['url' => 'admin/communicate/update','method' => 'put']) !!}


  {!! Form::hidden('id', $messages->id) !!}











            <!-- form start -->

             <div class="box-body">
               <div class="col-xs-4">
                 <div class="form-group">
                  {!!Form::label('m_date', 'Opening Date') !!}
  

    {!!     Form::text('m_date', $messages->m_date,  ['class' => 'form-control','disabled'=>'disabled']) !!}

          <div class="form_error"></div>
                 </div>
               </div>
         </div>

                      <div class="box-body">
               <div class="col-md-4">
                 <div class="form-group">
                  {!!Form::label('m_cat', 'Message Category') !!}
  

    {!!     Form::select('m_cat', $mycat, null, ['class' => 'form-control','disabled'=>'disabled']) !!}

          <div class="form_error"></div>
                 </div>
               </div>
         </div>
                   <div class="box-body">
               <div class="col-xs-4">
                 <div class="form-group">
                  {!!Form::label('m_sub_cat', 'Sub Category') !!}
  

    {!!     Form::select('m_sub_cat', $mysubcat, null,  ['class' => 'form-control','disabled'=>'disabled']) !!}

          <div class="form_error"></div>
                 </div>
               </div>
         </div>
			  
             <div class="box-body">
               <div class="col-xs-12">
                 <div class="form-group">
                  {!!Form::label('m_topic', 'Topic of Discussion') !!}
  

    {!!     Form::text('m_topic', $messages->m_topic, ['class' => 'form-control','disabled'=>'disabled']) !!}

          <div class="form_error"></div>
                 </div>
               </div>
         </div>

 



         <div class="box-body">
               <div class="col-xs-4">
                 <div class="form-group">
                  {!!Form::label('m_person_name', 'Person Name') !!}
  

    {!!     Form::text('m_person_name', $messages->m_person_name,  ['class' => 'form-control','disabled'=>'disabled']) !!}

          <div class="form_error"></div>
                 </div>
               </div>
         </div>

                      <div class="box-body">
               <div class="col-md-4">
                 <div class="form-group">
                  {!!Form::label('m_contact', 'Person Contact') !!}
  

    {!!     Form::text('m_contact', $messages->m_contact,  ['class' => 'form-control','disabled'=>'disabled']) !!}

          <div class="form_error"></div>
                 </div>
               </div>
         </div>
                   <div class="box-body">
               <div class="col-xs-4">
                 <div class="form-group">
                  {!!Form::label('m_idproof', 'ID Proof') !!}
  
    <a href="{{ URL::to('public/images/communicate/'.$messages->m_idproof)  }}">   <img id="img_view" src=" {{ URL::to('public/images/communicate/'.$messages->m_idproof)  }}" alt="your image"  style="width:100px;height:100px" /></a>
<!--     {!!     Form::text('m_idproof', $messages->m_idproof,  ['class' => 'form-control','disabled'=>'disabled']) !!} -->

          <div class="form_error"></div>
                 </div>
               </div>
         </div>



                   <div class="box-body">
               <div class="col-xs-12">
                 <div class="form-group">
                  {!!Form::label('details', 'Specific Details') !!}
  

    {!!     Form::textarea('m_desc', $messages->m_desc,  ['class' => 'form-control','disabled'=>'disabled']) !!}

          <div class="form_error"></div>
                 </div>
               </div>
         </div>
         






{!! Form::close() !!}


 <div class="box-footer">
              <div class="col-md-4">
                <!--<button type="clear" class="btn btn-default">Cancel</button>-->
   <button   class="btn btn-success pull-left" style="margin-bottom:65px;" id="addreply">Add Reply</button>
              </div>


             <!-- REPLY BOX--> 
       <div class="clearfix"></div>

       <form method="post" action="{{url('admin/communicate/reply')}}"> 
  <input type="hidden" name="_token" value="{{ csrf_token() }}" />
       <div class="box-body" id="reply_box">
               <div class="col-xs-10">
                 <div class="form-group">
                  {!!Form::label('details', 'Add New Reply') !!}
               

    {!!     Form::textarea('m_desc', $messages->m_desc,  ['class' => 'form-control', 'rows'=>2]) !!}

          <div class="form_error"></div>
                 </div>
               </div>
                <div class="col-xs-2">

        <button   class="btn btn-success pull-left"   id="addreply">Submit</button>

        
                
               </div>
         </div>


         </form>

         <!-- REPLY BOX--> 


<b class="center">Previous Reply</b>
          <div class="box-body">
               <div class="col-xs-12">
                 <div class="form-group">
                  {!!Form::label('details', 'Specific Details') !!}
  

    {!!     Form::textarea('m_desc', $messages->m_desc,  ['class' => 'form-control','disabled'=>'disabled','rows'=>2]) !!}

          <div class="form_error"></div>
                 </div>
               </div>
         </div>


              </div>




      

          
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

$("#c_res_date").datepicker({
     
      dateFormat: "yy-mm-dd",
      yearRange: '1940:2017',
      numberOfMonths: 1,
      changeMonth: true,
        changeYear: true
    });


$('#c_res_date').change(function(){
  if(! $(this).val().match('^[0-9]{4}-[0-1][0-9]-[0-3][0-9]$') )
  {
    alert('Invalid Date Format');
    $(this).val(' ');
    $(this).focus();
  }

});

$( document ).ready(function() {
    $('#reply_box').hide();
});

$('#addreply').click(function(){

  $('#reply_box').toggle('show');
})
</script>
@endpush