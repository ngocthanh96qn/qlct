<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\ConfigSystem;
use App\Page;
class PostArticle extends Controller
{
    public function createPost(){
      $pages = Page::all();
    	return view('pages.createPost',['pages'=>$pages]);
    }
    
    public function handleData(Request $request){
      dd($request->toArray());
    		$access_token = 'EAAKGZAc6bPdUBAMbanQGcPDWRV6mvEQ5RhxeoXqtglItvDHBkXbzIMkhr9kULpKT8frGcPACEQbZANCvCNHQeqdskO3yLNemZAzsZCv42ZBRXTVMIBCrC52HsOljV8LvXr7athFzmLS1kzRLTKGCU88PbhzPDYLV4tN888lRuxQZDZD';
    	$id_page = '104219037586480'; //ô tô fun
    	$response = Http::get('https://graph.facebook.com/'.$id_page.'?fields=access_token&access_token='.$access_token);
         $token_page = $response->json()['access_token'];
          // dd($token_page);
         $response = Http::post('https://graph.facebook.com/'.$id_page.'/feed/', [
            'message' => 'test Link',
            'access_token' => $token_page,
            'link'=> $request->link,
        ]);
          dd($response->json());
    }
}
