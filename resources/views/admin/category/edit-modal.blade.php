<div class="modal fade" id="editCategoryModal{{ $row->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('category.update', $row->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body row gy-3">
                    <div class="col-md-12">
                        <label for="inputName5" class="form-label">Name Category</label>
                        <input type="text" class="form-control" id="inputName5" name="name" value="{{ $row->name }}" required>
                    </div>
                    <div class="col-md-12">
                        <label for="inputName6" class="form-label">Image Category</label>
                        <input type="file" class="form-control" id="inputName6" name="image" value="{{ $row->image }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>