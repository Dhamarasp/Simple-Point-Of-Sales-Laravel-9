@foreach ($items as $data)
<div class="modal fade" id="itemModal-{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Item</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="" action="{{ route('item.update', $data->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="kategori">
                            <h5 class="fw-bold">Kategori</h5>
                        </label>
                        <select class="form-control form-select" type="text" name="category_id" id="kategori">
                            @foreach ($categories as $kategori)
                            <option @if($kategori->id == $data->category_id) selected @endif value="{{ $kategori->id }}">{{ $kategori->name }}</option>    
                            @endforeach
                        </select>
                        <br>

                        <label for="name">
                            <h5 class="fw-bold">Nama Item</h5>
                        </label>
                        <input class="form-control" type="text" name="name" id="name" value="{{ $data->name }}">
                        <br>
                        <label for="price">
                            <h5 class="fw-bold">Harga</h5>
                        </label>
                        <input class="form-control" type="number" min="0" name="price" id="price" value="{{ $data->price }}">
                        <br>
                        <label for="stock">
                            <h5 class="fw-bold">Stok</h5>
                        </label>
                        <input class="form-control" type="number" min="0" name="stock" id="stock" value="{{ $data->stock }}">
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
