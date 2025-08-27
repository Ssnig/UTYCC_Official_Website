<?php
// Start the session to access data from previous forms.
session_start();
$form1_data = $_SESSION['form1_data'] ?? [];
// echo "<pre>";
// print_r($form1_data);

// Define variables and initialize with empty values to avoid PHP notices.
$student_name = $start_date = $start_month = $start_year = "";
$preference1 = $preference2 = $preference3 = $preference4 = $preference5 = "";
$parent_name = $parent_nrc = $parent_occupation = $parent_address = "";
$student_name_signed = $student_nrc_signed = $student_occupation_signed = $student_address_signed = "";
$errors = [];

// Check if the form was submitted.
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitize and validate inputs for the form.
    // Major preferences validation
    for ($i = 1; $i <= 5; $i++) {
        $key = 'preference' . $i;
        if (empty(trim($_POST[$key]))) {
            $errors[$key] = "This field is required.";
        } else {
            // Sanitize the input
            ${'preference' . $i} = htmlspecialchars(trim($_POST[$key]));
        }
    }
    
    // Combine all preferences into an array for easier storage
    $preferences = [
        $preference1,
        $preference2,
        $preference3,
        $preference4,
        $preference5
    ];

    // If no validation errors, store data in session and redirect
    if (empty($errors)) {
        // Store the validated data in a session variable.
        $_SESSION['form4_data'] = [
            'student_name' => $student_name,
            'preferences' => $preferences,
            'parent_name' => $parent_name,
            'parent_nrc' => htmlspecialchars(trim($_POST["parent_nrc"])),
            'parent_occupation' => htmlspecialchars(trim($_POST["parent_occupation"])),
            'parent_address' => htmlspecialchars(trim($_POST["parent_address"])),
            'student_name_signed' => $student_name_signed,
            'student_nrc_signed' => htmlspecialchars(trim($_POST["student_nrc_signed"])),
            'student_occupation_signed' => htmlspecialchars(trim($_POST["student_occupation_signed"])),
            'student_address_signed' => htmlspecialchars(trim($_POST["student_address_signed"])),
        ];

        // Redirect to the next form or a success page.
        // Make sure form5.php exists.
        header("location: form3.php");
        exit;
    }
}
?>
<?php include 'formPartial/header.php'; ?>
    
    <br>
    <div class="max-w-4xl mx-auto">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" novalidate>
            <section class="form-section" id="major-application">
                <div class="form-header">
                    <p>ပြည်ထောင်စုသမ္မတမြန်မာနိုင်ငံတော်အစိုးရ</p>
                    <p>သိပ္ပံနှင့်နည်းပညာဝန်ကြီးဌာန</p>
                    <p>အဆင့်မြင့်သိပ္ပံနှင့်နည်းပညာဦးစီးဌာန</p>
                    <h2 class="form-title mt-2">နည်းပညာတက္ကသိုလ်(ရတနာပုံဆိုက်ဘာစီးတီး)</h2>
                    <div class="flex justify-between items-center mt-4 text-sm">
                        <span>သင်တန်းရေးရာ- 09445767834</span>
                        <!-- <span>ရက်စွဲ၊ <input type="text" name="start_year" value="<?php echo $start_year; ?>" class="form-input inline-block w-16"> ခုနှစ်၊ <input type="text" name="start_month" value="<?php echo $start_month; ?>" class="form-input inline-block w-16"> လ <input type="text" name="start_date" value="<?php echo $start_date; ?>" class="form-input inline-block w-16"> ရက်</span> -->
                        <p><?php  echo htmlspecialchars($_SESSION['form1_data']['date']); ?></p>
                    </div>
                </div>
                <h3 class="form-subtitle">ပထမနှစ် ကျောင်းသား/ ကျောင်းသူများ၏ အင်ဂျင်နီယာဘာသာရပ် ဆန္ဒပြုလျှောက်လွှာ</h3>
                <p class="pledge-text mb-6">ကျွန်တော်/ ကျွန်မ မောင်/မ <input type="text" name="student_name_and_roll" placeholder="____________________________________________" class="form-input border-0 inline-block w-full md:w-auto fs-3" value="<?php echo htmlspecialchars($_SESSION['form1_data']['student_name_mm']); ?>"
        readonly > သည် ၂၀၂၅ ခုနှစ် ဒီဇင်ဘာလ ၂၁ရက် နေ့တွင် စတင်ဖွင့်လှစ်သင်ကြားမည့် ဤတက္ကသိုလ်၏ အင်ဂျင်နီယာသင်တန်းတွင် အောက်ပါ ဦးစားပေး အစီအစဥ်အရ ရရှိလိုပြီး အင်ဂျင်နီယာဘာသာရပ်ဖြင့် တက်ရောက်ခွင့်ပြုပါရန် လျှောက်ထားအပ်ပါသည်-</p>
                 <span class="text-red-500 text-sm block ml-auto w-full md:w-96"><?php echo $errors['student_name_and_roll'] ?? ''; ?></span>
                 <span class="text-red-500 text-sm block ml-auto w-full md:w-96"><?php echo $errors['start_month'] ?? ''; ?></span>
                 <span class="text-red-500 text-sm block ml-auto w-full md:w-96"><?php echo $errors['start_date'] ?? ''; ?></span>

                <div class="grid md:grid-cols-2 gap-8">
                    <div>
                        <h4 class="font-semibold mb-2">ဤတက္ကသိုလ်တွင် တက်ရောက်နိုင်သောသင်တန်းများ</h4>
                        <ol class="list-decimal list-inside space-y-2">
                            <li>သတင်းအချက်အလက်သိပ္ပံနှင့် နည်းပညာအင်ဂျင်နီယာဘာသာရပ်(IST)</li>
                            <li>ကွန်ပျူတာအင်ဂျင်နီယာ ဘာသာရပ်(CE)</li>
                            <li>အီလက်ထရောနစ် အင်ဂျင်နီယာ ဘာသာရပ်(EcE)</li>
                            <li>တိကျပစ္စည်းထုတ်လုပ်မှု အင်ဂျင်နီယာ ဘာသာရပ်(PrE)</li>
                            <li>ဒြပ်ပစ္စည်းနှင့် သတ္တုဗေဒ အင်ဂျင်နီယာ ဘာသာရပ်(AME)</li>
                        </ol>
                    </div>
                    <div>
                        <h4 class="font-semibold mb-2">တက်ရောက်လိုသောဦးစားပေးအစီအစဥ်</h4>
                        <div class="space-y-2">
                            <div class="flex items-center gap-2"><span>၁။</span><input type="text" name="preference1" class="form-input flex-grow" value="<?php echo $preference1; ?>"></div>
                            <span class="text-red-500 text-sm block ml-auto w-full md:w-96"><?php echo $errors['preference1'] ?? ''; ?></span>
                            <div class="flex items-center gap-2"><span>၂။</span><input type="text" name="preference2" class="form-input flex-grow" value="<?php echo $preference2; ?>"></div>
                            <span class="text-red-500 text-sm block ml-auto w-full md:w-96"><?php echo $errors['preference2'] ?? ''; ?></span>
                            <div class="flex items-center gap-2"><span>၃။</span><input type="text" name="preference3" class="form-input flex-grow" value="<?php echo $preference3; ?>"></div>
                            <span class="text-red-500 text-sm block ml-auto w-full md:w-96"><?php echo $errors['preference3'] ?? ''; ?></span>
                            <div class="flex items-center gap-2"><span>၄။</span><input type="text" name="preference4" class="form-input flex-grow" value="<?php echo $preference4; ?>"></div>
                            <span class="text-red-500 text-sm block ml-auto w-full md:w-96"><?php echo $errors['preference4'] ?? ''; ?></span>
                            <div class="flex items-center gap-2"><span>၅။</span><input type="text" name="preference5" class="form-input flex-grow" value="<?php echo $preference5; ?>"></div>
                            <span class="text-red-500 text-sm block ml-auto w-full md:w-96"><?php echo $errors['preference5'] ?? ''; ?></span>
                        </div>
                    </div>
                </div>
                
                <div class="mt-6 p-4 bg-blue-50 border-l-4 border-blue-500 text-blue-800 rounded-r-lg">
                    <p class="font-bold">မှတ်ချက်</p>
                    <p class="text-sm">သင်ကြားခွင့်ပြုမည့် ဦးစားပေးအဓိက ဘာသာရပ်ကို ကျောင်းသား၊ကျောင်းသူ၏ တက္ကသိုလ်ဝင် စာမေးပွဲတွင် ရူပဗေဒ၊ ဓာတုဗေဒ၊ သင်္ချာနှင့် အင်္ဂလိပ်စာ (၄) ဘာသာပေါင်းရမှတ်၊ ကျောင်းသား၊ ကျောင်းသူ၏ ဦးစားပေး လျှောက်ထားမှုနှင့် သက်ဆိုင်ရာပညာရပ်အတွက် ကျောင်းသား၊ကျောင်းသူ လက်ခံနိုင်မှုဦးရေ ကန့်သတ်ချက်အပေါ်တွင် မူတည်၍ အချိုးကျခွဲဝေ သတ်မှတ်ပေးမည်ဖြစ်ပြီး ပြည့်စုံစွာ ဖြည့်စွက်ခြင်းမရှိပါက ရွေးချယ်ရေး အဖွဲ့က သတ်မှတ်ပေးသော သင်တန်းကိုသာ တက်ရောက်ရမည် ဖြစ်သည်။</p>
                </div>
            </section>

            <div class="nav-buttons">
                <a href="form1.php" class="nav-button">Back</a>
                <button type="submit" class="nav-button">Next</button>
            </div>
        </form>
    </div>

    <br>
    <?php include 'formPartial/footer.php'; ?>