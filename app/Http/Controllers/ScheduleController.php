<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\RoomSchedule;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class ScheduleController extends Controller
{

    protected $userId;

    public function __construct()
    {
        $this->middleware(function ($request, $next){
            if(!empty($request->user())){
                if ($request->user()->user_type == User::Roles['Admin']){
//                if (empty(session()->get('user_id'))){
//                    return $next($request)->route('dashboard');
//                }
                    $this->userId = session()->get('user_id');
                }else{
                    $this->userId = $request->user()->id;
                }
            }

            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $filter_data = [];
        $board_types = array_flip(RoomSchedule::BoardType);
        if(!empty($request->room_ids) && count($request->room_ids)){
            $filter_data['room_ids'] = $request->room_ids;
        }else{
            $filter_data['room_ids'] = [];
        }

        if(!empty($request->range)){
            $filter_data['range']=$request->range;
        }else{
            $range=[
                'start'=>today()->format('d-m-Y'),
                'end'=>Carbon::today()->addDays(15)->format('d-m-Y')
            ];
            $filter_data['range']=$range;
            $request->range=$range;
        }

        $hotel = Hotel::where('user_id', $this->userId)->with('rooms')->firstOrFail();
        $room_list = $hotel->rooms()->pluck('room_name', 'id');

        $rooms =$hotel->rooms();
        if (!empty($filter_data['room_ids'])){
            $rooms = $rooms->whereIn('id', $filter_data['room_ids']);
        }
        $rooms = $rooms->with('schedules')->get();

        $room_schedules = $dates = [];
        $startDate = Carbon::parse($request->range['start']);
        $endDate = Carbon::parse($request->range['end']);
        $dayDiff = $endDate->diffInDays($startDate);

        for($d=0; $d<=$dayDiff; $d++){
            $date = Carbon::parse($request->range['start'])->addDays($d)->format('Y-m-d');
            array_push($dates, [
                'date'=> Carbon::parse($date)->format('d/m'),
                'day'=> Carbon::parse($date)->format('D')
            ]);
        }
        foreach ($rooms as $room){
            $roomData['id']=$room->id;
            $roomData['room_name']=$room->room_name;
            $roomData['rack_price']=$room->rack_price;
            $roomData['available_rooms']=[];
            $roomData['sold_rooms']=[];
            $roomData['schedules']=[
                [
                    'have_value'=>0,
                    'title'=>'Option:',
                    'values'=>[],
                ],
                [
                    'have_value'=>0,
                    'title'=>'Bed and Breakfast',
                    'values'=>[],
                ],
                [
                    'have_value'=>0,
                    'title'=>'Half Board',
                    'values'=>[],
                ],
                [
                    'have_value'=>0,
                    'title'=>'Full Board',
                    'values'=>[],
                ],
            ];

            for($i=0; $i<=$dayDiff; $i++){
                $date =  Carbon::parse($request->range['start'])->addDays($i)->format('Y-m-d');

                $op0 = $op1 = $op2 = $op3 = [
                    'price'=>'0.00',
                    'status'=> 0
                ];

                $option0 = $room->schedules()
                    ->whereDate('start_date','<=', $date)
                    ->whereDate('end_date', '>', $date)
                    ->where('board_type', RoomSchedule::BoardType['None'])
                    ->latest()
                    ->first();
                if(!empty($option0)){
                    $roomData['schedules']['0']['have_value'] = 1;
                    $op0 =[
                        'price'=>$option0->bar_rate,
                        'status'=> $option0->status
                    ];
                }

                $option1 = $room->schedules()
                    ->whereDate('start_date','<=', $date)
                    ->whereDate('end_date', '>', $date)
                    ->where('board_type', RoomSchedule::BoardType['Bed and Breakfast'])
                    ->latest()
                    ->first();
                if(!empty($option1)){
                    $roomData['schedules']['1']['have_value'] = 1;
                    $op1 =[
                        'price'=>$option1->bar_rate,
                        'status'=> $option1->status
                    ];
                }

                $option2 = $room->schedules()
                    ->whereDate('start_date','<=', $date)
                    ->whereDate('end_date', '>', $date)
                    ->where('board_type', RoomSchedule::BoardType['Half Board'])
                    ->latest()
                    ->first();
                if(!empty($option2)){
                    $roomData['schedules']['2']['have_value'] = 1;
                    $op2 =[
                        'price'=>$option2->bar_rate,
                        'status'=> $option2->status
                    ];
                }

                $option3 = $room->schedules()
                    ->whereDate('start_date','<=', $date)
                    ->whereDate('end_date', '>', $date)
                    ->where('board_type', RoomSchedule::BoardType['Full Board'])
                    ->latest()
                    ->first();
                if(!empty($option3)){
                    $roomData['schedules']['3']['have_value'] = 1;
                    $op3 =[
                        'price'=>$option3->bar_rate,
                        'status'=> $option3->status
                    ];
                }

                $available = $room->schedules()
                    ->whereDate('start_date','<=', $date)
                    ->whereDate('end_date', '>', $date)
                    ->latest()
                    ->first();

                array_push($roomData['available_rooms'], !empty($available)?$available->available_room: 0);
                array_push($roomData['sold_rooms'], !empty($available)?$available->available_room - $available->not_sold: 0);

                array_push($roomData['schedules']['0']['values'], $op0);

                array_push($roomData['schedules']['1']['values'], $op1);

                array_push($roomData['schedules']['2']['values'], $op2);

                array_push($roomData['schedules']['3']['values'], $op3);
            }
            array_push($room_schedules, $roomData);
        }



        return Inertia::render('Schedule/RoomSchedule',
            compact('rooms', 'room_list', 'filter_data',
            'board_types', 'dates', 'room_schedules')
        );
    }

    public function store(Request $request)
    {

        Validator::make($request->all(), [
            'start_date' => ['required','string'],
            'end_date' => ['required','string'],
            'room_id' => ['required'],
            'selected_days' => ['nullable', 'array'],
            'available_room' => ['required', 'numeric'],
            'bar_rate' => ['required', 'numeric', 'min:0', 'not_in:0'],
        ])->validate();

        try {
            DB::beginTransaction();

            $hotel = Hotel::where('user_id', $this->userId)->with('rooms')->first();
            if (empty($hotel)){
                throw new \Exception('Invalid Hotel information');
            }

            $room = $hotel->rooms()->where('id', $request->room_id)->first();
            if (empty($room)){
                throw new \Exception('Invalid Room information');
            }

            $scheduleList = [];

            if(empty($request->selected_days) || count($request->selected_days) == 7){
                array_push($scheduleList, [
                    'start_date'=>Carbon::parse($request->start_date)->format('Y-m-d'),
                    'end_date'=>Carbon::parse($request->end_date)->format('Y-m-d'),
                    'room_id'=>$request->room_id,
                    'board_type'=>!empty($request->board_type)? $request->board_type: RoomSchedule::BoardType['None'],
                    'refundable'=>!empty($request->refundable)? $request->refundable: RoomSchedule::Refundable['No'],
                    'status'=>!empty($request->room_status)? $request->room_status : RoomSchedule::Status['Close'],
                    'available_room'=>!empty($request->available_room)? $request->available_room : 0,
                    'not_sold'=>!empty($request->available_room)? $request->available_room : 0,
                    'bar_rate'=>$request->bar_rate,
                    'hotel_id' => $hotel->id
                ]);
            }else{

                $startDate = Carbon::parse($request->start_date);
                $endDate = Carbon::parse($request->end_date);
                $dayDiff = $endDate->diffInDays($startDate);

                for ($i=0; $i<$dayDiff; $i++){
                    $date = Carbon::parse($request->start_date)->addDays($i);
                    $dayName = $date->format('l');
                    if (in_array(RoomSchedule::Days[$dayName], $request->selected_days)){
                        if(count($scheduleList) > 0 && $date->diffInDays(Carbon::parse($scheduleList[count($scheduleList) -1]['end_date'])) == 0){
                            $scheduleList[count($scheduleList) -1 ]['end_date'] = $date->addDay()->format('Y-m-d');
                        }else{
                            array_push($scheduleList, [
                                'start_date'=>$date->format('Y-m-d'),
                                'end_date'=>$date->addDay()->format('Y-m-d'),
                                'room_id'=>$request->room_id,
                                'board_type'=>!empty($request->board_type)? $request->board_type: RoomSchedule::BoardType['None'],
                                'refundable'=>!empty($request->refundable)? $request->refundable: RoomSchedule::Refundable['No'],
                                'status'=>!empty($request->room_status)? $request->room_status: RoomSchedule::Status['Close'],
                                'available_room'=>!empty($request->available_room)? $request->available_room : 0,
                                'not_sold'=>!empty($request->available_room)? $request->available_room : 0,
                                'bar_rate'=>$request->bar_rate,
                                'hotel_id' => $hotel->id
                            ]);
                        }
                    }

                }
            }

//            dd($scheduleList);
            if(empty($scheduleList) || count($scheduleList) <=0){
                throw new \Exception('Invalid room schedule information');
            }

            $schedule = $room->schedules()->createMany($scheduleList);

            if (!empty($schedule)){
                DB::commit();
                return redirect()->back()->with('success', 'Room calender & rates updated successfully');
//                return response()->json([
//                    'status'=>200,
//                    'message'=>'Room calender & rates updated successfully',
//                    'url'=>route('hotel.schedule.index')
//                ],200);
            }

            throw new \Exception('Invalid room schedule information');
        }catch (\Illuminate\Database\QueryException $ex){
            DB::rollBack();
            return redirect()->back()->with('error', 'Something very wrong');
        }catch (\Exception $ex){
            DB::rollBack();
            return redirect()->back()->with('error', $ex->getMessage());
//            return response()->json([
//                'status'=>400,
//                'message'=>$ex->getMessage()
//            ], 400);
        }
    }
}
