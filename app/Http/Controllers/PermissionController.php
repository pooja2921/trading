<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionRequest;
use Auth;
use DataTables;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
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
                $permissions= Permission::where('name','like', '%'.$request->name.'%')->select('id','name')->with('roles')->paginate(10); 
            }
            else{
                $permissions= Permission::select('id','name')->with('roles')->paginate(10);
            }
            
            $roles = Role::pluck('name', 'id');
            
             
            return view('permission', compact('roles','permissions'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();

            return redirect()->back()->with('error', $bug);
        }
    }

    public function permissionsearch(Request $request){
       //return $request;
        if($request->get('query')!=''){
             $query = $request->get('query');
                $searchper = Permission::where('name','like', '%'.$query.'%')->select('id','name')->get();
        }
        return response()->json($searchper);
    }

    /**
     * Show Role List with associate permission
     * Server side list view using yajra datatables
     *
     * @param Request $request
     * @return mixed
     */

    public function getPermissionList(Request $request)
    {
        $data = Permission::get();
        $hasManagePermission = Auth::user()->can('manage_permission');

        return Datatables::of($data)
            ->addColumn('roles', function ($data) {
                $roles = $data->roles()->get();
                $badges = '';
                foreach ($roles as $key => $role) {
                    $badges .= '<span class="badge badge-dark m-1">' . $role->name . '</span>';
                }

                return $badges;
            })
            ->addColumn('action', function ($data) use ($hasManagePermission) {
                $output = '';
                if ($hasManagePermission) {
                    $output = '<div class="table-actions">
                                    <a href="' . url('permission/delete/' . $data->id) . '"><i class="ik ik-trash-2 f-16 text-red"></i></a>
                                </div>';
                }

                return $output;
            })
            ->rawColumns(['roles', 'action'])
            ->make(true);
    }

    /**
     * Store new roles with assigned permission
     * Associate permissions will be stored in table
     *
     * @param PermissionRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function create(PermissionRequest $request)
    {
        try {
            $permission = Permission::create(['name' => $request->name]);
            $permission->syncRoles($request->roles);

            if ($permission) {
                return redirect('permission')->with('success', 'Permission created succesfully!');
            }

            return redirect('permission')->with('error', 'Failed to create permission! Try again.');
        } catch (\Exception $e) {
            $bug = $e->getMessage();

            return redirect()->back()->with('error', $bug);
        }
    }

    /**
     * update permission table
     *
     * @param Request $request
     * @return mixed
     */
    public function update(Request $request)
    {
        //
        $permission = Permission::find($request->id);
        $permission->name = $request->name;
        $permission->save();

        return $permission;
    }

    /**
     * delete permission
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        if ($permission = Permission::find($id)) {
            $delete = $permission->delete();
            $perm = $permission->roles()->delete();

           return \Response::json(["status"=>"success", "message"=> 'Permission delete successfully!']);
        }

        return redirect('404');
    }

    /**
     * get permission badges by role
     *
     * @param Request $request
     * @return mixed
     */
    public function getPermissionBadgeByRole(Request $request)
    {
        //return $request;
        $badges = '';
        if ($request->id) {
             $role = Role::find($request->id);
            $permissions = $role->permissions()->pluck('name', 'id');
            foreach ($permissions as $key => $permission) {
                $badges .= '<span class="badge badge-dark m-1">' . $permission . '</span>';
            }
        }

        if ($role->name == 'Super Admin') {
            $badges = ' Super Admin has all the permissions!';
        }

        return $badges;
    }
}
