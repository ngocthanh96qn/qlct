<?php

namespace App\Http\Controllers;

use App\ConfigSystem;
use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Auth;
class ConfigSystemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPageIa()
    {
        $info = ConfigSystem::all()->first();
        $response = Http::get('https://graph.facebook.com/'.$info->id_userFB.'/accounts?access_token='.$info->token);
        if(isset($response->json()['error']))
        {
            $errorToken = 'true';
        }
        else {
            $pages = $response->json()['data'];
            $errorToken = 'false';
        }
        
       return view('pages.setup_ia',['errorToken'=>$errorToken,'pages'=>$pages]);
    }

    public function getPage()
    {
        $info = ConfigSystem::all()->first();
        $response = Http::get('https://graph.facebook.com/'.$info->id_user.'/accounts?access_token='.$info->token);
        if(isset($response->json()['error']))
        {
            $errorToken = 'true';
        }
        else {
            $pages = $response->json()['data'];
            $errorToken = 'false';
        }
        // dd($pages);
       return view('pages.setup_page',['errorToken'=>$errorToken,'pages'=>$pages]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeToken(Request $request)
    {
        $app_id = '710721769520597';
        $app_secret = '490f939d0a0d39df163acededd229c4b';
        $id_userFB= '1735273423287825';
        // $response = 
        //  Http::get('https://graph.facebook.com/v8.0/oauth/access_token?grant_type=fb_exchange_token&client_id='.$app_id.'&client_secret='.$app_secret.'&fb_exchange_token='.$request->token_fb);
        $data = ['user_id'=>Auth::user()->id,'token'=>'EAAKGZAc6bPdUBAMbanQGcPDWRV6mvEQ5RhxeoXqtglItvDHBkXbzIMkhr9kULpKT8frGcPACEQbZANCvCNHQeqdskO3yLNemZAzsZCv42ZBRXTVMIBCrC52HsOljV8LvXr7athFzmLS1kzRLTKGCU88PbhzPDYLV4tN888lRuxQZDZD','id_userFB'=>$id_userFB,'app_id'=>$app_id,'app_secret'=>$app_secret];
        ConfigSystem::truncate();
        ConfigSystem::create($data);

        return view('pages.setup_token',['status'=>'success']);
    
    }
    public function storeIa(Request $request) {
        dd($request->toArray());
    }

    public function storePage(Request $request) {
        foreach ($request->data as $key => $value) {
           $data[]=['name'=>$key, 'id_page'=>$value];
        }
        Page::truncate();
        Page::insert($data);
        return redirect()->back();
        
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\ConfigSystem  $configSystem
     * @return \Illuminate\Http\Response
     */
    public function show(ConfigSystem $configSystem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ConfigSystem  $configSystem
     * @return \Illuminate\Http\Response
     */
    public function edit(ConfigSystem $configSystem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ConfigSystem  $configSystem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ConfigSystem $configSystem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ConfigSystem  $configSystem
     * @return \Illuminate\Http\Response
     */
    public function destroy(ConfigSystem $configSystem)
    {
        //
    }
}
