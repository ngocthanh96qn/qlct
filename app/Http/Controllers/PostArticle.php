<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\PostToPage;
use App\ConfigSystem;
use App\InfoArticle;
use App\Page;
use Auth;
class PostArticle extends Controller
{
    public function createPost(){
      $pages = Page::where('user_id','=',Auth::user()->id)->get();
      $InfoArticles = InfoArticle::where('user_id','=',Auth::user()->id)->orderBy('created_at', 'desc')->get();
    	return view('pages.createPost',['pages'=>$pages,'infoArticles'=>$InfoArticles]);
    }
    
    public function PostToPage(PostToPage $request){
      foreach ($request->pages as $id_page => $name_account) {
       $account = ConfigSystem::where('name_FB','=',$name_account)->where('user_id','=',Auth::user()->id)->get();
       $access_token = $account[0]->token;
      $response = Http::get('https://graph.facebook.com/'.$id_page.'?fields=access_token&access_token='.$access_token);
         $token_page = $response->json()['access_token'];

         $response = Http::post('https://graph.facebook.com/'.$id_page.'/feed/', [
            'message' => $request->caption,
            'access_token' => $token_page,
            'link'=> $request->link,
        ]);
         $page = Page::where('id_page','=',$id_page)->get();

         $data=['user_id'=>Auth::user()->id,'caption'=>$request->caption,'name_page'=>$page[0]->name,'id_page'=>$id_page,'account'=>$name_account ,'link'=>$response->json()['id']];
         InfoArticle::create($data);
      }
      $status = ['kq'=>'success','text'=>'Đăng thành công!'];
      return redirect()->back()->with(['status'=>$status]);    
    }

    public function DeletePost($id){
      $infoDelete = InfoArticle::find($id);


      $account = ConfigSystem::where('name_FB','=',$infoDelete->account)->where('user_id','=',Auth::user()->id)->get();
      $access_token = $account[0]->token;

      $response = Http::get('https://graph.facebook.com/'.$infoDelete->id_page.'?fields=access_token&access_token='.$access_token);
      $token_page = $response->json()['access_token'];
      $response = Http::delete('https://graph.facebook.com/'.$infoDelete->link.'?access_token='.$token_page);
      if(isset($response->json()['success'])){
        $infoDelete->delete();
        $status = ['kq'=>'success','text'=>'Xóa thành công!'];
        return redirect()->back()->with(['status'=>$status]);  
      }
      else {
       $infoDelete->delete();
       $status = ['kq'=>'failed','text'=>'Xóa Thất bại, bài viết không tồn tại!'];
       return redirect()->back()->with(['status'=>$status]); 
     }

   }

}
