<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Member;
use App\Models\Room;
use App\Models\RoomRegistration;
use App\Models\Supporter;
use App\Models\TypeSupport;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RoomRegistrationController extends Controller
{
    
    public function index()
    {
        $types = TypeSupport::select('id', 'name')->get();
        $rooms = Room::select('id', 'name')->get();
        $departments = Department::select('id', 'name')->get();
        $history_registrations = RoomRegistration::where('register_id', Auth::id())
            ->select('id', 'meet_name', 'status')
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('shared.registration', compact('types', 'rooms', 'departments', 'history_registrations'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $rules = [
            'meet_name' => 'required|max:500',
            'type_sp' => 'required|exists:types_support,id',
            'room_name' => 'required_if:type_sp,1',
            'test_time' => 'required|date_format:d-m-Y H:i|after:now',
            'start_time' => 'required|date_format:d-m-Y H:i|after:test_time',
            'end_time' => 'required|date_format:d-m-Y H:i|after:start_time',
            'document' => 'required|max:2048|mimes:pdf,doc,docx',
        ];

        $messages = [
            'meet_name.required' => 'Chưa nhập tên cuộc họp',
            'meet_name.max' => 'Tên cuộc họp quá dài',
            'type_sp.required' => 'Chưa chọn loại hỗ trợ',
            'type_sp.exists' => 'Loại hỗ trợ không tồn tại',
            'room_name.required_if' => 'Chưa chọn phòng họp',
            'test_time.required' => 'Chưa chọn thời gian thử nghiệm',
            'test_time.date_format' => 'Ngày chưa đúng định dạng',
            'test_time.after' => 'Thời gian đăng ký không hợp lệ',
            'start_time.required' => 'Chưa chọn thời gian bắt đầu',
            'start_time.date_format' => 'Ngày chưa đúng định dạng',
            'start_time.after' => 'Thời gian bắt đầu phải sau thời gian thử nghiệm',
            'end_time.required' => 'Chưa chọn thời gian kết thúc',
            'end_time.date_format' => 'Ngày chưa đúng định dạng',
            'end_time.after' => 'Thời gian kết thúc phải sau thời gian bắt đầu',
            'document.required' => 'Chưa upload văn bản đăng ký họp',
            'document.max' => 'Kích thước file vượt quá quy định',
            'document.mimes' => 'Văn bản phải là file pdf, doc hoặc docx',
        ];

        $request->validate($rules, $messages);

        $test_time = date("Y-m-d H:i:s", strtotime($request->test_time));
        $start_time = date("Y-m-d H:i:s", strtotime($request->start_time));
        $end_time = date("Y-m-d H:i:s", strtotime($request->end_time));
        if($request->type_sp == 1){
            $checkTime = RoomRegistration::where('room_id', $request->room_name)
                ->where('status', 1)
                ->where(function($query) use ($test_time, $end_time){
                    $query->whereBetween('test_time', [$test_time, $end_time])
                        ->orWhereBetween('end_time', [$test_time, $end_time])
                        ->orWhereRaw("'".$test_time."' BETWEEN test_time AND end_time")
                        ->orWhereRaw("'".$end_time."' BETWEEN test_time AND end_time");
                })->get();
            if($checkTime->count()){
                return back()->withInput()->with('status', 'Phòng đã có đơn vị sử dụng');
            };
        }
        
        $document = $request->file('document');
        if($document){
            $file = $request->file('document')->getClientOriginalName();
            $fileName = pathinfo($file, PATHINFO_FILENAME);
            $extension = $request->file('document')->getClientOriginalExtension();
            $newName = $fileName.time().'.'.$extension;
            $document->move(public_path('frontend/dist/upload/'), $newName);
        }

        if(Auth::user()->role_id == 1){
            $request->validate([
                'department_name' => 'required|exists:departments,id',
            ],[
                'department_name.required' => 'Chưa chọn đơn vị đăng ký',
                'department_name.exists' => 'Đơn vị không tồn tại',
            ]);
            $department_id = $request->department_name;
        }
        else{
            $department_id = Member::where('account_id', Auth::id())->first()->department_id;
        }

        if($request->type_sp != 1){
            $request->room_name = NULL;
        }
        
        $store = RoomRegistration::create([
            'meet_name' => $request->meet_name,
            'register_id' => Auth::id(),
            'room_id' => $request->room_name ?? NULL,
            'department_id' => $department_id,
            'type_sp_id' => $request->type_sp,
            'test_time' => $test_time,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'document' => $newName ?? NULL,
            'status' => 0,
        ]);

        if($store){
            Toastr::success('Đăng ký thành công, chờ kết quả xét duyệt từ lãnh đạo', 'Thành công');
        }
        else{
            Toastr::error('Có lỗi xảy ra, thử lại sau', 'Thất bại');
        }

        return back();
    }

    public function show($id)
    {

        $info = RoomRegistration::select('department_id', 'register_id', 'room_id', 'type_sp_id', 'supporter_id')->find($id);
        $this->authorize('view', $info);
        $data['info'] = RoomRegistration::select('meet_name', 'test_time', 'start_time', 'end_time', 'document', 'status' ,'feedback')->find($id);
        $data['department'] = Department::select('name')->find($info->department_id);
        $data['register'] = User::join('members', 'account_id', '=', 'users.id')->where('account_id', $info->register_id)->select('members.name')->first();
        $data['type'] = TypeSupport::select('name')->find($info->type_sp_id);
        $data['room'] = Room::select('name')->find($info->room_id);
        $data['supporter'] = Supporter::join('users', 'user_id', 'users.id')
            ->join('members', 'account_id', 'users.id')
            ->where('supporters.id', $info->supporter_id)
            ->select('name', 'email', 'phone')
            ->first();
        return response()->json(['data' => $data, 'status' => 1]);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $meeting = RoomRegistration::find($id);
        $this->authorize('delete', $meeting);
        $destinationPath = public_path('frontend/dist/upload/').$meeting->document;
        if(file_exists($destinationPath)){
            unlink($destinationPath);
        }
        $delete = $meeting->delete();
        if($delete){
            Toastr::success('Hủy đăng ký thành công', 'Thành công');
            return response()->json(['status' => 1]);
        }
        else{
            Toastr::error('Có lỗi xảy ra, thử lại sau', 'Thất bại');
            return response()->json(['status' => 0]);
        }
    }
}
