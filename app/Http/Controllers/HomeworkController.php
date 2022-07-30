<?php

namespace App\Http\Controllers;

use App\Models\Homework;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class HomeworkController extends Controller
{


    // GET All Homeworks
    public function getAll()
    {
        $homework = Homework::all();
        $respond = [
            'status' => 200,
            'message' => 'get all homework successufully',
            'data' => $homework
        ];
        return $respond;
    }

    //Get Homework By ID
    public function getById($id)
    {
        $homework = Homework::find($id);
        if (isset($homework)) {
            $respond = [
                "status" => 200,
                "data" => $homework
            ];
            return $respond;
        }
        return $respond = [
            "status" => 404,
            "message" => "homework not found"
        ];
    }


    // Add a new homework
    public function create(Request $request)
    {
        $homework = new Homework();
        $validation = Validator::make($request->all(), [
            'teacher_id' => 'required | integer',
            'title' => 'required |string ',
            'content' => 'required |string ',

        ]);

        if ($validation->fails()) {
            $respond = [
                "status" => 401,
                "message" => $validation->errors()->first(),
            ];
            return $respond;
        }

        $homework->title =  $request->title;
        $homework->content =  $request->content;
        $homework->teacher_id =  $request->teacher_id;



        $homework->save();
        return $respond = [
            'status' => 200,
            'message' => 'New homework is added',
            'data' => $homework
        ];
    }
}
