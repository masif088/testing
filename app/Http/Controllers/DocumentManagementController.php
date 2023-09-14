<?php

namespace App\Http\Controllers;

use App\Models\DocumentManagement;
use App\Models\User;
use App\Models\WasteFarmer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class DocumentManagementController extends Controller
{

    public function index($userId){
        return [
            'code' => 200,
            'status' => 'success',
            'document_managements'=>DocumentManagement::where('user_id','=',$userId)->get()
        ];
    }
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'title' => 'required|string|max:255',
            'content' => 'required',
            'singing' => 'required|mimes:png',
        ]);
        $file = $request->file('singing');

        if ($validate->fails()) {
            return [
                'code' => 200,
                'message' => $validate->errors(),
                'status' => 'error'
            ];
        }
        if (User::find($request['user_id']) == null) {
            return [
                'code' => 200,
                'message' => 'User not found',
                'status' => 'error'
            ];
        }

        $filename = 'singing/'.Str::slug($request['user_id'] . '-' . date('Hms')) . '.'
            . $request->file('singing')
                ->getClientOriginalExtension();
        Storage::disk('local')
            ->put('public/' . $filename, file_get_contents($file));

        DocumentManagement::create([
            'user_id' => $request['user_id'],
            'title' => $request['title'],
            'content' => $request['content'],
            'singing' => $filename,
        ]);

        return [
            'code' => 200,
            'message' => 'Success create',
            'status' => 'success'
        ];
    }

    public function update(Request $request, string $id)
    {
        $validate = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'title' => 'required|string|max:255',
            'content' => 'required',
            'singing' => 'required|mimes:png',
        ]);
        $file = $request->file('singing');

        if ($validate->fails()) {
            return [
                'code' => 200,
                'message' => $validate->errors(),
                'status' => 'error'
            ];
        }
        if (User::find($request['user_id']) == null) {
            return [
                'code' => 200,
                'message' => 'User not found',
                'status' => 'error'
            ];
        }

        $filename = 'singing/'.Str::slug($request['user_id'] . '-' . date('Hms')) . '.'
            . $request->file('singing')
                ->getClientOriginalExtension();
        Storage::disk('local')
            ->put('public/' . $filename, file_get_contents($file));

        DocumentManagement::find($id)->update([
            'user_id' => $request['user_id'],
            'title' => $request['title'],
            'content' => $request['content'],
            'singing' => $filename,
        ]);

        return [
            'code' => 200,
            'message' => 'Success update',
            'status' => 'success'
        ];
    }

    public function destroy(string $id)
    {
        DocumentManagement::find($id)->delete();
        return [
            'code' => 200,
            'message' => 'Success delete',
            'status' => 'success'
        ];
    }
}
