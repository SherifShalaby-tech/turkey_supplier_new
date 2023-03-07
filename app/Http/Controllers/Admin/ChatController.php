<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\SupervisorRequest;
use App\Http\Requests\UserRequest;
use App\Models\Admin;
use App\Models\Role;
use App\Models\SupportChat;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_admins')->only(['index']);
        $this->middleware('permission:create_admins')->only(['create', 'store']);
        $this->middleware('permission:update_admins')->only(['edit', 'update']);
        $this->middleware('permission:delete_admins')->only(['delete']);

    }// end of __construct
    public function index(){
        return view('Admin.chats.index');
    }
    public function data() {
        $admins = SupportChat::where('admin_id',null)->select();
        return DataTables::of($admins)
        ->addIndexColumn()
        ->editColumn('created_at', function (SupportChat $chat) {
            return $chat->created_at->format('Y-m-d');
        })
        // ->addColumn('replay', function (SupportChat $chat) {
        //     return $chat->admin_id <> null ? __('chats.done'):__('chats.pend');
        // })
        ->addColumn('company', function (SupportChat $chat) {
            if ($chat->company_id == null){
                return 'Vistor';
            }else{
                return $chat->company?->name;
            }
        })
            ->editColumn('files',function (SupportChat $chat){
                if($chat->files == null){
                    $html = 'No image';
                }else{
                    $html = '<img width="100" src="'.asset('images/support-chat/' . $chat->files).'">';
                }
                return $html;
            })
            ->addColumn('actions', function (SupportChat $chat) {
                return view('Admin.chats.data_table.actions',compact('chat'));
            })
         ->rawColumns(['files','actions'])
        ->toJson();
    }

    public function destroy(SupportChat $chat)
    {
        if($chat->files != null && file_exists(public_path('images/support-chat/' . $chat->files))){
            unlink('images/support-chat/' . $chat->files);
        }
        $chat->delete();
        Alert::success(trans('admins.success'), trans('admins.delete-succes'));
        return redirect()->back();
    }


    public function replay(Request $request)
    {
        // dd($request->chat_id);
        $request->validate([
            'message' => 'required',
        ]);
        $input['message'] = $request->message;
        $input['admin_id'] = Auth::guard('admin')->user()->id;
        $input['company_id'] = $request->company_id;
        $input['sender'] = 'admin';
        SupportChat::create($input);
        Alert::success(trans('admins.success'), trans('admins.delete-succes'));
        return redirect()->back();
    }

}
