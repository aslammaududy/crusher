<div class="card shadow mt-5">
    <div class="card-header py-3">
        <p class="text-primary m-0 fw-bold">Form</p>
    </div>
    <div class="card-body">
        <form class="user">
            <div class="mb-3">
                <input class="form-control" type="text" id="exampleInputEmail" aria-describedby="emailHelp"
                    placeholder="QR Code" wire:model="qrcode" disabled />
            </div>
            <div class="mb-3">
                <input class="form-control" required type="text" id="exampleInputEmail" aria-describedby="emailHelp"
                    placeholder="Equipment Code" wire:model="equipmentCode" />
            </div>
            <div class="mb-3">
                <input class="form-control" required type="text" id="exampleInputPassword" placeholder="Component Code"
                    wire:model="componentCode" />
            </div>
            <div class="mb-3">
                <input class="form-control" required type="text" id="exampleInputPassword"
                    placeholder="Material Description" wire:model="materialDescription" />
            </div>
            <div class="mb-3">
                <input class="form-control" required type="text" id="exampleInputPassword"
                    placeholder="Component Quantity" wire:model="componentQuantity" />
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
                @forelse ($images as $item)
                <div class="col-auto">
                    <img class="rounded-circle mb-3 mt-4" src="{{ $item->temporaryUrl() }}" width="120" height="120" />
                </div>
                @empty
                @endforelse
                <progress max="100" class="mt-3 mb-3 ms-3" wire:model="uploadProgress"></progress>

                <input type="file" class="form-control-file" wire:model="images" multiple>
                @error('images') <span class="text-danger">{{ $message }}</span> @enderror

            </div>
            <button class="btn btn-primary d-block w-100" type="submit">Login</button>
        </form>
    </div>

    <script>
        window.addEventListener('livewire-upload-start', function () {
            @this.set("isUploading", true);
        })

        window.addEventListener('livewire-upload-finish', function () {
            @this.set("isUploading", false);
        })

        window.addEventListener('livewire-upload-error', function () {
            @this.set("isUploading", false);
        })

        window.addEventListener('livewire-upload-progress', function (event) {
            @this.set("uploadProgress", event.detail.progress);
        })
    </script>
</div>
