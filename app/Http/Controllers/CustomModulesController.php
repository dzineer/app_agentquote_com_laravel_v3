<?php

namespace App\Http\Controllers;

use Chumper\Zipper\Facades\Zipper;
use Dzineer\CustomModules\Facades\CustomModules;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use ZipArchive;

/**
 * Class CustomModulesController
 *
 * @package App\Http\Controllers
 */
class CustomModulesController extends Controller
{
    /**
     * CustomModulesController constructor.
     */
    public function __construct()
	{
	}

	public function add(Request $request) {
        return view('custom_modules::custom_modules.admin/add-module', []);
    }

    public function add_module(Request $request) {
        $fileField = 'file';

        $data = $request->validate([
            $fileField => 'required|file|mimes:zip|max:2048'
        ]);

        // save logo to store/public/landing-pages/logos and filename to profile
        if ($request->hasFile($fileField)) {

            $ext = $request->file($fileField)->guessExtension();

            if ($ext == "zip") {
                $md5Name = md5_file($request->file($fileField)->getRealPath());
                $f = $request->file($fileField)->getClientOriginalName();
                $path = $request->file($fileField)->storeAs('modules/deploy', $f  ,'public');

                $whereToGo = str_replace(".zip", "", $path );

                $zip = new ZipArchive;
                $archiveFile = public_path($path);
                $archiveFile = $request->file($fileField)->getClientOriginalName();
                $newPath = public_path('modules/deploy');
                chdir($newPath);

                $res = $zip->open( $archiveFile );

                if( $res === TRUE ) {

                    $newPath = public_path($whereToGo);
                    $zip->extractTo( $newPath );
                    $zip->close();

                    return response()->json([
                        "archiveFile" => $archiveFile,
                        "extractTo" => $newPath,
                        "public_path" => $newPath,
                        "path3" => $f,
                        "path2" => $path,
                        "path" => str_replace(".zip", "", $path ),
                        "data" => $request->file($fileField)->getClientOriginalName()
                    ]);

                } else {

                    $ErrMsg = '';

                    switch($res){
                        case ZipArchive::ER_EXISTS:
                            $ErrMsg = "File already exists.";
                            break;

                        case ZipArchive::ER_INCONS:
                            $ErrMsg = "Zip archive inconsistent.";
                            break;

                        case ZipArchive::ER_MEMORY:
                            $ErrMsg = "Malloc failure.";
                            break;

                        case ZipArchive::ER_NOENT:
                            $ErrMsg = "No such file.";
                            break;

                        case ZipArchive::ER_NOZIP:
                            $ErrMsg = "Not a zip archive.";
                            break;

                        case ZipArchive::ER_OPEN:
                            $ErrMsg = "Can't open file.";
                            break;

                        case ZipArchive::ER_READ:
                            $ErrMsg = "Read error.";
                            break;

                        case ZipArchive::ER_SEEK:
                            $ErrMsg = "Seek error.";
                            break;

                        default:
                            $ErrMsg = "Unknow (Code $res)";
                            break;


                    }
                    // die( 'ZipArchive Error: ' . $ErrMsg);

                    return response()->json([
                        "archiveFile" => $archiveFile,
                        "extractTo" => $newPath,
                        "status" => $ErrMsg,
                        "path3" => $f,
                        "path2" => $path,
                        "path" => str_replace(".zip", "", $path ),
                        "data" => $request->file($fileField)->getClientOriginalName()
                    ]);
                }

            }

            // $Path = public_path($Path = public_path('modules/deploy/test.zip'));

/*            return response()->download(public_path(
                $Path = public_path('test.zip')
            ));*/

        }

        return response()->json([
            "answer" => $request->all()
        ]);

    }

    /**
     * @param $array
     * @param $key
     * @param $value
     *
     * @return bool
     */
    private function in_array_key_value($array, $key, $value)
    {
        // dd([$array, $key, $value]);

        foreach($array as $item) {
            if (key_exists($key, $item) &&  $item[$key] === $value) {
                return $item;
            }
        }
        return null;
    }

