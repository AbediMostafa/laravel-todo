<?php

namespace AbediMostafa\ToDo\http\Controllers;

use AbediMostafa\ToDo\http\Models\Label;
use AbediMostafa\ToDo\http\Requests\AddLabelRequest;
use AbediMostafa\ToDo\http\Resources\LabelAPIResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class LabelController extends Controller
{

    /**
     * Get a listing of the label via API
     * @return AnonymousResourceCollection
     */
    public function apiIndex()
    {
        $labels = Label::select('id', 'label')
            ->with([
                'tasks' => function ($task) {
                    $task->select('id', 'title', 'description', 'status')
                        ->ofAuthenticatedUser();
                }
            ])
            ->orderBy('id')
            ->get();

        return LabelAPIResource::collection($labels);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        return view('todo::labels');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create()
    {
        return view('todo::create-label');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function store(AddLabelRequest $request):array
    {
        return tryCatch(function () use ($request) {
            Label::create($request->all());
        },
            'Problem creating label',
            'Label Created successfully'
        );
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

    /**
     * Get a simple listing of the label (for dropdown)
     *
     * @return mixed
     */
    public function get()
    {
        return Label::select('id', 'label')->get();
    }
}
