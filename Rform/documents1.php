<?php
session_start();

// Ensure the user has completed the previous steps.
if (!isset($_SESSION['form1_data']) || !isset($_SESSION['option_data'])) {
    header("Location: form1.php?new=1");
    exit;
}

// Determine the correct back page URL based on accommodation choice
$back_page_url = 'option.php';
if (isset($_SESSION['option_data']['dormitory_preference']) && $_SESSION['option_data']['dormitory_preference'] == '1') {
    $back_page_url = 'hostel.php';
}

$uploadDir = __DIR__ . "/uploads/documents/";
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$document_definitions = [
    'doc_recommendation'      => '(၁) ရပ်ကွက်၊ ရဲစခန်းထောက်ခံစာ (မူရင်း)',
    'doc_medical'             => '(၂) ဆေးထောက်ခံစာ (မူရင်း)',
    'doc_certificate'         => '(၃) အောင်လက်မှတ် (မူရင်း/မိတ္တူ)',
    'doc_grades'              => '(၄) အမှတ်စာရင်း (မူရင်း/မိတ္တူ)',
    'doc_household'           => '(၅) အိမ်ထောင်စုဇယား (မူရင်း/မိတ္တူ)',
    'doc_student_nrc_front'   => 'မှတ်ပုံတင် (ရှေ့)',
    'doc_student_nrc_back'    => 'မှတ်ပုံတင် (နောက်)',
    'doc_father_nrc_front'    => 'မှတ်ပုံတင် (ရှေ့)',
    'doc_father_nrc_back'     => 'မှတ်ပုံတင် (နောက်)',
    'doc_mother_nrc_front'    => 'မှတ်ပုံတင် (ရှေ့)',
    'doc_mother_nrc_back'     => 'မှတ်ပုံတင် (နောက်)'
];

