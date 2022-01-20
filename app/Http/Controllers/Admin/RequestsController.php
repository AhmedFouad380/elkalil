<?php

    namespace App\Http\Controllers\Admin;

    use App\Http\Controllers\Controller;
    use App\Models\Contract;
    use App\Models\Explan;
    use App\Models\Project;
    use App\Models\ProjectContract;
    use http\Client;
    use Illuminate\Http\Request;
    use Yajra\DataTables\Facades\DataTables;
    use Auth;
    class RequestsController extends Controller
    {
        public function __construct()

        {
            $this->middleware('auth');
            $this->middleware(function ($request, $next) {
                $this->id = \Illuminate\Support\Facades\Auth::user()->userGroup->is_client_order;
                if( $this->id  == 0 ){
                    return redirect('/');
                }
                return $next($request);

            });

        }


        public function index()
        {
            return view('admin.Requests.index');
        }

        public function datatable(Request $request)
        {

            if(\Illuminate\Support\Facades\Auth::user()->jop_type == 3 ){
                $data = Project::where('is_accepted',2)->orderBy('date', 'desc');
            }elseif(Auth::user()->jop_type == 2){
                $data = Project::where('state',Auth::user()->state)->where('is_accepted',2)->orderBy('date', 'desc');
            }

            if(isset($request->view)){
                $data->where('view',$request->view);
            }
            if(isset($request->from)){
                $data->whereDate('date','>=',$request->from);
            }
            if(isset($request->to)){
                $data->whereDate('date','<=',$request->to);
            }
            $data->orderBy('id', 'desc')->get();
            return Datatables::of($data)
                    ->addColumn('checkbox', function ($row) {
                    $checkbox = '';
                    $checkbox .= '<div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="' . $row->id . '" />
                                    </div>';
                    return $checkbox;
                })
                ->editColumn('name', function ($row) {
                    $name = '';
                    $name .= ' <span class="text-gray-800 text-hover-primary mb-1">' . $row->name . '</span>
                                       <br> <small class="text-gray-600">' . $row->email . '</small>';
                    return $name;
                })
                ->editColumn('date', function ($row) {
                        return \Carbon\Carbon::parse($row->date)->format('Y-m-d H:i');

                })
                ->setRowClass(function ($row) {
                    return $row->view == 0 ? 'unread' : '';
                })
                ->addColumn('type', function ($row) {

                    return Contract::find($row->projectContract->contract_id) ? Contract::find($row->projectContract->contract_id)->title : "-";
                })
                ->addColumn('actions', function ($row) {
                    $actions = ' <a href="' . url("Requests-edit/" . $row->id) . '" class="btn btn-active-light-info"><i class="bi bi-pencil-fill"></i> عرض </a>';
                    return $actions;

                })
                ->rawColumns(['actions', 'checkbox', 'name', 'date', 'type'])
                ->make();

        }
        public function edit($id){

            $data = Project::findOrFail($id);
            $data->view=1;
            $data->save();
            $explans = Explan::OrderBy('id','desc')->where('project_id',$id)->get();
                return view('admin.Requests.edit',compact('data','explans'));
        }

        public function updateProjectData(Request $request){
            $Project = Project::find($request->id);
            $Project->phone=$request->phone;
            $Project->save();

            $client = \App\Models\Client::find($Project->client_id);
            $client->name=$request->name;
            $client->phone=$request->phone;
            $client->save();

            $contract = Contract::find($request->contract_id);
            $data = ProjectContract::where('project_id',$request->id)->first();
            $data->contract_id=$contract->id;
            $data->price=$contract->price;
            $data->template=$contract->template;
            $data->color=$contract->color;
            $data->save();

            $explan = 'تم تعديل بيانات المشروع ';
            Explan::create([
                'title' => $explan,
                'comments' => $explan,
                'date' => \Carbon\Carbon::now()->format('Y-m-d'),
                'time' => \Carbon\Carbon::now()->format('H:i:s'),
                'emp_name'=>Auth::user()->name,
                'emp_id'=>Auth::user()->id,
                'project_id'=>$request->id
            ]);
            return back()->with('message','Success');

        }

        public function updateLocation(Request $request){

            $data = Project::FindOrFail($request->id);
            $data->lat=$request->lat;
            $data->lng=$request->lng;
            $data->save();
            $explan = 'تم تعديل موقع المشروع ';
            Explan::create([
                'title' => $explan,
                'comments' => $explan,
                'date' => \Carbon\Carbon::now()->format('Y-m-d'),
                'time' => \Carbon\Carbon::now()->format('H:i:s'),
                'emp_name'=>Auth::user()->name,
                'emp_id'=>Auth::user()->id,
                'project_id'=>$request->id
            ]);
            return back()->with('message','Success');
        }

        public function AcceptProject(Request $request){


            try {
                $data = Project::FindOrFail($request->id);
                $data->is_accepted = 1;
                $data->is_contract=1;
                $data->view=0;
                $data->save();
                Explan::create([
                    'title' => 'تم قبول المشروع',
                    'comments' => 'تم قبول المشروع',
                    'date' => \Carbon\Carbon::now()->format('Y-m-d'),
                    'time' => \Carbon\Carbon::now()->format('H:i:s'),
                    'emp_name'=>Auth::user()->name,
                    'emp_id'=>Auth::user()->id,
                    'project_id'=>$request->id
                ]);
            } catch (\Exception $e) {
                return response()->json(['message' => 'Failed']);
            }
            return response()->json(['message' => 'Success']);
        }

        public function RejectProject(Request $request){


            try {
                $data = Project::FindOrFail($request->id);
                $data->is_accepted = 0;
                $data->save();
                Explan::create([
                    'title' => 'تم رفض المشروع',
                    'comments' => 'تم رفض المشروع',
                    'date' => \Carbon\Carbon::now()->format('Y-m-d'),
                    'time' => \Carbon\Carbon::now()->format('H:i:s'),
                    'emp_name'=>Auth::user()->name,
                    'emp_id'=>Auth::user()->id,
                    'project_id'=>$request->id
                ]);

            } catch (\Exception $e) {
                return response()->json(['message' => 'Failed']);
            }
            return response()->json(['message' => 'Success']);
        }
    }
