<div>
    <div>
        <input type="text" wire:model.debounce.500ms="needle" class="form-control" placeholder="Username" aria-label="Search" aria-describedby="basic-addon1">

    </div>
    <table class="table table-dark table-striped">
        <thead>
            <tr>
                @foreach($data['fields'] as $field)
                    <th scope="col">
                        @if(array_search($field,$data['sortByFields']))
                            <button wire:click="orderBy('{{$field}}')">{{$field}}</button>
                        @else
                            {{$field}}
                        @endif
                    </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
        @foreach($data['items'] as $item)
            <tr>
                @foreach($data['fields'] as $field)
                    <td>{{$item->$field}}</td>
                @endforeach
            </tr>
        @endforeach


        </tbody>

    </table>
    {{ $data['items']->links() }}


</div>
