<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{
    //getall teachers
    public function getAll()
    {
        $teacher = Teacher::all();
        $respond = [
            'status' => 200,
            'message' => 'get all teachers successufully',
            'data' => $teacher
        ];
        return $respond;
    }

    //Get Teacher by id
    public function getById($id)
    {
        $teacher = Teacher::find($id);
        if (isset($teacher)) {
            $respond = [
                "status" => 200,
                "data" => $teacher
            ];
            return $respond;
        }
        return $respond = [
            "status" => 404,
            "message" => "teach$teacher not found"
        ];
    }

    // Create A New Teacher
    public function create(Request $request)
    {
        $teacher = new Teacher();
        $validation = Validator::make($request->all(), [
            'name' => 'required |string | max:255',
            'email' => 'required |string ',
            'password' => 'required |string ',
            'date_of_birth' => 'required |string ',
            'phone_number' => 'required |string ',
            'gender' => 'required |string ',
        ]);

        if ($validation->fails()) {
            $respond = [
                "status" => 401,
                "message" => $validation->errors()->first(),
            ];
            return $respond;
        }

        $teacher->name =  $request->name;
        $teacher->email =  $request->email;
        $teacher->password =  $request->password;
        $teacher->date_of_birth =  $request->date_of_birth;
        $teacher->phone_number =  $request->phone_number;
        $teacher->gender =  $request->gender;


        $teacher->save();
        return $respond = [
            'status' => 200,
            'message' => 'New teacher is added',
            'data' => $teacher
        ];
    }

    public function update(Request $request, $id)
    {
        $teacher = Teacher::find($id);

        if (isset($teacher)) {
            $validation = Validator::make($request->all(), [
                'name' => 'required |string | max:255',
                'email' => 'required |string ',
                'password' => 'required |string ',
                'date_of_birth' => 'required |string ',
                'phone_number' => 'required |string ',
                'gender' => 'required |string ',
            ]);

            if ($validation->fails()) {
                $respond = [
                    "status" => 401,
                    "message" => $validation->errors()->first(),
                ];
                return $respond;
            };

            $teacher->name =  $request->name;
            $teacher->email =  $request->email;
            $teacher->password =  $request->password;
            $teacher->date_of_birth =  $request->date_of_birth;
            $teacher->phone_number =  $request->phone_number;
            $teacher->gender =  $request->gender;

            $teacher->save();



            return $respond = [
                'status' => 200,
                'message' => 'the teacher updated',
                'data' => $teacher,
            ];
        }
        return $respond = [
            'status' => 404,
            'message' => 'the teacher isnt updated',
        ];
    }

    //Delete a Teacher
    public function delete($id)
    {
        $teacher = Teacher::find($id);
        if (isset($teacher)) {
            $teacher->delete();
            $respond = [
                'status' => 200,
                'message' => 'teacher is deleted',

            ];
            return $respond;
        }
        return $respond = [
            'status' => 404,
            'message' => 'the teacher isnt deleted',
        ];
    }
}