	/**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)
    {
        // dd($request->all());
        // dd(http_build_query($request->except("action")));

        if ($request->has('module') ) {

            if ($request->has('action') && $request->input('action') === 'add' ) {
                $customModuleAdmin = CustomModules::toggleModule($request->input('module'), Auth::user()->id);
                // dd(http_build_query($request->except("action")));
                return redirect()->to(url()->current().'?'.http_build_query($request->except("action")));
            } else {
                return $this->moduleSettings($request->input('module'));
            }

        }

        $modules = CustomModules::getAllModules();
        $admin_modules = CustomModules::getModules(Auth::user()->id)->toArray();
        // dd([$modules, $user_modules]);

        $new_modules = [];

        // does user have module ?
        foreach( $modules as $module ) {
            $mod['id'] = $module['id'];
            $mod['name'] = $module['name'];
            $mod['module_name'] = $module['module_name'];
            $mod['module_image'] = $module['module_image'];
            $mod['module_display_image'] = $module['module_display_image'];
            $mod['description'] = $module['description'];
            $mod['module_type_id'] = $module['module_type_id'];
            $mod['featured'] = $module['featured'];
            $mod['status'] = $module['status'];

            $mod['module_type'] = $module->module_type->toArray();

            $customModule = $this->in_array_key_value( $admin_modules, 'custom_module_id', $module['id'] );

            if ( $customModule ) {
                $mod['in'] = true;
                $mod['custom_module_id'] = $customModule['id'];
            } else {
                $mod['in'] = false;
            }
            $new_modules[] = $mod;
            unset($mod);
        }

       // dd($new_modules);

        return view('custom_modules::custom_modules.admin.index', ['modules' => $new_modules] );
    }

    /**
     * @param $moduleName
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    private function moduleSettings( $moduleName ) {
        // dnd($moduleName);
        $data = [];
/*        $data['config'] = [];
        $data['config']['remote_site'] = 'httsp://www.agentquoter.com/session?id=2';
        $data['config']['monitored'] = true;
        $data['parameters'] = [];
        $data['parameters']['member_id'] = '';
        $config_data = json_encode($data);
        $module = CustomModules::updateModule( $moduleName, $config_data );*/
        $customModule = CustomModules::getAdminModule( $moduleName, Auth::user()->id );

        // dd($customModule);

        // trigger custom module's onEdit method
        // if result is null then the module is not supporting that method and we will use the default view
        $result =  CustomModules::editAdminModuleData($customModule['id'], Auth::user()->id);
        if ($result) {
            return $result;
        } else {
            return view('custom_modules::custom_modules.admin.settings', compact('customModule') );
        }
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
        // dd($id);
/*
        $data = request()->validate([
            'id' => 'number'
        ]);*/

        $userModule = CustomModules::getAdminModuleById( $id, Auth::user()->id );

        if (!$userModule) {
            return response()->json([
                "error" => "Module does not exist!"
            ], 404);
        }

        $params = json_decode( $userModule['data'], true );

        foreach( $params  as $key => $val ) {
            if ( isset( $params[$key] ) && $request->has($key)) {
                $params[ $key ] = $request->input( $key );
            }
        }

        $userModule->data = json_encode( $params );

        $userModule->save();

        // dd($userModule);

        return back();

    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request, $id)
    {
        $customModule = CustomModules::getAdminModuleById( $id, Auth::user()->id );

        $moduleId = $customModule->module->id;

        if ( !! $customModule ) {

            CustomModules::removeAdminModule($customModule->id,  Auth::user()->id);
            $res = CustomModules::removeAllUserModulesByCustomModuleId( $moduleId, Auth::user()->id  );
            $customModule->delete();

        } else {
            return response()->json([
               "error" => "Invalid request"
            ]);
        }

        return redirect()->route('custom.modules.index');
    }

}
