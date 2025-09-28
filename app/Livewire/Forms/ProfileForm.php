<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\Profile;
use App\Services\ProfileService;
use App\Dtos\Profiles\ProfileDto;
use Illuminate\Http\UploadedFile;
use Livewire\Attributes\Validate;

class ProfileForm extends Form
{
    #[Validate(rule: 'nullable|string|min:3|max:255')]
    public ?string $first_name = null;
    #[Validate(rule: 'nullable|string|min:3|max:255')]
    public ?string $last_name = null;
    #[Validate(rule: 'nullable|string|max:9')]
    public ?string $title = null;
    #[Validate(rule: 'nullable|sometimes|file|image|max:1024')]
    public ?UploadedFile $image = null;

    public function setProfile(?Profile $profile = null)
    {
        $this->first_name = $profile->first_name ?? null;
        $this->last_name = $profile->last_name ?? null;
        $this->title = $profile->title ?? null;
    }

    public function store(int $user_id): ?Profile
    {
        $validated =  $this->validate();

        if (
            is_null(value: $this->first_name) &&
            is_null(value: $this->last_name) &&
            is_null(value: $this->title)
        ) {
            return null;
        }

        $profileService = app(abstract: ProfileService::class);

        $validated['img_path'] = null;

        if ($this->image) {
            $validated['img_path'] = $profileService->uploadImage(
                uploadedFile: $this->image,
                userId: $user_id
            );
        }

        return $profileService->create(
            dto: ProfileDto::fromAppRequest(data: $validated),
            userId: $user_id
        );
    }

    public function update(Profile $profile): bool|null
    {
        $validated =  $this->validate();

        if (
            is_null(value: $this->first_name) &&
            is_null(value: $this->last_name) &&
            is_null(value: $this->title)
        ) {
            return null;
        }

        $profileService = app(abstract: ProfileService::class);

        $validated['img_path'] = null;

        if ($this->image) {
            $validated['img_path'] = $profileService->uploadImage(
                uploadedFile: $this->image,
                userId: $profile->user_id
            );
        }

        return $profileService->update(
            dto: ProfileDto::fromAppRequest(data: $validated),
            profile: $profile
        );
    }

    public function delete(Profile $profile): bool|null
    {
        $profileService = app(abstract: ProfileService::class);

        return $profileService->delete(profile: $profile);
    }
}
