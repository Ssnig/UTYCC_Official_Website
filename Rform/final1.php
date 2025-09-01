<?php 
session_start();



include "db.php"; // DB connection

$success_message = null;

// Check if the form was submitted using the POST method.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the required session variables exist.
    if (!isset($_SESSION['form1_data']) || !isset($_SESSION['form2_data']) || !isset($_SESSION['option_data'])) {
        // Redirect if session data is missing.
        header("Location: form1.php");
        exit;
    }

    try {
        $form1  = $_SESSION['form1_data'];
        $form2  = $_SESSION['form2_data'];
        $option = $_SESSION['option_data'];

        // Begin transaction
        $pdo->beginTransaction();

        // Insert Student
        $stmt_student = $pdo->prepare("
            INSERT INTO students 
            (year, academic_year, seat_no, entry_year, student_email, dormitory_preference,
             student_name_mm, student_name_en, student_race, student_religion, student_nrc,
             student_dob, student_birthplace, state_region, township,
             student_phone, student_address, date, photo_url)
            VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)
        ");

        $stmt_student->execute([
            $form1['year'], $form1['academic_year'], $form1['seat_no'], $form1['entry_year'], 
            $form1['student_email'], $option['dormitory_preference'],
            $form1['student_name_mm'], $form1['student_name_en'], $form1['student_race'], $form1['student_religion'], $form1['student_nrc'],
            $form1['student_dob'], $form1['student_birthplace'], $form1['state_region'], $form1['township'],
            $form1['student_phone'], $form1['student_address'], date("Y-m-d H:i:s"), $_SESSION['student_photo'] ?? ''
        ]);

        $student_id = $pdo->lastInsertId();

        // Insert Father
        $stmt_father = $pdo->prepare("
            INSERT INTO fathers 
            (student_id, father_name_mm, father_name_en, father_race, father_religion, father_nrc,
             father_phone, father_info, father_deceased_year, father_address)
            VALUES (?,?,?,?,?,?,?,?,?,?)
        ");
        $stmt_father->execute([
            $student_id, $form1['father_name_mm'], $form1['father_name_en'], $form1['father_race'], $form1['father_religion'], $form1['father_nrc'],
            $form1['father_phone'], $form1['father_info'], $form1['father_deceased_year'], $form1['father_address']
        ]);

        // Insert Mother
        $stmt_mother = $pdo->prepare("
            INSERT INTO mothers 
            (student_id, mother_name_mm, mother_name_en, mother_race, mother_religion, mother_nrc,
             mother_phone, mother_info, mother_deceased_year, mother_address)
            VALUES (?,?,?,?,?,?,?,?,?,?)
        ");
        $stmt_mother->execute([
            $student_id, $form1['mother_name_mm'], $form1['mother_name_en'], $form1['mother_race'], $form1['mother_religion'], $form1['mother_nrc'],
            $form1['mother_phone'], $form1['mother_info'], $form1['mother_deceased_year'], $form1['mother_address']
        ]);

        // Store Preferences (form2)
        $stmt_mother = $pdo->prepare("INSERT INTO preferences (student_id, preference_order, major_code) VALUES (?,?,?)");
        foreach ($form2['preferences'] as $order => $major_code) {
            $stmt->execute([$student_id, $order + 1, $major_code]);
        }

        // Commit transaction
        $pdo->commit();

        // Clear session data
        session_destroy();

        // Success message
        $success_message = "✅ ကျောင်းလျှောက်ခြင်း အောင်မြင်ပါသည်။ \n\nရတနာပုံ UTYCC မှ နွေးထွေးစွာကြိုဆိုပါသည်။";

    }  catch (PDOException $e) {
    $pdo->rollBack();
    die("Database error: " . $e->getMessage()); // Debug အတွက် အမှန်တကယ် error ပြမယ်
}

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Final form</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
    body {
      font-family: 'Inter', sans-serif;
      background-color: #f1f5f9;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      color: #1e293b;
    }
    .container { max-width: 700px; }
    .disk { width: 80%; margin: auto; }
    .modal-overlay {
      position: fixed; top: 0; left: 0; width: 100%; height: 100%;
      background-color: rgba(0, 0, 0, 0.5); display: flex;
      justify-content: center; align-items: center; z-index: 1000;
    }
  </style>
</head>
<body>

<div class="disk">
  <div class="container w-full bg-white rounded-3xl shadow-2xl p-8 md:p-12 space-y-8 animate-fade-in">
    <!-- Header -->
    <div class="text-center space-y-2">
      <img src="../Img/logo/utycc_logo.png" alt="UTYCC Logo" class="mx-auto w-20 h-20"/>
      <h2 class="text-4xl font-extrabold">UTYCC</h2>
      <p class="text-gray-500">You are at the final step of your submission.</p>
    </div>

    <!-- Review Steps -->
    <div class="space-y-6">
      <a href="form1.php" class="bg-gray-50 p-6 rounded-xl flex justify-between items-center shadow-sm">
        <div><p class="text-gray-400 text-sm font-medium">Personal Details</p><p class="font-semibold text-lg">Form 1 Completed</p></div>
        <div class="text-green-500 font-bold">✔</div>
      </a>
      <a href="form2.php" class="bg-gray-50 p-6 rounded-xl flex justify-between items-center shadow-sm">
        <div><p class="text-gray-400 text-sm font-medium">Major Preferences</p><p class="font-semibold text-lg">Form 2 Completed</p></div>
        <div class="text-green-500 font-bold">✔</div>
      </a>
      <a href="option.php" class="bg-gray-50 p-6 rounded-xl flex justify-between items-center shadow-sm">
        <div><p class="font-semibold text-lg">Accommodation</p></div>
        <div class="text-green-500 font-bold">✔</div>
      </a>
    </div>

    <!-- Buttons -->
    <div class="flex justify-between items-center gap-4 pt-4">
      <a href="option.php" class="px-6 py-3 rounded-full border border-gray-300 font-medium text-gray-700">Back</a>
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <button type="submit" class="px-8 py-3 rounded-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold">Submit</button>
      </form>
    </div>
  </div>
</div>

<!-- Confirmation Modal -->
<div id="confirmation-modal" class="modal-overlay hidden">
  <div class="bg-white rounded-2xl shadow-lg p-8 w-11/12 max-w-md mx-auto text-center">
    <div class="flex flex-col items-center space-y-4">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-green-500" fill="currentColor" viewBox="0 0 24 24">
        <path fill-rule="evenodd" d="M2.25 12c0-5.385..."/>
      </svg>
      <h3 class="text-2xl font-bold mb-2">လျှောက်လွှာတင်ပြီးပါပြီ</h3>
      <p class="text-gray-600">လျှောက်လွှာတင်ခြင်း အောင်မြင်ပါသည်။ သင့် email ကို စစ်ဆေးပါ။</p>
      <button id="okay-btn" class="w-full mt-4 px-8 py-3 rounded-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold">Okay</button>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const successMessage = "<?php echo $success_message; ?>";
  const modal = document.getElementById('confirmation-modal');
  const okayBtn = document.getElementById('okay-btn');
  if (successMessage.length > 0) { modal.classList.remove('hidden'); }
  okayBtn.addEventListener('click', () => { window.location.href = "form1.php"; });
});
</script>

</body>
</html>
