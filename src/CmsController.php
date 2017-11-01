<?php

namespace CameronWiley\Cms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use function json_encode;

class CmsController extends Controller
{
    private $cms;

    public function __construct(Cms $cms)
    {
        $this->cms = $cms;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu = $this->cms->all();
        return view('cms::home', compact('menu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input  = $request->input();
        $array  = [];
        $title  = $input['title'];
        $data   = $input['data'];
        $config = $input['config'];
        foreach ($data as $value) {
            array_set($array, $value['name'], $this->formatLine($value['value']));
        }

        // Add config data
        if (!empty($config)) {
            $array  = array_merge(['config' => $config], $array);
        }
        $json   = json_encode($array);
        $status = $this->cms->set($title, $json);

        return response()->json([
            'message' => 'json updated',
            'ok'      => $status
        ]);
    }

    private function formatLine($line)
    {
        $line = preg_replace("/\r\n|\r|\n/", '<br/>', $line);

        return $line;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json($this->cms->get($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu  = $this->cms->all();
        $title = $id;
        $data  = $this->cms->get($id);
        $edit  = true;
        return view('cms::page', compact('data', 'title', 'edit', 'menu'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
