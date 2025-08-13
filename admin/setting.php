<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login");
    exit();
}

include '../config/database.php';
require_once '../config/functions.php';

// Load settings from DB
$settings = load_settings($conn);

include_once('header.php');
include_once('sidebar.php');
include_once('topbar.php');
?>

<div class="container py-4" style="margin-left:300px;">
    <div class="row">
        <div class="col-lg-10">

            <h3 class="mb-4">Settings</h3>

            <form method="POST" action="save_settings.php" class="row g-4">

                <!-- Application Info -->
                <div class="card mb-4 shadow-sm h-100">
                    <div class="card-header fw-bold">Application Info</div>
                    <div class="card-body row g-3">
                        <div class="col-md-6">
                            <label for="app_name" class="form-label">Website Name</label>
                            <input type="text" id="app_name" class="form-control" name="app_name"
                                placeholder="Website name" value="<?= htmlspecialchars($settings['app_name'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="app_logo" class="form-label">Website Logo (URL)</label>
                            <input type="text" id="app_logo" class="form-control" name="app_logo"
                                placeholder="Logo URL" value="<?= htmlspecialchars($settings['app_logo'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="favicon" class="form-label">Favicon (URL)</label>
                            <input type="text" id="favicon" class="form-control" name="favicon"
                                placeholder="Favicon URL" value="<?= htmlspecialchars($settings['favicon'] ?? '') ?>">
                        </div>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="card mb-4 shadow-sm h-100">
                    <div class="card-header fw-bold">Contact Information</div>
                    <div class="card-body row g-3">
                        <div class="col-md-6">
                            <label for="contact_phone" class="form-label">Phone</label>
                            <input type="text" id="contact_phone" class="form-control" name="contact_phone"
                                placeholder="Phone number" value="<?= htmlspecialchars($settings['contact_phone'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="contact_email" class="form-label">Email</label>
                            <input type="email" id="contact_email" class="form-control" name="contact_email"
                                placeholder="example@gmail.com" value="<?= htmlspecialchars($settings['contact_email'] ?? '') ?>">
                        </div>
                        <div class="col-md-12">
                            <label for="contact_address" class="form-label">Address</label>
                            <input type="text" id="contact_address" class="form-control" name="contact_address"
                                placeholder="Full address" value="<?= htmlspecialchars($settings['contact_address'] ?? '') ?>">
                        </div>
                    </div>
                </div>

                <!-- Social Media -->
                <div class="card mb-4 shadow-sm h-100">
                    <div class="card-header fw-bold">Social Media Links</div>
                    <div class="card-body row g-3">
                        <div class="col-md-6">
                            <label for="facebook_url" class="form-label">Facebook</label>
                            <input type="text" id="facebook_url" class="form-control" name="facebook_url"
                                placeholder="Facebook URL" value="<?= htmlspecialchars($settings['facebook_url'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="twitter_url" class="form-label">Twitter / X</label>
                            <input type="text" id="twitter_url" class="form-control" name="twitter_url"
                                placeholder="Twitter/X URL" value="<?= htmlspecialchars($settings['twitter_url'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="linkedin_url" class="form-label">LinkedIn</label>
                            <input type="text" id="linkedin_url" class="form-control" name="linkedin_url"
                                placeholder="LinkedIn URL" value="<?= htmlspecialchars($settings['linkedin_url'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="instagram_url" class="form-label">Instagram</label>
                            <input type="text" id="instagram_url" class="form-control" name="instagram_url"
                                placeholder="Instagram URL" value="<?= htmlspecialchars($settings['instagram_url'] ?? '') ?>">
                        </div>
                    </div>
                </div>

                <!-- SMS API -->
                <div class="card mb-4 shadow-sm h-100">
                    <div class="card-header fw-bold">SMS API Settings</div>
                    <div class="card-body row g-3">
                        <div class="col-md-6">
                            <label for="sms_api_url" class="form-label">SMS API URL</label>
                            <input type="text" id="sms_api_url" class="form-control" name="sms_api_url"
                                placeholder="SMS API URL" value="<?= htmlspecialchars($settings['sms_api_url'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="sms_api_key" class="form-label">API Key</label>
                            <input type="text" id="sms_api_key" class="form-control" name="sms_api_key"
                                placeholder="SMS API Key" value="<?= htmlspecialchars($settings['sms_api_key'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="sms_sender_id" class="form-label">Sender ID</label>
                            <input type="text" id="sms_sender_id" class="form-control" name="sms_sender_id"
                                placeholder="Sender ID" value="<?= htmlspecialchars($settings['sms_sender_id'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="test_number" class="form-label">Test Number</label>
                            <div class="d-flex">
                                <input type="text" id="test_number" class="form-control me-2"
                                    placeholder="Test Phone Number">
                                <button type="button" class="btn btn-primary" onclick="testSMS()">Send Test</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mail Settings -->
                <div class="card mb-4 shadow-sm h-100">
                    <div class="card-header fw-bold">Mail Settings</div>
                    <div class="card-body row g-3">
                        <div class="col-md-6">
                            <label for="mail_mailer" class="form-label">Mailer</label>
                            <input type="text" id="mail_mailer" class="form-control" name="mail_mailer"
                                placeholder="smtp" value="<?= htmlspecialchars($settings['mail_mailer'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="mail_host" class="form-label">SMTP Host</label>
                            <input type="text" id="mail_host" class="form-control" name="mail_host"
                                placeholder="SMTP Host" value="<?= htmlspecialchars($settings['mail_host'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="mail_port" class="form-label">SMTP Port</label>
                            <input type="number" id="mail_port" class="form-control" name="mail_port"
                                placeholder="SMTP Port" value="<?= htmlspecialchars($settings['mail_port'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="mail_username" class="form-label">SMTP Username</label>
                            <input type="text" id="mail_username" class="form-control" name="mail_username"
                                placeholder="SMTP Username" value="<?= htmlspecialchars($settings['mail_username'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="mail_password" class="form-label">SMTP Password</label>
                            <input type="password" id="mail_password" class="form-control" name="mail_password"
                                placeholder="SMTP Password" value="<?= htmlspecialchars($settings['mail_password'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="mail_encryption" class="form-label">Encryption</label>
                            <input type="text" id="mail_encryption" class="form-control" name="mail_encryption"
                                placeholder="ssl/tls" value="<?= htmlspecialchars($settings['mail_encryption'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="mail_from_address" class="form-label">From Email</label>
                            <input type="email" id="mail_from_address" class="form-control" name="mail_from_address"
                                placeholder="From Email" value="<?= htmlspecialchars($settings['mail_from_address'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="mail_from_name" class="form-label">From Name</label>
                            <input type="text" id="mail_from_name" class="form-control" name="mail_from_name"
                                placeholder="From Name" value="<?= htmlspecialchars($settings['mail_from_name'] ?? '') ?>">
                        </div>
                    </div>
                </div>

                <!-- Maintenance Mode -->
                <div class="card mb-4 shadow-sm h-100">
                    <div class="card-header fw-bold">Maintenance Mode</div>
                    <div class="card-body">
                        <label for="maintenance_mode" class="form-label">Status</label>
                        <select class="form-select" id="maintenance_mode" name="maintenance_mode">
                            <option value="0" <?= (isset($settings['maintenance_mode']) && $settings['maintenance_mode'] == '0') ? 'selected' : '' ?>>Disabled</option>
                            <option value="1" <?= (isset($settings['maintenance_mode']) && $settings['maintenance_mode'] == '1') ? 'selected' : '' ?>>Enabled</option>
                        </select>
                    </div>
                </div>

                <!-- Save Button -->
                <div>
                    <button type="submit" class="btn btn-success">Save Settings</button>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
    function testSMS() {
        const number = document.getElementById('test_number').value;
        if (!number) {
            alert('Please enter a phone number');
            return;
        }
        alert('SMS test feature to be connected to backend API.');
    }
</script>
