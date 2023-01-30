@foreach ($categories as $data)
<div class="modal fade modal-edit" id="categoryModal-{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Category</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="" action="{{ route('category.update', $data->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">
                            <h5 class="fw-bold">Nama Kategori</h5>
                        </label>
                        <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" value="{{ $data->name }}">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <br>
                    </div>
                    <div class="d-flex gap-2 align-items-center">
                        <button class="w-50 btn btn-success" type="submit">Update</button>
                        <button class="w-50 btn btn-danger" type="button" data-bs-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

