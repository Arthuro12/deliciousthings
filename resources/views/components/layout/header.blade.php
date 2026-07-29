<div class="header-wrapper">
   <header class="header">
      <div class="header__inner">
         <a 
            class="logo" 
            aria-label="Deliciousthings Homeseite"
            href="{{ url('/') }}"
         >
            <span class="logo__prefix">D</span><span class="logo__suffix">ts</span>
         </a>

         <div 
            class="header__navmenu-wrapper"
            x-data="mobileMenu"
         >
            <nav class="header__navmenu">
               <ul class="list-none header__navmenu-items">
                  <li class="navmenu-item">
                     <a class="navmenu__link" href=""><span class="navmenu__link-text">Inspirationen</span></a>
                  </li>
                  <li class="navmenu-item">
                     <a class="navmenu__link" href=""><span class="navmenu__link-text">Über Uns</span></a>
                  </li>
               </ul>
               <div class="header__cta-buttons">
                  <a class="cta--secondary cta-link" href="{{ url('/login') }}">Anmelden</a>
                  <a class="cta--primary cta-link" href="{{ url('/register') }}">Loslegen</a>
               </div>
            </nav>

            <button 
               class="drawer-panel__trigger" 
               :class="{ 'drawer-panel__trigger--pressed': open }"
               type="button"
               @click="toggle"
            >
               <svg class="drawer-panel__trigger-icon drawer-panel__trigger-icon--hamburger" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#df4d69" width="18">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
               </svg>
               <svg class="drawer-panel__trigger-icon drawer-panel__trigger-icon--close" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#df4d69" width="18">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
               </svg>
            </button>

            <div 
               class="drawer-panel"
               :aria-hidden="(!open).toString()"
               x-cloak
               x-show="open"
               x-transition:enter="drawer-panel--enter"
               x-transition:enter-start="drawer-panel--enter-start"
               x-transition:enter-end="drawer-panel--enter-end"
               x-transition:leave="drawer-panel--leave"
               x-transition:leave-start="drawer-panel--leave-start"
               x-transition:leave-end="drawer-panel--leave-end"
            >
               <div class="drawer-panel__inner">
                  <ul class="list-none drawer-panel__items">
                     <li class="navmenu__item">
                        <a class="navmenu__link" href=""><span class="navmenu__link-text">Inspirationen</span></a>
                     </li>
                     <li class="navmenu__item">
                        <a class="navmenu__link" href=""><span class="navmenu__link-text">Über Uns</span></a>
                     </li>
                  </ul>

                  <div class="drawer-separator header__cta-buttons header__cta-buttons--mobile">
                     <a class="cta--secondary cta-link" href="{{ url('/login') }}">Anmelden</a>
                     <a class="cta--primary cta-link" href="{{ url('/register') }}">Loslegen</a>
                  </div>                
               </div>
            </div>
         </div>
      </div>
   </header>
</div>