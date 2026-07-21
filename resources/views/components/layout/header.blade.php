<div class="header-wrapper">
   <header class="header">
      <div class="header__inner">
         <a 
            class="logo" 
            aria-label="Deliciousthings Home page"
            href="{{ url('/') }}"
         >
            <span class="logo__inner">D</span><span class="logo__inner">ts</span>
         </a>

         <nav 
            class="header__navmenu mobile-menu"
            x-data="mobileMenu"
         >
            <div class="header__cta-buttons">
               <a class="cta--secondary" href="{{ url('/login') }}">Anmelden</a>
               <a class="cta--primary" href="{{ url('/register') }}">Loslegen</a>
            </div>
            <button 
               class="mobile-menu__trigger" 
               type="button"
               @click="openMenu"
            >
               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#df4d69" width="18">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
               </svg>
            </button>

            <div 
               class="mobile-menu__content"
               x-cloak
               x-show="open"
            >
               <div class="flex justify-end">
                  <button 
                     class="mobile-menu__trigger" 
                     type="button"
                     @click="closeMenu"
                  >
                     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#df4d69" width="18">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                     </svg>
                  </button>
               </div>

               <div class="header__cta-buttons--mobile">
                  <a class="cta--secondary" href="{{ url('/login') }}">Anmelden</a>
                  <a class="cta--primary" href="{{ url('/register') }}">Loslegen</a>
               </div>
            </div>
         </nav>
      </div>
   </header>
</div>