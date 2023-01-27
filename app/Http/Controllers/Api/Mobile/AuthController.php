<?php

namespace App\Http\Controllers\Api\Mobile;

use App\User;
use Carbon\Carbon;
use Lcobucci\JWT\Parser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;


class AuthController extends Controller
{
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
    public function signin(Request $request)
    {

        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);

        $credentials = request(['email', 'password']);
        $credentials['active'] = 1;
        $credentials['deleted_at'] = null;

        if (!Auth::attempt($credentials)) {
            if (User::where('email', $request->email)->first() != null && User::where('email', $request->email)->first()->active != 1) {
                /**
                 * Account does exist but the password might miss type
                 */
                return response()->json([
                    'message' => 'អ្នកមិនទាន់បានបញ្ជាក់ អំពីការចុះឈ្មោះនៅឡើយ។ សូមបញ្ចាក់ការចុះឈ្មោះរបស់អ្នកជាមុនសិន !'
                ], 401);
            } else if (User::where('email', $request->email)->first() != null) {
                /**
                 * Account does exist but the password might miss type
                 */
                return response()->json([
                    'message' => 'សូមពិនិត្យពាក្យសម្ងាត់របស់អ្នក !'
                ], 401);
            } else {
                /**
                 * Account does exist but the password might miss type
                 */
                return response()->json([
                    'message' => 'អ៊ីមែលរបស់អ្នកមិនមានក្នុងប្រព័ន្ធឡើយ !'
                ], 401);
            }
        }

        $user = $request->user();

        // $tokenResult = $user->createToken('Personal Access Token');
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addDay();
        $token->save();

        $user = Auth::user();
        if ($user) {
            if (Storage::disk(env('FILESYSTEM_DRIVER','public'))->exists($user->avatar_url)) {
                $user->avatar_url = Storage::disk(env('FILESYSTEM_DRIVER','public'))->url($user->avatar_url);
            }
            else{
                $user->avatar_url = null ;
            }
        }

        return response()->json([
            'token' => [
                'access_token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse(
                    $tokenResult->token->expires_at
                )->toDateTimeString()
            ],
            'user' => $user,
            'message' => 'ចូលប្រើប្រាស់បានជោគជ័យ !'
        ], 200);

    }
    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function signout(Request $request)
    {
        if( $request->user() != null ){
            $value = $request->bearerToken();
            if ($value) {
                $id = (new Parser())->parse($value)->getHeader('jti');
                $token = $request->user()->tokens()->find($id);
                $token->revoke();
                $request->user()->token()->revoke();
                return response()->json([
                    // 'message' => 'អ្នកបានចាកចេញដោយជោគជ័យ !'
                    'message' => 'Logout successful !'
                ], 200);
            }
            return response()->json([
                // 'message' => 'មានបញ្ហាជាមួយ Access Token !'
                'message' => 'There is a problem with Access Token !'
            ], 201);
        }
        Auth::logout();
        return response()->json([
            'result' => Auth::user() ,
            'message' => 'You have logout already !'
        ], 200);
    }
}
