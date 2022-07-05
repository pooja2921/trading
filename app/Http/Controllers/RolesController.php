<?php

namespace App\Http\Controllers;

use Auth;
use DataTables;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    /**
     * Show Role List
     *
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        try {
            if($request->name!=''){
                $roles= Role::where('name','like', '%'.$request->name.'%')->select('id','name')->with('permissions')->paginate(10); 
            }
            else{

                $roles= Role::select('id','name')->with('permissions')->paginate(10);

            }
                
            $permissions = Permission::pluck('name', 'id');

            return view('roles', compact('permissions','roles'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();

            return redirect()->back()->with('error', $bug);
        }
    }

    public function rolesearch(Request $request){
       //return $request;
        if($request->get('query')!=''){
             $query = $request->get('query');
                $searchcategory = Role::where('name','like', '%'.$query.'%')->select('id','name')->get();
        }
        return response()->json($searchcategory);
    }

    /**
     * Show the role list with associate permissions.
     * Server side list view using yajra datatables
     *
     * @param Request $request
     * @return mixed
     */
    public function getRoleList(Request $request)
    {
        $data = Role::get();
        $hasManageRoles = Auth::user()->can('manage_roles');

        return Datatables::of($data)
            ->addColumn('permissions', function ($data) {
                if ($data->name == 'Super Admin') {
                    return '<span class="badge badge-success m-1">All permissions</span>';
                }
                $badges = '';
                $roles = $data->permissions()->get();
                foreach ($roles as $key => $role) {
                    $badges .= '<span class="badge badge-dark m-1">' . $role->name . '</span>';
                }

                return $badges;
            })
            ->addColumn('action', function ($data) use ($hasManageRoles) {
                $output = '';
                if ($hasManageRoles && $data->name != 'Super Admin') {
                    $output = '<div class="table-actions">
                                    <a href="javascript:;"  class="editroleid"  data-id="'. $data->id .'" data-url="' . url('role/edit/' . $data->id) . '"><i class="ik ik-edit-2 f-16 mr-15 text-green"></i></a>
                                    <a href="' . url('role/delete/' . $data->id) . '"  ><i class="ik ik-trash-2 f-16 text-red"></i></a>
                                </div>';
                }

                return $output;
            })
            ->rawColumns(['permissions', 'action'])
            ->make(true);
    }

    /**
     * Store new roles with assigned permission
     * Associate permissions will be stored in table
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function create(Request $request)
    {
        try {
            $role = Role::create(['name' => $request->name]);
            $role->syncPermissions($request->permissions);

            if ($role) {
                return redirect('roles')->with('success', 'Role created succesfully!');
            }

            return redirect('roles')->with('error', 'Failed to create role! Try again.');
        } catch (\Exception $e) {
            $bug = $e->getMessage();

            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Edit Role
     *
     * @param int $id
     * @return mixed
     */
    public function edit($id)
    {
        $role = Role::where('id', $id)->first();

        if ($role) {
            $role_permission = $role->permissions()->pluck('id')->toArray();

            $permissions = Permission::pluck('name', 'id');

            return \Response::json(['status'=>"success", 'message'=>'role edit successfully.', 'role'=>$role,'role_permission'=>$role_permission,'permissions'=>$permissions]);
            //return view('edit-roles', compact('role', 'role_permission', 'permissions'));
        }

        return redirect('404');
    }

    /**
     * update role
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', $validator->messages()->first());
        }

        try {
            $role = Role::find($request->id);

            $update = $role->update([
                'name' => $request->name,
            ]);

            // Sync role permissions
            $role->syncPermissions($request->permissions);

            return redirect('roles')->with('success', 'Role info updated succesfully!');
        } catch (\Exception $e) {
            $bug = $e->getMessage();

            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * Edit Role
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        if ($role = Role::find($id)) {
            $delete = $role->delete();
            $perm = $role->permissions()->delete();
            
            return \Response::json(['status'=>'success', 'message'=>'Role deleted!']);
            
        }

        return redirect('404');
    }
}
