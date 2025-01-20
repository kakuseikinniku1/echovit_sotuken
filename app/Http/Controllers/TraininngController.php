<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorys;
use App\Http\Requests\traininngRequest;
use App\Models\User;
use App\Models\Movie;
use App\Models\Comment;
use App\Models\Favorite;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Mail\FogetPassword;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Http\Requests\ResetInputMailRequest;
use App\Mail\ResetPasswordMail;
use App\Models\Profile;
use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Support\Facades\Log;
use Exception;


class TraininngController extends Controller
{
    function registration(){
        return view("traininng.sinkitouroku");
    }
    function login(){
        return view("traininng.roguinn");
    }
    function index(){
        $categorys = Categorys::get()->take(3);
        $movies = Movie::where("movieCount", 1)->take(6)->get();
        $favorites = Favorite::where("userId", Auth::id())->take(3)->get();
        $id = Auth::id();
        return view("traininng.main", compact("categorys", "movies", "favorites", "id"));
    }

    function store(traininngRequest $request){
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->save();
        $profile = new Profile();
        $profile->name = $request->input("name");
        $profile->userId = $user->id;
        $profile->save();
        return view("traininng.roguinn");
    }

    function logincharenge(Request $request){
        $credentials = $request->only("email", "password");
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect("/");
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function destroy()
    { 
        Auth::logout();
 
        return redirect('/');
     }

     function uplode(){
        $categorys = Categorys::all();
        return view("traininng.uplode", compact("categorys"));
     }

     function checkUplode(Request $request){
        try{
            $validated = $request->validate([
                'title' => 'required|max:255',
                'lessonName' => 'required|max:255',
                'content' => 'required|max:255',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4194304',
                'movie' => 'required|mimes:mp4,mkv,avi,webm|max:4194304',
            ]);
            $imagefile = $request->file('image')->getClientOriginalExtension();
            $moviefile = $request->file('movie')->getClientOriginalExtension();
            $user = Auth::id();
            if(!Movie::where("lesson", $request->lessonName)->where("user_id", Auth::id())->exists()){
                $path = $request->file('image')->storeAs("{$user}/{$request->lessonName}/images", "{$request->title}.{$imagefile}","public");
                $path = $request->file('movie')->storeAs("{$user}/{$request->lessonName}/movies", "{$request->title}.{$moviefile}","public");
                $movie = Movie::create([
                    "user_id"=>Auth::id(),
                    "movieCount"=>1,
                    "lesson" => $request->lessonName,
                    "title" => $request->title,
                    "content" => $request->content,
                    "category" => $request->category,
                    "image" => "{$user}/{$request->lessonName}/images/{$request->title}.{$imagefile}",
                    "movie" => "{$user}/{$request->lessonName}/movies/{$request->title}.{$moviefile}"
                ]);
            }
            else{
                $movie = Movie::where("user_id", Auth::id())->where("lesson", $request->lessonName)->orderBy('movieCount', 'desc')->first();
                $cnt = intval($movie->movieCount) + 1;
                $imagefile = $request->file('image')->getClientOriginalExtension();
                $movie = $request->file('movie')->getClientOriginalExtension();
                $movie = Movie::create([
                    "user_id"=>Auth::id(),
                    "movieCount"=>$cnt,
                    "lesson" => $request->lessonName,
                    "title" => $request->title,
                    "content" => $request->content,
                    "category" => $request->category,
                    "image" => "{$user}/{$request->lessonName}/images/{$request->title}{$cnt}.{$imagefile}",
                    "movie" => "{$user}/{$request->lessonName}/movies/{$request->title}{$cnt}.{$moviefile}"
                ]);

                $path = $request->file('image')->storeAs("{$user}/{$request->lessonName}/images", "{$request->title}{$cnt}.{$imagefile}","public");
                $path = $request->file('movie')->storeAs("{$user}/{$request->lessonName}/movies", "{$request->title}{$cnt}.{$moviefile}","public");
        }
        return redirect("/");
    }catch (Exception $e) {
            return back()->withErrors([
                'error' => 'Images and videos are required, please submit within 4GB.',
            ]);
        }
     }

     function management(){
        $myMovie = Movie::where("user_id", Auth::id())->where("movieCount", 1)->get();
        $id = Auth::id();
        // dd($myMovie);
        return view("traininng.management", compact("myMovie", "id"));
     }

     function managementShow($lesson){
        $myMovie = Movie::where("user_id", Auth::id())->where("lesson", $lesson)->get();
        $id = Auth::id();
        return view("traininng.managementShow", compact("myMovie", "lesson", "id"));
     }

     function managementEdit($id){
        $editMovie = Movie::find($id);
        $id = Auth::id();
        return view("traininng.managementEdit", compact("editMovie", "id"));
     }

     function editMovie(Request $request){
        $movie = Movie::find($request->id);
        $movie->title = $request->title;
        $movie->content = $request->content;

        if($request->file("image") != null){
            $user = Auth::id();
            $imagefile = $request->file('image')->getClientOriginalExtension();
            $movie->image = "{$user}/{$request->lessonName}/images/{$request->title}{$request->cnt}.{$imagefile}";
        $path = $request->file('image')->storeAs("{$user}/{$request->lessonName}/images", "{$request->title}{$request->cnt}.{$imagefile}","public");
        }

        $movie->save();
        return redirect("/");
        
     }

     function deleatMovie($id){
        Storage::disk('public')->delete(Movie::find($id)->movie);
        Storage::disk('public')->delete(Movie::find($id)->image);
        $m = Movie::where("user_id", Auth::id())->where("title", Movie::find($id)->title)->get();
        $deleteMovieCount = Movie::find($id)->movieCount;
        $cnt = 1;
        foreach($m as $n){
            if ($cnt <= $deleteMovieCount){
                $cnt = $cnt + 1;
                continue;
            }
            $n->movieCount = $n->movieCount - 1;
            $n->save();
        }
        $favorite = Favorite::where("movieId", $id)->delete();
        $movie = Movie::destroy($id);
        return redirect('/');
     }

     function showMovie($id){
        $m = Movie::find($id);
        $movies = Movie::where("user_id", $m->user_id)->where("lesson", $m->lesson)->orderBy('movieCount', 'asc')->get();
        $comments = Comment::where("movieid", $id)->get();
        $favorite = Favorite::where("movieId", $id)->first();
        $profile = Profile::where("userId", $m->user_id)->first();
        $id = Auth::id();
        return view("traininng.dougagaiyou", compact("m", "movies", "comments", "favorite", "profile", "id"));
     }

     function addComment(Request $request){
        $comment = Comment::create([
            "movieid" => $request->movieid,
            "userName" => Auth::user()->name,
            "comment" => $request->comment,
        ]);
        return back();
        // "{{route('showMovie', ['id'=>$movie->id])}}"
     }

     function addfavorite($id){
        $f = Favorite::create([
            "userId" => Auth::id(),
            "movieId" => $id
        ]);
        return back();
     }

     function dellfavorite($id){
        Favorite::where("movieId", $id)->first()->delete();
        return back();
     }

     function category($id){
        $movies = Movie::where("category", $id)->get();
        $title = Categorys::where("categoryId", $id)->first()->categoryName;
        $id = Auth::id();
        return view("traininng.category", compact("movies", "title", "id"));
     }

     function search(){
        return view("traininng.search");
     }

     function searchCharenge(Request $request){
        $movies = Movie::where('lesson', 'LIKE', "%{$request->search}%")->get();
        $title = $request->search;
        $id = Auth::id();
        return view("traininng.kensaku", compact("movies", "title", "id"));
     }

	/**
     * パスワードリセット
     */
    private $userRepository;
    private const MAIL_SENDED_SESSION_KEY = 'user_reset_password_mail_sended_action';

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    // パスワード再設定用のメール送信フォーム
    public function requestResetPassword()
    {
        return view('users.reset_input_mail');
    }

    //  メール送信 
    public function sendResetPasswordMail(Request $request)
    {
          /* ③ここから追加 */
          try {
            // ユーザー情報取得
             $user = $this->userRepository->findFromMail($request->mail);
             $userToken = $this->userRepository->updateOrCreateUser($user->id);
            // メール送信
            Log::info(__METHOD__ . '...ID:' . $user->id . 'のユーザーにパスワード再設定用メールを送信します。');
            Mail::send(new ResetPasswordMail($user, $userToken));
            Log::info(__METHOD__ . '...ID:' . $user->id . 'のユーザーにパスワード再設定用メールを送信しました。');
        } catch(Exception $e) {
            Log::error(__METHOD__ . '...ユーザーへのパスワード再設定用メール送信に失敗しました。 request_email = ' . $request->mail . ' error_message = ' . $e);
            return redirect()->route('reset.form')->withErrors([
                'email' => 'アカウントが登録されていません',
            ]);
        }
        // 不正アクセス防止セッションキー
        session()->put(self::MAIL_SENDED_SESSION_KEY, 'user_reset_password_send_email');
        return redirect()->route('reset.send.complete');
    }

    // メール送信完了
    public function sendCompleteResetPasswordMail()
    {
        if (session()->pull(self::MAIL_SENDED_SESSION_KEY) !== 'user_reset_password_send_email') {
            return redirect()->route('reset.form')->withErrors([
                'token' => '不正なリクエストです',
            ]);
        }
        return view('users.reset_input_mail_complete');
    }

    // パスワード再設定
    public function resetPassword(Request $request)
    {
        // 署名付きURLではない場合
    	if (!$request->hasValidSignature()) {
            abort(403, 'URLの有効期限が過ぎたためエラーが発生しました。パスワード再設定メールを再発行してください。');
        }
        $resetToken = $request->query('reset_token');;
        try {
            // ユーザー情報取得
            $userToken = $this->userRepository->getUserTokenFromUser($resetToken);
            $userMail = User::where("password", $resetToken)->first()->email;
        } catch (Exception $e) {
            return redirect()->route('reset.form')->withErrors([
                'email' => 'アカウントが登録されていません',
            ]);
        }
        
        return view('users.reset_input_password', compact('userToken', 'userMail'));
    }

    // パスワード更新
    public function updatePassword(Request $request)
    {
        try {
            // ユーザー情報取得
            $validated = $request->validate([
                'password' => 'required|max:255|min:8',
            ]);
            $user = User::where("email", $request->email)->first()->update(["password" => $request->password]);
        } catch (Exception $e) {
            Log::error(__METHOD__ . '...ユーザーのパスワードの更新に失敗しました。...error_message = ' . $e);
            return back()->withErrors([
                'password' => 'password error',
            ]);
        }

        return view('users.reset_input_password_complete');
    }

    function mainlist(){
        $movies = Movie::where("movieCount", 1)->get();
        $id = Auth::id();
        return view("traininng.mainlist", compact("movies", "id"));
    }
    function categorylist(){
        $id = Auth::id();
        $categorys = Categorys::get();
        return view("traininng.categorylist", compact("categorys", "id"));
    }
    function favoritelist(){
        $favorites = Favorite::where("userId", Auth::id())->get();
        $id = Auth::id();
        return view("traininng.favoritelist", compact("favorites", "id"));
    }
    function profile($id){
        $profile = Profile::where("userId", $id)->first();
        $movies = Movie::where("user_id", $id)->where("movieCount", 1)->get(); 
        $myId = Auth::id();
        return view("traininng.profile", compact("profile", "movies", "myId", "id"));
    }

    function profileUpdate($id){
        $profile = Profile::where("userId", $id)->first();
        return view("traininng.profileUpdate", compact("profile", 'id'));
    }

    function profileup(Request $request){
        $id = Auth::id();
        if($request->image != null){
            $imagefile = $request->file('image')->getClientOriginalExtension();
            $profile = Profile::where("userId", $id)->first()->update([
                "name" => $request->name,
                "content" => $request->content,
                "explain" => $request->explain,
                "image" => "{$id}/profile/profile.{$imagefile}"
            ]);
            $path = $request->file('image')->storeAs("{$id}/profile", "profile.{$imagefile}","public");
        
        }else{
            $profile = Profile::where("userId", $id)->first()->update([
                "name" => $request->name,
                "content" => $request->content,
                "explain" => $request->explain,
            ]);
        }
        return redirect("/profile/{$id}");
    }
}