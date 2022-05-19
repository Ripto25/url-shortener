<?php
namespace App\Services\Url;

use App\Models\Url;
use Illuminate\Support\Facades\Auth;
use App\Services\ResService;

class UrlService{
    public function __construct(ResService $ress){
        $this->ress = $ress;
    }

    public function list(){
        try {
            $data = Url::where('userid', Auth::id())->get();
            return  $this->ress->successRess('success', 'Succes Get Data', $data);
        }
        catch (Exception $error){
            return  $this->ress->errorRess('error', 'Failed To Get Data');
        }
    }

    public function store($request){
        try {
            $name        = $request->name == null ? null : $request->name;
            $shortUrl    = $request->shorturl;
            $userId      = Auth::id();
            $originalUrl = $request->originalurl;
            $expiredAt   = $request->expiredat == null ? null : $request->expiredat;

            if($originalUrl == null){
                return  $this->ress->errorRess('error', 'Original Url Must Be Filled');
            }

            $checkData = Url::where('short_url', $shortUrl)
                ->where('deleted_at', null)
                ->first();
            if($checkData){
                return  $this->ress->errorRess('error', 'Url Not Available');
            }

            $data = new Url;
            $data->userid       = $userId;
            $data->name         = $name;
            $data->short_url    = $shortUrl;
            $data->original_url = $originalUrl;
            $data->expired_at   = $expiredAt;
            $data->save();

            $shortUrl = url('/').'/'.$data->short_url;
            return  $this->ress->successRess('success', 'Succes Generate Short Url', $shortUrl);
        }
        catch (Exception $error){
            return  $this->ress->errorRess('error', 'Failed Generate Short Url');
        }
    }

    public function update($request){
        try {
            $id          = $request->id;
            $name        = $request->name == null ? null : $request->name;
            $shortUrl    = $request->shorturl;
            $originalUrl = $request->originalurl;
            $expiredAt   = $request->expiredat == null ? null : $request->expiredat;

            if($id == null){
                return  $this->ress->errorRess('error', 'Id  Must Be Filled');
            }

            $checkData = Url::where('short_url', $shortUrl)
                ->where('deleted_at', null)
                ->first();
            if($checkData){
                return  $this->ress->errorRess('error', 'Url Not Available');
            }

            $data = Url::find($id);
            $data->name         = $name;
            $data->short_url    = $shortUrl;
            $data->original_url = $originalUrl;
            $data->expired_at   = $expiredAt;
            $data->update();

            $shortUrl = url('/').'/'.$data->short_url;
            return  $this->ress->successRess('success', 'Succes Update Generate Short Url', $shortUrl);
        }
        catch (Exception $error){
            return  $this->ress->errorRess('error', 'Failed Update Generate Short Url');
        }
    }

    public function delete($request)
    {
        try {
            $id = $request->id;
            if ($id == null) {
                return $this->ress->errorRess('error', 'Id  Must Be Filled');
            }

            $data = Url::find($id);
            $data->delete();

            return $this->ress->successRess('success', 'Deleted Success');
        } catch (Exception $error) {
            return $this->ress->errorRess('error', 'Deleted Failed');
        }
    }

}
