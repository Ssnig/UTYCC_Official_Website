<link rel="stylesheet" href="../../CSS/footer.css">
<div class="bg-white shadow-md sticky top-0 z-50">
    <nav class="container mx-auto px-6 py-3 flex justify-between items-center">
      <a href="../home.php" class="flex items-center space-x-3">
        <div class="p-2 rounded-lg">
          <img src="../Img/logo/utycc_logo_favicon/favicon.ico" alt="UTYCC Logo" />
        </div>
        <div>
          <span class="text-lg font-bold text-blue-900 block">UTYCC</span>
          <span class="text-xs text-gray-500" data-lang-key="utycc_full_name">University of Technology (Yatanarpon Cyber
            City)</span>
        </div>
      </a>
      <div class="hidden md:flex items-center space-x-6">
       <a href="../about.php" class="nav-link text-gray-700 hover:text-blue-800 transition font-medium"
          data-lang-key="nav_about">ကျွန်ုပ်တို့အကြောင်း</a>
        <a href="../activity.php" class="nav-link text-gray-700 hover:text-blue-800 transition font-medium"
          data-lang-key="nav_activity">လှုပ်ရှားမှုများ</a>
        <a href="../exam_results.php" class="nav-link text-gray-700 hover:text-blue-800 transition font-medium"
          data-lang-key="nav_examresult">အောင်စာရင်းများ</a>

        <!-- Language Switcher Dropdown - Updated Style -->
        <div class="relative ml-4">
          <div id="lang-switcher-container-desktop">
            <!-- Custom Button -->
            <button
              class="lang-switcher-button relative flex items-center bg-gray-100 hover:bg-gray-200 rounded-md transition py-1.5 pl-3 pr-10 text-left cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700 font-medium">
              <img id="selected-lang-flag-desktop" src="https://flagcdn.com/w20/mm.png" alt="Selected Flag"
                class="h-4 w-6 object-cover flex-shrink-0">
              <span id="selected-lang-text-desktop" class="ml-2">မြန်မာ</span>
              <i class="fas fa-chevron-down text-gray-500 text-xs absolute right-3 pointer-events-none"></i>
            </button>
            <!-- Custom Dropdown Menu -->
            <div
              class="lang-switcher-menu hidden absolute mt-1 w-auto min-w-full rounded-md bg-white shadow-lg z-20 ring-1 ring-black ring-opacity-5">
              <a href="#"
                class="lang-switcher-option whitespace-nowrap flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                data-lang="my">
                <img src="https://flagcdn.com/w20/mm.png" alt="Myanmar Flag"
                  class="h-4 w-6 mr-3 object-cover flex-shrink-0">
                <span>မြန်မာ</span>
              </a>
              <a href="#"
                class="lang-switcher-option whitespace-nowrap flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                data-lang="en">
                <img src="https://flagcdn.com/w20/gb.png" alt="UK Flag" class="h-4 w-6 mr-3 object-cover flex-shrink-0">
                <span>English</span>
              </a>
            </div>
          </div>
          <!-- Hidden original select to maintain JS compatibility -->
          <select id="language-switcher-desktop" class="hidden">
            <option value="my">မြန်မာ</option>
            <option value="en">English</option>
          </select>
        </div>
      </div>
      <button id="mobile-menu-button" class="md:hidden text-blue-900">
        <i class="fas fa-bars text-2xl"></i>
      </button>
    </nav>
    <div id="mobile-menu" class="hidden md:hidden px-6 pb-4 border-t">
      <br><br>
      <a href="./about.php" class="nav-link text-gray-700 hover:text-blue-800 transition font-medium"
        data-lang-key="nav_about_mobile">ကျွန်ုပ်တို့အကြောင်း</a>
        <br><br>
      <a href="./activity.php" class="nav-link text-gray-700 hover:text-blue-800 transition font-medium"
        data-lang-key="nav_activity_mobile">လှုပ်ရှားမှုများ</a>
        <br><br>
      <a href="./exam_results.php" class="nav-link text-gray-700 hover:text-blue-800 transition font-medium"
        data-lang-key="nav_examresult_mobile">အောင်စာရင်းများ</a>
        <br><br>
      <div class="relative mt-4 pt-4 border-t">
        <!-- Language Switcher for Mobile -->
        <div id="lang-switcher-container-mobile" class="relative">
          <!-- Custom Button -->
          <button
            class="lang-switcher-button relative flex items-center w-full bg-gray-100 hover:bg-gray-200 rounded-md transition py-2 pl-4 pr-10 text-left cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700 font-medium">
            <img id="selected-lang-flag-mobile" src="https://flagcdn.com/w20/mm.png" alt="Selected Flag"
              class="h-4 w-6 object-cover flex-shrink-0">
            <span id="selected-lang-text-mobile" class="ml-3">မြန်မာ</span>
            <i class="fas fa-chevron-down text-gray-500 text-sm absolute right-4 pointer-events-none"></i>
          </button>
          <!-- Custom Dropdown Menu -->
          <div
            class="lang-switcher-menu hidden absolute mt-1 w-full rounded-md bg-white shadow-lg z-20 ring-1 ring-black ring-opacity-5">
            <a href="#" class="lang-switcher-option flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
              data-lang="my">
              <img src="https://flagcdn.com/w20/mm.png" alt="Myanmar Flag"
                class="h-4 w-6 mr-3 object-cover flex-shrink-0">
              <span>မြန်မာ</span>
            </a>
            <a href="#" class="lang-switcher-option flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
              data-lang="en">
              <img src="https://flagcdn.com/w20/gb.png" alt="UK Flag" class="h-4 w-6 mr-3 object-cover flex-shrink-0">
              <span>English</span>
            </a>
          </div>
        </div>
        <!-- Hidden original select to maintain JS compatibility -->
        <select id="language-switcher-mobile" class="hidden">
          <option value="my">မြန်မာ</option>
          <option value="en">English</option>
        </select>
      </div>
    </div>
 </div>
      <nav
        class="container mx-auto px-6 py-3 flex justify-between items-center"
      >
        <a href="#" class="flex items-center space-x-3">
          <div class="p-2 rounded-lg">
                               <img src="../Img/logo/utycc_logo.png" alt="UTYCC Logo" style="height:48px; width:auto; max-width:120px;" />

          </div>
          <div>
            <span class="text-lg font-bold text-blue-900 block">UTYCC</span>
            <span class="text-xs text-gray-500" data-lang-key="utycc_full_name"
              >University of Technology (Yatanarpon Cyber City)</span
            >
          </div>
        </a>
        <div class="hidden md:flex items-center space-x-6">
          <a
            href="#about"
            class="nav-link text-gray-700 hover:text-blue-800 transition font-medium"
            data-lang-key="nav_about"
            >About Us</a
          >
          <a
            href="#programs"
            class="nav-link text-gray-700 hover:text-blue-800 transition font-medium"
            data-lang-key="nav_programs"
            >Academic Programs</a
          >
          <a
            href="#collaboration"
            class="nav-link text-gray-700 hover:text-blue-800 transition font-medium"
            data-lang-key="nav_collaboration"
            >Collaboration</a
          >
          <a
            href="#contact"
            class="nav-link text-gray-700 hover:text-blue-800 transition font-medium"
            data-lang-key="nav_contact"
            >Contact</a
          >

          <div class="relative ml-4">
            <div
              class="relative flex items-center bg-gray-100 hover:bg-gray-200 rounded-full transition"
            >
              <i
                class="fas fa-globe text-gray-500 absolute left-3 z-10 pointer-events-none"
              ></i>
              <select
                id="language-switcher"
                class="cursor-pointer appearance-none bg-transparent text-gray-700 font-medium rounded-full py-1.5 pl-9 pr-8 focus:outline-none focus:ring-2 focus:ring-blue-500"
              >
                <option value="my">မြန်မာ</option>
                <option value="en">English</option>
              </select>
              <i
                class="fas fa-chevron-down text-gray-500 text-xs absolute right-3 z-10 pointer-events-none"
              ></i>
            </div>
          </div>
        </div>
        <button id="mobile-menu-button" class="md:hidden text-blue-900">
          <i class="fas fa-bars text-2xl"></i>
        </button>
      </nav>
      <div id="mobile-menu" class="hidden md:hidden px-6 pb-4 border-t">
        <a
          href="#about"
          class="nav-link block py-2 text-gray-700 hover:text-blue-800"
          data-lang-key="nav_about_mobile"
          >About Us</a
        >
        <a
          href="#programs"
          class="nav-link block py-2 text-gray-700 hover:text-blue-800"
          data-lang-key="nav_programs_mobile"
          >Academic Programs</a
        >
        <a
          href="#collaboration"
          class="nav-link block py-2 text-gray-700 hover:text-blue-800"
          data-lang-key="nav_collaboration_mobile"
          >Collaboration</a
        >
        <a
          href="#contact"
          class="nav-link block py-2 text-gray-700 hover:text-blue-800"
          data-lang-key="nav_contact_mobile"
          >Contact</a
        >
      </div>
    </div>