$errors = [];
$uploaded_files = $_SESSION['document_files'] ?? []; // Repopulate from session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $all_files_ok = true;

    foreach ($document_definitions as $key => $label) {
        // If a file was already uploaded and is not being replaced, skip it.
        if (!empty($uploaded_files[$key]) && empty($_FILES[$key]['name'])) {
            continue;
        }

        if (isset($_FILES[$key]) && $_FILES[$key]['error'] === UPLOAD_ERR_OK) {
            $file = $_FILES[$key];
            $fileName = uniqid() . '-' . preg_replace('/[^A-Za-z0-9\.\-]/', '_', basename($file['name']));
            $targetPath = $uploadDir . $fileName;
            $dbPath = "uploads/documents/" . $fileName;

            // Validation
            $allowed_types = ['image/jpeg', 'image/png', 'application/pdf'];
            $max_size = 5 * 1024 * 1024; // 5MB

            if (!in_array($file['type'], $allowed_types)) {
                $errors[$key] = 'Invalid file type. Only JPG, PNG, PDF are allowed.';
                $all_files_ok = false;
                continue;
            }

            if ($file['size'] > $max_size) {
                $errors[$key] = 'File is too large. Maximum size is 5MB.';
                $all_files_ok = false;
                continue;
            }

            if (move_uploaded_file($file['tmp_name'], $targetPath)) {
                if (!empty($uploaded_files[$key]) && file_exists(__DIR__ . "/" . $uploaded_files[$key])) {
                    @unlink(__DIR__ . "/" . $uploaded_files[$key]);
                }
                $uploaded_files[$key] = $dbPath;
            } else {
                $errors[$key] = 'Failed to upload file.';
                $all_files_ok = false;
            }
        } else {
            if (empty($uploaded_files[$key])) {
                 $errors[$key] = 'This document is required.';
                 $all_files_ok = false;
            }
        }
    }

    $_SESSION['document_files'] = $uploaded_files;

    if ($all_files_ok) {
        header("Location: final1.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Required Documents Upload</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
        }
        .document-card {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            border: 1px solid #e5e7eb;
        }
        .nav-button {
            padding: 0.75rem 2rem;
            border-radius: 9999px;
            font-weight: 600;
            text-align: center;
            transition: all 0.3s ease;
        }
        .nav-button-back {
            background-color: #ffffff;
            color: #374151;
            border: 1px solid #d1d5db;
        }
        .nav-button-back:hover {
            background-color: #f9fafb;
        }
        .nav-button-next {
            background-color: #2563eb;
            color: white;
            border: 1px solid transparent;
        }
        .nav-button-next:hover {
            background-color: #1d4ed8;
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen p-4">

    <div class="w-full max-w-3xl mx-auto">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
            <div class="document-card p-8">
                <div class="text-center mb-8">
                    <img src="../Img/logo/utycc_logo.png" alt="UTYCC Logo" class="mx-auto w-16 h-16 mb-4"/>
                    <h1 class="text-2xl font-bold text-gray-800">လိုအပ်သော စာရွက်စာတမ်းများ Upload တင်ရန်</h1>
                    <p class="text-gray-500 mt-2">ကျောင်းအပ်လက်ခံရန် အောက်ပါစာရွက်စာတမ်းများအား တစ်ခုချင်းစီ upload တင်ပေးပါ။</p>
                </div>

                <div class="space-y-6">
                    <?php
                    // General Documents
                    $general_docs = array_slice($document_definitions, 0, 5, true);
                    foreach ($general_docs as $key => $label):
                    ?>
                    <div class="upload-container bg-gray-50 p-4 rounded-lg border">
                        <label class="block text-md font-semibold text-gray-700 mb-2"><?php echo htmlspecialchars($label); ?></label>
                        <div class="flex items-center space-x-4">
                             <div class="preview-box w-24 h-24 border-2 border-dashed border-gray-300 rounded-md flex items-center justify-center bg-white overflow-hidden">
                                <?php if (!empty($uploaded_files[$key])): ?>
                                    <?php if (str_ends_with(strtolower($uploaded_files[$key]), '.pdf')): ?>
                                        <span class="placeholder-text text-red-500 font-bold text-lg" id="placeholder-<?php echo $key; ?>">PDF</span>
                                        <img src="" class="h-full w-full object-cover hidden" id="preview-<?php echo $key; ?>">
                                    <?php else: ?>
                                        <img src="<?php echo htmlspecialchars($uploaded_files[$key]); ?>" class="h-full w-full object-cover" id="preview-<?php echo $key; ?>">
                                        <span class="placeholder-text text-gray-400 text-xs text-center hidden" id="placeholder-<?php echo $key; ?>">Image/PDF Preview</span>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <img src="" class="h-full w-full object-cover hidden" id="preview-<?php echo $key; ?>">
                                    <span class="placeholder-text text-gray-400 text-xs text-center" id="placeholder-<?php echo $key; ?>">Image/PDF Preview</span>
                                <?php endif; ?>
                            </div>
                            <div class="flex-1">
                                <label for="<?php echo $key; ?>" class="cursor-pointer bg-white text-blue-600 font-semibold px-4 py-2 rounded-md border border-blue-600 hover:bg-blue-50 transition">
                                    Choose File
                                </label>
                                <input type="file" name="<?php echo $key; ?>" id="<?php echo $key; ?>" class="hidden" accept=".jpg,.jpeg,.png,.pdf">
                                <span class="file-name text-gray-500 text-sm ml-3" id="file-name-<?php echo $key; ?>">
                                    <?php echo !empty($uploaded_files[$key]) ? basename($uploaded_files[$key]) : 'No file chosen'; ?>
                                </span>
                            </div>
                        </div>
                         <?php if (!empty($errors[$key])): ?>
                            <p class="text-red-500 text-sm mt-2"><?php echo htmlspecialchars($errors[$key]); ?></p>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>

                    <?php
                    // NRC Documents Grouping
                    $nrc_groups = [
                        'ကျောင်းသား' => ['front' => 'doc_student_nrc_front', 'back' => 'doc_student_nrc_back'],
                        'အဖေ' => ['front' => 'doc_father_nrc_front', 'back' => 'doc_father_nrc_back'],
                        'အမေ' => ['front' => 'doc_mother_nrc_front', 'back' => 'doc_mother_nrc_back'],
                    ];

                    foreach ($nrc_groups as $person => $keys):
                    ?>
                    <div class="upload-container bg-gray-50 p-4 rounded-lg border">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4"><?php echo $person; ?> မှတ်ပုံတင်</h3>
                        <div class="flex flex-col md:flex-row md:space-x-6 space-y-6 md:space-y-0">
                            <!-- Front Side -->
                            <div class="flex-1">
                                <label class="block text-md font-semibold text-gray-700 mb-2"><?php echo htmlspecialchars($document_definitions[$keys['front']]); ?></label>
                                <div class="flex items-center space-x-4">
                                     <div class="preview-box w-24 h-24 border-2 border-dashed border-gray-300 rounded-md flex items-center justify-center bg-white overflow-hidden">
                                         <?php if (!empty($uploaded_files[$keys['front']])): ?>
                                             <?php if (str_ends_with(strtolower($uploaded_files[$keys['front']]), '.pdf')): ?>
                                                 <span class="placeholder-text text-red-500 font-bold text-lg" id="placeholder-<?php echo $keys['front']; ?>">PDF</span>
                                                 <img src="" class="h-full w-full object-cover hidden" id="preview-<?php echo $keys['front']; ?>">
                                             <?php else: ?>
                                                 <img src="<?php echo htmlspecialchars($uploaded_files[$keys['front']]); ?>" class="h-full w-full object-cover" id="preview-<?php echo $keys['front']; ?>">
                                                 <span class="placeholder-text text-gray-400 text-xs text-center hidden" id="placeholder-<?php echo $keys['front']; ?>">Image/PDF Preview</span>
                                             <?php endif; ?>
                                         <?php else: ?>
                                             <img src="" class="h-full w-full object-cover hidden" id="preview-<?php echo $keys['front']; ?>">
                                             <span class="placeholder-text text-gray-400 text-xs text-center" id="placeholder-<?php echo $keys['front']; ?>">Image/PDF Preview</span>
                                         <?php endif; ?>
                                     </div>
                                     <div class="flex-1">
                                         <label for="<?php echo $keys['front']; ?>" class="cursor-pointer bg-white text-blue-600 font-semibold px-4 py-2 rounded-md border border-blue-600 hover:bg-blue-50 transition">Choose File</label>
                                         <input type="file" name="<?php echo $keys['front']; ?>" id="<?php echo $keys['front']; ?>" class="hidden" accept=".jpg,.jpeg,.png,.pdf">
                                         <span class="file-name text-gray-500 text-sm ml-3" id="file-name-<?php echo $keys['front']; ?>"><?php echo !empty($uploaded_files[$keys['front']]) ? basename($uploaded_files[$keys['front']]) : 'No file chosen'; ?></span>
                                     </div>
                                 </div>
                                <?php if (!empty($errors[$keys['front']])): ?>
                                    <p class="text-red-500 text-sm mt-2"><?php echo htmlspecialchars($errors[$keys['front']]); ?></p>
                                <?php endif; ?>
                            </div>
                            <!-- Back Side -->
                             <div class="flex-1">
                                <label class="block text-md font-semibold text-gray-700 mb-2"><?php echo htmlspecialchars($document_definitions[$keys['back']]); ?></label>
                                <div class="flex items-center space-x-4">
                                     <div class="preview-box w-24 h-24 border-2 border-dashed border-gray-300 rounded-md flex items-center justify-center bg-white overflow-hidden">
                                          <?php if (!empty($uploaded_files[$keys['back']])): ?>
                                             <?php if (str_ends_with(strtolower($uploaded_files[$keys['back']]), '.pdf')): ?>
                                                 <span class="placeholder-text text-red-500 font-bold text-lg" id="placeholder-<?php echo $keys['back']; ?>">PDF</span>
                                                 <img src="" class="h-full w-full object-cover hidden" id="preview-<?php echo $keys['back']; ?>">
                                             <?php else: ?>
                                                 <img src="<?php echo htmlspecialchars($uploaded_files[$keys['back']]); ?>" class="h-full w-full object-cover" id="preview-<?php echo $keys['back']; ?>">
                                                 <span class="placeholder-text text-gray-400 text-xs text-center hidden" id="placeholder-<?php echo $keys['back']; ?>">Image/PDF Preview</span>
                                             <?php endif; ?>
                                         <?php else: ?>
                                             <img src="" class="h-full w-full object-cover hidden" id="preview-<?php echo $keys['back']; ?>">
                                             <span class="placeholder-text text-gray-400 text-xs text-center" id="placeholder-<?php echo $keys['back']; ?>">Image/PDF Preview</span>
                                         <?php endif; ?>
                                     </div>
                                     <div class="flex-1">
                                         <label for="<?php echo $keys['back']; ?>" class="cursor-pointer bg-white text-blue-600 font-semibold px-4 py-2 rounded-md border border-blue-600 hover:bg-blue-50 transition">Choose File</label>
                                         <input type="file" name="<?php echo $keys['back']; ?>" id="<?php echo $keys['back']; ?>" class="hidden" accept=".jpg,.jpeg,.png,.pdf">
                                         <span class="file-name text-gray-500 text-sm ml-3" id="file-name-<?php echo $keys['back']; ?>"><?php echo !empty($uploaded_files[$keys['back']]) ? basename($uploaded_files[$keys['back']]) : 'No file chosen'; ?></span>
                                     </div>
                                 </div>
                                <?php if (!empty($errors[$keys['back']])): ?>
                                    <p class="text-red-500 text-sm mt-2"><?php echo htmlspecialchars($errors[$keys['back']]); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <div class="mt-8 flex justify-between items-center">
                    <a href="<?php echo $back_page_url; ?>" class="nav-button nav-button-back">Back</a>
                    <button type="submit" class="nav-button nav-button-next">Next Step</button>
                </div>
            </div>
        </form>
    </div>
    <script>
        document.querySelectorAll('input[type="file"]').forEach(input => {
            input.addEventListener('change', event => {
                const file = event.target.files[0];
                const id = event.target.id;
                const preview = document.getElementById('preview-' + id);
                const placeholder = document.getElementById('placeholder-' + id);
                const fileNameSpan = document.getElementById('file-name-' + id);

                if (file) {
                    fileNameSpan.textContent = file.name;
                    const fileType = file.type;

                    if (fileType.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            preview.src = e.target.result;
                            preview.classList.remove('hidden');
                            if (placeholder) placeholder.classList.add('hidden');
                        };
                        reader.readAsDataURL(file);
                    } else if (fileType === 'application/pdf') {
                        preview.src = '';
                        preview.classList.add('hidden');
                        if (placeholder) {
                            placeholder.innerHTML = '<span class="text-red-500 font-bold text-lg">PDF</span>';
                            placeholder.classList.remove('hidden');
                        }
                    }
                } else {
                    fileNameSpan.textContent = 'No file chosen';
                    preview.src = '';
                    preview.classList.add('hidden');
                    if (placeholder) {
                        placeholder.innerHTML = 'Image/PDF Preview';
                        placeholder.classList.remove('hidden');
                    }
                }
            });
        });
    </script>
</body>
</html>

