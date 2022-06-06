<?php

namespace App\Http\Controllers;

use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentsController extends Controller
{

    public function index()
    {

        return view('students.index');
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:5|max:191',
            'email' => 'required|email|max:191',
            'phone' => 'required|max:191',
            'course' => 'required|max:191',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        } else {

            $student = new Students;

            $student->name = $request->input('name');
            $student->email = $request->input('email');
            $student->phone = $request->input('phone');
            $student->course = $request->input('course');
            $student->save();

            return response()->json([
                'status' => 200,
                'message' => 'Students Added Successfully'
            ]);
        }
    }



    public function fetchStudents()
    {
        $students = Students::all();

        return response()->json([
            'students' => $students
        ]);
    }

    public function edit($id)
    {

        $student = Students::find($id);

        if ($student) {
            return response()->json([
                'status' => 200,
                'student' => $student
            ]);
        } else {

            return response()->json([
                'status' => 404,
                'message' => 'Student Not Found'
            ]);
        }
    }


    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:5|max:191',
            'email' => 'required|email|max:191',
            'phone' => 'required|max:191',
            'course' => 'required|max:191',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        } else {

            $student = Students::find($id);

            if ($student) {
                $student->name = $request->input('name');
                $student->email = $request->input('email');
                $student->phone = $request->input('phone');
                $student->course = $request->input('course');
                $student->update();

                return response()->json([
                    'status' => 200,
                    'message' => 'Students Updated Successfully'
                ]);
            } else {

                return response()->json([
                    'status' => 404,
                    'message' => 'Student Not Found'
                ]);
            }
        }
    }


    public function destroy($id)
    {
        $student = Students::find($id);
        $student->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Delete Successful'
        ]);
    }
}