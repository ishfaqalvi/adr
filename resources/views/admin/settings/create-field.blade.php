<div id="modal_default" class="modal fade modal-lg" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Field</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form method="POST" action="{{ route('settings.create-field') }}" class="validate" role="form"
                enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf

                    <div class="row g-2">

                        <div class="form-group col-md-6">
                            <label for="setting_field_group_id">Group</label>
                            <select name="field_group_id" id="setting_field_group_id"
                                class="form-control select" required>
                                @forelse ($groups as $group)
                                    <option value="{{ $group->id }}">{{ $group->title }}</option>
                                @empty
                                    <option>No Group</option>
                                @endforelse
                                <option value="NEW">Add new Group</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="type">Type</label>
                            <select name="type" id="type" class="form-control form-select" required>
                                <option value="email">Email</option>
                                <option value="text">Text</option>
                                <option value="number">Number</option>
                                <option value="file">File</option>
                                <option value="select">Select</option>
                                <option value="textarea">Textarea</option>
                            </select>
                        </div>


                        <div class="form-group col-md-6">
                            <label for="name">Name <span class="form-text text-muted">(Small Letter with
                                    -)</span></label>
                            <input type="text" class="form-control" name="name" id="name" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="label">Label</label>
                            <input type="text" class="form-control" name="label" id="label" required>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="placeholder">Placeholder</label>
                            <input type="text" class="form-control" name="placeholder" id="placeholder">
                        </div>

                        <div class="form-group col-md-12 d-none" id="options-div">
                            <label for="options">Options</label>
                            <input type="text" class="form-control" id="options" name="options">
                            <div class="form-text text-muted">Comma seprated</div>
                        </div>


                    </div>

                    <div class="row mt-3">
                        <div class="col-md-4">
                            <label class="form-check mb-2">
                                <input type="checkbox" class="form-check-input form-check-input-secondary"
                                    name="is_required" value="1">
                                <span class="form-check-label">Required</span>
                            </label>
                        </div>

                        <div class="col-md-4 d-none" id="editor-div">
                            <label class="form-check mb-2">
                                <input type="checkbox" class="form-check-input form-check-input-secondary"
                                    name="is_editor" id="editor" value="1">
                                <span class="form-check-label">Editor</span>
                            </label>
                        </div>
                    </div>


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
