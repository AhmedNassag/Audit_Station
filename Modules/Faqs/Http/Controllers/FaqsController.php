<?php

namespace Modules\Faqs\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\HttpResponse;
use Modules\Faqs\Http\Requests\FaqsRequest;
use Modules\Faqs\Models\Faq;
use Modules\Faqs\Services\FaqsService;
use Modules\Faqs\Transformers\FaqResource;

class FaqsController extends Controller
{
    use HttpResponse;

    private FaqsService $faqService;

    public function __construct(FaqsService $faq)
    {
        $this->faqService = $faq;
    }

    public function index()
    {
        $faqs = $this->faqService->index();

        return $this->paginatedResponse($faqs, FaqResource::class);
    }

    public function show($id)
    {
        $faq = Faq::query()->findOrFail($id);

        return $this->okResponse(data: new FaqResource($faq));
    }

    public function store(FaqsRequest $request)
    {
        $this->faqService->store($request->validated());

        return $this->okResponse(message: translate_success_message('faq', 'created'));
    }

    public function update($id, FaqsRequest $request)
    {
        $this->faqService->update($id, $request->validated());

        return $this->okResponse(message: translate_success_message('faq', 'updated'));
    }

    public function destroy($id)
    {
        Faq::query()->findOrFail($id)->delete();

        return $this->okResponse(message: translate_success_message('faq', 'deleted'));
    }
}
