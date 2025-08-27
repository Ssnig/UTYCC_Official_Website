<?php
// Start the session to carry data across pages
session_start();
$form1= $_SESSION['form1_data'] ?? [];
// echo "<pre>";
// print_r($form1);
// Define variables and initialize with empty values
$student_name = $student_id = $parent_name = $parent_address = $parent_phone = "";
$errors = [];

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitize and validate Student Name
    if (empty(trim($_POST["student_name"]))) {
        $errors['student_name'] = "Student's name is required.";
    } else {
        $student_name = htmlspecialchars(trim($_POST["student_name"]));
    }

    // Sanitize and validate Student ID/Roll Number
    if (empty(trim($_POST["student_id"]))) {
        $errors['student_id'] = "Student's roll number is required.";
    } else {
        $student_id = htmlspecialchars(trim($_POST["student_id"]));
    }
    
    // Sanitize and validate Parent Name
    if (empty(trim($_POST["parent_name"]))) {
        $errors['parent_name'] = "Parent's/Guardian's name is required.";
    } else {
        $parent_name = htmlspecialchars(trim($_POST["parent_name"]));
    }

    // Sanitize and validate Parent Address
    if (empty(trim($_POST["parent_address"]))) {
        $errors['parent_address'] = "Parent's/Guardian's address is required.";
    } else {
        $parent_address = htmlspecialchars(trim($_POST["parent_address"]));
    }

    // Sanitize and validate Parent Phone
    if (empty(trim($_POST["parent_phone"]))) {
        $errors['parent_phone'] = "Parent's/Guardian's phone number is required.";
    } elseif (!preg_match('/^[0-9\-\+\s\(\)]*$/', trim($_POST["parent_phone"]))) {
         $errors['parent_phone'] = "Please enter a valid phone number.";
    } else {
        $parent_phone = htmlspecialchars(trim($_POST["parent_phone"]));
    }

    // If there are no errors, store data in session and redirect to the next form
    if (empty($errors)) {
        // Store the validated data in a session variable
        $_SESSION['form2_data'] = [
            'student_name' => $student_name,
            'student_id' => $student_id,
            'parent_name' => $parent_name,
            'parent_address' => $parent_address,
            'parent_phone' => $parent_phone
        ];

        // Redirect to the next step of the registration
        header("location: form3.php"); // Make sure form3.php exists
        exit;
    }
}
?>
<?php include 'partial/header.php'; ?>


    <br>

    <div class="max-w-4xl mx-auto">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" novalidate>

            <section class="form-section" id="parent-pledge">
                <h2 class="form-title">မိဘ/အုပ်ထိန်းသူ၏ ကတိခံဝန်ချက်</h2>
                <div class="space-y-4 pledge-text">
                    <p>၁။ နည်းပညာတက္ကသိုလ်(ရတနာပုံဆိုက်ဘာစီးတီး)တွင် ပညာသင်ယူလျက်ရှိသော မောင်/မ 
                        <input type="text" name="student_name" placeholder="_______________________" class="border-0 form-input inline-block w-64" value="<?php echo $student_name; ?>"> ခုံအမှတ် 
                        <input type="text" name="student_id" placeholder="__________________________" class="border-0 form-input inline-block w-48" value="<?php echo $student_id; ?>"> သည် နည်းပညာတက္ကသိုလ်(ရတနာပုံဆိုက်ဘာစီးတီး)က ချမှတ်ထားသော စည်းမျဥ်း စည်းကမ်းများကို ရိုသေလေးစားစွာ လိုက်နာပါမည်ဟု ခံဝန်ကတိပြုပါသည်။
                    </p>
                    <span class="text-red-500 text-sm block"><?php echo $errors['student_name'] ?? ''; ?></span>
                    <span class="text-red-500 text-sm block"><?php echo $errors['student_id'] ?? ''; ?></span>

                    <p>၂။ တစ်ခုခုကျူးလွန်ဖောက်ဖျက်ပါက အုပ်ချုပ်ရေးအဖွဲ့၏ ချမှတ်ထားသော အပြစ်ဒဏ်စည်းမျဥ်းစည်းကမ်းကို ခံယူပါမည်ဟု လက်မှတ်ရေးထိုးပါသည်။</p>
                </div>
                <div class="mt-12 ml-auto w-full md:w-1/2">
                    <div class="input-group flex items-center">
                        <label class="w-48">မိဘ/ အုပ်ထိန်းသူလက်မှတ်:</label>
                        <div class="signature-line flex-grow"></div>
                    </div>
                    <div class="input-group flex items-center">
                        <label for="parent-name" class="w-48">မိဘ/ အုပ်ထိန်းသူအမည်:</label>
                        <input type="text" id="parent-name" name="parent_name" class="form-input flex-grow" value="<?php echo $parent_name; ?>">
                    </div>
                    <span class="text-red-500 text-sm block ml-48"><?php echo $errors['parent_name'] ?? ''; ?></span>

                    <div class="input-group flex items-center">
                        <label for="parent-address" class="w-48">နေရပ်လိပ်စာအပြည့်အစုံ:</label>
                        <input type="text" id="parent-address" name="parent_address" class="form-input flex-grow" value="<?php echo $parent_address; ?>">
                    </div>
                    <span class="text-red-500 text-sm block ml-48"><?php echo $errors['parent_address'] ?? ''; ?></span>
                    
                    <div class="input-group flex items-center">
                        <label for="parent-phone" class="w-48">ဖုန်းနံပါတ်:</label>
                        <input type="tel" id="parent-phone" name="parent_phone" class="form-input flex-grow" value="<?php echo $parent_phone; ?>">
                    </div>
                    <span class="text-red-500 text-sm block ml-48"><?php echo $errors['parent_phone'] ?? ''; ?></span>

                </div>
                <div class="form-footer">UTYCC/ SA/ F-20/ Rev-0/31-10-2022</div>
            </section>

            <div class="nav-buttons">
                <a href="form1.php" class="nav-button ">Back</a>
                <button type="submit" class="nav-button">Next</button>
            </div>
            
        </form> </div>
    <br>

    <?php include 'partial/footer.php'; ?>