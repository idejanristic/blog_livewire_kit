<x-layouts.frontend.app title="Contact page"
    description="it can use the contact page to send suggestions for further work or to send your impressions">
    <x-pages.header title="Contact Me" subtitle="Have questions? I have answers (maybe)" />

    <flux:separator class="mb-6 mt-2" />

    <div class="flex flex-col lg:flex-row gap-6">

        <div class="w-full min-h-150 lg:w-2/3">
            <p class="mb-4">
                Want to get in touch with me? Fill out the form below to send me a message and I will try to get back to
                you within 24 hours!
            </p>
            @livewire('frontend.contact-us')
        </div>

        <div class="w-full lg:w-1/3">
            <x-pages.tags :tags="$allTags" :tagId="$tagId" />
        </div>

    </div>


</x-layouts.frontend.app>
