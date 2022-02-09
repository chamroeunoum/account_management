<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use LasseRafn\InitialAvatarGenerator\InitialAvatar;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Signup an account
     */
    public function register(Request $request){
        /**
         * Check the email whether it does exists
         */
        if( isset( $request->email ) && ( $user = \App\Models\User::where('email',$request->email)->first() ) !== null ){
            /**
             * Check the account verification
             */
            if( $user->account_verified_at == null || $user->account_verified_at == "" ){
                return response()->json([
                    'record' => $user ,
                    'message' => 'This account has been registered but yet does not confirm the registration.'
                ],401);
            }
            return response()->json([
                'record' => $user ,
                'message' => 'This email has already taken.'
            ],401);
        }
        /**
         * Check the phone whether it does exists
         */
        if( isset( $request->phone ) && ( $user = \App\Models\User::where('phone',$request->phone)->first() ) !== null ){
            /**
             * Check the account verification
             */
            if( $user->account_verified_at == null || $user->account_verified_at == "" ){
                return response()->json([
                    'record' => $user ,
                    'message' => 'This account has been registered but yet does not confirm the registration.'
                ],401);
            }
            return response()->json([
                'record' => $user ,
                'message' => 'This phone has already taken.'
            ],401);
        }
        /**
         * Create background information of a person who will be the owner of the account (user)
         */
        $person = \App\Models\People::create([
            'firstname' => $request->firstname ,
            'lastname' => $request->lastname
        ]);

        /**
         * Create profile picture for the owner of the account (person)
         */
        $avatar = new InitialAvatar();
        $image = $avatar->name($request->firstname . ' ' . $request->lastname )->size(128)->color('#0A437A')->generate();
        /**
         * Store the avatar picture to the storage
         */
        $result = $image->save(
            // Image path
            storage_path('app/public').'/people/'.$person->id.'.png',
            // Image quality
            100,
            // Image format
            'png'
        );
        $person->picture = '/people/'.$person->id.'.png';
        $person->save();

        $user = \App\Models\User::create([
            'name' => $person->lastname . " " . $person->firstname ,
            'email' => $request->email ,
            'password' => Hash::make($request->password) ,
            'people_id' => $person->id ,
            'active' => 0 ,
            'username' => $request->username == "" ? "" : $request->username ,
            'phone' => $request->phone == "" ? "" : $request->phone , 
            'varification_codes' => mt_rand(100000,999999)
        ]);
        $user->save();
        $user->notify( new \App\Notifications\RegisterAccount() );

        return response()->json([
            'record' => $user ,
            'message' => "Account has created."
        ]);
    }
    public function emailVerification(Request $request){
        if( 
            ( ( $user = \App\Models\User::where('email' , $request->email)->first() ) !== null )
        ){
            if( 
                ( $user->varification_codes == $request->code )
            ){
                $user->varification_codes = '' ;
                $user->account_verified_at = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
                $user->active = 1 ;
                $user->save();
                return response()->json([
                    'record' => $user ,
                    'message' => "The email has been confirmed."
                ],200);
            }
            return response()->json([
                'record' => false ,
                'message' => "The verification code does not match."
            ],401);
        }
        return response()->json([
            'record' => false ,
            'message' => "The email does not exists in the system."
        ],401);
    }
    public function phoneVerification(Request $request){
        if( 
            ( ( $user = \App\Models\User::where('phone' , $request->phone)->first() ) !== null )
        ){
            if( 
                ( $user->varification_codes == $request->code )
            ){
                $user->varification_codes = '' ;
                $user->account_verified_at = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
                $user->active = 1 ;
                $user->save();
                return response()->json([
                    'record' => $user ,
                    'message' => "The phone has been confirmed."
                ],200);
            }
            return response()->json([
                'record' => false ,
                'message' => "The verification code does not match."
            ],401);
        }
        return response()->json([
            'record' => false ,
            'message' => "The phone does not exists in the system."
        ],401);
    }
    /**
     * Signin an account
     */
    public function login(Request $request){
        
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);

        $credentials = request(['email', 'password']);
        $credentials['active'] = 1;
        $credentials['deleted_at'] = null;


        if (!\Auth::attempt($credentials,$request->remember_me)) {
            // $request->session()->regenerate();

            if ( ( $user = \Auth::user() ) != null ){ 
                /**
                 * Account is disabled
                 */
                if( $user->active != 1 ){
                    return response()->json([
                        'record' => false ,
                        'message' => 'Account has been disabled.'
                    ], 201);
                }
                /**
                 * Account does exist but the password might miss type
                 */
                if( $user->email_verified_at == "" ) {
                    
                    return response()->json([
                        'record' => false ,
                        'message' => 'Email has not been confirmed, yet.'
                    ], 201);
                }
                if( $user->deleted_at != null ) {
                    
                    return response()->json([
                        'record' => false ,
                        'message' => 'Account has been deleted.'
                    ], 201);
                }

                return response()->json([
                    'record' => false ,
                    'message' => 'Password is not correct.'
                ], 201);
                
            } else {
                /**
                 * Account does exist but the password might miss type
                 */
                return response()->json([
                    'record' => false ,
                    'message' => 'There is no email in the system.'
                ], 401);
            }
        }

        \Auth::user()->person;
        if( \Storage::disk('public')->exists( \Auth::user()->person->picture ) ){
            \Auth::user()->person->picture = \Storage::disk('public')->url( \Auth::user()->person->picture );
        }

        /**
         * Create token for authenticated user
         */
        $tokenResult = \Auth::user()->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = \Carbon\Carbon::now()->addDay();
        $token->save();

        return response()->json([
            'token' => [
                'access_token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => \Carbon\Carbon::parse(
                    $tokenResult->token->expires_at
                )->toDateTimeString()
            ],
            'user' => \Auth::user() ,
            'message' => 'Sign in successfully.'
        ], 200);

        // if( $user = \Auth::attempt(['email' => $request->email, 'password' => $request->password  , 'active' => 1 ], $request->remember_me) ){
        //     \Auth::user()->person;
        //     if( \Storage::disk('public')->exists( \Auth::user()->person->picture ) ){
        //         \Auth::user()->person->picture = \Storage::disk('public')->url( \Auth::user()->person->picture );
        //     }
        //     return response()->json([ 'record' => \Auth::user() ]);
        // }
        // return response()->json([ 'message' => "There is a problem when signing in." ]);
    }
    /**
     * Signout an account
     */
    public function logout(Request $request){

        if( $request->user() != null ){
            $value = $request->bearerToken();
            if ($value) {
                $request->user()->token()->revoke();
                return response()->json([
                    'record' => true ,
                    'message' => 'Logout successfully.'
                ], 200);
            }
            return response()->json([
                'record' => false ,
                'message' => 'There is a problem with Access Token.'
            ], 201);
        }
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return response()->json([
            'record' => Auth::user() ,
            'message' => 'You have already logged out.'
        ], 200);
    }
    /**
     * Get profile
     */
    public function getProfile(){
        \Auth::user()->person;
        if( \Storage::disk('public')->exists( \Auth::user()->person->picture ) ){
            \Auth::user()->person->picture = \Storage::disk('public')->url( \Auth::user()->person->picture );
        }
        return response()->json([
            'record' => \Auth::user() ,
            'message' => 'Read profile successfully.'
        ], 200);
    }
    public function sendCodeForEmailVerification(Request $request){
        $request->user()->varification_codes = mt_rand(100000,999999);
        $request->user()->save();
        $request->user()->notify( new \App\Notifications\RegisterAccount() );
        return response()->json([
            'record' => $request->user() ,
            'message' => 'An email has been send to you with verification code.'
        ], 200);
    }
    public function updateEmail(Request $request){
        if( $request->user()->varification_codes == $request->code ){
            $request->user()->varification_codes == "";
            $request->user()->email = $request->email ;
            $request->user()->save();
            return response()->json([
                'record' => $request->user() ,
                'message' => 'An email has been update successfully.'
            ], 200);
        }
        return response()->json([
            'record' => false ,
            'message' => 'There is a problem while updating email.'
        ], 200);
    }
    public function updateUsername(Request $request){
        if( \App\Models\User::where('username', $request->username)->where('id','!=',$request->user()->id)->count() <= 0 ){
            $request->user()->username = $request->username ;
            $request->user()->save();
            return response()->json([
                'record' => $request->user() ,
                'message' => 'The username has been update successfully.'
            ], 200);
        }
        return response()->json([
            'record' => false ,
            'message' => 'There is a problem while updating username.'
        ], 200);
    }
    public function updateProfileInformation(Request $request){
        $request->user()->update([
            'name' => $request->lastname . " " . $request->firstname
        ]);
        if( $person = ( $request->user()->person ?? false ) ){
            if( \Storage::disk('public')->exists( $person->picture ) ){
                $person->picture = \Storage::disk('public')->url( $person->picture );
            }
            $person->update([
                'firstname' => $request->firstname ,
                'lastname' => $request->lastname ,
                'dob' => $request->dob ,
                'gender' => $request->gender ,
                'pob' => $request->pob ,
                'current_address' => $request->current_address
            ]);
        }
        
        return response()->json([
            'record' => $request->user() ,
            'message' => 'The username has been update successfully.'
        ], 200);
    }
    public function updateProfilePicture(Request $request){
        if( $request->picture !== null ){
            /**
             * Create profile picture for the owner of the account (person)
             */
            if( $request->user()->person ){
                $image = \Image::make( $request->picture )->resize(128,128);
                /**
                 * Store the avatar picture to the storage
                 */
                $result = $image->save(
                    // Image path
                    storage_path('app/public').'/people/'.$request->user()->person->id.'.png',
                    // Image quality
                    100,
                    // Image format
                    'png'
                );
                $request->user()->person->picture = '/people/'.$request->user()->person->id.'.png';
                $request->user()->person->save();
            }
            if( \Storage::disk('public')->exists( $request->user()->person->picture ) ){
                $request->user()->person->picture = \Storage::disk('public')->url( $request->user()->person->picture );
            }
        }
        return response()->json([
            'record' => $request->user() ,
            'message' => 'The profile has been update successfully.'
        ], 200);
    }
    public function passwordProfileChange(Request $request){
        if( Hash::check( $request->current , $request->user()->password ) ){
            $request->user()->fill([
                'password' => Hash::make( $request->password )
            ])->save();
            return response()->json([
                'record' => true ,
                'message' => 'The password has been updated successfully.'
            ], 200);
        }
        return response()->json([
            'record' => $request->user()->password . " , " . bcrypt( $request->current ) ,
            'message' => 'The current password is not currect.'
        ], 501);
    }
    public function passwordRequestResetByemail(Request $request){
        /**
         * Check email
         */
        if( ( $user = \App\Models\User::where('email',$request->email)->first() ) !== null ){
            /**
             * Send 6 digits code to email
             */
            $user->varification_codes = mt_rand(100000,999999);    
            $user->save();
            $user->notify( new \App\Notifications\RegisterAccount() );   
            return response()->json([
                'record' => true ,
                'message' => 'An email to reset password has been send to you email.'
            ], 200);
        }
        /**
         * Email does not match
         */
        return response()->json([
            'record' => false ,
            'message' => 'This email does not match.'
        ], 501);
    }
    public function passwordRequestResetChange(Request $request){
        /**
         * Check email
         */
        if( ( $user = \App\Models\User::where('email',$request->email)->where('varification_codes',$request->code)->first() ) !== null ){
            /**
             * Send 6 digits code to email
             */
            $user->fill([
                'password' => Hash::make( $request->password )
            ])->save();
            return response()->json([
                'record' => true ,
                'message' => 'The password has been updated successfully.'
            ], 200);
        }
        /**
         * Email does not match
         */
        return response()->json([
            'record' => false ,
            'message' => 'The email or code does not match.'
        ], 501);
    }
}