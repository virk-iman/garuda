<?php

namespace App\Http\Controllers;

use App\Drone;
use App\Consignment;
use App\Recovery;
use App\Bsf;
use App\Indian_BOPS;
use App\Pak_BOPS;
use App\Indian_Vill;
use App\Pak_Vill;
use App\Arrest_Per;
use App\Ind_Susp;
use App\Ind_Roads;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Auth;
use Storage;
use Yajra\Datatables\Datatables;

class DroneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //
       // $drones = Drone::all();

      //  return view('drones.index', compact('drones'));

      //$drones = Drone::all();
      if( Auth::check() ) {
        return view('drones.index');
      }
      else{
        return Redirect::to('login');
      }
    }

    public function categoryData()
    {
        return Datatables::of(Drone::query())
                    ->addIndexColumn()
                    ->addColumn('edit', function($row){
       
                           $btn = '<a href="javascript:void(0)" class="edit btn btn-info btn-sm">View</a>';
                           $btn = '<a href="' . route("drones.edit", $row->id) .'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
         
                            return $btn;
                    })
                    ->rawColumns(['edit'])
                    ->make(true);
    }

    public function DroneMap()
    {
        $drones = Drone::all();
        $consignments = Consignment::all();
        $recovery = Recovery::all();
        $arrest_per = Arrest_Per::all();
        $ind_susp = Ind_Susp::all();
      return view('drones.drone_map', compact('drones','consignments','recovery','arrest_per','ind_susp'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $path = storage_path() . "/json/bops.json"; // ie: /var/www/laravel/app/storage/json/filename.json

        $json = file_get_contents($path); 
        return view('drones.create')->with('Bops',$json);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $rules = [
			'location' => 'required|string|min:3|max:255',
			
         
		];
		$validator = Validator::make($request->all(),$rules);
		if ($validator->fails()) {
			return redirect('/drones/create')
			->withInput()
			->withErrors($validator);
		}
		else{
            
            $data = $request->input();
			try{
				$drone = new Drone();
                //$drone->drone_type = $data['uav_type'];
                $drone->location = $data['location'];
				$drone->district = $data['district'];
                $drone->ps = $data['ps'];
                $drone->bop = $data['bop_rec'];
                $drone->vill = $data['vill'];
                $drone->lat = $data['lat'];
                $drone->long = $data['long'];
				$drone->time_seen = date('Y-m-d H:i:s', strtotime($data['time_seen']));
                $drone->fly_dur = $data['hours'].":".$data['minutes'].":".$data['seconds'];
                if($drone->fly_dur == "::")
                {
                    $drone->fly_dur = "";
                }
                $drone->pen_dist = $data['dist_pen'].$data['unit_dis'];
                $drone->action = $data['action'];
                $drone->fir_no=$data['fir_no'];
                $drone->fir_date=$data['fir_date'];
                $drone->under_sec=$data['under_sec'];
                $drone->fir_act=$data['fir_act'];
                $drone->fir_ps=$data['fir_ps'];
                $drone->cons_dropped = $data['cons_dropped'];
                $drone->recovery = $data['rec_radio'];
                $drone->forensics = $data['forensic_radio'];
                $drone->save();
                 foreach(array_filter($data['cons_type']) as $key=>$consignment)
                {
                $cons=new Consignment();
                $cons->type = $consignment;
                $cons->item = $data['cons_item'][$key];
                $cons->qty = $data['cons_qty'][$key];
                $cons->drone_id = $drone->id;
                $cons->save();
                }
                if(isset($data['date_rec'])) {
                $reco= new Recovery();
                $reco->dor = $data['date_rec'];
                $reco->rec_agency = $data['agency_rec'];
                $reco->type_drone = $data['type_drone'];
                $reco->model = $data['model_drone'];
                $reco->payload_cap = $data['payload'].$data['unit_payload'];
                $reco->max_speed = $data['max_speed'].$data['unit_speed'];
                $reco->flight_time = $data['flight_time'].$data['unit_ft'];
                $reco->one_way = $data['onewaydis'].$data['unit_onewaydis'];
                $reco->drone_id = $drone->id;
                $reco->save();
            }
                foreach(array_filter($data['bsf_drone']) as $bsf_dron)
                {
                $bsf=new Bsf();
                $bsf->bsf_post = $bsf_dron;
                $bsf->drone_id = $drone->id;
                $bsf->save();
                }
                foreach(array_filter($data['indian_bops']) as $indian_bop)
                {
                $ind_bop=new Indian_BOPS();
                $ind_bop->bop = $indian_bop;
                $ind_bop->drone_id = $drone->id;
                $ind_bop->save();
                }
                
                foreach(array_filter($data['pak_bops']) as $pak_bop)
                {
                $pakis_bop=new Pak_BOPS();
                $pakis_bop->bop = $pak_bop;
                $pakis_bop->drone_id = $drone->id;
                $pakis_bop->save();
                }
                
                foreach(array_filter($data['indian_vill']) as $key=>$indian_vill)
                {
                $ind_vill=new Indian_Vill();
                $ind_vill->vill = $indian_vill;
                $ind_vill->dist = $data['indianvill_dist'][$key].$data['indianvill_unit'][$key];
                $ind_vill->drone_id = $drone->id;
                $ind_vill->save();
                }
                
                foreach(array_filter($data['pak_vill']) as $key=>$pak_vill)
                {
                $pk_vill=new Pak_Vill();
                $pk_vill->vill = $pak_vill;
                $pk_vill->dist = $data['pakvill_dist'][$key].$data['pakvill_unit'][$key];
                $pk_vill->drone_id = $drone->id;
                $pk_vill->save();
                }
                
                foreach(array_filter($data['perarr_name']) as $key=>$per_arrest)
                {
                $per_arr=new Arrest_Per();
                $per_arr->name = $per_arrest;
                $per_arr->father = $data['perarr_so'][$key];
                $per_arr->address=$data['perarr_ro'][$key];
                $per_arr->district=$data['perarr_dis'][$key];
                $per_arr->age=$data['perarr_age'][$key];
                $per_arr->drone_id = $drone->id;
                $per_arr->save();
                }

                foreach(array_filter($data['indiansusp']) as $key=>$ind_susp)
                {
                $ind_sus=new Ind_Susp();
                $ind_sus->name = $ind_susp;
                $ind_sus->father = $data['indiansusp_so'][$key];
                $ind_sus->address=$data['indiansusp_ro'][$key];
                $ind_sus->district=$data['indiansusp_dis'][$key];
                $ind_sus->age=$data['indiansusp_age'][$key];
                $ind_sus->drone_id = $drone->id;
                $ind_sus->save();
                }
               
                foreach(array_filter($data['roads_drone']) as $road)
                {
                $ind_road=new Ind_Roads();
                $ind_road->road = $road;
                $ind_road->drone_id = $drone->id;
                $ind_road->save();
                }
				return redirect('/submit')->with('status',"Insert successfully");
			}
			catch(Exception $e){
				return redirect('/submit')->with('failed',"operation failed");
			}
		}
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Drone  $drone
     * @return \Illuminate\Http\Response
     */
    public function show(Drone $drone)
    {
        //
    }

    public function Insert_bop()
    {
        $path = storage_path() . "/json/bops.json"; // ie: /var/www/laravel/app/storage/json/filename.json

        $json = file_get_contents($path); 
        //$data = json_decode(file_get_contents($path), true);

        //collect($data);
        return view('drones.insert_bop')->with('Bops', $json);
    }

     public function Submit_bop(Request $request)
    {
        $rules = [
            
            
         
        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            return redirect('/drones/insert_bop')
            ->withInput()
            ->withErrors($validator);
        }
        else{
            
            $data = $request->input();
            try{
                //$drone = new Drone();
                //$drone->drone_type = $data['uav_type'];
                $district = $data['district'];
                $ps = $data['ps'];
                $nbop = $data['nbop'];
                $path = storage_path() . "/json/bops.json"; 
                $content = json_decode(file_get_contents($path), true);
                //$content['district']['ps']= $nbop;
                //dd($content[$district][$ps]);
                array_push($content[$district][$ps],$nbop);
                file_put_contents($path, json_encode($content,true) );
                return redirect()->back()->with('success', 'Added Successfully');
                }
                catch(Exception $e){
                return redirect()->back()->with('failed',"operation failed");
            }   
    }
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Drone  $drone
     * @return \Illuminate\Http\Response
     */
    public function edit(Drone $drone)
    {
        //
        $path = storage_path() . "/json/bops.json"; // ie: /var/www/laravel/app/storage/json/filename.json

        $json = file_get_contents($path); 
        $consignments = Consignment::where('drone_id',$drone->id )->get();
        $recovery = Recovery::where('drone_id',$drone->id )->get();
        $bsf_posts = Bsf::where('drone_id',$drone->id )->get();
        $indian_bops = Indian_BOPS::where('drone_id',$drone->id )->get();
        $pak_bops = Pak_BOPS::where('drone_id',$drone->id )->get();
        $indian_vill = Indian_Vill::where('drone_id',$drone->id )->get();
        $pak_vill = Pak_Vill::where('drone_id',$drone->id )->get();
        $arrest_per = Arrest_Per::where('drone_id',$drone->id )->get();
        $ind_susp = Ind_Susp::where('drone_id',$drone->id )->get();
        $ind_roads = Ind_Roads::where('drone_id',$drone->id )->get();
        $Bops= $json;
        return view('drones.edit',compact('drone','consignments','recovery','bsf_posts','indian_bops','pak_bops','indian_vill','pak_vill','arrest_per','ind_susp','ind_roads','Bops'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Drone  $drone
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Drone $drone)
    {
        //
        $rules = [
			'location' => 'required|string|min:3|max:255',
			
         
		];
		$validator = Validator::make($request->all(),$rules);
		if ($validator->fails()) {
			return redirect('/drones')
			->withInput()
			->withErrors($validator);
		}
		else{
            
            $data = $request->input();
			try{
				$drone = Drone::find($drone->id);
                //$drone->drone_type = $data['uav_type'];
                $drone->location = $data['location'];
				$drone->district = $data['district'];
                $drone->ps = $data['ps'];
                $drone->bop = $data['bop_rec']; 
                $drone->vill = $data['vill'];
                $drone->lat = $data['lat'];
                $drone->long = $data['long'];
				$drone->time_seen = date('Y-m-d H:i:s', strtotime($data['time_seen']));
                $drone->fly_dur = $data['hours'].":".$data['minutes'].":".$data['seconds'];
                   if($drone->fly_dur == "::")  
                {   
                    $drone->fly_dur = "";   
                }
                $drone->pen_dist = $data['dist_pen'].$data['unit_dis'];
                $drone->action = $data['action'];
                $drone->fir_no=$data['fir_no']; 
                $drone->fir_date=$data['fir_date']; 
                $drone->under_sec=$data['under_sec'];   
                $drone->fir_act=$data['fir_act'];   
                $drone->fir_ps=$data['fir_ps']; 
                $drone->cons_dropped = $data['cons_dropped'];   
                $drone->recovery = $data['rec_radio'];  
                $drone->forensics = $data['forensic_radio'];
                $drone->updated_at = Carbon::now()->timestamp;
                $drone->save();
                //$drone->touch();
                if(isset($data['bsf_dron'])) {
                foreach($data['bsf_dron'] as $key=>$bsf_dron)
                {
                #$bsf=new Bsf();
                #$bsf->bsf_post = $bsf_dron;
                #$bsf->drone_id = $drone->id;
                #$bsf->save();
                $bsf = Bsf::find($data['bsf_dron_id'][$key]);
                $bsf->bsf_post = $bsf_dron;
                #$bsf->drone_id = $drone->id;
                $bsf->save();
                }
            }
                foreach(array_filter($data['bsf_drone']) as $bsf_dron)
                {
                $bsf=new Bsf();
                $bsf->bsf_post = $bsf_dron;
                $bsf->drone_id = $drone->id;
                $bsf->save();
                }
                #EDIT INDIAN_BOP
                if(isset($data['indian_bop'])) {
                foreach($data['indian_bop'] as $key=>$value)
                {
                $ind_bop = Indian_BOPS::find($data['indian_bop_id'][$key]);
                $ind_bop->bop = $value;
                $ind_bop->save();
                }
            }
                foreach(array_filter($data['indian_bops']) as $indian_bop)
                {
                $ind_bop=new Indian_BOPS();
                $ind_bop->bop = $indian_bop;
                $ind_bop->drone_id = $drone->id;
                $ind_bop->save();
                }
                #EDIT PAK_BOP
                if(isset($data['pak_bop'])) {
                foreach($data['pak_bop'] as $key=>$value)
                {
                $pakis_bop = Pak_BOPS::find($data['pak_bop_id'][$key]);
                $pakis_bop->bop = $value;
                $pakis_bop->save();
                }
            }
                foreach(array_filter($data['pak_bops']) as $pak_bop)
                {
                $pakis_bop=new Pak_BOPS();
                $pakis_bop->bop = $pak_bop;
                $pakis_bop->drone_id = $drone->id;
                $pakis_bop->save();
                }
                #EDIT INDIAN_VILL
                if(isset($data['ind_vill'])) {
                foreach($data['ind_vill'] as $key=>$value)
                {
                $ind_vill = Indian_Vill::find($data['ind_vill_id'][$key]);
                $ind_vill->vill = $value;
                $ind_vill->dist = $data['ind_vill_dist'][$key];
                $ind_vill->save();
                }
            }
                foreach(array_filter($data['indian_vill']) as $key=>$indian_vill)
                {
                $ind_vill=new Indian_Vill();
                $ind_vill->vill = $indian_vill;
                $ind_vill->dist = $data['indianvill_dist'][$key].$data['indianvill_unit'][$key];
                $ind_vill->drone_id = $drone->id;
                $ind_vill->save();
                }
                #EDIT PAK_VILL
                if(isset($data['pk_vill'])) {
                foreach($data['pk_vill'] as $key=>$value)
                {
                $pk_vill = Pak_Vill::find($data['pk_vill_id'][$key]);
                $pk_vill->vill = $value;
                $pk_vill->dist = $data['pk_vill_dist'][$key];
                $pk_vill->save();
                }
            }
                foreach(array_filter($data['pak_vill']) as $key=>$pak_vill)
                {
                $pk_vill=new Pak_Vill();
                $pk_vill->vill = $pak_vill;
                $pk_vill->dist = $data['pakvill_dist'][$key].$data['pakvill_unit'][$key];
                $pk_vill->drone_id = $drone->id;
                $pk_vill->save();
                }
                #EDIT INDIAN_SUSP
                if(isset($data['indian_susp'])) {
                foreach($data['indian_susp'] as $key=>$value)
                {
                $ind_sus = Ind_Susp::find($data['indian_susp_id'][$key]);
                $ind_sus->name = $value;
                $ind_sus->father = $data['indian_susp_so'][$key];
                $ind_sus->address = $data['indian_susp_ro'][$key];
                $ind_sus->age = $data['indian_susp_age'][$key];
                $ind_sus->save();
                }
            }
                foreach(array_filter($data['indiansusp']) as $key=>$ind_susp)
                {
                $ind_sus=new Ind_Susp();
                $ind_sus->name = $ind_susp;
                $ind_sus->father = $data['indiansusp_so'][$key];
                $ind_sus->address=$data['indiansusp_ro'][$key];
                $ind_sus->age=$data['indiansusp_age'][$key];
                $ind_sus->drone_id = $drone->id;
                $ind_sus->save();
                }
                #EDIT INDIAN_ROAD
                if(isset($data['road_drone'])) {
                foreach($data['road_drone'] as $key=>$value)
                {
                $ind_road = Ind_Roads::find($data['road_drone_id'][$key]);
                $ind_road->road = $value;
                $ind_road->save();
                }
            }
                foreach(array_filter($data['roads_drone']) as $road)
                {
                $ind_road=new Ind_Roads();
                $ind_road->road = $road;
                $ind_road->drone_id = $drone->id;
                $ind_road->save();
                }
				return Redirect::back()->with('status',"Update successful");
			}
			catch(Exception $e){
				return Redirect::back()->with('status',"operation failed");
			}
		}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Drone  $drone
     * @return \Illuminate\Http\Response
     */
    public function destroy(Drone $drone)
    {
        //
    }
}
