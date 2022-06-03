@extends('layouts.app')

@section('content')

<!-- Modal -->
<div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
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

@endsection