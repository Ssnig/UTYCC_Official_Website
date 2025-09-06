<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <link rel="stylesheet" href="../CSS/star-layout.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="../CSS/footer.css" />
  <link rel="stylesheet" href="../CSS/BE_Advantages.css" />
  <script src="../JS/star-layout.js"></script>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- name ပြောင်းရန် -->
  <title>Advanced Materials Engineering</title>
  <link rel="shortcut icon" href="../Img/logo/utycc_logo_favicon/favicon.ico" type="image/x-icon" />

  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link rel="stylesheet" href="../CSS/hero-carousel.css" />
  <script src="../JS/hero-carousel.js"></script>
  <link rel="stylesheet" href="../CSS/font.css" />
  <style>
    body {
      font-family: "Inter", sans-serif;
    }

    .hero-bg {
      background-image: linear-gradient(rgba(0, 51, 102, 0.75),
          rgba(0, 51, 102, 0.75)),
        url("https://placehold.co/1600x800/003366/FFFFFF?text=UTYCC+Campus");
      background-size: cover;
      background-position: center;
    }

    .stat-card {
      background-color: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(10px);
    }

    /* This new style makes the program cards look clickable */
    .program-card {
      cursor: pointer;
    }
  </style>
</head>

<body class="bg-gray-100">
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

  <!-- ဒီကစရန် -->
  <div class="w-full max-w-7xl bg-white rounded-2xl shadow-xl overflow-hidden mx-auto mt-8">
    <div class="md:flex">
      <div class="md:shrink-0">
        <!-- ဒီမှာပုံပြောင်းရန် -->
        <img id="AME" class="h-48 w-full object-cover md:h-full md:w-48" src="../Img/logo/AME_updated.jpg"
          alt="Major Image" />
      </div>
      <div class="p-8">
        <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold" data-lang-key="uni_name">
          University of Technology (Yatanarpon Cyber City)
        </div>
        <a id="major-title" href="#"
          class="block mt-1 text-lg leading-tight font-medium text-black hover:underline"data-lang-key="major_Title">Advanced Materials Engineering</a>
        <p id="major-description" class="mt-2 text-slate-500"data-lang-key="major_Description">
         နည်းပညာတက္ကသိုလ် (ရတနာပုံဆိုက်ဘာစီးတီး)  ၏ အဆင့်မြင့်ဒြပ်ပစ္စည်းထုတ်လုပ်မှုအင်ဂျင်နီယာဌာန (Faculty of Advanced Materials Engineering - AME) သည် သတ္တုနှင့် သတ္တုစပ်ပစ္စည်းများကို ဒီဇိုင်းရေးဆွဲခြင်းနှင့် ဖွံ့ဖြိုးတိုးတက်စေရန် အခြေခံသိပ္ပံနှင့် နည်းပညာများကို လေ့ကျင့်သင်ကြားပေးသော ဘာသာရပ်တစ်ခုဖြစ်ပါတယ်။
        </p>
      </div>
    </div>
  </div>
  <!-- headline -->
  <!-- Hero Section to start the page with a strong visual -->
  <header class="mb-12 rounded-3xl overflow-hidden shadow-2xl py-4">
    <div class="relative h-96">
      <!-- ဒီအောက်ကဟာ ကြိုက်တဲ့ပုံထည့်လို့ရတယ် ဥပမာ majorနဲ့ဆိုင်တဲ့ buildingတွေ ပုံတွေက "./Img/utycc_buildings/"ထဲက ဟာတွေယူသုံး srcမှာနော် -->
      <img src="../Img/utycc_buildings/Lab5.JPG" alt="Hero image of a bustling university campus"
        class="absolute inset-0 w-full h-full object-cover brightness-75" />
      <div class="relative z-10 flex items-center justify-center h-full bg-black bg-opacity-40">
        <div class="text-center text-white p-4">
          <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight mb-4"
            style="font-family: 'Times New Roman', Times, serif">
            Our Motto
          </h1>
          <!-- mottoက မေဂျာ တစ်ခုချင်းစီရဲ့ ဆောင်ပုဒ် အမ မယမင်း ရဲ့ doc fileတွေမှာသေချာထည့်ပေးထားတယ် အဲ့တာကိုထည့်ပေး -->
          <p class="text-lg sm:text-xl font-light max-w-2xl mx-auto italic" data-lang-key="motto">
            “Let's Improve Engineering Works with the Power of Materials”
          </p>
        </div>
      </div>
    </div>
  </header>
  <br />

  <!-- Main content container with a grid of cards -->
  <div class="container mx-auto">
    <!-- အောက်ကဟာတွေက ရည်ရွယ်ချက် တာဝန်တွေ ခေါင်းစဥ်နဲ့ စာကိုယ်ခွဲထည့်  -->
    <h2 class="text-3xl sm:text-4xl font-bold text-center mb-6" data-lang-key="objectivesH">
      AME ဌာန၏ ရည်ရွယ်ချက်နှင့် တာဝန်များ
    </h2>
    <p class="text-center text-lg text-gray-600 mb-12 max-w-3xl px-2 mx-auto" data-lang-key="objectives">
      ပစ္စည်း၏ လက္ခဏာများ၊ ပြုပြင်လုပ်ဆောင်နည်းများ၊ နှင့် အသုံးချနည်းများကို နက်နက်ရှိုင်းရှိုင်း နားလည်စေရန်။
      အဆင့်မြင့်ပစ္စည်းများကို ဖန်တီးအသုံးချခြင်းနှင့် စက်မှုလုပ်ငန်းတွင် တီထွင်တိုးတက်မှုတွင် ပါဝင်နိုင်စေရန်။
      ပစ္စည်းဗေဒ၊ သတ္တုဗေဒနှင့် အင်ဂျင်နီယာနယ်ပယ်များတွင် အထူးကျွမ်းကျင်မှုများ ရရှိစေရန်။
      ကျောင်းသား/သူများကို အလုပ်အကိုင် ရရှိနိုင်စေရန် နှင့် စက်မှုလုပ်ငန်းများတွင် ထိရောက်စွာ လုပ်ကိုင်နိုင်စေရန်။
      စသည်တို့ ဖြစ်ပါသည်။ ထို့အပြင် တက်ရောက်လေ့လာမည့် ကျောင်းသား/သူများအား မိမိတို့ အထူးပြုလေ့လာသည့်
      ပစ္စည်းနည်းပညာနှင့် ပတ်သက်သည့် နောက်ဆုံးပေါ် သိပ္ပံနှင့် နည်းပညာများကို သင်ယူနိုင်ရန် လေ့ကျင့်သင်ကြားပေးမည်
      ဖြစ်ပါသည်။
      AME ဘာသာရပ်သင်တန်းသည် ကျောင်းသား/သူများကို အနာဂတ်အလုပ်အကိုင်မှာသာမက၊ သုတေသန၊ ဖန်တီးတီထွင်မှု နယ်ပယ်တွေမှာပါ
      အောင်မြင်စွာ ပါဝင်ဆောင်ရွက်နိုင်ရန် ရည်ရွယ်ထားပြီး အဓိကလေ့လာရမည့် အကြောင်းအရာများမှာ အောက်ပါအတိုင်းဖြစ်ပါသည်။
    </p>

    <!-- Grid to hold the cards -->
    <div id="majorsGrid" class="grid gap-8 grid-cols-1 md:grid-cols-2 lg:grid-cols-3 py-4">
      <!-- cardတွေမှာက ခေါင်းစဥ်တွေ နံပါတ်တွေကို အစဥ်လိုက်ထည့်ပေး တစ်ခုချင်းစီတွက် card တစ်ခုစီ အမယမင်းရေးထားတဲ့ IST docက ပုံစံနဲ့ အောက်ဟာကိုယှဥ်ကြည့် h3မှာခေါင်းစဥ် li မှာအောက်ကအချက် အချက်လိုရင်liထည့်ထပ်ရေး cardလိုရင် cardတစ်ခုကို copy paste သုံးလို့ရ -->
      <!-- Card 1  -->
      <div
        class="bg-white rounded-xl shadow-lg p-6 flex flex-col items-center text-center transition-transform duration-300 hover:scale-105 hover:shadow-2xl">
        <div class="bg-indigo-500 text-white rounded-full p-3 mb-4">
          <!-- Icon for the card - using a simple SVG or emoji is great -->
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="2" y="7" width="8" height="10" rx="1"></rect>
            <circle cx="4" cy="11" r="0.5"></circle>
            <circle cx="6" cy="11" r="0.5"></circle>
            <circle cx="8" cy="11" r="0.5"></circle>
            <circle cx="4" cy="13" r="0.5"></circle>
            <circle cx="6" cy="13" r="0.5"></circle>
            <circle cx="8" cy="13" r="0.5"></circle>

            <line x1="11" y1="12" x2="13" y2="12"></line>

            <rect x="14" y="7" width="8" height="10" rx="1"></rect>
            <path d="M16 11l-0.5 0.5"></path>
            <circle cx="18" cy="11" r="0.5"></circle>
            <circle cx="20" cy="11" r="0.5"></circle>
            <circle cx="16" cy="13" r="0.5"></circle>
            <circle cx="18" cy="13" r="0.5"></circle>
            <path d="M20 13l0.5 -0.5"></path>

            <line x1="18" y1="5" x2="18" y2="7"></line>
            <polyline points="16 6 18 4 20 6"></polyline>
          </svg>
        </div>
        <h3 class="text-xl font-bold mb-2" data-lang-key="mate_fund">Materials Science Fundamentals</h3>
        <ol class="list-decimal list-inside space-y-2 text-gray-700">
          <li class="font-medium text-lg" data-lang-key="matersc_1">
            Structure and properties of materials
          </li>
          <li class="font-medium text-lg" data-lang-key="matersc_2">Phase diagrams and thermodynamics</li>
          <li class="font-medium text-lg" data-lang-key="matersc_3">
            Crystallography and defects
          </li>
        </ol>
      </div>

      <!-- Card 2 -->
      <div
        class="bg-white rounded-xl shadow-lg p-6 flex flex-col items-center text-center transition-transform duration-300 hover:scale-105 hover:shadow-2xl">
        <div class="bg-green-500 text-white rounded-full p-3 mb-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M4 16h16v4H4z"></path>
            <path d="M6 16l-2 4"></path>
            <path d="M18 16l2 4"></path>

            <path d="M8 13h8v3H8z"></path>

            <rect x="9" y="2" width="6" height="6" rx="1"></rect>
            <line x1="12" y1="8" x2="12" y2="11"></line>

            <line x1="6" y1="5" x2="8" y2="7"></line>
            <line x1="18" y1="5" x2="16" y2="7"></line>
          </svg>
        </div>
        <h3 class="text-xl font-bold mb-2" data-lang-key="matel_alloy">Metallurgy and Alloy Design</h3>
        <ol class="list-decimal list-inside space-y-2 text-gray-700">
          <li class="font-medium text-lg" data-lang-key="matalloy_1">
            Physical and mechanical metallurgy
          </li>
          <li class="font-medium text-lg" data-lang-key="metalloy_2">Heat treatment processes</li>
          <li class="font-medium text-lg" data-lang-key="metalloy_3">Alloy development and characterization</li>
        </ol>
      </div>

      <!-- Card 3   -->
      <div
        class="bg-white rounded-xl shadow-lg p-6 flex flex-col items-center text-center transition-transform duration-300 hover:scale-105 hover:shadow-2xl">
        <div class="bg-red-500 text-white rounded-full p-3 mb-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="8" y="8" width="8" height="8" rx="1"></rect>

            <path d="M12 5c.5-1 1.5-1 2 0 .5-1 1.5-1 2 0"></path>
            <line x1="12" y1="8" x2="12" y2="6"></line>

            <rect x="18" y="10" width="4" height="4" rx="0.5"></rect>
            <line x1="16" y1="12" x2="18" y2="12"></line>

            <path d="M6 12l-3-3v6l3-3z"></path>
            <line x1="8" y1="12" x2="6" y2="12"></line>

            <path d="M12 19a2 2 0 0 0-2-2 2 2 0 0 0-2 2"></path>
            <line x1="12" y1="16" x2="12" y2="17"></line>
          </svg>
        </div>
        <h3 class="text-xl font-bold mb-2" data-lang-key="process_tech">Materials Processing Techniques</h3>
        <ol class="list-decimal list-inside space-y-2 text-gray-700">
          <li class="font-medium text-lg" data-lang-key="protech_1">Casting, forging, and welding</li>
          <li class="font-medium text-lg" data-lang-key="protech_2">Powder metallurgy</li>
          <li class="font-medium text-lg" data-lang-key="protech_3">Surface engineering and coatings</li>
        </ol>
      </div>

      <!-- card 4 -->
      <div
        class="bg-white rounded-xl shadow-lg p-6 flex flex-col items-center text-center transition-transform duration-300 hover:scale-105 hover:shadow-2xl">
        <div class="bg-orange-500 text-white rounded-full p-3 mb-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="2" y="2" width="20" height="20" rx="1"></rect>

            <line x1="2" y1="8" x2="22" y2="8"></line>
            <line x1="2" y1="16" x2="22" y2="16"></line>
            <line x1="8" y1="2" x2="8" y2="22"></line>
            <line x1="16" y1="2" x2="16" y2="22"></line>

            <circle cx="12" cy="12" r="2.5" stroke-dasharray="2 2"></circle>
          </svg>
        </div>
        <h3 class="text-xl font-bold mb-2" data-lang-key="advan_m">Advanced Materials</h3>
        <ol class="list-decimal list-inside space-y-2 text-gray-700">
          <li class="font-medium text-lg" data-lang-key="advam_1">
            Composite materials
          </li>
          <li class="font-medium text-lg" data-lang-key="advam_2">
            Nanomaterials and biomaterials
          </li>
          <li class="font-medium text-lg" data-lang-key="advam_3">Functional and smart materials</li>
        </ol>
      </div>

      <!-- card 5 -->
      <div
        class="bg-white rounded-xl shadow-lg p-6 flex flex-col items-center text-center transition-transform duration-300 hover:scale-105 hover:shadow-2xl">
        <div class="bg-amber-500 text-white rounded-full p-3 mb-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M4 8h2a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2H4"></path>
            <line x1="8" y1="12" x2="10" y2="12"></line>
            <path d="M4 6V8m0 8v2"></path>
            <path d="M2 4h4m-4 16h4"></path>

            <line x1="11" y1="12" x2="13" y2="12"></line>

            <rect x="14" y="4" width="8" height="16" rx="1"></rect>
            <polyline points="15 18 17 14 20 12 21 6"></polyline>
          </svg>
        </div>
        <h3 class="text-xl font-bold mb-2" data-lang-key="test_char">Materials Testing and Characterization</h3>
        <ol class="list-decimal list-inside space-y-2 text-gray-700">
          <li class="font-medium text-lg" data-lang-key="testch_1">
            Mechanical testing methods
          </li>
          <li class="font-medium text-lg" data-lang-key="testch_2">Microstructural analysis</li>
          <li class="font-medium text-lg" data-lang-key="testch_3">Spectroscopy and microscopy techniques</li>
        </ol>
      </div>

      <!-- card 6 -->
      <div
        class="bg-white rounded-xl shadow-lg p-6 flex flex-col items-center text-center transition-transform duration-300 hover:scale-105 hover:shadow-2xl">
        <div class="bg-yellow-500 text-white rounded-full p-3 mb-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="9" y="9" width="6" height="6" rx="1"></rect>

            <path d="M9 12H4"></path>
            <path d="M4 12L2 10m0 4l2-2m-2-2v4"></path>

            <path d="M15 12h5"></path>
            <circle cx="20" cy="12" r="1"></circle>
            <path d="M20 11v-1m0 4v-1m1.4-.6l.7-.7m-3.5 3.5l.7-.7m2.8 0l-.7-.7m-3.5 0l-.7.7"></path>

            <path d="M12 9V4"></path>
            <circle cx="12" cy="3" r="2"></circle>
            <line x1="11" y1="3" x2="13" y2="3"></line>
          </svg>
        </div>
        <h3 class="text-xl font-bold mb-2" data-lang-key="applic_me">
          Applications of Materials Engineering
        </h3>
        <ol class="list-decimal list-inside space-y-2 text-gray-700">
          <li class="font-medium text-lg" data-lang-key="applic_1">Materials selection for engineering applications</li>
          <li class="font-medium text-lg" data-lang-key="applic_2">Corrosion and degradation mechanisms</li>
          <li class="font-medium text-lg" data-lang-key="applic_3">Sustainable materials and recycling</li>
        </ol>
      </div>

      <!-- card 7
        <div
          class="bg-white rounded-xl shadow-lg p-6 flex flex-col items-center text-center transition-transform duration-300 hover:scale-105 hover:shadow-2xl"
        >
          <div class="bg-emerald-500 text-white rounded-full p-3 mb-4">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="h-8 w-8"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M10 21h4"
              />
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M12 15a3 3 0 100-6 3 3 0 000 6z"
              />
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
              />
            </svg>
          </div>
          <h3 class="text-xl font-bold mb-2">Project & Research Skills</h3>
          <ol class="list-decimal list-inside space-y-2 text-gray-700">
            <li class="font-medium text-lg">ICT Project Management</li>
            <li class="font-medium text-lg">Research Methodology</li>
            <li class="font-medium text-lg">
              Final Year Project (Capstone Project)
            </li>
            <li class="font-medium text-lg">Teamwork & Communication Skills</li>
          </ol>
        </div>

         -->
    </div>
  </div>



  <!-- anoter description panel -->
  <!-- ဒီမှာကတစ်မျိုး -->
  <!-- New section for "What You Can Learn" -->
  <div class="container mx-auto mt-16 p-12">
    <h2 class="text-3xl sm:text-4xl font-bold text-center mb-6" data-lang-key="labs_heading">
      Where You Can Learn
    </h2>
    <p class="text-center text-lg text-gray-600 mb-12 max-w-3xl mx-auto" data-lang-key="labs_intro">
      AME major သည် ကျောင်းသား/သူများအား သက်ဆိုင်ရာ နည်းပညာကျွမ်းကျင်မှုများ တိုးတက်စေရန်နှင့် လက်တွေ့ကျကျ
      သုတေသနလုပ်ငန်းများ ပြုလုပ်နိုင်စေရန် —
    </p>

    <!-- Description box above the cards -->
    <div id="skillCardContainer">
      <!-- Description box - Its position in HTML does not matter as much now -->
      <div id="descriptionBox"
        class="transition-opacity duration-200 opacity-100 ease-in-out w-full h-24 bg-white rounded-xl shadow-lg flex mb-8 italic items-center justify-center p-4 text-center text-gray-700">
        <p id="descriptionText" data-lang-key="tap">Hover over or tap a skill to see a brief description.</p>
      </div>

      <!-- Grid to display the skills -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
        <!-- Skill Card 1: Software Development -->
        <!-- ဒီထဲက data descriptionဆိုတာမှာက -နောက်က အချက်ကို copy paste ထည့် -->
        <div
          class="skill-card group relative w-full h-40 bg-white rounded-xl shadow-lg flex flex-col items-center justify-center text-center transition-all duration-300 hover:scale-105 hover:shadow-2xl"
          data-description="materials များ၏ physical နှင့် mechanical အားဖြင့် တည်ငြိမ်မှု၊ ပြောင်းလဲမှုများကို စမ်းသပ်လေ့လာရန်။">
          <div class="bg-blue-500 text-white rounded-full p-4 mb-4">
            <!-- SVG for Software Development -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <rect x="2" y="2" width="10" height="4" rx="1"></rect>
              <rect x="2" y="18" width="10" height="4" rx="1"></rect>
              <line x1="4" y1="6" x2="4" y2="18"></line>
              <line x1="10" y1="6" x2="10" y2="18"></line>

              <path d="M7 6v2a1 1 0 0 0 1 1h-2a1 1 0 0 0 1-1V6"></path>
              <path d="M7 18v-2a1 1 0 0 1-1-1h2a1 1 0 0 1-1 1v2"></path>
              <line x1="7" y1="9" x2="7" y2="15"></line>

              <line x1="12" y1="12" x2="14" y2="12"></line>

              <rect x="14" y="7" width="8" height="10" rx="1"></rect>
              <polyline points="15 15 17 11 20 9 21 8"></polyline>
            </svg>
          </div>
          <h3 class="text-lg font-bold text-sm p-1" data-lang-key="test_lab">
            <!-- ဒီမှာ - ရှေ့ကဟာကိုရေး -->
            Materials Testing Lab
          </h3>
        </div>

        <!-- Skill Card 2: Networking & Security -->
        <div
          class="skill-card group relative w-full h-40 bg-white rounded-xl shadow-lg flex flex-col items-center justify-center text-center transition-all duration-300 hover:scale-105 hover:shadow-2xl"
          data-description="သတ္တုပစ္စည်းများ၏ internal structure ကို microscope ဖြင့် ကြည့်ရှုစစ်ဆေးနိုင်ရန်။">
          <div class="bg-green-500 text-white rounded-full p-4 mb-4">
            <!-- SVG for Networking & Security -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
              <circle cx="12" cy="12" r="3"></circle>

              <path d="M18 12h-3"></path>
              <path d="M6 12h-3"></path>

              <path d="M12 12l1 2"></path>
              <path d="M12 12l-2-1"></path>
              <path d="M12 12l2-1.5"></path>
            </svg>
          </div>
          <h3 class="text-lg font-bold text-sm p-1" data-lang-key="metallo_lab">
            Metallography Lab
          </h3>
        </div>

        <!-- Skill Card 3: Emerging Technology -->
        <div
          class="skill-card group relative w-full h-40 bg-white rounded-xl shadow-lg flex flex-col items-center justify-center text-center transition-all duration-300 hover:scale-105 hover:shadow-2xl"
          data-description="ပစ္စည်းများ ပြုလုပ်ခြင်းနှင့် လက်တွေ့ ပြုပြင်ခြင်းများကို လုပ်ဆောင်နိုင်ရန်။">
          <div class="bg-yellow-500 text-white rounded-full p-4 mb-4">
            <!-- SVG for Emerging Technology -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M7 10v4h10v-4l-5-4-5 4z"></path>
              <line x1="12" y1="14" x2="12" y2="16"></line>

              <path d="M6 22h12"></path>
              <path d="M7 22v-2h10v2"></path>
              <path d="M8 20v-2h8v2"></path>
              <path d="M9 18v-2h6v2"></path>
            </svg>
          </div>
          <h3 class="text-lg font-bold text-sm p-1" data-lang-key="process_lab">
            Materials Processing Lab
          </h3>
        </div>

        <!-- Skill Card 4: Professional & Ethical Practices -->
        <div
          class="skill-card group relative w-full h-40 bg-white rounded-xl shadow-lg flex flex-col items-center justify-center text-center transition-all duration-300 hover:scale-105 hover:shadow-2xl"
          data-description="ပစ္စည်းမျက်နှာပြင်၏ အတိုင်းအတာများ၊ ပြုပြင်ခြင်းနည်းလမ်းများကို တိကျစွာ စစ်ဆေးနိုင်ရန်။">
          <div class="bg-purple-500 text-white rounded-full p-4 mb-4">
            <!-- SVG for Professional & Ethical Practices -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M8 4h8v4H8z"></path>
              <line x1="12" y1="8" x2="12" y2="12"></line>

              <rect x="4" y="18" width="16" height="4" rx="1"></rect>
              <rect x="4" y="14" width="16" height="4" rx="1" fill-opacity="0.5"></rect>

              <path d="M10 12l2 2 2-2"></path>
              <circle cx="12" cy="14" r="1"></circle>

              <path d="M18 4h4v4h-4z"></path>
              <line x1="18" y1="6" x2="22" y2="6"></line>
            </svg>
          </div>
          <h3 class="text-lg font-bold text-sm p-1" data-lang-key="surfana_lab">
            Surface Analysis Lab
          </h3>
        </div>

        <!-- Skill Card 5: Project & Research Skills -->
        <div
          class="skill-card group relative w-full h-40 bg-white rounded-xl shadow-lg flex flex-col items-center justify-center text-center transition-all duration-300 hover:scale-105 hover:shadow-2xl"
          data-description="ပစ္စည်းတစ်ခုချင်း၏ chemical, physical နှင့် performance ဆိုင်ရာ အသေးစိတ်အချက်အလက်များကို သိရှိလေလာနိုင်ရန်။">
          <div class="bg-red-500 text-white rounded-full p-4 mb-4">
            <!-- SVG for Project & Research Skills -->
            <svg
  xmlns="http://www.w3.org/2000/svg"
  class="h-8 w-8"
  viewBox="0 0 24 24"
  fill="none"
  stroke="currentColor"
  stroke-width="2"
  stroke-linecap="round"
  stroke-linejoin="round"
