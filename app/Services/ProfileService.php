<?php

namespace App\Services;

use App\Dtos\Profiles\ProfileDto;
use App\Models\Profile;
use App\Repositories\ProfileRepository;

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
        return $this->profileRepository
            ->update(dto: $dto, profile: $profile);
    }

    /**
     * @param \App\Models\Profile $profile
     * @return bool|null
     */
    public function delete(Profile $profile): bool
    {
        return $this->profileRepository
            ->delete(profile: $profile);
    }
}
