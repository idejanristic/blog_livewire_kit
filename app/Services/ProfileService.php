<?php

namespace App\Services;

use App\Models\Profile;
use Illuminate\Support\Str;
use App\Dtos\Profiles\ProfileDto;
use Illuminate\Http\UploadedFile;
use App\Repositories\ProfileRepository;
use Illuminate\Support\Facades\Storage;

class ProfileService
{
    public function __construct(
        protected ProfileRepository $profileRepository
    ) {}

    /**
     * @param \App\Dtos\Profiles\ProfileDto $dto
     * @param int $userId
     * @return Profile
     */
    public function create(ProfileDto $dto, int $userId): Profile
    {
        return $this->profileRepository
            ->create(
                dto: $dto,
                userId: $userId
            );
    }

    /**
     * @param \App\Dtos\Profiles\ProfileDto $dto
     * @param \App\Models\Profile $profile
     * @return bool
     */
    public function update(ProfileDto $dto, Profile $profile): bool
    {
        if ($dto->img_path) {
            $this->deleteImage(profile: $profile);
        }

        return $this->profileRepository
            ->update(dto: $dto, profile: $profile);
    }

    /**
     * @param \App\Models\Profile $profile
     * @return bool|null
     */
    public function delete(Profile $profile): bool
    {
        $this->deleteImage(profile: $profile);

        return $this->profileRepository
            ->delete(profile: $profile);
    }

    /**
     * @param \Illuminate\Http\UploadedFile $uploadedFile
     * @param int $userId
     * @return bool|string
     */
    public function uploadImage(UploadedFile $uploadedFile, int $userId): string
    {
        $randomName = str::random(length: 20);

        $extension = $uploadedFile->getClientOriginalExtension();

        $fileName = $randomName . '_' . time() . '.' . $extension;

        $path = $uploadedFile->storeAs(
            path: "img/{$userId}",
            name: $fileName,
            options: 'public'
        );

        return $path;
    }

    /**
     * @param \App\Models\Profile $profile
     * @return void
     */
    private function deleteImage(Profile $profile): void
    {
        if ($profile->img_path && Storage::disk('public')->exists($profile->img_path)) {
            Storage::disk('public')->delete($profile->img_path);
        }
    }
}
