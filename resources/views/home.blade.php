@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="page-header">
    <h3 class="page-title">Dashboard</h3>
</div>

<div class="row">
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row" id="chanelll">
                    @foreach ($chanels as $chanel)
                        @php
                            $members = App\Models\Member::where('id_chanel', $chanel->id_chanel)->where('status', 'Y')->get();
                            $membersCount = $members->count();
                        @endphp
                        <div class="col-md-3 coba">
                            <div class="sat text-warning"><b>{{ strtoupper($chanel->nama_chanel) }}</b></div>
                            @if ($chanel->status == 'N')
                                <h3 class="">READY</h3>
                            @else
                                <h3 class="text-success">ON GOING</h3>
                            @endif

                            @if ($membersCount == 0)
                                <b class="">00:00:00</b>
                                <p>MEMBER</p>
                            @else
                                @foreach ($members as $member)
                                    @php
                                        $diff = $member->tgl_mulai->diff(now());
                                        $timestampg = $diff->format('%H:%I:%S');
                                    @endphp
                                    <input type="hidden" name="jjm" id="jjm" value="{{ $loop->iteration }}">
                                    <h1 id="jamServer{{ $chanel->id_chanel }}">{{ $timestampg }}</h1>
                                    <script>
                                        document.addEventListener("DOMContentLoaded", function() {
                                            var serverClock = document.getElementById("jamServer" + '{{ $chanel->id_chanel }}');
                                            if (serverClock) {
                                                showServerTime(serverClock, serverClock.textContent);
                                            }

                                            function showServerTime(obj, time) {
                                                var parts = time.split(":"),
                                                    newTime = new Date('{{ $member->tgl_mulai }}');

                                                newTime.setHours(parseInt(parts[0], 10));
                                                newTime.setMinutes(parseInt(parts[1], 10));
                                                newTime.setSeconds(parseInt(parts[2], 10));

                                                var timeDifference = new Date().getTime() - newTime.getTime();

                                                var methods = {
                                                    displayTime: function() {
                                                        var now = new Date(new Date().getTime() - timeDifference);
                                                        obj.textContent = [
                                                            methods.leadZeros(now.getHours(), 2),
                                                            methods.leadZeros(now.getMinutes(), 2),
                                                            methods.leadZeros(now.getSeconds(), 2)
                                                        ].join(":");
                                                        setTimeout(methods.displayTime, 500);
                                                    },

                                                    leadZeros: function(time, width) {
                                                        while (String(time).length < width) {
                                                            time = "0" + time;
                                                        }
                                                        return time;
                                                    }
                                                }
                                                methods.displayTime();
                                            }
                                        });
                                    </script>
                                    <p>{{ $member->nama_member }}</p>
                                @endforeach
                            @endif

                            @if ($chanel->status == 'N')
                                <button type="button" data-nm="{{ $chanel->nama_chanel }}" data-id="{{ $chanel->id_chanel }}" class="btn btn-success btn-sm btn_star" data-toggle="modal" data-target="#exampleModal-3">START <i class="fa fa-play-circle ml-1"></i></button>
                            @else
                                <button data-nm="{{ $chanel->nama_chanel }}" data-idc="{{ $chanel->id_chanel }}" data-idm="{{ $member->id_member ?? '' }}" class="btn btn-info btn-sm btn_stop">STOP <i class="fa fa-stop ml-1"></i></button>
                                <a href="#" data-nm="{{ $chanel->nama_chanel }}" data-idc="{{ $chanel->id_chanel }}" data-idm="{{ $member->id_member ?? '' }}" class="btn text-danger btn_hapus"><i class="fa fa-trash"></i></a>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <div class="card-body">
                <h4 class="card-title">FORM PEMBAYARAN</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="30%">Atas Nama</th>
                            <th id="nma"></th>
                        </tr>
                        <tr>
                            <th>Lama Sewa</th>
                            <th id="lama"></th>
                        </tr>
                        <tr>
                            <th>Total</th>
                            <th id="tl_rp"></th>
                        </tr>
                    </thead>
                </table>
                <hr>
                <form class="forms-sample" method="POST" action="{{ route('dashboard.pay') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-8">
                            <input type="hidden" name="id_m" id="id_m">
                            <input type="hidden" name="sewa" id="sewa">
                            <input type="hidden" name="total" id="total">
                            <input type="hidden" name="by" id="by">
                            <input type="text" class="form-control berr" name="dbyr" id="dbyr" placeholder="Rp. 0" autofocus>
                            <input type="text" class="form-control kecc" name="kemd" id="kemd" placeholder="Kembali Rp. 0" readonly>
                        </div>
                        <div class="col-md-4 text-center">
                            <button type="submit" class="btn-block btn-lg btn btn-primary mr-14">
                                <i class="fa fa-save font-weight-bold icon-lg"></i><br><br>
                                SAVE
                            </button>
                            <span class="km">Harga Per {{ $harga->menit }} : Rp. {{ number_format($harga->harga, 0, ",", ".") }}</span>
                            <input type="hidden" name="hargac" value="Harga Rp. {{ number_format($harga->harga, 0, ",", ".") }} Per {{ $harga->menit }} Menit">
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <table class="tab">
                    <thead>
                        <tr style="background-color:#5200E4; color:ghostwhite;">
                            <th class="text-center">ATAS NAMA</th>
                            <th width="23%" class="text-center">LAMA SEWA</th>
                            <th width="18%" class="text-center">TOTAL</th>
                            <th width="18%" class="text-center">DIBAYAR</th>
                            <th width="16%" class="text-center">HAPUS</th>
                        </tr>
                    </thead>
                </table>
                <div id="lebar">
                    <table class="tab2">
                        <tbody>
                            @foreach ($members as $member)
                                <tr>
                                    <td>{{ $member->nama_member }}</td>
                                    <td width="23%" class="text-center">{{ $member->lama_sewa }}</td>
                                    <td width="18%" class="text-right">Rp. {{ number_format($member->total, 0, ",", ".") }}</td>
                                    <td width="18%" class="text-right">Rp. {{ number_format($member->dibayar, 0, ",", ".") }}</td>
                                    <td width="16%" class="text-center">
                                        <button data-nm="{{ $member->nama_member }}" data-id="{{ $member->id_member }}" class="btn_ubah"><i class="text-success fa fa-edit"></i></button>
                                        <button data-nm="{{ $member->nama_member }}" data-id="{{ $member->id_member }}" class="btn_hapus"><i class="text-danger fa fa-trash"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for START button -->
<div class="modal fade" id="exampleModal-3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-3" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <form action="{{ route('dashboard.start') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <h4 id="cen" class="text-center"></h4>
                    <input type="hidden" name="id" id="id">
                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Atas Nama" autofocus required>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-block">START</button>
                    <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('.btn_star').forEach(button => {
            button.addEventListener('click', function() {
                let id = this.getAttribute('data-id');
                let nm = this.getAttribute('data-nm');
                document.getElementById('id').value = id;
                document.getElementById('cen').textContent = nm;
                document.getElementById('nama').focus();
            });
        });

        document.getElementById('dbyr').addEventListener('keyup', function() {
            let total = parseInt(document.getElementById('total').value);
            let byr = this.value.replace(/Rp\.|\./g, '');
            let subTotal = parseInt(byr) - total;

            let formattedSubTotal = subTotal.toLocaleString('id-ID', { minimumFractionDigits: 0 });
            document.getElementById('by').value = byr;
            if (subTotal >= 0) {
                document.getElementById('kemd').value = `KEMBALI : Rp. ${formattedSubTotal}`;
            } else {
                document.getElementById('kemd').value = `KURANG : Rp. ${formattedSubTotal}`;
            }
        });
    });
</script>
@endpush
