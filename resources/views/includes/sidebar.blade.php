<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        @if( Session::get('level') == '4')
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="p-t-30">
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('dashboard') }}" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-dropbox"></i><span class="hide-menu">Master Data </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="{{ route('pegawai') }}" class="sidebar-link"><i class="mdi mdi-account-card-details"></i><span class="hide-menu"> Pegawai </span></a></li>
                        <li class="sidebar-item"><a href="{{ route('jabatan') }}" class="sidebar-link"><i class="mdi mdi-account-card-details"></i><span class="hide-menu"> Jabatan </span></a></li>
                    </ul>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('kriteria') }}" aria-expanded="false"><i class="mdi mdi-arrange-bring-to-front"></i><span class="hide-menu">Kriteria</span></a></li>
                
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('admin') }}" aria-expanded="false"><i class="mdi mdi-account-box-outline"></i><span class="hide-menu">Data Admin</span></a></li>
            </ul>
        </nav>
        @else
        @endif
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>