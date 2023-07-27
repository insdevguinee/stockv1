<?php
 
namespace App\Http\Controllers;
 
use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use Session;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::all();
        return view('permissions.index',compact('permissions'));
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get(); //Get all roles
        return view('permissions.create',compact('roles'));
    }
 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=>'required|max:40',
        ]);
        $permission = new Permission();
        $permission->name = $request->name;
        $permission->save();
        if ($request->roles <> '') { 
            foreach ($request->roles as $key=>$value) {
                $role = Role::find($value); 
                $role->permissions()->attach($permission);
            }
        }
        Session::flash('success','Permission <strong>'.$permission->name.'</strong> créée');
        return redirect()->back();
    }
 
    /**
     * Display the specified resource.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
 
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        
        return view('permissions.edit', compact('permission'));
    }
 
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $this->validate($request, [
            'name'=>'required',
        ]);
        $permission = Permission::findOrFail($id);
        $permission->name=$request->name;
        $permission->save();
        Session::flash('success','Permission modifée !');
        return redirect()->route('permissions.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();
        Session::flash('success','Permission supprimée !');

        return redirect()->route('permissions.index');
    }
}