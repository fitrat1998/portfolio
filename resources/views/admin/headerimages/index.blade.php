    @extends('admin.layouts.admin')
    @section('content')

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center m-4">
                <div>
                    <h1 class="h3 mb-0">Header Images</h1>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('headerimages.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-lg me-2"></i>
                        Qo'shish
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            
            <table id="dataTable" class="table table-bordered table-striped statistics">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Sahifa Nomi</th>
                        <th>Amallar</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach($headerImages as $key => $headerimage)
                
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $headerimage->page->page_name }}</td>
                        <td>
                            <a href="{{ asset('storage/'.$headerimage->header_image) }}"
                                target="_blank"
                                class="btn btn-sm btn-info">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('headerimages.edit', $headerimage->id) }}" class="btn btn-sm btn-primary"><i
                                    class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('headerimages.destroy', $headerimage->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger"
                                    onclick="return confirm('O‘chirishga ishonchingiz komilmi?')"><i
                                        class="bi bi-trash"></i>

                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

    @endsection