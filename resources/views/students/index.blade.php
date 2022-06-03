@extends('layouts.app')

@section('content')

{{-- Addstudentmodal --}}
<div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <ul id="save_errorlist" ></ul>   
     <form action="" class="form-group mb-3">
         <label for="">Name</label>
         <input type="text" name="name" class="name form-control">

         <label for="">Email</label>
         <input type="text" name="email" class="email form-control">

         <label for="">Phone</label>
         <input type="text" name="phone" class="phone form-control">

         <label for="">Course</label>
         <input type="text" name="course" class="course form-control">
     </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary add_student">Save</button>
      </div>
    </div>
  </div>
</div>

<div class="container py-5">
    <div class="row">
        <div class="col-md-12">

              <div id="success_msg"></div>
            <div class="card">
              
                <div class="card-header">
                    <h4>Students Data</h4>
                    <a href="http://" data-bs-toggle="modal" data-bs-target="#addStudentModal" class="btn btn-primary float-end btn-sm"> Add Student</a>
                </div>
                <div class="card-body">
                    
                </div>
            </div>
        </div>
    </div>
</div>
{{-- End Addstudentmodal --}}

@endsection

@section('scripts')
<script>


   
    $(document).ready(function () {

// showAlerts('info', 'error on the toastr');
         function showAlerts(type, msg){
    var msg = msg;
   
        switch(type){
            case 'info':
               toastr.info(msg);
                break;
            case 'success':
                toastr.success(msg);
                break;
            case 'warning':
                toastr.warning(msg);
                break;
             case 'error':
                toastr.error(msg);
                break;
        }
    }

  



        $(document).on('click','.add_student', function (e) {
            event.preventDefault();
           //get input values

           var data = {
               'name': $('.name').val(),
               'email': $('.email').val(),
               'phone': $('.phone').val(),
               'course': $('.course').val(),
           }

        //    console.log(data);

        $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

        $.ajax({
            type: "POST",
            url: "/students",
            data: data,
            dataType: "json",
            beforeSend: function (response){
                console.log('loading....')
            },
            success: function (response) {
                console.log(response);

                if(response.status == 400){
                    $('#save_errorlist').html("");
                    $('#save_errorlist').addClass('alert alert-danger');
                    $.each(response.errors, function (key, err_value) { 
                         $('#save_errorlist').append(`<li class='text-danger'>${err_value}</li>`);
                         showAlerts('error', err_value);
                    });
                }else{
                    $('#success_msg').html(""); 
                    $('#success_msg').addClass('alert alert-success');
                    $('#success_msg').text(response.message);
                    // $('#addStudentModal').modal('hide');
                     showAlerts('success', response.message);
                    $('.btn-close').click();
                    setTimeout(() => {
                        $('.modal-backdrop').hide();
                        
                    }, 3000);
                    $('#addStudentModal').find('input').val("");
                }
            }
        });
        });
    });
</script>

@endsection