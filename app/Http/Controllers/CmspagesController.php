<?php

namespace App\Http\Controllers;

use App\Models\Cmspages;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Cviebrock\EloquentSluggable\Services\SlugService;


class CmspagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)


    {
        if ($request->ajax()) {
            $data = Cmspages::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $btn = ' <a href="/cmspages/' . $data->id . '/edit"  class="btn btn-primary btn-md "><i class="fas fa-pen text-white"></i></a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $data->id . '" data-original-title="Delete" class="btn btn-danger btn-md deletePage"><i class="far fa-trash-alt text-white" data-feather="delete"></i></a>';

                    return $btn;
                })
                // ->editColumn('image', function ($row) {
                //     return $row->image;
                // })
                ->rawColumns(['action'])->make(true);
        }

        $cmspages = Cmspages::latest()->paginate(5);

        return view('cmspages.index', compact('cmspages'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cmspages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $insert = [
            'slug' => SlugService::createSlug(Cmspages::class, 'slug', $request->title),
            'title' => $request->title,
            'content' => $request->content,
        ];

        Cmspages::insertGetId($insert);

        return redirect()->route('cmspages.index')
            ->with('success', 'Page created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return view('cmspages.show', compact('cmspages'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cmspage = Cmspages::find($id);
        $cmspages = Cmspages::latest()->paginate(5);
        return view('cmspages.index', compact('cmspage', 'cmspages'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cmspages $cmspages)
    {
        $request->validate([
            'title' => 'required',
            'slug' => 'required',
            'content' => 'required',
        ]);

        $cmspages->update($request->all());

        return redirect()->route('cmspages.index')
            ->with('success', 'Page updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cmspages $cmspage)
    {
        $cmspage->delete();

        return redirect()->route('cmspages.index')
            ->with('success', 'page deleted successfully');
    }
}
