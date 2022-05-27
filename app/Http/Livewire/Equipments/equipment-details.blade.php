<div>
    <div>
        @if (session()->has("success"))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session()->get("success") }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div class="row">
            <div class="col-md-6 text-nowrap">
                <button type="button" data-bs-toggle="modal"
                    data-equipment-header-code="{{ $this->equipmentHeaderCode }}" data-bs-target="#exampleModal"
                    class="btn btn-primary btn-sm">
                    Add Equipment Detail
                </button>
                <button type="button" wire:click="$refresh()" onclick="Swal.showLoading()"
                    class="btn btn-outline-success btn-sm" aria-label="Refresh">
                    <span class="fa fa-refresh" aria-hidden="true"></span>
                </button>
            </div>
            <div class="col-md-6">
                <div class="text-md-end dataTables_filter" id="dataTable_filter">
                    <label class="form-label">
                        <input type="search" wire:model="search" class="form-control form-control-sm"
                            aria-controls="dataTable" placeholder="Search" />
                    </label>
                </div>
            </div>
        </div>
        <table class="table table-responsive table-bordered table-dark">
            <thead>
                <th>Component Number</th>
                <th>Material Description</th>
                <th>Component Quantity</th>
                <th>Unit</th>
                <th>Storage</th>
            </thead>
            <tbody>
                @foreach ($details as $item)
                <tr wire:key="{{ $item->component_number }}">
                    <td>{{ $item->component_number }}</td>
                    <td>{{ $item->material_description }}</td>
                    <td>{{ $item->component_quantity }}</td>
                    <td>{{ $item->unit }} </td>
                    <td>{{ $item->storage }}</td>
                </tr>
                @endforeach

            </tbody>
        </table>
        <div class="row">
            <div class="col-md-6 align-self-center">
            </div>
            <div class="col-md-6">
                {{ $details->links() }}
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    @auth
                    @livewire('equipments.equipment-detail-form')
                    @else
                    <h5 class="text-center">
                        You have to login first
                    </h5>
                    @endauth
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    window.addEventListener('DOMContentLoaded', function () {
        $("#exampleModal").on('show.bs.modal', function (e) {
            var equipmentHeaderCode = $(e.relatedTarget).data('equipment-header-code')

            Swal.showLoading()
            Livewire.emitTo('equipments.equipment-detail-form', 'loadHeaderCode', equipmentHeaderCode)
        })

        Livewire.hook('message.processed', function (message, component) {
            Swal.close()
        })
    })
</script>
@endpush
