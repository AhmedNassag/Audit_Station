<?php

namespace Modules\AboutUs\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\ImageService;
use App\Traits\HttpResponse;
use Illuminate\Support\Facades\DB;
use Modules\AboutUs\Http\Requests\AboutUsRequest;
use Modules\AboutUs\Models\AboutUs;
use Modules\AboutUs\Transformers\AboutUsResource;

class AboutUsController extends Controller
{
    use HttpResponse;

    public function show()
    {
        $data = AboutUs::query()->with('image')->first();

        return $this->okResponse(new AboutUsResource($data));
    }

    public function update(AboutUsRequest $request)
    {
        DB::transaction(function () use ($request) {
            $about = AboutUs::first();
            $data = $request->validated();

            $about->update($data);

            $imageService = new ImageService($about, $data);
            $imageService->updateOneMedia(
                'about_us_image',
                'image',
                'resetImage'
            );
        });

        return $this->okResponse(message: translate_success_message('about_us', 'updated'));
    }
}
