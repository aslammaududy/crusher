<div>
    <a class="btn btn-sm btn-secondary mb-3" href="{{ url('/equipments/'.$qrcode) }}"><i class="fa fa-arrow-left"></i>
        Back</a>

    <h3 class="text-dark mb-4">Equipments Form</h3>
    <div class="card shadow">
        <div class="card-header py-3">
            <p class="text-primary m-0 fw-bold">Add new Equipment</p>
        </div>
        <div class="card-body">
            <form class="user" wire:submit.prevent="save">
                <div class="mb-3">
                    <input class="form-control" type="text" id="exampleInputEmail" aria-describedby="emailHelp"
                        placeholder="QR Code" wire:model.defer="qrcode" disabled />
                </div>
                <div class="mb-3">
                    <input class="form-control" required type="text" id="exampleInputEmail" aria-describedby="emailHelp"
                        placeholder="Equipment Code" wire:model.defer="equipmentCode" @if (!empty($equipmentCode))
                        disabled @endif />
                </div>
                <div class="mb-3">
                    <input class="form-control" required type="text" id="exampleInputEmail" aria-describedby="emailHelp"
                        placeholder="Equipment Name" wire:model.defer="equipmentName" />
                </div>

                <button class="btn btn-primary d-block w-100" id="btn-save" type="submit">Save</button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    window.addEventListener("equipmentSaved", function ($event) {
        Swal.fire(
            'Success!',
            'Equipment Saved Successfully',
            'success'
        ).then(function(result){
            if(result.isConfirmed){
                @this.redirectBack()
            }
        })
    })
</script>
@endpush
