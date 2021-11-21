<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BusinessSettingsController extends Controller
{

    public function smtp_settings(Request $request)
    {
        return view('backend.setup_configurations.smtp_settings');
    }
    public function social_login(Request $request)
    {
        return view('backend.setup_configurations.social_login');
    }
    public function env_key_update(Request $request)
    {
        foreach ($request->types as $key => $type) {
                $this->overWriteEnvFile($type, $request[$type]);
        }

        session()->flash("success","Settings updated successfully");
        return back();
    }
    public function overWriteEnvFile($type, $val)
    {
        if(env('DEMO_MODE') != 'On'){
            $path = base_path('.env');
            if (file_exists($path)) {
                $val = '"'.trim($val).'"';
                if(is_numeric(strpos(file_get_contents($path), $type)) && strpos(file_get_contents($path), $type) >= 0){
                    file_put_contents($path, str_replace(
                        $type.'="'.env($type).'"', $type.'='.$val, file_get_contents($path)
                    ));
                }
                else{
                    file_put_contents($path, file_get_contents($path)."\r\n".$type.'='.$val);
                }
            }
        }
    }
}
