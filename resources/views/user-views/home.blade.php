<x-user-components.layout>
    <x-user-components.slider :sliders="$sliders" />

    <x-user-components.quotes :pimpinan="$pimpinan" />
    
    <x-user-components.agenda :agendas="$agendasForMonth" />

    <x-user-components.news :latestPosts="$latestPosts" :popularPosts="$popularPosts"></x-user-components.news>
    
    <x-user-components.media :latestPhotos="$latestPhotos" :latestVideos="$latestVideos"></x-user-components.media>
</x-user-components.layout>

