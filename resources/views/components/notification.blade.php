<div>
    <!-- Nav Item - Alerts -->
    <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-bell fa-fw"></i>
            <!-- Counter - Alerts -->
            <span class="badge badge-danger badge-counter" id="total"></span>
        </a>
        <!-- Dropdown - Alerts -->
        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
            aria-labelledby="alertsDropdown">
            <h6 class="dropdown-header">
                Verifikasi Surat
            </h6>
            <div id="notif">

            </div>

            <a class="dropdown-item text-center small text-gray-500" href="{{ route('surat.Adminlist') }}">Show All
                Surat</a>
        </div>
    </li>

</div>
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script>
    // $(document).ready(function() {
    //     setInterval(() => {
    //         $.ajax({
    //             url: "{{ route('api.notify') }}",
    //             // return the result
    //             success: function(res) {
    //                 let html = '';
    //                 $('#total').html(res.length);
    //                 res.forEach(e => {
    //                     let date = new Date(e.created_at).toLocaleDateString('id', {  day: '2-digit', month: 'long', year: 'numeric' });
                        
    //                     html = html + ` <a class="dropdown-item d-flex align-items-center" href="{{ route('surat.Adminlist') }}">
    //                             <div class="mr-3">
    //                                 <div class="icon-circle bg-primary">
    //                                     <i class="fas fa-file-alt text-white"></i>
    //                                 </div>
    //                             </div>
    //                             <div>
    //                                 <div class="small text-gray-500">` + date + `</div>
    //                                 <span class="font-weight-bold">` + e.penduduk.nama_lengkap + `</span>
    //                                 <br>
    //                                 <span class="font-weight-bold">( ` + e.jenis_surat.nama + ` )</span>
    //                             </div>
    //                         </a>`;
    //                 });

    //                 $('#notif').html(html);

    //             },
    //         })
    //     }, 1000);

    // })
</script>
