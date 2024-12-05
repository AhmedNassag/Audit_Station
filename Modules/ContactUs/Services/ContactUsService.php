<?php

namespace Modules\ContactUs\Services;

use Modules\ContactUs\Models\ContactUs;

readonly class ContactUsService
{
    public function __construct(private ContactUs $contactUsModel) {}

    public function index()
    {
        return $this->contactUsModel::query()
            ->latest()
            ->searchable(['name', 'email', 'subject'])
            ->paginatedCollection();
    }

    public function store(array $data)
    {
        $this->contactUsModel::create($data);
    }

    public function show($id)
    {
        return $this->contactUsModel::query()->findOrFail($id);
    }

    public function destroy($id)
    {
        $this->contactUsModel::query()->findOrFail($id)->delete();
    }
}
