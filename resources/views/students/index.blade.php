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
{{-- End Adstudentmodal --}}

{{-- edit/update studentsmodal --}}

<div class="modal fade" id="editStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit & Update Student</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <ul id="update_errorlist" ></ul>   
     <form action="" class="form-group mb-3">
         <input type="hidden" id="edit_student_id">
         <br>
         <label for="">Name</label>
         <input type="text" name="name" id="edit_name" class="name form-control">

         <label for="">Email</label>
         <input type="text" name="email" id="edit_email"  class="email form-control">

         <label for="">Phone</label>
         <input type="text" name="phone" id="edit_phone"  class="phone form-control">

         <label for="">Course</label>
         <input type="text" name="course" id="edit_course"  class="course form-control">
     </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary update_student">Update</button>
      </div>
    </div>
  </div>
</div>

{{-- end edit/update students modal --}}

{{-- Delete student modal --}}

<div class="modal fade" id="deleteStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">DeleteStudent</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <ul id="update_errorlist" ></ul>   
     <form action="" class="form-group mb-3">
         <input type="hidden" id="delete_student_id">
         
         <h4>Are you sure you want to delete?</h4>
     </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary delete_student_btn">Yes, Delete</button>
      </div>
    </div>
  </div>
</div>

{{-- end Delete student modal --}}
<div class="container py-5">
    <div class="row">
        <div class="col-md-12">

              <div id="success_msg"></div>
            <div class="card">
              
                <div class="card-header">
                    <h4>Students Data</h4>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#addStudentModal" class="btn btn-primary float-end btn-sm"> Add Student</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-stripped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Course</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>


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


   

//ajax fetch students
 fetchStudents();
function fetchStudents(){
$.ajax({
    type: "GET",
    url: "/fetch-students",
    dataType: "json",
    success: function (response) {
        //console.log(response.students)
        $('tbody').html("");
        $.each(response.students, function (key, item) {
            
            $('tbody').append(
                ` <tr>
                                <td>${item.id}</td>
                                <td>${item.name}</td>
                                <td>${item.email}</td>
                                <td>${item.phone}</td>
                                <td>${item.course}</td>
                                <td>
                                    <button type="button" value="${item.id}" class="edit_student btn btn-primary btn-sm">edit</button>
                                </td>
                                <td>
                                    <button type="button" value="${item.id}" class="delete_student btn btn-danger btn-sm">delete</button>
                                </td>
                            </tr>`
            )
             
        });
    }
});

}

//Delete feature ajax

$(document).on('click', '.delete_student', function () {
    
    var stud_id = $(this).val();
    $('#delete_student_id').val(stud_id);
    $('#deleteStudentModal').modal('show');
});

$(document).on('click', '.delete_student_btn', function (e) {
    e.preventDefault();

    var stud_id = $('#delete_student_id').val();

      $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

    $.ajax({
        type: "DELETE",
        url: "/delete-student/"+stud_id,
        success: function (response) {
           // console.log(response);
           $('#success_msg').addClass('alert alert-success');
                    $('#success_msg').text(response.message);
                    // $('#deleteStudentModal').modal('hide');
                     showAlerts('success', response.message);
                     
                      $('.btn-close').click();
                      fetchStudents();
        }
    });
});
  
//Edit form view with ajax
$(document).on('click', '.edit_student', function (event) {
    event.preventDefault();
    var student_id = $(this).val();
    $('#editStudentModal').modal('show');

    $.ajax({
        type: "GET",
        url: "/edit-student/"+student_id,
        success: function (response) {
            //console.log(response)
            if(response.status == 404){
                $('#success_message').html("");
                $('#success_message').addClass("alert alert-danger");
                showAlerts('error', response.message)
            }else{

                $('#edit_student_id').val(student_id );
                $('#edit_name').val(response.student.name);
                $('#edit_email').val(response.student.email);
                $('#edit_phone').val(response.student.phone);
                $('#edit_course').val(response.student.course);
            }
        }
    });
});

//Update with edit form ajax

$(document).on('click', '.update_student', function (e) {
    e.preventDefault();

    var stud_id = $('#edit_student_id').val();

    // $(this).text('Updating...')

    var data = {
        name: $('#edit_name').val(),
        email: $('#edit_email').val(),
        phone: $('#edit_phone').val(),
        course: $('#edit_course').val(),
    }

      $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

    $.ajax({
        type: "PUT",
        url: "/update-student/"+stud_id,
        data: data,
        dataType: "json",
        beforeSend: function(response){
           $('.update_student').text('Updating...'); 
        },
        success: function (response) {
            //console.log(response);
            if(response.status == 400){

                //errors
                 $('#update_errorlist').html("");
                    $('#update_errorlist').addClass('alert alert-danger');
                    $.each(response.errors, function (key, err_value) { 
                         $('#update_errorlist').append(`<li class='text-danger'>${err_value}</li>`);
                         showAlerts('error', err_value);
                    });
                     $('.update_student').text('Update'); 
            }else if(response.status == 400){
                 $('#update_errorlist').html(""); 
                    $('#success_msg').addClass('alert alert-error');
                    $('#success_msg').text(response.message);
                    // $('#addStudentModal').modal('hide');
                     showAlerts('success', response.message);
                      $('.update_student').text('Update'); 
            }else{
 $('#update_errorlist').html("");
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
                     $('.update_student').text('Update'); 
                    //fetch all students
                     fetchStudents();

            }
        }
    });

});

//Insert data with ajax
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
                    //fetch all students
                     fetchStudents();
                }
            }
        });
        });
    });
</script>

@endsection