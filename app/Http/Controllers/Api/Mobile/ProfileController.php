<?php

namespace App\Http\Controllers\Api\Mobile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

use App\User;

class ProfileController extends Controller
{
    public function read (Request $request)
    {
        $user = Auth::user() ;
        // $user = \App\User::select(['firstname','lastname','email','phone','avatar_url'])->where('id', Auth::user()->id)->first();
        if( Storage::disk(env('FILESYSTEM_DRIVER','public'))->exists( $user->avatar_url ) && $user->avatar_url!='' )  $user->avatar_url = Storage::disk(env('FILESYSTEM_DRIVER','public'))->url($user->avatar_url );
        // $user->member_id != null && $user->member_id > 0 ? $user->member : false;
        return response()->json( [
            'record' => [
                'id' => (int) $user->id ,
                'username' => (string) $user->username,
                'firstname' => (string) $user->firstname ,
                'lastname' => (string) $user->lastname ,
                'phone' => (string) $user->phone ,
                'email' => (string) $user->email ,
                'address' => (string) $user->member->contact_address,
                'profile_url'=>$user->avatar_url
                // 'profile_url' => is_array( $user->member->photos ) && !empty( $user->member->photos ) && Storage::disk(env('FILESYSTEM_DRIVER','public'))->exists( $user->member->photos[0] ) ? Storage::disk(env('FILESYSTEM_DRIVER','public'))->url( $user->member->photos[0]  ) : null
            ] ,
            'message' => 'Loading ready !'
        ],200 );
    }

