<div>
    <h3 class="text-dark mb-4">Equipments</h3>
    <div class="card shadow">
        <div class="card-header py-3">
            <p class="text-primary m-0 fw-bold">List of Equipments</p>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 text-nowrap">
                    <a href="{{ url('equipments/'.$this->qrcode.'/form') }}" class="btn btn-primary btn-sm">Add New
                        Equipment</a>
                    <button type="button" wire:click="$refresh(); $emitSelf('equipmentsRefreshed')"
                        onclick="Swal.showLoading()" class="btn btn-outline-success btn-sm" aria-label="Refresh">
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
            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table my-0" id="dataTable">
                    <thead>
                        <tr>
                            <th>Actions</th>
                            <th>QRCode</th>
                            <th>Equipment Code</th>
                            <th>Equipment Name</th>
                        </tr>
                    </thead>
                    <tbody id="equipmentsGroup">
                        @foreach ($equipments as $item)
                        <tr>
                            <td class="text-nowrap">
                                <button class="btn btn-sm btn-outline-primary equipment-details"
                                    id="btn-{{ $item->code }}" data-bs-toggle="collapse"
                                    data-bs-target="#equipment-details-{{ $item->code }}" aria-expanded="false"
                                    onclick="this.innerText == 'Show Details' ? this.innerText = 'Hide Details' : this.innerText = 'Show Details'"
                                    aria-controls="equipment-details-{{ $item->code }}">Show
                                    Details</button>

                                @php
                                $eq = base64_encode(json_encode($item));
                                @endphp
                                <a href="{{ url('equipments/'.$this->qrcode.'/form/'.$eq) }}"
                                    class="btn btn-sm btn-outline-warning" aria-controls="equipment-details">Edit</a>
                            </td>
                            <td>{{ $item->qr_code }}</td>
                            <td>{{ $item->code }}</td>
                            <td>{{ $item->name }}</td>
                        </tr>
                        <tr class="collapse" id="equipment-details-{{ $item->code }}" data-bs-parent="#equipmentsGroup"
                            data-equipment-code="{{ $item->code }}">
                            <td colspan="4">
                                <div class="m-4 equipment-details-content">
                                    @livewire('equipments.equipment-details', key($item->code))
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-md-6 align-self-center">
                </div>
                <div class="col-md-6">
                    {{ $equipments->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    window.addEventListener('DOMContentLoaded', function () {
       window.addEventListener('show.bs.collapse', function (e) {
            Swal.showLoading()

            var equipmentCode = $(e.target).data("equipment-code")

            $("#equipment-details-content").show()

            Livewire.emitTo('equipments.equipment-details', 'loadDetails', equipmentCode)
        })

        window.addEventListener('hide.bs.collapse', function (e) {
            $("#equipment-details-content").hide()
        })
    })
</script>
@endpush
