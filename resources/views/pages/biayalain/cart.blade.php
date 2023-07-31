@extends('layout.master')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 grid-margin stretch-card ">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ $title }}</h4>
                    <p class="card-description">

                    </p>
                    <form class="forms-sample" action="{{ url('/store-biaya-siswa/' . $biaya->id) }}" method="POST">
                        {{-- {{ csrf_field() }} --}}
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputUsername1">Nama Biaya</label>
                            <input type="text" class="form-control" id="namakelas" placeholder="Nama Biaya"
                                name="nama_biaya" readonly value="{{ old('nama_biaya') ?? $biaya->nama_biaya }}">

                            @error('nama_biaya')
                                <div class="error">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputUsername1">Tanggal</label>
                            <input type="date" class="form-control" name="tanggal">

                            @error('nama_biaya')
                                <div class="error">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        {{-- <div class="form-group">
                            <label for="exampleInputUsername1">Nama Siswa</label>
                            <input type="text" class="form-control" id="siswa_id" placeholder="Joko" name="siswa_id"
                                autocomplete="off">
                            <div id="nama_list"></div>
                            @error('siswa_id')
                                <div class="error">
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
                        </div> --}}
                        {{-- <div class="form-group">
                            <label for="siswa-id">Nama Siswa</label>
                            <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="siswa_id">
                                <option selected>Pilih Siswa</option>
                                @foreach ($siswa as $sw)
                                    <option value="{{ $sw->id }}">{{ $sw->nama }}</option>
                                @endforeach
                            </select>
                        </div> --}}


                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <a href="{{ url('/daftar-biaya-lain') }}" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#siswa_id').keyup(function() {
                var query = $(this).val();
                if (query != '') {
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url: '/take-siswa',
                        method: "POST",
                        data: {
                            query: query,
                            _token: _token

                        },
                        success: function(data) {

                            $('#nama_list').fadeIn();
                            $('#nama_list').html(data);
                        }
                    });

                } else {

                }
            });
            $(document).on('click', 'li', function() {
                $('#siswa_id').val($(this).text());
                $('#nama_list').fadeOut();
            });
        });
    </script>


    {{-- <script type="text/javascript">
        // CSRF Token
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function() {

            $("#siswa_id").autocomplete({
                source: function(request, response) {
                    // alert('oke');
                    $.ajax({
                        url: "/take-siswa",
                        type: 'post',
                        dataType: "json",
                        data: {
                            _token: CSRF_TOKEN,
                            search: request.term
                        },
                        success: function(data) {
                            console.log(data);
                            response(data);
                        }
                    });
                },
                select: function(event, ui) {
                    $('#siswa_id').val(ui.item.label);
                    $('#siswa_id').val(ui.item.value);
                    return false;
                }
            });

        });
    </script> --}}
@endsection
