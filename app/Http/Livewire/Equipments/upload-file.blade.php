<div>
    <form wire:submit.prevent="upload">
        <h5 class="text-dark">Upload File</h5>
        <div class="mb-3 row me-3">
            @if ($file)
            <div class="col-auto">
                <img class="rounded-circle mb-3 mt-4" src="{{ $file->temporaryUrl() }}" width="120" height="120" />
            </div>
            @endif
            <progress max="100" class="mt-3 mb-3 ms-3" wire:model="uploadProgress"></progress>

            <input type="file" class="form-control-file" wire:model.lazy="file">
            @error('file') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <button class="btn btn-primary d-block w-100" onclick="Swal.showLoading()" id="btn-save"
            type="submit">Save</button>
    </form>

    <script>
        window.addEventListener('livewire-upload-start', function () {
            @this.set("isUploading", true);
            $("#btn-save").prop("disabled", true)
        })

        window.addEventListener('livewire-upload-finish', function () {
            @this.set("isUploading", false);
            $("#btn-save").prop("disabled", false)
        })

        window.addEventListener('livewire-upload-error', function () {
            @this.set("isUploading", false);
            $("#btn-save").prop("disabled", false)
        })

        window.addEventListener('livewire-upload-progress', function (event) {
            @this.set("uploadProgress", event.detail.progress);
        })

        window.addEventListener('uploadSucceded', function () {
            setTimeout(() => {
                Swal.fire(
                    'Success!',
                    'File Upload Successfully',
                    'success'
                )

                $("#fileModal-{{ $componentNumber }}").modal('hide')
            }, 300);
        })
    </script>
</div>

@push('scripts')

@endpush
