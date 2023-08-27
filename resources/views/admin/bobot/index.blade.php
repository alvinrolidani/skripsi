@extends('admin.layouts.main')

@section('content')
    @include('sweetalert::alert')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Perbandingan Kriteria</h4>
                    <br>
                    <br>


                    <br>
                    <div class="table-rep-plugin">
                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                            <form action="{{ route('hitungbobot') }}" method="post">
                                @csrf
                                <table class="table table-striped">
                                    @if ($pilihan)
                                        <?php

				//inisialisasi
				$urut = 0;

				for ($x = 0; $x <= ($count - 2); $x++) {
					for ($y = ($x + 1); $y <= ($count - 1); $y++) {

						$urut++;

				?>
                                        <tr>
                                            <td>
                                                <div class="field">
                                                    <div class="ui radio checkbox">
                                                        <input name="pilih{{ $urut }}" value="1" checked=""
                                                            type="radio">
                                                        <label>{{ $pilihan[$x] }}</label>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="field">

                                                    <select name="bobot{{ $urut }}" id=""
                                                        class="form-select">
                                                        @foreach ($tingkatkepentingan as $item => $value)
                                                            <option value="{{ $item }}"
                                                                @foreach ($perbandingan as $key)

                                                        {{ $item == $key->kepentingan && $rowId[$x] == $key->kriteria_pertama && $rowId[$y] == $key->kriteria_kedua ? 'selected' : '' }} @endforeach>
                                                                {{ $item . ' - ' . $value }} </option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                            </td>
                                            <td>
                                                <div class="field">
                                                    <div class="ui radio checkbox">
                                                        <input name="pilih{{ $urut }}" value="2"
                                                            type="radio">
                                                        <label>{{ $pilihan[$y] }}</label>
                                                    </div>
                                                </div>
                                            </td>

                                        </tr>
                                        <?php
					}
				}

				?>
                                    @endif

                                </table>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
@endsection
