<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Http\Requests\ViewPageRequest;
use App\ConfigSystem;
use Auth;
use App\InfoArticle;
use App\Page;
use DateTime;
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
     public function GetInfoPost($listPost,$token_page){
     	foreach ($listPost['data'] as $key => $post) {

     	$response = Http::get('https://graph.facebook.com/v8.0/'.$post['id'].'/comments?summary=order,total_count&access_token='.$token_page);
     	$cmt = $response->json()['summary']['total_count'];
     	$listPost['data'][$key]['cmt']=$cmt;
     	$response = Http::get('https://graph.facebook.com/v8.0/'.$post['id'].'/reactions?&summary=total_count,viewer_reaction&access_token='.$token_page);
     	$reaction = $response->json()['summary']['total_count'];
     	$listPost['data'][$key]['reaction']=$reaction;
     	}
     	return $listPost;
     	dd($listPost);
     	dd($response->json());
      
     }
     public function FilterData($listPost,$token_page){
     			$listInfo=[];
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
    				'cmt'=>$post['cmt'],
    				'reaction'=>$post['reaction'],
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
    				'cmt'=>$post['cmt'],
    				'reaction'=>$post['reaction'],
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
    				'cmt'=>$post['cmt'],
    				'reaction'=>$post['reaction'],
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
    				'cmt'=>$post['cmt'],
    				'reaction'=>$post['reaction'],
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
    	$response = Http::get('https://graph.facebook.com/'.$id_page.'/posts?fields=created_time,status_type,permalink_url,attachments,message,full_picture&limit=50&access_token='.$token_page); //lấy bài viết
    	$listPost = $response->json();
    	$listPost = $this->GetInfoPost($listPost,$token_page);
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

    public function Statisticle(){

         $pages = Page::where('user_id','=',Auth::user()->id)->get();
         $data_day = [];
         foreach ($pages as $key => $page) {
         $data_day[$key]['name_page']= $page->name;
         $account = ConfigSystem::where('name_FB','=',$page->account)->where('user_id','=',Auth::user()->id)->get(); //lây access_token
         $access_token = $account[0]->token;
         $response = Http::get('https://graph.facebook.com/v8.0/'.$page->id_page.'?fields=access_token&access_token='.$access_token);
         $token_page = $response->json()['access_token']; 
         //lây bai viet
         $response = Http::get('https://graph.facebook.com/v8.0/'.$page->id_page.'/posts?fields=created_time,status_type,permalink_url,attachments,message,full_picture&limit=10&access_token='.$token_page); //lấy bài viết
        $listPost = $response->json();

        $period = $this->getDay('today');
        $listPostPeriod = $this->getPostPeriod($period,$listPost);
        $data_day[$key]['today'] = $listPostPeriod;   

         $period = $this->getDay('week');
        $listPostPeriod = $this->getPostPeriod($period,$listPost);
        $data_day[$key]['week']=$listPostPeriod;

         $period = $this->getDay('month');
        $listPostPeriod = $this->getPostPeriod($period,$listPost);
        $data_day[$key]['month']=$listPostPeriod;
        }
        dd($data_day);

        $name_page =['Trang test 1'=>[3,5,7,7,2,4,6],'Trang test 2'=>[3,5,7,3,2,2,6],'Trang test 3'=>[3,5,9,3,2,4,6]];
       foreach ($name_page as $name => $data) {
          $data_page[] = ['name'=> $name,'data'=> $data];
       }
        $data_page = json_encode($data_page);
        return view('pages.satatis_page',['data_page'=>$data_page]);
    }

    public function getPostPeriod($period,$listPost){
        $count=0;
        foreach ($period as $key => $day) { //loc ngay
            $listPostPeriod[$day] =[];
            foreach ($listPost['data'] as $key => $post) { 
                if (strpos($post['created_time'], $day) !== false) {
                    $listPostPeriod[$day]['post'][] = $post;
                    }   
            }
            if (isset($listPostPeriod[$day]['post'])) {
               $listPostPeriod[$day]['count']= count($listPostPeriod[$day]['post']);
            }else {
                 $listPostPeriod[$day]['count']= 0;
            }
             
             // dd( $listPostPeriod);
        }
        return $listPostPeriod;
    }

     public function getDay($period){
        
        switch ($period) {
           
            case 'today':
            $date = new DateTime('0 days ago');
            $date = $date->format('Y-m-d');
            $today[] = $date;
                return $today;
                break;
            case 'week':
                for ($i=1; $i < 8 ; $i++) { 
                    $date = new DateTime($i.'days ago');
                    $date = $date->format('Y-m-d');
                    $week[] = $date;
                }
                return $week;
                break;
            case 'month':
                for ($i=1; $i < 31 ; $i++) { 
                    $date = new DateTime($i.'days ago');
                    $date = $date->format('Y-m-d');
                    $month[] = $date;
                }
                return $month;
                break;
            default:
                # code...
                break;
        }
     }
}
