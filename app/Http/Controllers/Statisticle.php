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
       public function GetBetween($content,$start,$end){
            $r = explode($start, $content);
            if (isset($r[1])){
                $r = explode($end, $r[1]);
                return $r[0];
            }
            return 'false' ;
        }
    public function viewPage(ViewPageRequest $request){
    	$id_page = $this->GetBetween($request->page,'/','//');
    	$token_page = $this->GetBetween($request->page,'//','/');
    	$response = Http::get('https://graph.facebook.com/'.$id_page.'/posts?fields=created_time,updated_time,status_type,permalink_url,attachments,message,full_picture&access_token='.$token_page); //lấy bài viết
    	$listPost = $response->json();
    	// dd($listPost);
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
    				'time'=>$post['updated_time'],
    				'ia' => '',
    			];	
    		}
    		if ($post['status_type']=='shared_story') {
    			if ($post['attachments']['data'][0]['type']=='instant_article_legacy') {
    				$listInfo[] = [
    				'type'=>'Share Link',
    				'caption'=>$post['message'],
    				'link'=>$post['permalink_url'],
    				'img'=>asset('image/link.jpg'),
    				'time'=>$post['updated_time'],
    				'ia' => asset('image/ia.png'),
    			];	
    			}
    			else {
    				$listInfo[] = [
    				'type'=>'Share Link',
    				'caption'=>$post['message'],
    				'link'=>$post['permalink_url'],
    				'img'=>asset('image/link.jpg'),
    				'time'=>$post['updated_time'],
    				'ia' => '',
    			];	
    			}	
    		}
    		if ($post['status_type']=='added_photos') {

    			$listInfo[] = [
    				'type'=>'Photo',
    				'caption'=>$post['message'],
    				'link'=>$post['permalink_url'],
    				'img'=>$post['full_picture'],
    				'time'=> $post['updated_time'],
    				'ia' => '',
    			];	

    		}
    		
    	}
    	$data[] = $listInfo;
    	$data[] = $listPost['paging'];
    	
	return redirect()->route('menu.ShowPage')->with('data',$data);
    }
}
