 <!-- ========== Left Sidebar Start ========== -->
 <div class="vertical-menu">

     <div class="h-100">

         <div class="user-wid text-center py-4">
             <div class="user-img">
                 @if (auth()->user()->image)
                     <img src="{{ asset('storage/' . auth()->user()->image) }}" alt=""
                         class="avatar-md mx-auto rounded-circle">
                 @else
                     <img src="/templates/layouts/assets/images/user/default.png" alt=""
                         class="avatar-md mx-auto rounded-circle">
                 @endif


             </div>

             <div class="mt-3">

                 <a href="#" class="text-dark fw-medium font-size-16">{{ ucwords(auth()->user()->name) }}</a>


             </div>
         </div>
         <!--- Sidemenu -->
         <div id="sidebar-menu">
             <!-- Left Menu Start -->
             <ul class="metismenu list-unstyled" id="side-menu">
                 <li class="menu-title">Beranda</li>

                 <li>
                     <a href="{{ route('dashboard') }}" class="waves-effect">
                         <i class="mdi mdi-airplay"></i>
                         <span>Dashboard</span>
                     </a>

                 </li>

                 <li>
                     <a href="{{ route('staff.index') }}" class=" waves-effect">
                         <i class="mdi mdi-account-outline"></i>
                         <span>Staff Desa</span>
                     </a>
                 </li>

                 <li>
                     <a href="{{ route('position.index') }}" class=" waves-effect">
                         <i class="mdi mdi-calendar-text"></i>
                         <span>Posisi</span>
                     </a>
                 </li>
                 <li class="menu-title">Kriteria</li>

                 <li>
                     <a href="javascript: void(0);" class="has-arrow waves-effect">
                         <i class="mdi mdi-checkbox-multiple-blank-outline"></i>
                         <span>Kriteria</span>
                     </a>
                     <ul class="sub-menu" aria-expanded="false">
                         <li><a href="{{ route('aturan.index') }}">Aturan Kriteria</a></li>
                         <li><a href="{{ route('kriteria.index') }}">Kriteria</a></li>
                     </ul>
                 </li>


             </ul>
         </div>
         <!-- Sidebar -->
     </div>
 </div>
 <!-- Left Sidebar End -->
 @include('admin.partials.page_title')
