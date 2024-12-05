<?php

namespace Modules\Setting\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\HttpResponse;
use Modules\Map\Helpers\PointHelper;
use Modules\Setting\Http\Requests\SettingRequest;
use Modules\Setting\Models\Setting;
use Modules\Setting\Transformers\SettingResource;

class SettingController extends Controller
{
    use HttpResponse;

    public function show()
    {
        $setting = Setting::query()->first();

        return $this->resourceResponse(new SettingResource($setting));
    }

    public function update(SettingRequest $request)
    {
        $data = $request->validated();

        $settings = Setting::query()->first();
        $data['location'] = PointHelper::rawPoint($data['latitude'] ?? $settings->location->getLat(), $data['longitude'] ?? $settings->location->getLng());

        $settings->update($data);

        return $this->okResponse(message: translate_success_message('setting', 'updated'));
    }
}
