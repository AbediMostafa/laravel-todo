<?php

namespace AbediMostafa\ToDo\http\Controllers;

use AbediMostafa\ToDo\http\Models\Label;
use AbediMostafa\ToDo\http\Models\Task;
use AbediMostafa\ToDo\http\Requests\AddTaskRequest;
use AbediMostafa\ToDo\http\Requests\UpdateTaskRequest;
use AbediMostafa\ToDo\http\Resources\TaskAPIResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Get a listing of the task
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function apiIndex()
    {
        $tasks = Task::ofAuthenticatedUser()
            ->select('id', 'title', 'description', 'status')
            ->with([
                'labels' => function ($label) {
                    $label->select('id', 'label')
                        ->with([
                            'tasks' => function ($task) {
                                $task->select('id', 'title', 'description', 'status')
                                    ->ofAuthenticatedUser();
                            }
                        ]);
                }
            ])
            ->orderBy('id')
            ->get();

        return TaskAPIResource::collection($tasks);
    }

    /**
     * Change status of the task
     */
    public function changeStatus(Request $request): \Illuminate\Http\JsonResponse
    {
        return tryCatch(function () use ($request){
            Task::findOrFail($request->id)
                ->update([
                    'status' => $request->status
                ]);
        },
            'problem changing status',
            'status changed successfully'
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        return view('todo::tasks');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create()
    {
        return view('todo::create-task');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function store(AddTaskRequest $request):  \Illuminate\Http\JsonResponse
    {
        return tryCatch(function () use ($request) {
            $request->merge(['user_id' => Auth::id()]);
            Task::create($request->all());

        },
            'Problem creating task',
            'Task Created successfully'
        );
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $task = Task::whereId($id)
            ->ofAuthenticatedUser()
            ->select('id', 'title', 'description', 'status')
            ->with([
                'labels' => function ($label) {
                    $label->select('id', 'label');
                }
            ])->firstOrFail();

        return response()->json($task);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit($id)
    {
        return view('todo::edit-task')->withId($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     */
    public function update(UpdateTaskRequest $request, $id)
    {
        return tryCatch(function () use ($request, $id) {
            $task = Task::findOrFail($id);
            $task->title = $request->input('task.title');
            $task->description = $request->input('task.description');
            $task->status = $request->input('task.status');

            $task->isDirty() && $task->save();
            $task->labels()->sync($request->input('labels'));
        },
            'Problem updating task',
            'Task updated successfully'
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
