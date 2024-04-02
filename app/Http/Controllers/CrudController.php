<?php

namespace App\Http\Controllers;

use App\Models\Crud;
use App\Models\User;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Validation\ValidatesRequests;



class CrudController extends Controller
{


    public function index(Request $request)
    {
        $getGroupMaster = Crud::orderBy('id')->get();

        foreach ($getGroupMaster as $key => $record) {
            $id = $record->id;
            $action = '<button type="button" class="btn btn-primary btn-sm me-1" onclick="editGroupMaster(' . $id . ')" title="Edit"><i class="fa fa-pencil"></i></button>';
            $action .= '<button type="button" class="btn btn-danger btn-sm" onclick="daletetabledata(' . $id . ')" title="Delete"><i class="fa fa-trash"></i></button>';
            $getGroupMaster[$key]['action'] =  $action;
        }
        return DataTables::of($getGroupMaster)
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
    }

    use ValidatesRequests;
    public function insert(Request $request)
    {
        if ($request->crud_id == '') {
            $rules = [
                'name' => 'required',
                'profile_pic' => 'required',
                'hobby' => 'required',
                'gender' => 'required',
                'number' => 'required',
                'email' => 'required',
                'address' => 'required',
            ];
        } else {
            $rules = [
                'name' => 'required',
                // 'profile_pic' => 'required',
                'hobby' => 'required',
                'gender' => 'required',
                'number' => 'required',
                'email' => 'required',
                'address' => 'required',
            ];
        }
        $this->validate($request, $rules);


        if ($request->crud_id != '') {
            $groupMaster = Crud::find($request->crud_id);

            if (!$groupMaster) {
                return response()->json(['status' => 400, 'msg' => 'Group Master details not found!']);
            }
            // $groupMaster->updated_at = Auth::user()->id;
        } else {
            $groupMaster = new Crud();

            // $groupMaster->created_at = Auth::user()->id;
        }
        if ($request->profile_pic !== '' && $request->profile_pic !== 'null') {
            if ($request->hasFile('profile_pic')) {
                // Get the file from the request
                $profilePic = $request->file('profile_pic');

                // Generate a unique file name
                $fileName = time() . '.' . $profilePic->getClientOriginalExtension();

                // Move the file to the storage location (e.g., public/uploads)
                $profilePic->move(public_path('uploads'), $fileName);

                $groupMaster->profile_pic = $fileName;
            }
        } else {
            if ($request->profile_pic_preview) {
                $groupMaster->profile_pic = $request->profile_pic_preview;
            }
        }


        $groupMaster->name = $request->input('name');
        $groupMaster->gender = $request->input('gender');
        $groupMaster->number = $request->input('number');
        $groupMaster->email = $request->input('email');
        $groupMaster->address = $request->input('address');
        $groupMaster->address = $request->input('address');
        $hobby = $request->input('hobby');
        if (isset($hobby) && sizeof($hobby)) {
            $groupMaster->hobby = implode(",", $hobby);
        }
        $groupMaster->save();

        return response()->json(['status' => '200', 'msg' => 'success']);
    }


    public function get_crud($id)
    {
        $getGroupMaster = Crud::where('id', '=', $id)->first();
        if ($getGroupMaster) {
            return response()->json(['status' => '200', 'msg' => 'success', 'data' => $getGroupMaster]);
        }
        return response()->json(['status' => '200', 'msg' => 'success'], 400);
    }


    public function delete(Request $request)
    {
        $id =  $request->input('id');
        $getGroupMaster = Crud::find($id);
        $getGroupMaster->delete();

        return response()->json(['status' => '200', 'msg' => 'success']);
    }
}