>
  <rect x="2" y="10" width="8" height="8" rx="1"></rect>
  <circle cx="6" cy="14" r="1.5"></circle>
  <path d="M4 8a2 2 0 0 1 2-2 2 2 0 0 1 2 2"></path>
  <path d="M8 8a2 2 0 0 1 2-2 2 2 0 0 1 2 2"></path>

  <path d="M6 10V4h12v6"></path>
  
  <line x1="12" y1="4" x2="6" y2="4"></line>
  <polygon points="12 4 10 2 14 2"></polygon>

  <polyline points="16 10 18 16 20 15 22 18"></polyline>
  <rect x="16" y="10" width="8" height="8" rx="1"></rect>
</svg>
          </div>
          <h3 class="text-lg font-bold text-sm p-1" data-lang-key="char_lab">
            Characterization Lab
          </h3>
        </div>

        <!-- Skill Card 6: Critical Thinking 
        <div
          class="group relative w-full h-40 bg-white rounded-xl shadow-lg flex flex-col items-center justify-center text-center transition-all duration-300 hover:scale-105 hover:shadow-2xl"
          data-description="Cloud-based Application Deployment နှင့် Internet of Things (IoT) Device တွေ အပြန်အလှန်ချိတ်ဆက်သုံးစွဲရန်။"
        >
          <div class="bg-indigo-500 text-white rounded-full p-4 mb-4">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="h-10 w-10"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M13 10V3L4 14h7v7l9-11h-7z"
              />
            </svg>
          </div>
          <h3 class="text-lg font-bold text-sm p-1">
            Cloud Computing & IoT Lab
          </h3>
        </div>  -->

        <!-- Skill Card 7: Data Analytics -->
        <!-- <div class="group relative w-full h-40 bg-white rounded-xl shadow-lg flex flex-col items-center justify-center text-center transition-all duration-300 hover:scale-105 hover:shadow-2xl"
                 data-description="Extract insights and make data-driven decisions.">
                <div class="bg-gray-500 text-white rounded-full p-4 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19v-4m-4 4v-4m8 4v-4" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 19a4 4 0 11-8 0" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold">Data Analytics</h3>
            </div> -->

        <!-- Skill Card 8: Innovation & Creativity -->
        <!-- <div class="group relative w-full h-40 bg-white rounded-xl shadow-lg flex flex-col items-center justify-center text-center transition-all duration-300 hover:scale-105 hover:shadow-2xl"
                 data-description="Cultivate an innovative mindset and build products that change the world.">
                <div class="bg-orange-500 text-white rounded-full p-4 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21c-4.97 0-9-4.03-9-9s4.03-9 9-9 9 4.03 9 9-4.03 9-9 9z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 16.5c2.485 0 4.5-2.015 4.5-4.5S14.485 7.5 12 7.5 7.5 9.515 7.5 12s2.015 4.5 4.5 4.5z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 12a.5.5 0 110-1 .5.5 0 010 1z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold">Innovation & Creativity</h3>
            </div> -->

        <!-- Skill Card 9: User Experience (UX) -->
        <!-- <div class="group relative w-full h-40 bg-white rounded-xl shadow-lg flex flex-col items-center justify-center text-center transition-all duration-300 hover:scale-105 hover:shadow-2xl"
                 data-description="Design and optimize intuitive and accessible digital interfaces.">
                <div class="bg-teal-500 text-white rounded-full p-4 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 14v6m-3-3h6m-1-1v6m-3-3h6" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 21H3a1 1 0 01-1-1V5a1 1 0 011-1h7a1 1 0 011 1v15z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold">User Experience (UX)</h3>
            </div> -->

        <!-- Skill Card 10: Global Collaboration -->
        <!-- <div class="group relative w-full h-40 bg-white rounded-xl shadow-lg flex flex-col items-center justify-center text-center transition-all duration-300 hover:scale-105 hover:shadow-2xl"
                 data-description="Work with diverse teams and contribute to projects on a global scale.">
                <div class="bg-cyan-500 text-white rounded-full p-4 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21a9 9 0 100-18 9 9 0 000 18z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 12a.5.5 0 110-1 .5.5 0 010 1z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold">Global Collaboration</h3>
            </div> -->
      </div>
    </div>
  </div>

  <!-- it's end here -->

  <!-- what you will learn here tab -->
  <div class="container mx-auto mt-16 p-12">
    <h2 class="text-3xl sm:text-4xl font-bold text-center mb-6" data-lang-key="advantagesH">
      What You Will Learn After BE Course
    </h2>
    <p class="text-center text-lg text-gray-600 mb-12 max-w-3xl mx-auto" data-lang-key="advan_intro">
      Our Bachelor of Engineering curriculum is designed to prepare you for
      the real world with these key advantages.
    </p>

    <div class="slider-container w-full max-w-6xl mx-auto rounded-2xl shadow-xl overflow-hidden group">
      <div id="slides" class="slides">
        <!-- Slide 1 -->
        <div class="slide bg-white rounded-xl">
          <div class="slide-content">
            <h3 class="text-2xl font-bold mb-4" data-lang-key="advan_1">
              <!-- ဒီထဲမှာက BEရပြီးရင်သိမယ့်ဟာတွေ sliderမို့လို့ slide divကို copy pasteလုပ်လို့ရတယ် ပိုနေရင်ဖျက် လိုနေရင်ထည့် -->
              Aircraft Design Knowledge
            </h3>
            <!-- <p class="text-gray-700">Gain practical experience by working on real-world projects and case studies throughout your studies.</p> -->
          </div>
        </div>
        <!-- Slide 2 -->
        <div class="slide bg-white rounded-xl">
          <div class="slide-content">
            <h3 class="text-2xl font-bold mb-4" data-lang-key="advan_2">Aerodynamics and Flight Mechanics</h3>
            <!-- <p class="text-gray-700">Our curriculum is continuously updated to align with the latest industry demands and technologies.</p> -->
          </div>
        </div>
        <!-- Slide 3 -->
        <div class="slide bg-white rounded-xl">
          <div class="slide-content">
            <h3 class="text-2xl font-bold mb-4" data-lang-key="advan_3">Aircraft Maintenance Skills</h3>
            <!-- <p class="text-gray-700">Connect with peers, professors, and industry professionals from around the globe.</p> -->
          </div>
        </div>
        <!-- Slide 4 -->
        <div class="slide bg-white rounded-xl">
          <div class="slide-content">
            <h3 class="text-2xl font-bold mb-4" data-lang-key="advan_4">Avionics System Understanding</h3>
            <!-- <p class="text-gray-700">Receive personalized support for internships, job searches, and career development.</p> -->
          </div>
        </div>
        <!-- Slide 5 -->
        <div class="slide bg-white rounded-xl">
          <div class="slide-content">
            <h3 class="text-2xl font-bold mb-4" data-lang-key="advan_5">
              Propulsion System Knowledge
            </h3>
            <!-- <p class="text-gray-700">Build a solid base in engineering principles that will last throughout your career.</p> -->
          </div>
        </div>
        <!-- Slide 6 -->
        <div class="slide bg-white rounded-xl">
          <div class="slide-content">
            <h3 class="text-2xl font-bold mb-4" data-lang-key="advan_6">Structural Analysis and Materials Skills</h3>
            <!-- <p class="text-gray-700">Tailor your education to your interests with specialized tracks in various engineering fields.</p> -->
          </div>
        </div>
        <!-- Slide 7 -->
        <div class="slide bg-white rounded-xl">
          <div class="slide-content">
            <h3 class="text-2xl font-bold mb-4" data-lang-key="advan_7">
              Problem-Solving and Innovation
            </h3>
            <!-- <p class="text-gray-700">Participate in leadership programs and team-based projects to hone your soft skills.</p> -->
          </div>
        </div>
        <!-- Slide 8 -->
        <div class="slide bg-white rounded-xl">
          <div class="slide-content">
            <h3 class="text-2xl font-bold mb-4" data-lang-key="advan_8">CAD and Simulation Proficiency</h3>
            <!-- <p class="text-gray-700">Work alongside faculty on cutting-edge research projects and contribute to new discoveries.</p> -->
          </div>
        </div>
        <!-- Slide 9 -->
        <div class="slide bg-white rounded-xl">
          <div class="slide-content">
            <h3 class="text-2xl font-bold mb-4" data-lang-key="advan_9">Teamwork and Communication Skills</h3>
            <!-- <p class="text-gray-700">Learn to identify opportunities and develop your own ventures with our dedicated support.</p> -->
          </div>
        </div>
        <!-- Slide 10 -->
        <div class="slide bg-white rounded-xl">
          <div class="slide-content">
            <h3 class="text-2xl font-bold mb-4" data-lang-key="advan_10">
              Safety and Regulatory Compliance
            </h3>
            <!-- <p class="text-gray-700">Understand the societal impact of your work and practice engineering with integrity.</p> -->
          </div>
        </div>
      </div>

      <!-- Navigation Buttons -->
      <button id="left-button" class="nav-button left-button">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
      </button>
      <button id="right-button" class="nav-button right-button">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
      </button>
    </div>

    <!-- Dots Container -->
    <div id="dots-container" class="dots-container"></div>
  </div>

  <!-- job opportunities -->
  <!-- Section for Job Opportunities -->
  <div class="container mx-auto job-opportunities-section p-8">
    <h2 class="text-3xl sm:text-4xl font-bold text-center mb-6" data-lang-key="jobs_heading">
      Career Paths & Job Opportunities
    </h2>
    <p class="text-center text-lg text-gray-600 mb-12 max-w-3xl mx-auto" data-lang-key="jobs_info">
      <!-- ဒီမှာက စာလေးပြင် -->
      B.E. Materials and Metallurgy ဘွဲ့ရရှိသူများသည် International Aircraft MRO Providers,
      Aircraft Handling & Ground Support Service Companies,
      Aviation Training & Support Services Providers, Airlines & MRO Operators စသည်တို့တွင်
    </p>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
      <!-- h3 job-cardတွေမှာ စာတွေပြောင်း cardလည်း လိုတိုးပိုလျှော့  -->
      <!-- Job Card 1 -->
      <div class="job-card">
        <h3 class="job-title" data-lang-key="job_1">B1 or B2 Aircraft Maintenance Engineer</h3>
      </div>
      <!-- Job Card 2 -->
      <div class="job-card">
        <h3 class="job-title" data-lang-key="job_2">Aircraft Technician / Mechanic</h3>
      </div>
      <!-- Job Card 3 -->
      <div class="job-card">
        <h3 class="job-title" data-lang-key="job_3">MRO Line Maintenance Engineer</h3>
      </div>
      <!-- Job Card 4 -->
      <div class="job-card">
        <h3 class="job-title" data-lang-key="job_4">Maintenance Operation Control Engineer</h3>
      </div>
      <!-- Job Card 5 -->
      <div class="job-card">
        <h3 class="job-title" data-lang-key="job_5">Calibration & Testing Technician</h3>
      </div>
      <!-- Job Card 6 -->
      <div class="job-card">
        <h3 class="job-title" data-lang-key="job_6">Ground Support & Ramp Technician</h3>
      </div>
      <!-- Job Card 7 -->
      <div class="job-card">
        <h3 class="job-title" data-lang-key="job_7">Avionics Maintenance Engineer</h3>
      </div>
      <!-- Job Card 8 -->
      <div class="job-card">
        <h3 class="job-title" data-lang-key="job_8">Quality Assurance / Airworthiness Inspector</h3>
      </div>
      <!-- Job Card 9 -->
      <div class="job-card">
        <h3 class="job-title" data-lang-key="job_9">Hangar Maintenance Supervisor</h3>
      </div>
      <!-- Job Card 10 -->
      <div class="job-card">
        <h3 class="job-title" data-lang-key="job_10">Licensing & Airworthiness Documentation Officer</h3>
      </div>
    </div>
  </div>
  <!-- footer region -->

  <footer id="contact" class="bg-blue-900 text-white ">
    <div class="container mx-auto px-6 py-12">
      <div class="grid md:grid-cols-4 gap-8">
        <div>
          <img src="../Img/logo/utycc_logo_favicon/favicon.ico" alt="UTYCC Logo" class="h-12 mb-4" />
          <h3 class="text-lg font-bold">UTYCC</h3>
          <p class="text-blue-200 text-sm mt-4">
            <a href="https://maps.app.goo.gl/xEgFrM6hWEiYZdGYA" data-lang-key="footer_address" target="_blank">
              Yatanarpon Cyber City,<br>Near Pyin Oo Lwin,<br>Mandalay
              Region, Myanmar
            </a>
          </p>
          <div class="mt-4 text-sm text-blue-200">
            <p>Email: info@utycc.edu.mm (example)</p>
            <p>Phone: +95 (XX) XXX XXX (example)</p>
          </div>
        </div>

        <div>
          <h3 class="text-lg font-bold mb-4" data-lang-key="footer_faculties_title">
            Faculties
          </h3>
          <ul class="space-y-2 text-sm text-blue-200">
            <li>
              <a href="../Majors/ist.php" data-lang-key="footer_faculty_ist">Information Science Technology</a>
            </li>
            <li>
              <a href="../Majors/ce.php" data-lang-key="footer_faculty_ce">Computer Engineering</a>
            </li>
            <li>
              <a href="../Majors/ece.php" data-lang-key="footer_faculty_ece">Electronics Engineering</a>
            </li>
            <li><a data-lang-key="footer_faculty_pre" href="../Majors/pre.php">Precision Engineering</a></li>
            <li><a data-lang-key="footer_faculty_ame" href="../Majors/ame.php">
                Advanced Materials Engineering
              </a></li>
          </ul>
        </div>

        <div>
          <h3 class="text-lg font-bold mb-4" data-lang-key="footer_quick_links_title">
            Quick Links
          </h3>
          <ul class="space-y-2 text-sm text-blue-200">
            <li>
              <a href="../terms.php" class="hover:text-white" data-lang-key="footer_link_terms">Terms & Policies</a>
            </li>
            <li>
              <a href="../FAQs.php" class="hover:text-white" data-lang-key="footer_link_faq">FAQs</a>
            </li>
            <li>
              <a href="../about.php" class="hover:text-white" data-lang-key="footer_link_about">About Us</a>
            </li>
            <li>
              <a href="../randr.php" class="hover:text-white" data-lang-key="footer_link_rules">Rules & Regulations</a>
            </li>
            <li>
              <a href="../data_protection.php" class="hover:text-white " data-lang-key="footer_link_dp">Data Protection</a>
            </li>
          </ul>
        </div>

        <div>
          <h3 class="text-lg font-bold mb-4" data-lang-key="footer_follow_title">
            Follow Us
          </h3>
          <div class="flex space-x-4">
            <a href="#" class="text-blue-200 hover:text-white"><i class="fab fa-facebook-f text-xl"></i></a>
            <a href="https://mm.linkedin.com/school/university-of-technology-yatanarpon-cyber-city/"
              class="text-blue-200 hover:text-white"><i class="fab fa-linkedin-in text-xl"></i></a>
            <a href="#" class="text-blue-200 hover:text-white"><i class="fa-brands fa-youtube"></i></a>
            <a href="#" class="text-blue-200 hover:text-white"><i class="fa-brands fa-tiktok"></i></a>
          </div>
          <br />
          <br />
          <div>
            <div class="newtons-cradle">
              <div class="newtons-cradle__dot"></div>
              <div class="newtons-cradle__dot"></div>
              <div class="newtons-cradle__dot"></div>
              <div class="newtons-cradle__dot"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="mt-10 border-t border-blue-800 pt-6 text-center text-sm text-blue-300"
        data-lang-key="footer_copyright">
        &copy; 2025 University of Technology - Yatanarpon Cyber City. All
        Rights Reserved.
      </div>
    </div>
  </footer>

  <script>
    // ပြင်စရာရှိတယ်
    // Function to update the major details panel
    function updateMajorPanel(title, description, imageUrl) {
      const majorTitle = document.getElementById("major-title");
      const majorDescription = document.getElementById("major-description");
      const majorImage = document.getElementById("major-image");

      // Check if elements exist before updating
      if (majorTitle) {
        majorTitle.textContent = title;
      }
      if (majorDescription) {
        majorDescription.textContent = description;
      }
      if (majorImage) {
        majorImage.src = imageUrl;
      }
    }

    // major name change ပြီးတော့ descriptionရော change
    updateMajorPanel(
      "Advanced Materials Engineering",
      "နည်းပညာတက္ကသိုလ် (ရတနာပုံဆိုက်ဘာစီးတီး)  ၏ အဆင့်မြင့်ဒြပ်ပစ္စည်းထုတ်လုပ်မှုအင်ဂျင်နီယာဌာန (Faculty of Advanced Materials Engineering - AME) သည် သတ္တုနှင့် သတ္တုစပ်ပစ္စည်းများကို ဒီဇိုင်းရေးဆွဲခြင်းနှင့် ဖွံ့ဖြိုးတိုးတက်စေရန် အခြေခံသိပ္ပံနှင့် နည်းပညာများကို လေ့ကျင့်သင်ကြားပေးသော ဘာသာရပ်တစ်ခုဖြစ်ပါတယ်။ "
    );
    // --- DOM Elements ---
    const navLinks = document.querySelectorAll(".nav-link");
    const mobileMenuButton = document.getElementById("mobile-menu-button");
    const mobileMenu = document.getElementById("mobile-menu");

    // --- Event Listeners ---
    navLinks.forEach((link) => {
      link.addEventListener("click", (e) => {
        // This ensures the page scrolls smoothly to the target section
        const targetId = link.getAttribute("href");
        document
          .querySelector(targetId)
          .scrollIntoView({ behavior: "smooth" });
      });
    });

    mobileMenuButton.addEventListener("click", () => {
      mobileMenu.classList.toggle("hidden");
    });
  </script>
  <script src="../js/Des_Major.js"></script>
  <script src="../js/BE_Advantages.js"></script>
  <script>
    // --- Translation Script ---
    const translations = {
      my: {
        major_Title: "အဆင့်မြင့်ဒြပ်ပစ္စည်းထုတ်လုပ်မှု အင်ဂျင်နီယာ",
        major_Description:
          "နည်းပညာတက္ကသိုလ် (ရတနာပုံဆိုက်ဘာစီးတီး)  ၏ အဆင့်မြင့်ဒြပ်ပစ္စည်းထုတ်လုပ်မှုအင်ဂျင်နီယာဌာန (Faculty of Advanced Materials Engineering - AME) သည် သတ္တုနှင့် သတ္တုစပ်ပစ္စည်းများကို ဒီဇိုင်းရေးဆွဲခြင်းနှင့် ဖွံ့ဖြိုးတိုးတက်စေရန် အခြေခံသိပ္ပံနှင့် နည်းပညာများကို လေ့ကျင့်သင်ကြားပေးသော ဘာသာရပ်တစ်ခုဖြစ်ပါတယ်။ ကျောင်းသား/သူများကို ပစ္စည်းဗေဒ၊ သတ္တုဗေဒ၊ နှင့် အင်ဂျင်နီယာနယ်ပယ်များတွင် အထူးကျွမ်းကျင်မှုများ ရရှိစေရန် ရည်ရွယ်ထားပြီး၊ စက်မှုလုပ်ငန်းများတွင် တီထွင်တိုးတက်မှုတွင် ပါဝင်နိုင်စေရန် လေ့ကျင့်သင်ကြားပေးပါသည်။ ကျောင်းသား/သူများသည် ပစ္စည်း၏ လက္ခဏာများ၊ ပြုပြင်လုပ်ဆောင်နည်းများ၊ နှင့် အသုံးချနည်းများကို နက်နက်ရှိုင်းရှိုင်း နားလည်စေရန်၊ အဆင့်မြင့်ပစ္စည်းများကို ဖန်တီးအသုံးချခြင်းနှင့် စက်မှုလုပ်ငန်းတွင် တီထွင်တိုးတက်မှုတွင် ပါဝင်နိုင်စေရန် လေ့ကျင့်သင်ကြားပါသည်။ ထို့အပြင် ကျောင်းသား/သူများအား မိမိတို့ အထူးပြုလေ့လာသည့် ပစ္စည်းနည်းပညာနှင့် ပတ်သက်သည့် နောက်ဆုံးပေါ် သိပ္ပံနှင့် နည်းပညာများကို သင်ယူနိုင်ရန် လေ့ကျင့်သင်ကြားပါသည်။",  
     utycc_full_name: "နည်းပညာတက္ကသိုလ် (ရတနာပုံဆိုက်ဘာစီးတီး)",
        nav_about: "ကျွန်ုပ်တို့အကြောင်း",
        nav_activity: "လှုပ်ရှားမှုများ",
        nav_examresult: "အောင်စာရင်း",
        nav_about_mobile: "ကျွန်ုပ်တို့အကြောင်း",
        nav_activity_mobile: "လှုပ်ရှားမှုများ",
        nav_examresult_mobile: "အောင်စာရင်း",
        footer_address:
          "ရတနာပုံဆိုက်ဘာစီးတီး၊\nပြင်ဦးလွင်မြို့အနီး၊\nမန္တလေးတိုင်းဒေသကြီး၊ မြန်မာနိုင်ငံ",
        footer_faculties_title: "မဟာဌာနများ",
        footer_faculty_ist: "သတင်းအချက်အလက် သိပ္ပံနှင့် နည်းပညာ",
        footer_faculty_ce: "ကွန်ပျူတာ အင်ဂျင်နီယာ",
        footer_faculty_ece: "အီလက်ထရောနစ် အင်ဂျင်နီယာ",
        footer_faculty_ame: "အဆင့်မြင့် ဒြပ်ပစ္စည်း အင်ဂျင်နီယာ",
        footer_faculty_pre: "တိကျစက်မှု အင်ဂျင်နီယာ",
        footer_contact_title: "ဆက်သွယ်ရန်",
        footer_follow_title: "Follow Us",
        footer_copyright:
          "&copy; ၂၀၂၅ နည်းပညာတက္ကသိုလ် - ရတနာပုံဆိုက်ဘာစီးတီး။ မူပိုင်ခွင့်များရယူပြီး။",
        footer_quick_links_title: "အသုံးဝင်သောလင့်များ",
        footer_link_terms: "စည်းမျဉ်းများနှင့် မူဝါဒများ",
        footer_link_faq: "အမေးများသော မေးခွန်းများ",
        footer_link_about: "ကျွန်ုပ်တို့အကြောင်း",
        footer_link_rules: "စည်းကမ်းများနှင့် စည်းမျဉ်းများ",
        uni_name: "နည်းပညာတက္ကသိုလ် (ရတနာပုံဆိုက်ဘာစီးတီး)",
        motto: '"ဒြပ်ပစ္စည်းအင်ဂျင်နီယာ အစွမ်း၊ အင်ဂျင်နီယာလုပ်ငန်းများ အံ့မခန်း။"',
        objectivesH: "အဆင့်မြင့်ဒြပ်ပစ္စည်းထုတ်လုပ်မှု အင်ဂျင်နီယာဌာန၏ ရည်ရွယ်ချက်နှင့် တာဝန်များ",
        objectives: "ပစ္စည်း၏ လက္ခဏာများ၊ ပြုပြင်လုပ်ဆောင်နည်းများ၊ နှင့် အသုံးချနည်းများကို နက်နက်ရှိုင်းရှိုင်း နားလည်စေရန်။ အဆင့်မြင့်ပစ္စည်းများကို ဖန်တီးအသုံးချခြင်းနှင့် စက်မှုလုပ်ငန်းတွင် တီထွင်တိုးတက်မှုတွင် ပါဝင်နိုင်စေရန်။ ပစ္စည်းဗေဒ၊ သတ္တုဗေဒနှင့် အင်ဂျင်နီယာနယ်ပယ်များတွင် အထူးကျွမ်းကျင်မှုများ ရရှိစေရန်။ ကျောင်းသား/သူများကို အလုပ်အကိုင် ရရှိနိုင်စေရန် နှင့် စက်မှုလုပ်ငန်းများတွင် ထိရောက်စွာ လုပ်ကိုင်နိုင်စေရန်။ စသည်တို့ ဖြစ်ပါသည်။ ထို့အပြင် တက်ရောက်လေ့လာမည့် ကျောင်းသား/သူများအား မိမိတို့ အထူးပြုလေ့လာသည့် ပစ္စည်းနည်းပညာနှင့် ပတ်သက်သည့် နောက်ဆုံးပေါ် သိပ္ပံနှင့် နည်းပညာများကို သင်ယူနိုင်ရန် လေ့ကျင့်သင်ကြားပေးမည် ဖြစ်ပါသည်။ AME ဘာသာရပ်သင်တန်းသည် ကျောင်းသား/သူများကို အနာဂတ်အလုပ်အကိုင်မှာသာမက၊ သုတေသန၊ ဖန်တီးတီထွင်မှု နယ်ပယ်တွေမှာပါ အောင်မြင်စွာ ပါဝင်ဆောင်ရွက်နိုင်ရန် ရည်ရွယ်ထားပြီး အဓိကလေ့လာရမည့် အကြောင်းအရာများမှာ အောက်ပါအတိုင်းဖြစ်ပါသည်။",
        matersc_fund: "ပစ္စည်းဗေဒ အခြေခံကျွမ်းကျင်မှုများ",
        matersc_1: "ပစ္စည်း ဖွဲ့စည်းပုံ နှင့် ဂုဏ်သတ္တိလက္ခဏာများ",
        matersc_2: "ပစ္စည်းအဆင့်ပြောင်းဇယားများ နှင့် အပူဓာတ်ဗေဒ နိယာမများ",
        matersc_3: "Crystal ဖွဲ့စည်းပုံဗေဒ နှင့် ချို့ယွင်းချက်များ",
        metal_alloy: "သတ္တုဗေဒ လေ့လာမှုများ နှင့် သတ္တုစပ် ဒီဇိုင်းပုံစံများ",
        metalloy_1: "ရူပသတ္တုဗေဒ နည်းပညာများ နှင့် မော်ကွန်းသတ္တုဗေဒ လေ့လာမှုများ",
        metalloy_2: "အပူသုံး ပြုပြင်လုပ်ငန်းစဉ်များ",
        metalloy_3: "သတ္တုစပ် တီထွင်တိုးတက်မှု နှင့် ဂုဏ်သတ္တိ သတ်မှတ်ချက်များ",
        process_tech: "ပစ္စည်း ထုတ်လုပ်ပြုပြင် နည်းစနစ်များ",
        protech_1: "သတ္တုပုံသွင်းထုတ်လုပ်ခြင်း၊ သံချောထည်ပြုလုပ်ခြင်း နှင့် ဂ‌ဟေဆက်ခြင်း",
        protech_2: "သတ္တုမှုန့်ဖန်တီးခြင်း နည်းပညာ",
        protech_3: "သတ္တုမျက်နှာပြင်ပြုပြင်ခြင်း နှင့် အလွှာအလှဆင်ခြင်း",
        advan_m: "အဆင့်မြင့် ပစ္စည်းများ",
        advam_1: "ပေါင်းစပ်ပစ္စည်းများ",
        advam_2: "နာနိုပစ္စည်းများ နှင့် ဇီဝပစ္စည်းများ",
        advam_3: "အသုံးချနိုင်သည့်ပစ္စည်းများ နှင့် အထောက်အကူပစ္စည်းများ",
        test_char: "ပစ္စည်း စမ်းသပ်စစ်ဆေးမှုများ နှင့် ဂုဏ်သတ္တိ သတ်မှတ်ချက်များ",
        testch_1: "စက်ယန္တရား စမ်းသပ်နည်းပညာများ",
        testch_2: "မိုက်ခရိုဖွဲ့စည်းပုံ ခွဲခြမ်းစိတ်ဖြာမှု",
        testch_3: "ရောင်စဉ်ဗေဒနည်းပညာ နှင့် မိုက်ခရိုဖွဲ့စည်းမှု စစ်ဆေးနည်းများ",
        applic_me: "ဒြပ်ပစ္စည်းထုတ်လုပ်ခြင်းနည်းပညာကို အသုံးချမှုများ",
        applic_1: "အင်ဂျင်နီယာ အသုံးချမှုများအတွက် ပစ္စည်းရွေးချယ်မှု",
        applic_2: "သံချေးစားမှု လုပ်ငန်းစဉ်များ နှင့် ပျက်စီးယွင်းယိုင်မှု",
        applic_3: "တာရှည်တည်တံ့ ပစ္စည်းများ နှင့် ပြန်လည်အသုံးချ နည်းပညာများ",
        labs_heading: "သင်ယူလေ့လာနိုင်မည့် နေရာများ",
        labs_intro: "အဆင့်မြင့်ဒြပ်ပစ္စည်းထုတ်လုပ်မှု အင်ဂျင်နီယာဌာနသည် ကျောင်းသား/သူများအား သက်ဆိုင်ရာ နည်းပညာကျွမ်းကျင်မှုများ တိုးတက်စေရန်နှင့် လက်တွေ့ကျကျ သုတေသနလုပ်ငန်းများ ပြုလုပ်နိုင်စေရန်  စမ်းသပ်ခန်းများ (Laboratories) တည်ဆောက်ထားပါသည်။",
        tap: "ကျွမ်းကျင်မှုတစ်ခု၏ အသေးစိတ်ဖော်ပြချက်များကို ကြည့်ရန် နှိပ်ပါ။",
        test_lab: "ပစ္စည်း စမ်းသပ်စစ်ဆေးခန်း",
        metallo_lab: "သတ္တုဖွဲ့စည်းပုံ စမ်းသပ်လေ့လာခန်း",
        process_lab: "ပစ္စည်းပြုပြင်ထုတ်လုပ်မှု စမ်းသပ်ခန်း",
        surfana_lab: "သတ္တုမျက်နှာပြင် စမ်းသပ်လေ့လာခန်း",
        char_lab: "ပစ္စည်းဂုဏ်သတ္တိ စစ်ဆေးခန်း",
        advantagesH: "ဘွဲ့ကြိုသင်တန်းပြီးနောက် သင်ယူရရှိမည့် အကျိုးကျေးဇူးများ",
        advan_intro: "ကျွန်ုပ်တို့၏ အင်ဂျင်နီယာဘွဲ့ သင်ရိုးညွှန်းတမ်းကို လက်တွေ့အသက်မွေးဝမ်းကျောင်းလောကတွင် အသုံးချနိုင်စေရန် အဓိကအားသာချက်များဖြင့် ပြုစုထားပါသည်။",
        advan_1: "လေယာဉ်ဖွဲ့စည်းမှု နည်းပညာ အတွေ့အကြုံများ",
        advan_2: "လေဝင်လေထွက် နည်းဗေဒနှင့် ပျံသန်းမှုစနစ်များ",
        advan_3: "လေယာဉ်ထိန်းသိမ်းမှု နည်းပညာ အတွေ့အကြုံများ",
        advan_4: "လေယာဉ်အီလက်ထရောနစ်စနစ် သိမြင်နားလည်မှု",
        advan_5: "လေယာဉ်မော်တာနှင့် စွမ်းအားစနစ် သိမြင်နားလည်မှု",
        advan_6: "ဖွဲ့စည်းပုံစမ်းသပ်မှု နှင့် သတ္တု/ပစ္စည်း အင်ဂျင်နီယာ နည်းပညာများ",
        advan_7: "စိန်ခေါ်မှုပြဿနာများ ဖြေရှင်းနည်း နှင့် နည်းပညာတီထွင်မှု",
        advan_8: "ကွန်ပျူတာကူညီဒီဇိုင်း နှင့် နမူနာထုတ်လုပ်ကျွမ်းကျင်မှု",
        advan_9: "အဖွဲ့နှင့် ပူးပေါင်းဆောင်ရွက်နိုင်မှု နှင့် ဆက်သွယ်နိုင်မှု",
        advan_10: "လုံခြုံရေးနှင့် စည်းမျဉ်းဥပဒေလိုက်နာမှု",
        jobs_heading: "အလုပ်အကိုင် လမ်းကြောင်းများနှင့် အခွင့်အလမ်းများ",
        jobs_info: "ပစ္စည်းဗေဒ နှင့် သတ္တုဗေဒဘွဲ့ (B.E. Materials and Metallurgy) ရရှိသူများသည် အပြည်ပြည်ဆိုင်ရာ လေယာဉ် MRO ပံ့ပိုးသူများ၊ လေယာဉ်ကိုင်တွယ်ခြင်းနှင့် မြေပြင်ပံ့ပိုးဝန်ဆောင်မှုကုမ္ပဏီများ၊ လေကြောင်းသင်တန်းနှင့် ပံ့ပိုးဝန်ဆောင်မှုပေးသူများ၊ လေကြောင်းလိုင်းများနှင့် MRO လုပ်ငန်းများ စသည်တို့တွင် အလုပ်လုပ်ကိုင်နိုင်ပါသည်။",
        job_1: "B1/B2 လေယာဉ် ပြုပြင်ထိန်းသိမ်းရေး အင်ဂျင်နီယာ",
        job_2: "လေယာဉ်ပြုပြင်ထိန်းသိမ်းမှု နည်းပညာရှင် / ယန္တရားအင်ဂျင်နီယာ",
        job_3: "MRO လိုင်း ပြုပြင်ထိန်းသိမ်းရေး အင်ဂျင်နီယာ",
        job_4: "ပြုပြင်ထိန်းသိမ်းမှု လုပ်ငန်းစီမံခန့်ခွဲခြင်း အင်ဂျင်နီယာ",
        job_5: "ကိရိယာ အတိုင်းအတာချိန်ညှိခြင်း နှင့် စမ်းသပ်မှု နည်းပညာရှင်",
        job_6: "မြေပြင် လေယာဉ်ပံ့ပိုး နည်းပညာရှင်",
        job_7: "လေယာဉ်အီလက်ထရောနစ် နည်းပညာရှင်",
        job_8: "အရည်အသွေး စစ်ဆေးရေး နှင့် လေယာဉ်လုံခြုံရေး စစ်ဆေးသူ",
        job_9: "လေယာဉ်ပြုပြင်ထိန်းသိမ်းမှု စီမံခန့်ခွဲသူ",
        job_10: "လိုင်စင်နှင့် လေယာဉ်လုံခြုံရေး စာရွက်စာတမ်း တာဝန်ရှိသူ",
        footer_link_dp: "ဒေတာကာကွယ်ရေး",
      },
      en: {
      major_Title: "Advanced Materials Engineering",
      major_Description:  "The Faculty of Advanced Materials Engineering (AME) at the University of Technology (Yatanarpon Cyber City) is a discipline that imparts fundamental scientific and technological knowledge for the design and development of metals and alloys. It aims to equip students with specialized expertise in Materials Science, Metallurgy, and Engineering fields, enabling them to participate in the creation and utilization of advanced materials and contribute to innovation in the industrial sector.",
        utycc_full_name: "University of Technology (Yatanarpon Cyber City)",
        nav_about: "About Us",
        nav_activity: "Activities",
        nav_examresult: "Exam Results",
        nav_about_mobile: "About Us",
        nav_activity_mobile: "Activities",
        nav_examresult_mobile: "Exam Results",
        nav_programs_mobile: "Academic Programs",
        footer_address:
          "Yatanarpon Cyber City,\nNear Pyin Oo Lwin,\nMandalay Region, Myanmar",
        footer_faculties_title: "Faculties",
        footer_faculty_ist: "Information Science Technology",
        footer_faculty_ce: "Computer Engineering",
        footer_faculty_ece: "Electronics Engineering",
        footer_faculty_ame: "Advanced Materials Engineering",
        footer_faculty_pre: "Precision Engineering",
        footer_contact_title: "Contact Us",
        footer_follow_title: "Follow Us",
        footer_copyright:
          "&copy; 2025 University of Technology - Yatanarpon Cyber City. All Rights Reserved.",
        footer_quick_links_title: "Quick Links",
        footer_link_terms: "Terms & Policies",
        footer_link_faq: "FAQs",
        footer_link_about: "About Us",
        footer_link_rules: "Rules & Regulations",
        uni_name: "University of Technology (Yatanarpon Cyber City)",
        motto: "Let’s Improve Engineering Works with the Power of Materials",
        objectivesH: "The objectives and responsibilities",
        objectives: "To provide students with a profound understanding of the properties of materials, methods of processing, and applications; to enable them to participate in the creation and utilization of advanced materials and contribute to innovation in the industrial sector; and to acquire specialized expertise in Materials Science, Metallurgy, and Engineering fields. The program also aims to prepare students for employment opportunities and to work effectively in industries. In addition, students will be trained to learn and apply the latest scientific and technological advancements related to their specialization in materials technology. The AME program is designed not only to prepare students for future careers but also to enable them to actively and successfully engage in research and innovation. The main areas of study include the following:",
        matersc_fund: "Materials Science Fundamentals",
        matersc_1: "Structure and properties of materials",
        matersc_2: "Phase diagrams and thermodynamics",
        matersc_3: "Crystallography and defects",
        metal_alloy: "Metallurgy and Alloy Design",
        metalloy_1: "Physical and mechanical metallurgy",
        metalloy_2: "Heat treatment processes",
        metalloy_3: "Alloy development and characterization",
        process_tech: "Materials Processing Techniques",
        protech_1: "Casting, forging, and welding",
        protech_2: "Powder metallurgy",
        protech_3: "Surface engineering and coatings",
        advan_m: "Advanced Materials",
        advam_1: "Composite materials",
        advam_2: "Nanomaterials and biomaterials",
        advam_3: "Functional and smart materials",
        test_char: "Materials Testing and Characterization",
        testch_1: "Mechanical testing methods",
        testch_2: "Microstructural analysis",
        testch_3: "Spectroscopy and microscopy techniques",
        applic_me: "Applications of Materials Engineering",
        applic_1: "Materials selection for engineering applications",
        applic_2: "Corrosion and degradation mechanisms",
        applic_3: "Sustainable materials and recycling",
        labs_heading: "Where You Can Learn",
        labs_intro: "In the department of Advanced Materials Engineering< laboratories have been established to allow students to enhance their relevant technical expertise and to conduct practical research activities.",
        tap: "Hover over or tap a skill to see a brief description",
        test_lab: "Materials Testing Lab",
        metallo_lab: "Metallography Lab",
        process_lab: "Materials Processing Lab",
        surfana_lab: "Surface Analysis Lab",
        char_lab: "Characterization Lab",
        advantagesH: "What You Will Learn After B.E. Course",
        advan_intro: "Our Bachelor of Engineering curriculum is designed to prepare you for the real world with these key advantages.",
        advan_1: "Aircraft Design Knowledge",
        advan_2: "Aerodynamics and Flight Mechanics",
        advan_3: "Aircraft Maintenance Skills",
        advan_4: "Avionics System Understanding",
        advan_5: "Propulsion System Knowledge",
        advan_6: "Structural Analysis and Materials Skills",
        advan_7: "Problem-Solving and Innovation",
        advan_8: "CAD and Simulation Proficiency",
        advan_9: "Teamwork and Communication Skills",
        advan_10: "Safety and Regulatory Compliance",
        jobs_heading: "Career Paths & Job Opportunities",
        jobs_info: "Graduates with a B.E. Materials and Metallurgy can work in International Aircraft MRO Providers, Aircraft Handling & Ground Support Service Companies, Aviation Training & Support Services Providers, Airlines & MRO Operators, and so on.",
        job_1: "B1 or B2 Aircraft Maintenance Engineer",
        job_2: "Aircraft Technician / Mechanic",
        job_3: "MRO Line Maintenance Engineer",
        job_4: "Maintenance Operation Control Engineer",
        job_5: "Calibration & Testing Technician",
        job_6: "Ground Support & Ramp Technician",
        job_7: "Avionics Maintenance Engineer",
        job_8: "Quality Assurance / Airworthiness Inspector",
        job_9: "Hangar Maintenance Supervisor",
        job_10: "Licensing & Airworthiness Documentation Officer",
        footer_link_dp: "Data Protection",
      },
    };

    const languageSwitcher = document.getElementById("language-switcher-desktop");
    const languageSwitcherMobile = document.getElementById('language-switcher-mobile');

    const changeLanguage = (lang) => {
      // Store the selected language
      localStorage.setItem("language", lang);

      // Set the dropdown to the correct value
      languageSwitcher.value = lang;
      languageSwitcherMobile.value = lang;

      // Translate all elements with the data-lang-key attribute
      document.querySelectorAll("[data-lang-key]").forEach((element) => {
        const key = element.dataset.langKey;
        const translation = translations[lang][key];
        if (translation) {
          element.innerHTML = translation.replace(/\\n/g, "<br>");
        }
      });
    };

    // Event listener for the language switcher
    languageSwitcher.addEventListener("change", (event) => {
      changeLanguage(event.target.value);
    });

    languageSwitcherMobile.addEventListener('change', (event) => {
      changeLanguage(event.target.value);
    });

    // Function to run when the page loads
    document.addEventListener("DOMContentLoaded", () => {
      // Check for a saved language in localStorage, otherwise default to 'en'
      const savedLang = localStorage.getItem("language") || "en";
      changeLanguage(savedLang);
    });
  </script>
  <script src="../JS/lgl.js"></script>
</body>

</html>