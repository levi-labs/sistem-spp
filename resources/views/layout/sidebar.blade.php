  <ul class="nav d-print-none">
      <li class="nav-item">
          <a class="nav-link" href="{{ url('/dashboard') }}">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">Dashboard</span>
          </a>
          @if (auth()->user()->akses_user == 'bendahara' || auth()->user()->akses_user == 'siswa')
              <a class="nav-link" href="{{ url('/cek-invoice') }}">
                  <i class="mdi mdi-receipt-text-check menu-icon"></i>
                  <span class="menu-title">Cek invoice</span>
              </a>
          @endif
          @if (auth()->user()->akses_user == 'bendahara')
              <a class="nav-link" href="{{ url('/report') }}">
                  <i class="mdi mdi-finance menu-icon"></i>
                  <span class="menu-title">Report</span>
              </a>
          @endif
      </li>
      {{-- <li class="nav-item">
          <a class="nav-link" href="{{ url('/daftar-pembayaran-siswa') }}">
              <i class="mdi  mdi-currency-usd menu-icon"></i>
              <span class="menu-title">Daftar Pembayaran</span>
          </a>
      </li> --}}
      @if (auth()->user()->akses_user == 'bendahara' || auth()->user()->akses_user == 'siswa')
          <li class="nav-item nav-category">Pembayaran</li>
      @endif

      <li class="nav-item">
          @if (auth()->user()->akses_user == 'bendahara' || auth()->user()->akses_user == 'siswa')
              <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false"
                  aria-controls="ui-basic">
                  <i class="menu-icon mdi mdi-floor-plan"></i>
                  <span class="menu-title">Menu Pembayaran</span>
                  <i class="menu-arrow"></i>
              </a>
          @endif
          <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                  @if (auth()->user()->akses_user == 'bendahara' || auth()->user()->akses_user == 'siswa')
                      <li class="nav-item"> <a class="nav-link" href="{{ url('/daftar-belum-dibayar') }}">Belum
                              Terbayar</a>
                      </li>
                      <li class="nav-item"> <a class="nav-link" href="{{ url('/daftar-sudah-dibayar') }}">Sudah
                              Terbayar</a>
                      </li>
                  @endif
                  @if (auth()->user()->akses_user == 'bendahara')
                      <li class="nav-item"> <a class="nav-link" href="{{ url('/daftar-kelas') }}">Daftar Kelas</a>
                      </li>
                      <li class="nav-item"> <a class="nav-link" href="{{ url('/daftar-biaya-lain') }}">Biaya Lain</a>
                      </li>
                  @endif

              </ul>
          </div>
      </li>

      @if (auth()->user()->akses_user == 'bendahara')
          <li class="nav-item nav-category">Siswa</li>
          <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#form-elements" aria-expanded="false"
                  aria-controls="form-elements">
                  <i class="menu-icon mdi mdi-card-text-outline"></i>
                  <span class="menu-title">Menu Siswa</span>
                  <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="form-elements">
                  <ul class="nav flex-column sub-menu">
                      <li class="nav-item"><a class="nav-link" href="{{ url('/daftar-siswa') }}">Daftar
                              Siswa</a></li>
                  </ul>
              </div>
          </li>
      @endif
      @if (auth()->user()->akses_user == 'bendahara' || auth()->user()->akses_user == 'master')
          <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
                  <i class="menu-icon mdi mdi-chart-line"></i>
                  <span class="menu-title">Menu Bendahara</span>
                  <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="charts">
                  <ul class="nav flex-column sub-menu">
                      <li class="nav-item"> <a class="nav-link" href="{{ url('/daftar-bendahara') }}">Daftar
                              Bendahara</a>
                      </li>
                  </ul>
              </div>
          </li>

          <li class="nav-item nav-category">User Management</li>
          <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                  <i class="menu-icon mdi mdi-account-circle-outline"></i>
                  <span class="menu-title">Daftar Users</span>
                  <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="auth">
                  <ul class="nav flex-column sub-menu">
                      <li class="nav-item"> <a class="nav-link" href="{{ url('/daftar-users') }}"> Daftar All Users </a>
                      </li>
                  </ul>
              </div>
          </li>
      @endif
      @if (auth()->user()->akses_user == 'master')
          <div class="nav-item">
              <a class="nav-link" href="{{ url('/logout') }}">
                  <i class="mdi mdi-logout menu-icon"></i>
                  <span class="menu-title">Log Out</span>
              </a>
          </div>
      @endif


      {{-- 
      <li class="nav-item nav-category">help</li>
      <li class="nav-item">
          <a class="nav-link" href="http://bootstrapdash.com/demo/star-admin2-free/docs/documentation.html">
              <i class="menu-icon mdi mdi-file-document"></i>
              <span class="menu-title">Documentation</span>
          </a>
      </li> --}}
  </ul>
