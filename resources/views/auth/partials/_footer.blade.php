 <!--begin::Footer container-->
 <div class="app-container container-fluid d-flex flex-column flex-md-row flex-center flex-md-stack py-3">
     <!--begin::Copyright-->
     <div class="text-dark order-2 order-md-1">
         <span class="text-muted fw-semibold me-1">
             @if (app()->getLocale() === 'bn')
                 @php
                     $currentYear = date('Y');
                     $banglaYear = str_replace(range(0, 9), ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'], $currentYear);
                 @endphp
                 &copy; {{ __('dashboard-footer.copyright_year', ['year' => $banglaYear]) }}
             @else
                 &copy; {{ __('dashboard-footer.copyright_year', ['year' => date('Y')]) }}
             @endif
         </span>
         <a href="https://newgen-bd.com/" target="_blank"
             class="text-gray-800 text-hover-primary">{{ __('dashboard-footer.company_name') }}</a>
     </div>
     <!--end::Copyright-->
     <!--begin::Menu-->
     <ul class="menu menu-gray-600 menu-hover-primary fw-semibold order-1">
         <li class="menu-item">
             <a href="" target="_blank" class="menu-link px-2">{{ __('dashboard-footer.about_us') }}</a>
         </li>

     </ul>
     <!--end::Menu-->
 </div>
 <!--end::Footer container-->
