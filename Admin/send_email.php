<?php

    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\PHPMailer;

    // --- FIX: Corrected the path to be robust, preventing "file not found" errors. ---
    require 'vendor/autoload.php';

    /**
     * Sends a welcome email to a newly approved student.
     */
    function sendWelcomeEmail($recipientName, $recipientEmail)
    {
        if (! filter_var($recipientEmail, FILTER_VALIDATE_EMAIL)) {
            error_log("Invalid email address for welcome email: " . $recipientEmail);
            return false;
        }

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.privateemail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'admission@utycc.site';
            $mail->Password   = 'admission';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;
            $mail->CharSet    = 'UTF-8';

            $mail->setFrom('admission@utycc.site', 'UTYCC Student Affairs');
            $mail->addAddress($recipientEmail, $recipientName);

            $mail->isHTML(true);
            $mail->Subject = "Welcome to UTYCC";
            $mail->Body    = "
            <div style='font-family: Arial, sans-serif; line-height: 1.6; color: #333;'>
    <h2 style='color: #0056b3;'>Welcome to UTYCC!</h2>
    <p>Dear {$recipientName},</p>
    <p>We are thrilled to inform you that your registration has been accepted. Welcome to the <strong>University of Technology (Yatanarpon Cyber City)</strong> community!</p>
    <p>Further information will be sent to you shortly.</p>
    <p>Best regards,</p>
    <p><strong>UTYCC Administration Office</strong></p>

    <h2 style='color: #0056b3;'>ပထမနှစ်ဝင်ခွင့် ကျောင်းအပ်ရာတွင် လိုအပ်သောအချက်အလက်များ</h2>
    <ul>
        <li>(၁) ရပ်ကွက်၊ ရဲစခန်းထောက်ခံစာ (မူရင်း) <span style='color: #888;'>(Optional)</span></li>
        <li>(၂) ဆေးထောက်ခံစာ (မူရင်း) <span style='color:#888;'>(Optional)</span></li>
        <li>(၃) အောင်လက်မှတ် (မူရင်း/မိတ္တူ)</li>
        <li>(၄) အမှတ်စာရင်း (မူရင်း/မိတ္တူ)</li>
        <li>(၅) ကျောင်းသား/မိဘ မှတ်ပုံတင် (မူရင်း/မိတ္တူ)</li>
        <li>(၆) အိမ်ထောင်စုဇယား (မူရင်း/မိတ္တူ)</li>
        <li>(၇) လိုင်စင်ဓာတ်ပုံ</li>
        <li>(၈) ပုံ (မှတ်ပုံတင်နံပါတ်ပါရှိသည့်ပုံ)</li>
    </ul>
</div>
        ";
            $mail->AltBody = "Dear {$recipientName},\n\nWe are thrilled to inform you that your registration has been accepted...\n\nBest regards,\nUTYCC Administration Office";

            $mail->send();
            return true;

        } catch (Exception $e) {
            error_log("Welcome email could not be sent to {$recipientEmail}. Mailer Error: {$mail->ErrorInfo}");
            return false;
        }
    }

    /**
     * Sends a rejection email to a student.
     */
    function sendRejectionEmail($recipientName, $recipientEmail)
    {
        if (! filter_var($recipientEmail, FILTER_VALIDATE_EMAIL)) {
            error_log("Invalid email address for rejection email: " . $recipientEmail);
            return false;
        }

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.privateemail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'admission@utycc.site';
            $mail->Password   = 'admission';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;
            $mail->CharSet    = 'UTF-8';

            $mail->setFrom('admission@utycc.site', 'UTYCC Student Affairs');
            $mail->addAddress($recipientEmail, $recipientName);

            $mail->isHTML(true);
            $mail->Subject = "Regarding Your Application to UTYCC";
            $mail->Body    = "
            <div style='font-family: Arial, sans-serif; line-height: 1.6; color: #333;'>
                <h2 style='color: #c0392b;'>Update on Your UTYCC Application</h2>
                <p>Dear {$recipientName},</p>
                <p>Thank you for your interest in UTYCC. After a careful review, we regret to inform you that we are unable to offer you a place at this time.</p>
                <p>We wish you the very best in your future academic endeavors.</p>
                <br>
                <p>Sincerely,</p>
                <p><strong>UTYCC Administration Office</strong></p>
            </div>
        ";
            $mail->AltBody = "Dear {$recipientName},\n\nThank you for your interest... We regret to inform you that we are unable to offer you a place at this time.\n\nSincerely,\nUTYCC Administration Office";

            $mail->send();
            return true;

        } catch (Exception $e) {
            error_log("Rejection email could not be sent to {$recipientEmail}. Mailer Error: {$mail->ErrorInfo}");
            return false;
        }
    }

    /**
     * Sends a reply to a student's feedback email.
     *
     * @param string $recipientName The name of the student.
     * @param string $recipientEmail The email address of the student.
     * @param string $subject The subject of the reply email.
     * @param string $replyMessage The admin's reply message.
     * @param string $originalMessage The student's original message for context.
     * @return bool True if the email was sent successfully, false otherwise.
     */
    function sendSupportReplyEmail($recipientName, $recipientEmail, $subject, $replyMessage, $originalMessage)
    {
        if (! filter_var($recipientEmail, FILTER_VALIDATE_EMAIL)) {
            error_log("Invalid email address for support reply: " . $recipientEmail);
            return false;
        }

        $mail = new PHPMailer(true);

        try {
            // SMTP settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.privateemail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'support@utycc.site';
            $mail->Password   = 'support';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;
            $mail->CharSet    = 'UTF-8';

            // Recipients
            $mail->setFrom('support@utycc.site', 'UTYCC Support');
            $mail->addAddress($recipientEmail, $recipientName);
            $mail->addReplyTo('support@utycc.site', 'UTYCC Support');

            // Email content
            $mail->isHTML(true);
            $mail->Subject = $subject;

            // Sanitize messages for HTML display
            $formattedReply    = nl2br(htmlspecialchars($replyMessage));
            $formattedOriginal = nl2br(htmlspecialchars($originalMessage));

            $mail->Body = "
            <div style='font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: auto; border: 1px solid #ddd; padding: 20px;'>
                <h2 style='color: #0056b3;'>Regarding Your Feedback</h2>
                <p>Dear {$recipientName},</p>
                <p>Thank you for contacting us. Please see our response to your message below.</p>
                <div style='border-left: 4px solid #0056b3; padding-left: 15px; margin: 15px 0;'>
                    {$formattedReply}
                </div>
                <p>Best regards,</p>
                <p><strong>UTYCC Support Team</strong></p>
                <hr style='border: none; border-top: 1px solid #eee; margin: 20px 0;'>
                <div style='font-size: 12px; color: #777;'>
                    <p><strong>Your original message:</strong></p>
                    <blockquote style='border-left: 3px solid #ccc; padding-left: 10px; margin: 10px 0; font-style: italic;'>
                        {$formattedOriginal}
                    </blockquote>
                </div>
            </div>
        ";

            $mail->AltBody = "Dear {$recipientName},\n\n{$replyMessage}\n\n---\nOriginal Message:\n{$originalMessage}";

            $mail->send();
            return true;

        } catch (Exception $e) {
            error_log("Support reply email could not be sent to {$recipientEmail}. Mailer Error: {$mail->ErrorInfo}");
            return false;
        }
}
