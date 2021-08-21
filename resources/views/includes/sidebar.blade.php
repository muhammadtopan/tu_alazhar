<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        @if( Session::get('level') == '4')
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="p-t-30">
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('dashboard') }}" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>

                <li class="sidebar-item"> 
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi mdi-dropbox"></i><span class="hide-menu">Master Data </span>
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <!-- <li class="sidebar-item"> 
                            <a href="{{ route('jabatan') }}" class="sidebar-link"><i class="mdi mdi-account-switch"></i><span class="hide-menu"> Jabatan </span></a>
                        </li> -->
                        <li class="sidebar-item">
                            <a href="{{ route('kelas') }}" class="sidebar-link"><i class="mdi mdi-chair-school"></i><span class="hide-menu"> Kelas </span></a>
                        </li>
                        <!-- <li class="sidebar-item">
                            <a href="{{ route('jam_ajar') }}" class="sidebar-link"><i class="mdi mdi-clock"></i><span class="hide-menu"> Jam Ajar </span></a>
                        </li> -->
                        <li class="sidebar-item">
                            <a href="{{ route('pelajaran') }}" class="sidebar-link"><i class="mdi mdi-clipboard-text"></i><span class="hide-menu"> Mata Pelajaran </span></a>
                        </li>
                        <!-- <li class="sidebar-item">
                            <a href="{{ route('hari') }}" class="sidebar-link"><i class="mdi mdi-calendar"></i><span class="hide-menu"> Hari </span></a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('semester') }}" class="sidebar-link"><i class="mdi mdi-dns"></i><span class="hide-menu"> Semester </span></a>
                        </li> -->
                    </ul>
                </li>
                
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('pegawai') }}" aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span class="hide-menu"> Pegawai </span></a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi mdi-account-card-details"></i><span class="hide-menu"> Siswa </span>
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"> 
                            <a href="{{ route('siswa') }}" class="sidebar-link"><i class="mdi mdi-view-list"></i><span class="hide-menu"> Siswa Baru</span></a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('siswa-verified') }}" class="sidebar-link"><i class="mdi mdi-check"></i><span class="hide-menu"> Data Siswa </span></a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('jadwal_pelajaran') }}" aria-expanded="false"><i class="mdi mdi-calendar-clock"></i><span class="hide-menu"> Jadwal Pelajaran </span></a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('jadwal_ujian') }}" aria-expanded="false"><i class="mdi mdi-calendar-clock"></i><span class="hide-menu"> Jadwal Ujian </span></a>
                </li>
                <!-- <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('lapor') }}" aria-expanded="false"><i class="mdi mdi-file-multiple"></i><span class="hide-menu"> Lapor </span></a>
                </li> -->
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('surat') }}" aria-expanded="false"><i class="mdi mdi-message"></i><span class="hide-menu"> Surat </span></a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('absensi') }}" aria-expanded="false"><i class="fas fa-tasks"></i><span class="hide-menu"> Absensi </span></a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('spp') }}" aria-expanded="false"><i class="mdi mdi-credit-card-multiple"></i><span class="hide-menu"> SPP </span></a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('berkas') }}" aria-expanded="false"><i class="mdi mdi-file-multiple"></i><span class="hide-menu"> Berkas </span></a>
                </li>
                <!-- <li class="sidebar-item"> 
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('user') }}" aria-expanded="false"><i class="mdi mdi-account-box-outline"></i><span class="hide-menu">Data Admin</span></a>
                </li> -->
            </ul>
        </nav>
        @else
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="p-t-30">
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('dashboard') }}" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-dropbox"></i><span class="hide-menu">Master Data </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"> 
                            <a href="{{ route('materi') }}" class="sidebar-link"><i class="mdi mdi-file-multiple"></i><span class="hide-menu"> Materi </span></a>
                        </li>
                        <li class="sidebar-item"> 
                            <a href="{{ route('tugas') }}" class="sidebar-link"><i class="fas fa-tasks"></i><span class="hide-menu"> Tugas </span></a>
                        </li>
                        <li class="sidebar-item"> 
                            <a href="{{ route('kirim_tugas') }}" class="sidebar-link"><i class="mdi mdi-file-pdf"></i><span class="hide-menu"> Tugas Siswa </span></a>
                        </li>
                        <li class="sidebar-item"> 
                            <a href="{{ route('quis') }}" class="sidebar-link"><i class="mdi mdi-book-open-page-variant"></i><span class="hide-menu"> Quiz </span></a>
                        </li>
                        <li class="sidebar-item"> 
                            <a href="{{ route('nilai') }}" class="sidebar-link"><i class="mdi mdi-chart-bar"></i><span class="hide-menu"> Nilai </span></a>
                        </li>
                        <li class="sidebar-item"> 
                            <a href="{{ route('izin') }}" class="sidebar-link"><i class="mdi mdi-account-card-details"></i><span class="hide-menu"> Izin </span></a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        @endif
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>