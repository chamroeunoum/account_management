<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\CrudController;
use Illuminate\Support\Facades\Hash;
use App\Models\User as RecordModel;
use LasseRafn\InitialAvatarGenerator\InitialAvatar;

class UserController extends Controller
{
    private $selectFields = [
        'id',
        'name',
        'email',
        'username' ,
        'phone' ,
        'active' ,
        'people_id'
    ];
    public function index(Request $request){
        /** Format from query string */
        $search = isset( $request->search ) && $request->serach !== "" ? $request->search : false ;
        $perPage = isset( $request->perPage ) && $request->perPage !== "" ? $request->perPage : 10 ;
        $page = isset( $request->page ) && $request->page !== "" ? $request->page : 1 ;

        $queryString = [
            // "where" => [
            //     'default' => [
            //         [
            //             'field' => 'type_id' ,
            //             'value' => $type === false ? "" : $type
            //         ]
            //     ],
            //     'in' => [] ,
            //     'not' => [] ,
            //     'like' => [
            //         [
            //             'field' => 'number' ,
            //             'value' => $number === false ? "" : $number
            //         ],
            //         [
            //             'field' => 'year' ,
            //             'value' => $date === false ? "" : $date
            //         ]
            //     ] ,
            // ] ,
            // "pivots" => [
            //     $unit ?
            //     [
            //         "relationship" => 'units',
            //         "where" => [
            //             "in" => [
            //                 "field" => "id",
            //                 "value" => [$request->unit]
            //             ],
            //         // "not"=> [
            //         //     [
            //         //         "field" => 'fieldName' ,
            //         //         "value"=> 'value'
            //         //     ]
            //         // ],
            //         // "like"=>  [
            //         //     [
            //         //        "field"=> 'fieldName' ,
            //         //        "value"=> 'value'
            //         //     ]
            //         // ]
            //         ]
            //     ]
            //     : []
            // ],
            "pagination" => [
                'perPage' => $perPage,
                'page' => $page
            ],
            "search" => $search === false ? [] : [
                'value' => $search ,
                'fields' => [
                    'name', 'email', 'username' , 'phone' ,
                ]
            ],
            "order" => [
                'field' => 'id' ,
                'by' => 'desc'
            ],
        ];

        $request->merge( $queryString );

        $crud = new CrudController(new RecordModel(), $request, $this->selectFields);
        $crud->setRelationshipFunctions([
            /** relationship name => [ array of fields name to be selected ] */
            "person" => ['id','firstname' , 'lastname' , 'gender' , 'dob' , 'pob' , 'picture' ] 
        ]);

        $builder = $crud->getListBuilder();

        $responseData = $crud->pagination(true, $builder);
        $responseData['message'] = __("crud.read.success");
        $responseData['ok'] = true ;
        return response()->json($responseData, 200);
    }
    public function read(Request $request){
        $crud = new CrudController(new RecordModel(), $request, $this->selectFields);
        if( ( $record = $crud->read() ) !== false ){
            $record->person;
            if( \Storage::disk('public')->exists( $record->person->picture ) ){
                $record->person->picture = \Storage::disk('public')->url( $record->person->picture );
            }
            return response()->json([
                'ok' => true ,
                'record' => $record ,
                'message' => 'Read success.'
            ]);
        }else{
            return response()->json([
                'ok' => false ,
                'message' => 'There is no matched data.'
            ]);
        }
    }
    public function create(Request $request){
        /**
         * Create person record before create user
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
            'active' => $request->active ,
            'username' => $request->username == "" ? "" : $request->username ,
            'phone' => $request->phone == "" ? "" : $request->phone
        ]);

        return response()->json([
            // 'record' => $user ,
            'ok' => true ,
            'message' => 'Created record.'
        ]);
    }
    public function update(Request $request){
        /**
         * Checking for the record to update
         */
        if( ( $user = RecordModel::find($request->id) ) != false ){
            /**
             * Updating the pivot table of this record
             */
            $user->person->update([
                'firstname' => $request->firstname ,
                'lastname' => $request->lastname
            ]);

            $user->update([
                'name' => $user->person->lastname . " " . $user->person->firstname ,
                'email' => $request->email ,
                'username' => $request->username == "" ? "" : $request->username ,
                'phone' => $request->phone == "" ? "" : $request->phone
            ]);

            return response()->json([
                'ok' => true ,
                'message' => 'Updated the record.'
            ]);
            
        }else {
            return response()->json([
                'ok' => false ,
                'message' => 'There is not matched data to update.'
            ]);
        }

    }
    public function delete(Request $request){

    }
    /**
     * Update password of the user from admin
     */
    public function passwordChange(Request $request){
        if( ( $request->id > 0 ) && ( ( $user = RecordModel::find($request->id) ) !== null ) ){
            $user->update(['password' => Hash::make( $request->password )]);
            return response()->json([
                'message' => 'The password has been updated successfully.' ,
                'ok' => true
            ]);
        }else{
            return response()->json([
                'message' => "There is no matched data." ,
                'ok' => false
            ]);
        }
        
        return response()->json([
            'ok' => false ,
            'message' => 'The current password is not currect.'
        ]);
    }
    public function checkExistingEmail(Request $request){
        $crud = new CrudController(new RecordModel(), $request, $this->selectFields);
        if( ( $record = $crud->exists(['email']) ) !== false ){
            return response()->json([
                'message' => 'Email already exists.' ,
                'ok' => true
            ]);
        }else{
            return response()->json([
                'ok' => false ,
                'message' => 'Email does not exists.'
            ]);
        }
    }
    public function checkExistingPhone(Request $request){
        $crud = new CrudController(new RecordModel(), $request, $this->selectFields);
        if( ( $record = $crud->exists(['phone']) ) !== false ){
            return response()->json([
                'message' => 'Phone already exists.' ,
                'ok' => true
            ]);
        }else{
            return response()->json([
                'ok' => false ,
                'message' => 'Phone does not exists.'
            ]);
        }
    }
    public function checkExistingUsername(Request $request){
        $crud = new CrudController(new RecordModel(), $request, $this->selectFields);
        if( ( $record = $crud->exists(['username']) ) !== false ){
            return response()->json([
                'message' => 'Username already exists.' ,
                'ok' => true
            ]);
        }else{
            return response()->json([
                'ok' => false ,
                'message' => 'Username does not exists.'
            ]);
        }
    }
    public function checkExistingEmailAndExcludeUser(Request $request){
        return response()->json($request->email );
        if( RecordModel::where('email',$request->email)->where('id','!=',$request->id)->first() !== null ){
            return response()->json([
                'message' => 'Email already exists.' ,
                'ok' => true
            ]);
        }else{
            return response()->json([
                'ok' => false ,
                'message' => 'Email does not exists.'
            ]);
        }
    }
    public function checkExistingPhoneAndExcludeUser(Request $request){
        if( ( $record = RecordModel::where('phone',$request->phone)->where('id','!=',$request->id)->first() ) !== false ){
            return response()->json([
                'message' => 'Phone already exists.' ,
                'ok' => true
            ]);
        }else{
            return response()->json([
                'ok' => false ,
                'message' => 'Phone does not exists.'
            ]);
        }
    }
    public function checkExistingUsernameAndExcludeUser(Request $request){
        if( ( $record = RecordModel::where('username',$request->phone)->where('id','!=',$request->id)->first() ) !== false ){
            return response()->json([
                'message' => 'Username already exists.' ,
                'ok' => true
            ]);
        }else{
            return response()->json([
                'ok' => false ,
                'message' => 'Username does not exists.'
            ]);
        }
    }
}
