@props(['user'])

<flux:avatar {{ $attributes }} src="http://secure.gravatar.com/avatar/{{ md5($user->email) }}"
    :name="$user->initials()" />
