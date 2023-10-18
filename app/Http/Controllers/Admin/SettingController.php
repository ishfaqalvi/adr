<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Field;
use App\Models\FieldGroup;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Image;


class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        // $this->middleware('permission:tool-list',  ['only' => ['index']]);
        // $this->middleware('permission:tool-create',['only' => ['create','save']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): View
    {
        $groups = FieldGroup::with('fields')->get();
        return view('admin.settings.index', compact('groups'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function clearCache(): RedirectResponse
    {
        Artisan::call('optimize');
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        return redirect()->back()->with('success', 'Optimization completed! successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request): RedirectResponse
    {
        $data = array();
        if ($request->values) {
            foreach ($_POST['values'] as $key => $value) {
                $data[] = array(
                    'key'   => $key,
                    'value' => $value
                );
            }
        }
        foreach ($request->file() as $key => $file) {
            if ($image = $request->file($key)) {
                $filenamewithextension = $image->getClientOriginalName();
                $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
                $filenametostore = 'upload/images/settings/' . $filename . '_' . time() . '.webp';
                // $img = Image::make($image)->encode('webp', 90)->resize(100 , 200)->save(public_path($filenametostore));
                $img = Image::make($image)->encode('webp', 90)->save(public_path($filenametostore));
            }
            $data[] = array(
                'key'    => $key,
                'value'  => $filenametostore
            );
        }
        Setting::set($data);
        return redirect()->back()->with('success', 'Setting updated successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createField(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'field_group_id' => 'required',
        ]);

        Field::create($request->all());
        return redirect()->route('settings.index')->with('success', 'Field created successfully');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroyField($id): JsonResponse
    {
        Field::find($id)->delete();
        return response()->json([
            'success' => true,
            'message' => "Field deleted successfully.",
        ]);
    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createGroup(Request $request): JsonResponse
    {
        $request->validate([
            'title' => 'required',
        ]);

        FieldGroup::create($request->all());
        return response()->json([
            'success' => true,
            'message' => "Group created successfully.",
        ]);
    }

}
