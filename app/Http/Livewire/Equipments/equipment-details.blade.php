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
                               aria-controls="dataTable" placeholder="Search"/>
                    </label>
                </div>
            </div>
        </div>
        <table class="table table-responsive table-bordered table-dark">
            <thead>
            <th>File</th>
            @auth
                @if (auth()->user()->role == 'admin')
                    <th>Action</th>
                @endif
            @endauth
            <th>Component Number</th>
            <th>Material Description</th>
            <th>Component Quantity</th>
            <th>Unit</th>
            <th>Storage</th>
            </thead>
            <tbody>
            @foreach ($details as $item)
                @php
                    $modalID = "fileModal-".random_int(1, 1000)
                @endphp
                <tr wire:key="{{ $modalID }}">
                    <td>
                        <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#{{ $modalID }}">
                            File
                        </a>
                    </td>
                    @auth
                        @if (auth()->user()->role == 'admin')
                            <td>
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                        data-equipment-header-code="{{ $this->equipmentHeaderCode }}"
                                        data-bs-target="#exampleModal"
                                        wire:click="$emitTo('equipments.equipment-detail-form', 'editing', '{{ $item->component_number }}')">
                                    Edit
                                </button>
                                <button class="btn btn-sm btn-danger"
                                        data-equipment-header-code="{{ $this->equipmentHeaderCode }}"
                                        onclick="deleteEquipmentDetail({{$item->component_number}})">
                                    Delete
                                </button>
                            </td>
                        @endif
                    @endauth
                    <td>{{ $item->component_number }}</td>
                    <td>{{ $item->material_description }}</td>
                    <td>{{ $item->component_quantity }}</td>
                    <td>{{ $item->unit }} </td>
                    <td>{{ $item->storage }} </td>
                </tr>
                <div class="modal fade" id="{{ $modalID }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog {{ !empty($item->file) ? 'modal-xl' : '' }}">
                        <div class="modal-content">
                            <div class="modal-body text-center">
                                <x-file-viewer :src="Storage::url($item->file)"
                                               :component-number="$item->component_number"/>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
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
</div>

@push('scripts')
    <script>
        window.addEventListener('DOMContentLoaded', function () {
            $("#exampleModal").on('show.bs.modal', function (e) {
                var equipmentHeaderCode = $(e.relatedTarget).data('equipment-header-code')

                var auth = '{{ auth()->check() }}'

                if (auth == 1) {
                    Swal.showLoading()
                }

                Livewire.emitTo('equipments.equipment-detail-form', 'loadHeaderCode', equipmentHeaderCode)
            })

            Livewire.hook('message.processed', function (message, component) {
                Swal.close()
            })
        })

        function deleteEquipmentDetail(componentNumber) {
            Swal.fire('Attention!',
                'Are you sure you want to delete this equipment detail?',
                'warning').then(function(result) {
                    if (result.isConfirmed){
                        @this.delete(componentNumber);
                    }
            })
        }

        window.addEventListener('componentDetailDeleted', function() {
            Swal.fire(
                'Success!',
                'Equipment Deleted Successfully',
                'success'
            )
        })
    </script>
@endpush
