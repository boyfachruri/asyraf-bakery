<form action="{{ url('import-excel') }}" method="post">
    <input name="_token" type="hidden" value="{{ csrf_token() }}" readonly />
    {{-- upload --}}
    <div class="form-group"> <label class="form-label" for="customFileLabel">Default File Upload</label>
        <div class="form-control-wrap">
            <div class="form-file"> <input type="file" class="form-file-input" id="customFile"> <label
                    class="form-file-label" for="customFile">Choose file</label> </div>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-outline-primary" data-dismiss="modal">Batal</a>
        <button type="submit" class="btn btn-primary" id="btnSave">Simpan</button>
        {{-- <a href="#" class="btn btn-primary">Simpan</a> --}}
    </div>
</form>

<script text="text/javascript">
    $('.select2').select2();
</script>
