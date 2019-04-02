<?php
namespace App\Http\Controllers;

use Storage;
use Avatar;
use App\ProfilePic;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
use App\Notifications\SignupActivate;

class AuthController extends Controller
{
    /**
     * Create user
     *
     * @param  [string] name
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] message
     */
    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'phone' => 'required|digits:11',
            // 'avatar' => 'image|nullable|max:1999',
            'address' => 'required|min:6|max:50',
            'password' => 'required|string|confirmed'
        ]);

        \DB::beginTransaction();
        $user = new User();
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->password = bcrypt($request->password);
        $user->activation_token = str_random(60);
        $user->save();
        

        $png_url = "/user/" . time() . "_" .$user->id. ".png";
        $path = "/public" . $png_url;
        $avatar = Avatar::create($user->name)->getImageObject()->encode('png');
        Storage::put($path, (string) $avatar);

        $pic = new ProfilePic();
        $pic->user_id = $user->id;
        $pic->path = $png_url;
        
        if (!$pic->save()){
            \DB::rollBack();}

        \DB::commit();
        
        

        $user->notify(new SignupActivate($user));

        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }



    public function signupActivate($token)
    {
        $user = User::where('activation_token', $token)->first();
        if (!$user) {
            return response()->json([
                'message' => 'This activation token is invalid.'
            ], 404);
        }
        $user->active = true;
        $user->activation_token = '';
        $user->save();
        return $user;
    }
  
    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);

        $credentials = request(['email', 'password']);
        $credentials['active'] = 1;
        $credentials['deleted_at'] = null;

        if(!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
            
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }
  
    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
  
    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }
    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'name' => 'nullable|string',
            'email' => 'nullable|string|email|unique:users',
            'phone' => 'nullable|digits:11',
            'avatar' => 'image|nullable|max:1999',
            'address' => 'nullable|min:6|max:50',
        ]);
        \DB::beginTransaction();
        
        $food->update($request->all());

        if ($request->avatar) {
            $user->profile_pics->delete();
            
                $png_url = "/user/" .time() . "_" .$user->id. ".png";
                $path = public_path() . "/storage" . $png_url;
                
                $data = $request->avatar;
                $data = base64_encode($data);
                $data = base64_decode($data);
                Image::make($data)->fit(500, 500)->save($path);
                $img = \DB::table('Profile_pics')->where('user_id', $user)->first();
                Image::make($data)->fit(500, 500)->save($path);
                $img = new ProfilePic();
                $img->path = $png_url;
                $img->user_id = $user->id;
                if (!$img->save())
                    \DB::rollBack();
        }
        \DB::commit();

    }
}