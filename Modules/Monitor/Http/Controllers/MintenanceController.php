<?php

namespace Modules\Monitor\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Artisan;
use App\Models\User;
use DB;


class MintenanceController extends Controller
{

    public function Mintenancedown()
    {
        Artisan::call('down --secret="132598MG5-F542a-246b-4b66-afa1-Lo97Wa"');
    }


    public function MintenanceUP()
    {
        Artisan::call('up');
        return view('monitor::index');
    }

    public function CheckRun()
    {
        $data='<h5>the application is <span style="color:red">running</span></h5>';

        return $data;
    
    }
    public function countUserOnline()
    {
        $count =User::online()->get();
        $data='<h5><span style="color:red">Count Users Online</span> ('. $count->count().'<i class="fa fa-user"></i>)</h5>';
      
      return  $data;
    }

    public function getCheck($id)
    {
        $all =  DB::table('checks')->where('host_id',$id)->get();
        $data='<div class="container-fluid">
        <div class="row">

    
            <div class="col-xl-6 box-col-6">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Pie Chart 1</h5>
                    </div>
                    <div class="card-body peity-charts"><span class="pie" data-peity=`{ "fill": ["#24695c", "#ba895d"]}`>30,80</span></div>
                </div>
            </div>
            <div class="col-xl-6 box-col-6">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Pie Chart 2</h5>
                    </div>
                    <div class="card-body peity-charts"><span class="pie" data-peity=`{ "fill": ["#24695c", "#ba895d"]}`>1,2,3,2,2</span></div>
                </div>
            </div>
            
        
        </div>
    </div>';
     return $data;
        // if ($all != null) {
        //     return response()->json([
        //         'data' => $all,
        //         'message' => 'Succeed',
        //         'code' => 200
        //     ], JsonResponse::HTTP_OK);
        // } else {
        //     return response()->json([
        //         'message' => 'faild',
        //         'code' => 00
        //     ], JsonResponse::HTTP_OK);
        // }
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('monitor::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('monitor::create');
    }



    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('monitor::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('monitor::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
