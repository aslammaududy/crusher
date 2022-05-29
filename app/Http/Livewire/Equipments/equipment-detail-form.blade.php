<div>
    <h3 class="text-dark mb-4">Equipments Detail Form</h3>

    <form wire:submit.prevent="save">
        <div class="mb-3">
            <input class="form-control" type="text" id="exampleInputEmail" aria-describedby="emailHelp"
                placeholder="Equipment Header Code" wire:model.defer="equipmentHeaderCode" disabled />
        </div>
        <div class="mb-3">
            <input class="form-control" required type="text" id="exampleInputPassword" placeholder="Component Number"
                wire:model="componentNumber" />
        </div>
        <div class="mb-3">
            <input class="form-control" required type="text" id="exampleInputPassword"
                placeholder="Material Description" wire:model="materialDescription" />
        </div>
        <div class="mb-3">
            <input class="form-control" required type="text" id="exampleInputPassword" placeholder="Component Quantity"
                wire:model="componentQuantity" />
        </div>
        <div class="mb-3">
            <input class="form-control" required type="text" id="exampleInputPassword" placeholder="Unit"
                wire:model="unit" />
        </div>
        <div class="mb-3">
            <input class="form-control" required type="text" id="exampleInputPassword" placeholder="Storage"
                wire:model="storage" />
        </div>
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
</div>

@push('scripts')
<script>
    window.addEventListener('DOMContentLoaded', function () {
        Swal.close()
    })

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

    window.addEventListener("equipmentSaved", function (event) {
        setTimeout(() => {
            Swal.fire(
                'Success!',
                'Equipment Saved Successfully',
                'success'
            )

            $("#exampleModal").modal('hide')
        }, 300);
    })

    window.addEventListener("equipmentNotSaved", function (event) {
        Livewire.on('detailFormLoaded', function () {
            Swal.close()
        })

        setTimeout(() => {
            Swal.fire(
            'Error!',
            'Something went wrong. Check console for more details',
            'error'
        )
        console.log(`${event.detail.message}\n${event.detail.line}\n${event.detail.file}`);
        }, 300);
    })
</script>
@endpush
