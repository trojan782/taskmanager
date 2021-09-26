<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TaskService;

class TaskController extends Controller
{
    protected $taskservice;

    public function __construct(TaskService $taskservice)
    {
        $this->taskservice = $taskservice;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        $task = $this->taskservice->all();
        if(count($task) <= 0) {
            return response()->json(['message' => 'no tasks found!'], 404);
        }
        return response()->json($task);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make([
            'title' => 'required|min:1|string',
            'description' => 'required|string',
            'category' => 'required|string',
            'completed' => 'boolean|required'
        ]);
        if($validator->fails()) {
            return response()->json([
                'Message' => 'Request cound not be completed',
                'Error' => $validator->errors()
            ]);
        }
       $response = $this->taskservice->store($request->all());
       if(!$response) {
           return response()->json([
               'Message' => 'Task not created!',
               'status' => 'error'
           ],500);
       }
       return response()->json([
           'Message' => 'Task Created successfully!',
           'status' => 'success',
           'data' => $response
       ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = $this->taskservice->show($id);
        return response()->json($task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        return response()->json($this->taskservice->update($data, $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return response()->json($this->taskservice->destroy($id));
    }
}
