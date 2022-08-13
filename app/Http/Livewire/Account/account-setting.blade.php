<div>
    <div>
        @if (session()->has("success"))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get("success") }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <table class="table table-responsive table-bordered table">
            <thead>
            <th>Action</th>
            <th>Name</th>
            <th>Email</th>
            <th>Password</th>
            <th>Role</th>
            </thead>
            <tbody>
            @foreach ($users as $index => $item)
                <tr>
                    <td>
                        @if($editedIndex == $index)
                            <button class="btn btn-sm btn-success text-white" wire:click="update('{{$index}}')">Update</button>
                            <button class="btn btn-sm btn-danger text-white" wire:click="cancelEdit">Cancel</button>
                        @else
                            <button class="btn btn-sm btn-primary" wire:click="edit({{ $index }})">Edit</button>
                        @endif
                    </td>
                    <td>
                        @if($editedIndex == $index)
                            <input type="text" wire:model.defer="users.{{ $index }}.name">
                        @else
                            {{ $item["name"] }}
                        @endif
                    </td>
                    <td>
                        @if($editedIndex == $index)
                            <input type="text" wire:model.defer="users.{{ $index }}.email">
                        @else
                            {{ $item["email"] }}
                        @endif
                    </td>
                    <td>
                        @if($editedIndex == $index)
                            <input type="password" wire:model.defer="users.{{ $index }}.password">
                        @else
                            Password is Hidden
                        @endif
                    </td>
                    <td>
                        @if($editedIndex == $index)
                            <select wire:model.defer="users.{{ $index }}.role">
                                <option value="admin">admin</option>
                                <option value="staff">staff</option>
                            </select>
                            {{--                            <input type="text" >--}}
                        @else
                            {{ $item["role"] }}
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
