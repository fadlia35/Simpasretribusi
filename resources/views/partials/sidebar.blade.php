<div class="nk-sidebar" style="background-color: black">           
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu" style="background-color: black;color:white">
                    <li class="nav-label">Menu</li>
                    @if (Auth::user()->tipe === 'kadis')
                       {{-- <li>
                            <a href="widgets.html" aria-expanded="false">
                                <i class="icon-badge menu-icon"></i><span class="nav-text">Beranda</span>
                            </a>
                        </li> --}}
                        <li>
                            <a href="{{ route('user.index') }}" aria-expanded="false">
                                <i class="icon-badge menu-icon"></i>
                                <span class="nav-text">Pengguna Aplikasi</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('algoritma.index') }}" aria-expanded="false">
                                <i class="icon-badge menu-icon"></i>
                                <span class="nav-text">Algoritma Prediksi</span>
                            </a>
                        </li>  
                    @endif
                    @if (Auth::user()->tipe ==='operator')
                    <li>
                            <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                                <i class="icon-speedometer menu-icon"></i><span class="nav-text">Pasar</span>
                            </a>
                            <ul aria-expanded="false">
                                <li><a href="{{ route('pasar.index') }}">Pasar </a></li>
                                <li><a href="{{ route('blok.index') }}">Blok</a></li>
                            </ul>
                        </li>
                        <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-speedometer menu-icon"></i><span class="nav-text">Informasi</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('penindakan.index') }}">Penindakan </a></li>
                            <li><a href="{{ route('sembako.index') }}">Sembako </a></li>
                        </ul>
                    </li>
                    
                    <li>
                        <a href="{{ route('pemilik.index') }}" aria-expanded="false">
                            <i class="icon-badge menu-icon"></i><span class="nav-text">Pemilik</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('usaha.index') }}" aria-expanded="false">
                            <i class="icon-badge menu-icon"></i><span class="nav-text">Usaha</span>
                        </a>
                    </li>
                    
                    @endif
                    @if (Auth::guard('pemilik')->user())

                        <li>
                            <a href="{{ route('pemilik.profile') }}" aria-expanded="false">
                                <i class="icon-badge menu-icon"></i><span class="nav-text">Pemilik</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('pemilik.usaha') }}" aria-expanded="false">
                                <i class="icon-badge menu-icon"></i><span class="nav-text">Usaha</span>
                            </a>
                        </li>
                        <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-speedometer menu-icon"></i><span class="nav-text">Informasi</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('penindakan-pemilik.index') }}">Penindakan </a></li>
                            <li><a href="{{ route('sembako-pemilik.index') }}">Sembako </a></li>
                        </ul>
                    </li>
                    
                    @endif
                    @if (Auth::user()->tipe === 'bendahara' || Auth::user()->tipe === 'operator')
                        <li>
                            <a href="{{ route('pembayaran.index') }}" aria-expanded="false">
                                <i class="icon-badge menu-icon"></i><span class="nav-text">Retribusi</span>
                            </a>
                        </li>  
                    @endif
                    {{-- <li>
                        <a href="{{ route('pembayaran.index') }}" aria-expanded="false">
                            <i class="icon-badge menu-icon"></i><span class="nav-text">Retribusi</span>
                        </a>
                    </li> --}}
                    
                    
                    @if (Auth::user()->tipe == 'bendahara')
                        <li>
                            <a href="{{ route('rekening.index') }}" aria-expanded="false">
                                <i class="icon-badge menu-icon"></i><span class="nav-text">Rekening</span>
                            </a>
                        </li>    
                    @endif
                    
                    
                    <li>
                        <a href="{{ route('logout') }}" aria-expanded="false">
                            <i class="fa fa-sign-out" aria-hidden="true"></i>
                            <span class="nav-text">Keluar</span>
                        </a>
                    </li>
                    
                </ul>
            </div>
        </div>