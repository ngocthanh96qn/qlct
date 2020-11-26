<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Http\Requests\ViewPageRequest;
use App\ConfigSystem;
use Auth;
class Statisticle extends Controller
{
    public function showPage(){
    	$listToken = ConfigSystem::where('user_id','=',Auth::user()->id)->get();
    	return view('pages.show_page',['listToken'=>$listToken]);
    }
    public function StatisticleGetPage(Request $request){
    	$token = ConfigSystem::where('id_userFB','=',$request->id_user)->get();

    	$response = Http::get('https://graph.facebook.com/'.$token[0]->id_userFB.'/accounts?access_token='.$token[0]->token);
    	return response()->json([
          'listPage' => $response->json(),
          
      ]);
    }
    public function Pagination(Request $request){
    	$link =$request->link;
    	$token_page = $request->token;
    	$response = Http::get($request->link);
    	$listPost = $response->json();
		$data = $this->FilterData($listPost,$token_page);
	return redirect()->route('menu.ShowPage')->with('data',$data);
    }
    public function GetBetween($content,$start,$end){
            $r = explode($start, $content);
            if (isset($r[1])){
                $r = explode($end, $r[1]);
                return $r[0];
            }
            return 'false' ;
        }
     public function FilterData($listPost,$token_page){
     	    	foreach ($listPost['data'] as $key => $post) {
    		if (!isset($post['message'])) {
    			$post['message']='';
    		}
    		if (!isset($post['full_picture'])) {
    			$post['full_picture']='';
    		}
    		if ($post['status_type']=='added_video') {
    			$listInfo[] = [
    				'type'=>'video',
    				'caption'=>$post['message'],
    				'link'=>$post['permalink_url'],
    				'img'=>asset('image/video.jpg'),
    				'time'=>$post['created_time'],
    				'ia' => '',
    				'id'=>$post['id'],
    				'stt'=>$key+1
    			];	
    		}
    		if ($post['status_type']=='shared_story') {
    			if ($post['attachments']['data'][0]['type']=='instant_article_legacy') {
    				$listInfo[] = [
    				'type'=>'Share Link',
    				'caption'=>$post['message'],
    				'link'=>$post['permalink_url'],
    				'img'=>asset('image/link.jpg'),
    				'time'=>$post['created_time'],
    				'ia' => asset('image/ia.png'),
    				'id'=>$post['id'],
    				'stt'=>$key+1
    			];	
    			}
    			else {
    				$listInfo[] = [
    				'type'=>'Share Link',
    				'caption'=>$post['message'],
    				'link'=>$post['permalink_url'],
    				'img'=>asset('image/link.jpg'),
    				'time'=>$post['created_time'],
    				'id'=>$post['id'],
    				'ia' => '',
    				'stt'=>$key+1
    			];	
    			}	
    		}
    		if ($post['status_type']=='added_photos') {

    			$listInfo[] = [
    				'type'=>'Photo',
    				'caption'=>$post['message'],
    				'link'=>$post['permalink_url'],
    				'img'=>$post['full_picture'],
    				'time'=> $post['created_time'],
    				'id'=>$post['id'],
    				'ia' => '',
    				'stt'=>$key+1
    			];	

    		}
    		
    	}
    	$data[] = $listInfo;
    	$data[] = $listPost['paging'];
    	$data[] = $token_page;
    	return $data;
     }
    public function viewPage(ViewPageRequest $request){
    	$id_page = $this->GetBetween($request->page,'/','//');
    	$token_page = $this->GetBetween($request->page,'//','/');
    	$response = Http::get('https://graph.facebook.com/'.$id_page.'/posts?fields=created_time,status_type,permalink_url,attachments,message,full_picture&limit=100&access_token='.$token_page); //lấy bài viết
    	$listPost = $response->json();
    	$data = $this->FilterData($listPost,$token_page);
	return redirect()->route('menu.ShowPage')->with('data',$data);
    }

    public function DeletePost(Request $request){
    
    	$response = Http::delete('https://graph.facebook.com/'.$request->id.'?access_token='.$request->token_page);
    

      if(isset($response->json()['success'])){
        return response()->json(['status' => 'success',]);  
      }
      else {
      return response()->json(['status' => 'failed',]); 
     }
    }
}
