<div>
    <style>
        [contenteditable=true]:empty:before {
            content: attr(placeholder);
            pointer-events: none;
            display: block;
            /* For Firefox */
        }
    </style>
    <div>
        @if (session()->has("success"))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session()->get("success") }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div class="row">
            <div class="col-md-6 text-nowrap">
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
                <th>Action</th>
                <th>Equipment Code</th>
                <th>Component Number</th>
                <th>Material Description</th>
                <th>Component Quantity</th>
                <th>Unit</th>
                <th>Storage</th>
            </thead>
            <tbody>
                @foreach ($details as $item)
                <tr wire:key="{{ $item->component_number }}">
                    <td>
                        @auth
                        <input type="button" class="btn btn-success text-white btn-sm"
                            wire:click="save('{{ $item->component_number }}', {{ true }}, {{ $loop->index }})"
                            value="Update" onclick="Swal.showLoading()">
                        @endauth
                    </td>
                    <td>{{ $item->equipment_header_code }}</td>
                    <td>{{ $item->component_number }}</td>
                    <td wire:ignore
                        onkeyup="@this.fillDetails('material_description', this.innerText, {{ true }}, {{ $loop->index }})"
                        contenteditable="true">{{ $item->material_description }}</td>
                    <td wire:ignore
                        onkeyup="@this.fillDetails('component_quantity', this.innerText, {{ true }}, {{ $loop->index }})"
                        contenteditable="true">{{ $item->component_quantity }}</td>
                    <td wire:ignore onkeyup="@this.fillDetails('unit', this.innerText, {{ true }}, {{ $loop->index }})"
                        contenteditable="true">{{ $item->unit }} </td>
                    <td wire:ignore
                        onkeyup="@this.fillDetails('storage', this.innerText, {{ true }}, {{ $loop->index }})"
                        contenteditable="true">{{ $item->storage }}</td>
                </tr>
                @endforeach
                @auth
                <tr wire:key="0">
                    <td><input type="button" class="btn btn-primary btn-sm" wire:click="save" value="Save"
                            onclick="Swal.showLoading()"></td>
                    <td class="input-details" wire:ignore placeholder="Click to fill"
                        onkeyup="@this.fillDetails('equipment_header_code', this.innerText)" contenteditable="true">
                    </td>
                    <td class="input-details" wire:ignore placeholder="Click to fill"
                        onkeyup="@this.fillDetails('component_number', this.innerText)" contenteditable="true"></td>
                    <td class="input-details" wire:ignore placeholder="Click to fill"
                        onkeyup="@this.fillDetails('material_description', this.innerText)" contenteditable="true"></td>
                    <td class="input-details" wire:ignore placeholder="Click to fill"
                        onkeyup="@this.fillDetails('component_quantity', this.innerText)" contenteditable="true"></td>
                    <td class="input-details" wire:ignore placeholder="Click to fill"
                        onkeyup="@this.fillDetails('unit', this.innerText)" contenteditable="true"></td>
                    <td class="input-details" wire:ignore placeholder="Click to fill"
                        onkeyup="@this.fillDetails('storage', this.innerText)" contenteditable="true"></td>
                </tr>
                @else
                <tr>
                    <td colspan="7" class="text-center">
                        You must login to add / update
                    </td>
                </tr>
                @endauth

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

    <script>
        window.addEventListener('DOMContentLoaded', function () {
            Livewire.hook('message.received', function (message, component) {
                Swal.close()
            })

            window.addEventListener('details-saved', function () {
                $(".input-details").text('')
            })
        })
    </script>
</div>