    public function update(Request $request)
    {
        // $this->validate($request, [
        //     'name' => 'required|string',
        //     'email' => 'required|email|unique:users,email,'.Auth::id()
        // ]);

        $user = User::find(Auth::id());
        $user->firstname = $request->firstname ;
        $user->lastname = $request->lastname ;
        $user->username = $request->username ;
        // $user->name = $request->lastname . ' ' . $request->firstname;
        $user->phone = $request->phone;
        $user->save();

        /** Create Data Relationship To Member */
        if( $user->member_id != null && $user->member_id > 0){
            $member = \App\Member::find( $user->member_id );
            // $member->name = $user->lastname . ' ' . $user->firstname;
            $member->firstname = $member->enfirstname = $user->firstname;
            $member->lastname = $member->enlastname = $user->lastname;
            $member->phone = $user->phone;
            $member->contact_address = $request->address;
            $member->save();
        }else {
            $member = new \App\Member();
            // $member->name = $user->lastname . ' ' . $user->firstname ;
            $member->firstname = $member->enfirstname = $user->firstname;
            $member->lastname = $member->enlastname = $user->lastname;
            $member->phone = $user->phone;
            $member->contact_address = $request->address;
            $member->member_since = \Carbon\Carbon::today();
            $member->save();
            $member->code = "M" . sprintf("%04d", $member->id) . "-" . \Carbon\Carbon::today()->format('Ymd');
            $member->save();
            $user->member_id = $member->id;
            $user->save();
        }
        if( Storage::disk(env('FILESYSTEM_DRIVER','public'))->exists( $user->avatar_url ) && $user->avatar_url!='' ) {
            $user->avatar_url = Storage::disk(env('FILESYSTEM_DRIVER','public'))->url($user->avatar_url);
        }else{
            $user->avatar_url = null;
        }
        return response()->json( [
            'record' => [
                'id' => (int) $user->id ,
                'username' => (string) $user->username,
                'firstname' => (string) $user->firstname ,
                'lastname' => (string) $user->lastname ,
                'phone' => (string) $user->phone ,
                'email' => (string) $user->email ,
                'address' => (string) $user->member->contact_address,
                'profile_url' => $user->avatar_url
            ],
            'message' => 'Save successfully !'
        ],200);
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'current_password' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ]);

        if ( $request->password !== $request->password_confirmation) {
            return response([
                'message' => 'Your new password and its comfirmation do not march.'
            ],201);
        }

        $user = User::find(Auth::id());

        if (!Hash::check($request->current_password, $user->password)) {
            return response([
                'message' => 'The current password is not matched with the database.'
            ],201);
        }

        $user->password = Hash::make($request->password);
        $user->save();
        if( Storage::disk(env('FILESYSTEM_DRIVER','public'))->exists( $user->avatar_url ) && $user->avatar_url!='' ) {
            $user->avatar_url = Storage::disk(env('FILESYSTEM_DRIVER','public'))->url($user->avatar_url);
        }else{
            $user->avatar_url = null;
        }
        return response()->json( [
            'record' => [
                'id' => (int) $user->id ,
                'username' => (string) $user->username,
                'firstname' => (string) $user->firstname ,
                'lastname' => (string) $user->lastname ,
                'phone' => (string) $user->phone ,
                'email' => (string) $user->email ,
                'address' => (string) $user->member->contact_address,
                'profile_url' => $user->avatar_url
            ],
            'message' => 'The new password has changed successfully !'
        ],200);
    }
    private function base64_to_jpeg($base64_string, $output_file)
    {
        // open the output file for writing
        $ifp = fopen($output_file, 'wb');

        // split the string on commas
        // $data[ 0 ] == "data:image/png;base64"
        // $data[ 1 ] == <actual base64 string>
        $data = explode(',', $base64_string);

        // we could add validation here with ensuring count( $data ) > 1
        fwrite($ifp, base64_decode($data[1]));

        // clean up the file resource
        fclose($ifp);

        return $output_file;
    }
    public function uploadBase64(Request $request)
    {
        $user = Auth::user();
        $photo = $request->get('photo',null);
        if ($user && $photo) {
            $profileName = Str::random(10);
            // update profile
            if (preg_match('/^data:image\/(\w+);base64,/', $photo)) {
                $data = substr($photo, strpos($photo, ',') + 1);
                $data = base64_decode($data);
                Storage::disk(env('FILESYSTEM_DRIVER','public'))->put("avatars/$user->id/$profileName.jpg", $data);
                $user->avatar_url = "avatars/$user->id/$profileName.jpg";
                $user->save();
            }
        }
        return response()->json( [
            'record' => [
                'id' => (int) $user->id ,
                'username' => (string) $user->username,
                'firstname' => (string) $user->firstname ,
                'lastname' => (string) $user->lastname ,
                'phone' => (string) $user->phone ,
                'email' => (string) $user->email ,
                'address' => (string) $user->member?$user->member->contact_address:'',
                'profile_url' =>Storage::disk(env('FILESYSTEM_DRIVER','public'))->url($user->avatar_url )
            ],
            'message' => 'The profile picture updated successfully.'
        ], 200);
    }
    public function uploadFilePhoto(Request $request){
        $user = Auth::user();
        if( $user ){
            $uniqeName = Storage::disk(env('FILESYSTEM_DRIVER','public'))->putFile( "photos/members/".$user->member->id, new File( $_FILES['photo']['tmp_name'] ),'public' );
            $photos = [] ;
            if( is_array( $user->member->photos ) ) {
                $photos = $user->member->photos ;
            }
            array_unshift( $photos, $uniqeName );
            $user->member->photos = $photos;
            $user->member->save();

            if( Storage::disk(env('FILESYSTEM_DRIVER','public'))->exists( $user->member->photos[0] ) ){
                return response()->json( [
                    'user' => [
                        'id' => (int) $user->id ,
                        'username' => (string) $user->username,
                        'firstname' => (string) $user->firstname ,
                        'lastname' => (string) $user->lastname ,
                        'phone' => (string) $user->phone ,
                        'email' => (string) $user->email ,
                        'address' => (string) $user->member->contact_address,
                        'profile_url' => Storage::disk(env('FILESYSTEM_DRIVER','public'))->url( $user->member->photos[0]  )
                    ],
                    'message' => 'Profile picture saved !'
                ], 200);
            }
        }else{
            return response()->json( [
                'record' => null ,
                'message' => 'There is a problem with changing profile picture !'
            ],350);
        }
    }
    public function deletePhoto(){
        $user = Auth::user();
        if( $user ){
            if( is_array( $user->member->photos ) && !empty( $user->member->photos ) && Storage::disk(env('FILESYSTEM_DRIVER','public'))->exists($user->member->photos[0]) ){
                if( Storage::disk(env('FILESYSTEM_DRIVER','public'))->delete($user->member->photos[0]) ){
                    $member = $user->member ;
                    $member->photos = count( $member->photos ) > 1 ? array_slice($member->photos,1) : [] ;
                    $member->save();
                    return response()->json( [
                        'user' => [
                            'id' => (int) $user->id ,
                            'username' => (string) $user->username,
                            'firstname' => (string) $user->firstname ,
                            'lastname' => (string) $user->lastname ,
                            'phone' => (string) $user->phone ,
                            'email' => (string) $user->email ,
                            'address' => (string) $user->member->contact_address,
                            'profile_url' => is_array( $user->member->photos ) && !empty( $user->member->photos ) && Storage::disk(env('FILESYSTEM_DRIVER','public'))->exists( $user->member->photos[0] ) ? Storage::disk(env('FILESYSTEM_DRIVER','public'))->url( $user->member->photos[0]  ) : null
                        ],
                        'message' => 'Profile picture saved !'
                    ], 200);
                }
                else{
                    return response()->json([
                        'record' => null ,
                        'message' => 'There is a problem with deleting the profile picture.'
                    ],200);
                }
            }
            return response()->json([
                'record' => null ,
                'message' => 'There is no profile picture to delete.'
            ],200);
        }else{
            return response()->json( [
                'record' => null ,
                'message' => 'There is a problem with delete profile picture.'
            ],350);
        }
    }
}
