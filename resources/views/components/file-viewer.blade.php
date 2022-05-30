<div>
    @empty($ext)
    @auth
    <livewire:equipments.upload-file :componentNumber='$componentNumber' :wire:key="$componentNumber" />
    @else
    <h5 class="text-secondary">
        You have to login first
    </h5>
    @endauth
    @else
    @if ($ext == 'pdf')
    <iframe height="500" width="100%" src="{{ $src }}"></iframe>
    @else
    <img src="{{ $src }}" class="img-fluid">
    @endif
    @endempty
</div>
