<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class StudentController extends Controller
{
    // GET All Students
    public function getAll()
    {
        $student = Student::all();
        $respond = [
            'status' => 200,
            'message' => 'get all student successufully',
            'data' => $student
        ];
        return $respond;
    }

    //Get Student By ID
    public function getById($id)
    {
        $student = Student::find($id);
        if (isset($student)) {
            $respond = [
                "status" => 200,
                "data" => $student
            ];
            return $respond;
        }
        return $respond = [
            "status" => 404,
            "message" => "student not found"
        ];
    }

    // Add a new student
    public function create(Request $request)
    {
        $student = new Student();
        $validation = Validator::make($request->all(), [
            'name' => 'required |string | max:255',
            'email' => 'required |string ',
            'password' => 'required |string ',
            'date_of_birth' => 'required |string ',
            'phone_number' => 'required |string ',
            'class' => 'required |string ',
            'gender' => 'required |string ',
        ]);

        if ($validation->fails()) {
            $respond = [
                "status" => 401,
                "message" => $validation->errors()->first(),
            ];
            return $respond;
        }

        $student->name =  $request->name;
        $student->email =  $request->email;
        $student->password =  $request->password;
        $student->date_of_birth =  $request->date_of_birth;
        $student->phone_number =  $request->phone_number;
        $student->class = $request->class;
        $student->gender =  $request->gender;
        // $student->student_id = $request->student_id;


        $student->save();
        return $respond = [
            'status' => 200,
            'message' => 'New student is added',
            'data' => $student
        ];
    }
    //Updating stud$student Info
    public function update(Request $request, $id)
    {
        $student = Student::find($id);

        if (isset($student)) {
            $validation = Validator::make($request->all(), [
                'name' => 'required |string | max:255',
                'email' => 'required |string ',
                'password' => 'required |string ',
                'date_of_birth' => 'required |string ',
                'phone_number' => 'required |string ',
                'class' => 'required |string ',
                'gender' => 'required |string ',
            ]);

            if ($validation->fails()) {
                $respond = [
                    "status" => 401,
                    "message" => $validation->errors()->first(),
                ];
                return $respond;
            };

            $student->name =  $request->name;
            $student->email =  $request->email;
            $student->password =  $request->password;
            $student->date_of_birth =  $request->date_of_birth;
            $student->phone_number =  $request->phone_number;
            $student->gender =  $request->gender;

            $student->save();



            return $respond = [
                'status' => 200,
                'message' => 'the stud$student updated',
                'data' => $student,
            ];
        }
        return $respond = [
            'status' => 404,
            'message' => 'the student isnt updated',
        ];
    }

    //Delete a Student
    public function delete($id)
    {
        $student = Student::find($id);
        if (isset($student)) {
            $student->delete();
            $respond = [
                'status' => 200,
                'message' => 'student is deleted',

            ];
            return $respond;
        }
        return $respond = [
            'status' => 404,
            'message' => 'the student isnt deleted',
        ];
    }
}
