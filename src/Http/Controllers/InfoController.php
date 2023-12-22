<?php

namespace Fahim\InfoPackage\Http\Controllers;

use App\Http\Controllers\Controller;
use Fahim\InfoPackage\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InfoController extends Controller
{


    public function index()
    {
        $infolists = UserInfo::orderBy('created_at', 'desc')->paginate(10);
        return view('info::template.info-add', compact('infolists'));
    }

    public function store(Request $data)
    {

        $validator = Validator::make($data->all(), [
            'name' => ['required', 'string', 'min:3', 'max:200'],
            'age' => ['required', 'numeric'],
            'address' => ['required', 'string', 'max:500'],
        ]);
        if ($validator->fails()) {
            return back()->with('error', $validator->errors());
        }

        UserInfo::create([
            'name' => $data->name,
            'age' => $data->age,
            'address' => $data->address
        ]);
        return back()->with('success', 'Successfully Saved.');
    }

    public function getUserInfo($id)
    {
        $userInfo = UserInfo::find($id);
        return response()->json($userInfo);
    }

    public function updateUserInfo(Request $request)
    {
        $userInfo = UserInfo::find($request->input('id'));
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'min:3', 'max:200'],
            'age' => ['required', 'numeric'],
            'address' => ['required', 'string', 'max:500'],
        ]);
        if ($validator->fails()) {
            return back()->with('error', $validator->errors());
        }

        $userInfo->name = $request->input('name');
        $userInfo->age = $request->input('age');
        $userInfo->address = $request->input('address');
        $userInfo->save();

        return response()->json(['success' => 'User info updated successfully']);
    }

    public function deleteUserInfo($id){
       UserInfo::where('id',$id)->delete();
        
        return response()->json(['success' => 'User info deleted successfully']);
    }
}
