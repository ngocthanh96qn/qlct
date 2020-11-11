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
    public function getToken(){
        $listToken = ConfigSystem::where('user_id','=',Auth::user()->id)->get();

        return view('pages.setup_token',['listToken'=>$listToken]);
    }

    public function getPageIa()  //lấy page ở menu chọn page cài đặt Ia
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

    public function getPage() //lấy page, ở menu chọn page làm việc
    {
        $listToken = ConfigSystem::where('user_id','=',Auth::user()->id)->get();
        // dd($listToken);
        foreach ($listToken as $key => $token) {
               $response = Http::get('https://graph.facebook.com/'.$token->id_userFB.'/accounts?access_token='.$token->token);
            if(isset($response->json()['error']))
            {
                $errorToken = 'true';
                return view('pages.setup_page',['errorToken'=>$errorToken]);
            }
            else {
                foreach ($response->json()['data'] as $key => $page) {
                    $page['account'] =  $token->name_FB;
                    $pages[] = $page;
                }
               
                $errorToken = 'false';
            }
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
        
        $response = 
         Http::get('https://graph.facebook.com/v8.0/oauth/access_token?grant_type=fb_exchange_token&client_id='.$app_id.'&client_secret='.$app_secret.'&fb_exchange_token='.$request->tokenFB);
         if($response->json()['token_type']=='bearer') {
                $data = ['user_id'=>Auth::user()->id,'token'=>$response->json()['access_token'],'name_FB'=>$request->nameFB,'app_id'=>$app_id,'app_secret'=>$app_secret];       
                ConfigSystem::UpdateOrCreate(['id_userFB'=>$request->userIdFb],$data);
                $listToken = ConfigSystem::where('user_id','=',Auth::user()->id)->get();
                return view('pages.setup_token',['status'=>'success','msg'=>'Cài Đặt Thành Công','listToken'=>$listToken]);
         }
         else {
            return view('pages.setup_token',['status'=>'failed','msg'=>'Lỗi Thiết Lập Token Dài Hạn']);
         }
        
    
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
