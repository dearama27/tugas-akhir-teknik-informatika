<div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          {!! $column !!}
          {{-- <th style="width: 10px">#</th>
          <th>Name</th>
          <th>Image</th>
          <th>Join At</th>
          <th style="width: 80px">Status</th>
          <th style="width: 160px">Action</th> --}}
        </tr>
      </thead>
      @if (!count($results))
      <tr>
        <td colspan="6" class="text-center">@lang('general.not_found')</td>
      </tr>
      @endif
      <tbody>
        @php
        //$no = 1;
        $no = ($results->currentPage() - 1) * $results->perPage() + 1;
        @endphp
        @foreach ($results as $item)

        <tr>
          <td>{{ $no }}</td>
          <td>{{ $item->name }}</td>
          <td><img width="20" class="rounded-circle" src="{{ $item->get_image->url }}" /></td>
          <td>{{ $item->join_at }}</td>

          <td>
            @if(!$item->deleted_at)
              <span class="badge bg-success">Aktif</span>
            @else
              <span class="badge bg-danger">Deleted</span>
            @endif
          </td>
          
          <td>
              <a href="{{route($resource.'.edit', $item->id)}}" class="btn btn-primary btn-xs text-white"><i class="fas fa-pencil-alt"></i> Edit</a>
              @if($item->deleted_at)
              <button class="btn btn-success btn-xs text-white restore" data-id="{{$item->id}}"><i class="fas fa-sync-alt"></i> Restore</button>
              @else
                @if (Role::isAllow("delete"))
                <button class="btn btn-danger btn-xs text-white delete" data-id="{{$item->id}}"><i class="fas fa-trash"></i> Delete</button>
                @endif
              @endif
          </td>
        </tr>
        @php
        $no++;
        @endphp
        @endforeach

      </tbody>
    </table>
</div>