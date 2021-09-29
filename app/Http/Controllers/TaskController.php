<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TaskService;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\TaskRequest;
use App\Http\Requests\UpdateRequest;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    protected $taskservice;
    protected $userservice;
    public function __construct(TaskService $taskservice, UserService $userservice)
    {
        $this->taskservice = $taskservice;
        $this->userservice = $userservice;
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
            return response(['message' => 'no tasks found!'], 404);
        }
        return response()->json([$task]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request)
    {

        $validator = $request->all();

        if(!$validator) {
            return response([
                'Message' => 'Request could not be completed',
                'Error' => $validator->errors()
            ]);
        }

        $response = $this->taskservice->store([
            'userId' => Auth::id(),
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'category' => $request->get('category'),
            'completed' => $request->get('completed')
        ]);

    //    $response = $this->taskservice->store($request->all());

       if(!$response) {
           return response([
               'Message' => 'Task not created!',
               'status' => 'error'
           ],500);
       }
       return response([
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
    public function update(TaskRequest $request, $id)
    {
        $data = $request->all();

        //to get a particular task
        $task = $this->taskservice->show($id);

        //to check permission to update task
        if($task['userId'] == Auth::id()) {
            $response = $this->taskservice->update($data, $id);
             return response([
            'Message' => 'Task Updated!',
            'data' => $response
        ], 200);
        }
        return response([
            'Message' => 'Permission denied! Task does not belong to you!'
        ]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = $this->taskservice->show($id);

        //to check permission to update task
        if($task['userId'] == Auth::id()) {
        $response = $this->taskservice->destroy($id);
         return response([
                'status' => 'success',
                'Message' => 'Task Deleted successfully!'
            ], 200);
        }
        return response([
            'status' => 'failed!',
            'Message' => 'Permission denied!, Not your Task!'
        ]);

    }
}
