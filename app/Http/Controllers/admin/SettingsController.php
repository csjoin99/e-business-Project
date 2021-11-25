<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\settings\SettingsUpdateRequest;
use App\Models\Settings;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class SettingsController extends Controller
{
    public function settings()
    {
        $settings = Settings::get()->first();
        return view('admin.settings.index', compact('settings'));
    }

    public function settings_update(SettingsUpdateRequest $request, Settings $settings)
    {
        try {
            $data = $request->except('_token');
            $url = Cloudinary::upload($request->file('logo')->getRealPath())->getSecurePath();
            /* if ($request->hasFile('logo')) {
                $image_name = time() . '-' . $request->logo->getClientOriginalName();
                $request->logo->move(public_path('img/settings/'), $image_name);
                $url = url('') . '/img/settings/' . $image_name;
            } */
            $data['logo'] = isset($url) ? $url : $settings->logo;
            $settings->update($data);
            return redirect()->route('settings')->with('success', 'Configuración actualizada exitosamente');
        } catch (\Throwable $th) {
            return redirect()->route('settings')->with('failure', 'Ocurrio un error, no se pudo actualizar la configuración');
        }
    }
}
