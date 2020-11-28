<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Login;
use App\Http\Requests\Api\UploadDocument;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Library\Auth\JwtAuthentication;
use App\Document;
class HomeController extends Controller
{
    private $user;
    private $jwtauth;
    private $document;

    public function __construct(User $user,JwtAuthentication $jwtauth,Document $document){
        $this->user = $user;
        $this->jwtauth  = $jwtauth;
        $this->document = $document;
    }
    public function login(Login $request){
       try{
          $userObject =  $this->user->whereName($request->username)->first();
          if(Hash::check($request->password,$userObject->password)){
            $jwt_token = $this->jwtauth->generateToken($userObject['id']);
            $headers = [
                'Authorization' => $jwt_token,
            ];
            $final_response['message'] = "logged in";
            $userObject->is_logged_in=1;
            $userObject->save();
            return response()->json($final_response, 200, $headers);
          }
          abort(400, "Invalid Crendtials");
       } catch (\Exception $ex) {
            logger()->error($ex->getMessage());
            abort(400, "Invalid Crendtials");
       }
    }

    public function logout(){
        $uid = config("api.current_user.uid");
        try{
            $userObject = $this->user->find($uid);
            $userObject->is_logged_in=null;
            $userObject->save();
            $final_response['message'] = "logout successfully.";
            return response()->json($final_response, 200);
        } catch (\Exception $ex) {
            logger()->error($ex->getMessage());
            abort(400, "Loggout Failed to update");
        }
    }

    public function uploadDocument(UploadDocument $request){
        try{
            $uid = config("api.current_user.uid");
            $file = $request->file('upload_doc');
            //Display File Name
            $fileName = rand()."_".uniqid()."_".$file->getClientOriginalName();
            //Move Uploaded File
            $destinationPath = 'uploads';
            $savePath = $destinationPath."/".$fileName;
            $file->move($destinationPath,$fileName);
            $document = $this->document->newInstance();
            $document->user_id = $uid;
            $document->document = $savePath;
            $document->save();
            $final_response['message'] = "Document Uploaded Successfully.";
            return response()->json($final_response, 200);
        } catch (\Exception $ex) {
            logger()->error($ex->getMessage());
            abort(400, "Upload Failed");
        }
    }

    public function list(){
        $uid = config("api.current_user.uid");
        $documents = $this->document->whereUserId($uid)->paginate(10);
        $responses = [];
        $userObject = $this->user->find($uid);
        $responses['user']=[
            "user_name" => $userObject->name,
            "email"=>$userObject->email
        ];
        if(!empty($documents)){
            foreach ($documents as $document){
                $responses['list'][] = [
                    "file"=>$document->document_url,
                    "createdAt"=>$document->created_at
                ];
            }
            $responses['pagination'] = [
                'total' => $documents->total(),
                'per_page' => $documents->perPage(),
                'current_page' => $documents->currentPage(),
                'total_pages' => $documents->lastPage(),
            ];
        }

        return response()->json($responses, 200);
    }

}
