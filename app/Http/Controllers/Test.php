<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
include_once './simple_html_dom.php';
class Test extends Controller
{
    public function uploadVideo(){
    	$access_token = 'EAAKGZAc6bPdUBAMbanQGcPDWRV6mvEQ5RhxeoXqtglItvDHBkXbzIMkhr9kULpKT8frGcPACEQbZANCvCNHQeqdskO3yLNemZAzsZCv42ZBRXTVMIBCrC52HsOljV8LvXr7athFzmLS1kzRLTKGCU88PbhzPDYLV4tN888lRuxQZDZD';
    	$id_page = '104219037586480'; //ô tô fun
    	$response = Http::get('https://graph.facebook.com/'.$id_page.'?fields=access_token&access_token='.$access_token);
         $token_page = $response->json()['access_token'];

         $response = Http::post('https://graph-video.facebook.com/v8.0/'.$id_page.'/videos', [
            'upload_phase' => 'start',
            'access_token' => $token_page,
            'file_size'=> '691508',
        ]);
         dd($response->json());
    } 
    public function upPhoto(Request $request){
      dd($request);
        if ($request->file($avatar)->isValid()){
            // Lấy tên file
            $file_name = $request->file($avatar)->getClientOriginalName();
            dd($file_name);
            // Lưu file vào thư mục upload với tên là biến $filename
            $request->file($name)->move('upload',$file_name);
        }

    	$access_token = 'EAAKGZAc6bPdUBAMbanQGcPDWRV6mvEQ5RhxeoXqtglItvDHBkXbzIMkhr9kULpKT8frGcPACEQbZANCvCNHQeqdskO3yLNemZAzsZCv42ZBRXTVMIBCrC52HsOljV8LvXr7athFzmLS1kzRLTKGCU88PbhzPDYLV4tN888lRuxQZDZD';
    	$id_page = '104219037586480'; //ô tô fun
    	$response = Http::get('https://graph.facebook.com/'.$id_page.'?fields=access_token&access_token='.$access_token);
         $token_page = $response->json()['access_token'];
          // dd($token_page);
         $response = Http::post('https://graph.facebook.com/'.$id_page.'/photos/', [
            'published' => 'true',
            'access_token' => $token_page,
            'url'=> 'http://thoithanhxuan.com/wp-content/uploads/2020/10/122704686_420582366004724_3284785554116213262_o-255x300.jpg',
        ]);
          dd($response->json());
    }
    
    public function getPage(){
      $access_token = 'EAAKGZAc6bPdUBAMbanQGcPDWRV6mvEQ5RhxeoXqtglItvDHBkXbzIMkhr9kULpKT8frGcPACEQbZANCvCNHQeqdskO3yLNemZAzsZCv42ZBRXTVMIBCrC52HsOljV8LvXr7athFzmLS1kzRLTKGCU88PbhzPDYLV4tN888lRuxQZDZD';
      $id_page = '318385568768613'; //ccc
      $response = Http::get('https://graph.facebook.com/'.$id_page.'?fields=access_token&access_token='.$access_token);
         $token_page = $response->json()['access_token'];

      $response = Http::get('https://graph.facebook.com/'.$id_page.'/posts?fields=status_type,permalink_url,attachments,message,full_picture&access_token='.$token_page); //lấy bài viết
      // $response = Http::get('https://graph.facebook.com/318385568768613_452551955351973?fields=likes.summary(true)&access_token='.$token_page); 
      // $response = Http::get('https://graph.facebook.com/v8.0/318385568768613_447911692482666/reactions?access_token='.$access_token); 
    
        
         dd($response->json());
    }

}
