@php $sidebarLogo = settings()->getFirstMediaUrl('settings'); @endphp

<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show {{ request()->routeIs('app.pos.*') ? 'c-sidebar-minimized' : '' }}" id="sidebar">
    <div class="c-sidebar-brand d-md-down-none">
        <a href="{{ route('home') }}" style="display:flex;align-items:center;justify-content:center;width:100%;">

            {{-- Logo completo (sidebar expandido) --}}
            @if ($sidebarLogo)
                <img class="c-sidebar-brand-full" src="{{ $sidebarLogo }}" alt="Logo"
                     width="110" style="object-fit:contain;max-height:48px;"
                     onerror="this.style.display='none';document.getElementById('brand-text-full').style.display='flex';">
            @endif
            <div id="brand-text-full" class="c-sidebar-brand-full"
                 style="{{ $sidebarLogo ? 'display:none;' : 'display:flex;' }} align-items:center;gap:10px;">
                <div style="width:36px;height:36px;border-radius:8px;background:rgba(255,255,255,0.15);border:1.5px solid rgba(255,255,255,0.25);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <i class="bi bi-box-seam" style="color:#fff;font-size:1.1rem;"></i>
                </div>
                <span style="color:#fff;font-weight:700;font-size:1rem;letter-spacing:0.5px;white-space:nowrap;">
                    {{ config('app.name') }}
                </span>
            </div>

            {{-- Logo minimizado (sidebar colapsado) --}}
            @if ($sidebarLogo)
                <img class="c-sidebar-brand-minimized" src="{{ $sidebarLogo }}" alt="Logo"
                     width="36" style="object-fit:contain;max-height:36px;border-radius:6px;"
                     onerror="this.style.display='none';document.getElementById('brand-icon-min').style.display='flex';">
            @endif
            <div id="brand-icon-min" class="c-sidebar-brand-minimized"
                 style="{{ $sidebarLogo ? 'display:none;' : 'display:flex;' }} width:36px;height:36px;border-radius:8px;background:rgba(255,255,255,0.15);border:1.5px solid rgba(255,255,255,0.25);align-items:center;justify-content:center;">
                <i class="bi bi-box-seam" style="color:#fff;font-size:1.1rem;"></i>
            </div>

        </a>
    </div>
    <ul class="c-sidebar-nav">
        @include('layouts.menu')
        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps__rail-y" style="top: 0px; height: 692px; right: 0px;">
            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 369px;"></div>
        </div>
    </ul>
    <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
</div>
