<?php
/**
 * Contact Page Template
 * Form lead generation dengan integrasi WhatsApp
 *
 * @package AKDISI
 * @since 1.0.0
 *
 * Template Name: Contact Page
 */

get_header();
?>

<section class="hero" style="padding:3rem 0;">
    <div class="container">
        <h1><?php echo esc_html(get_the_title()); ?></h1>
        <p><?php _e('Ceritakan kebutuhan Anda — kami akan membantu Anda menemukan solusi yang tepat.', 'akdisi'); ?></p>
    </div>
</section>

<div class="section">
    <div class="container">
        <div class="card-grid" style="grid-template-columns:1fr;">
            <div style="max-width:400px;margin-bottom:2rem;">
                <h2 style="font-size:1.25rem;margin-bottom:1rem;"><?php _e('Kontak Langsung', 'akdisi'); ?></h2>
                <?php
                $phone = get_theme_mod('akdisi_phone', '628123456789');
                $email = get_theme_mod('akdisi_email', '');
                $wa_msg = get_theme_mod('akdisi_wa_message', 'Halo AKDISI, saya ingin konsultasi kebutuhan sistem.');
                ?>
                <p style="margin-bottom:0.5rem;">
                    <a href="https://wa.me/<?php echo esc_attr($phone); ?>?text=<?php echo rawurlencode($wa_msg); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-accent" style="display:inline-block;">
                        <?php _e('Chat WhatsApp', 'akdisi'); ?>
                    </a>
                </p>
                <?php if ($email) : ?>
                    <p><a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></p>
                <?php endif; ?>
                <p><?php echo esc_html(get_theme_mod('akdisi_address', 'Jambi, Indonesia')); ?></p>
            </div>

            <div style="max-width:600px;" id="contact">
                <h2 style="font-size:1.25rem;margin-bottom:1rem;"><?php _e('Form Konsultasi', 'akdisi'); ?></h2>

                <div id="form-success" class="form-success">
                    <?php _e('Terima kasih. Kebutuhan Anda telah diterima. Tim AKDISI akan menghubungi Anda melalui kontak yang diberikan.', 'akdisi'); ?>
                </div>

                <div class="form-general-error" role="alert" style="display:none;"></div>

                <form id="contact-form" class="contact-form" novalidate>
                    <?php wp_nonce_field('akdisi_contact_nonce'); ?>
                    <input type="hidden" name="campaign" value="<?php echo esc_attr(sanitize_text_field(wp_unslash($_GET['campaign'] ?? ''))); ?>">

                    <div class="form-field">
                        <label for="name"><?php _e('Nama *', 'akdisi'); ?></label>
                        <input type="text" id="name" name="name" required>
                        <span class="field-error"></span>
                    </div>
                    <div class="form-field">
                        <label for="organization"><?php _e('Organisasi / Perusahaan', 'akdisi'); ?></label>
                        <input type="text" id="organization" name="organization">
                        <span class="field-error"></span>
                    </div>
                    <div class="form-field">
                        <label for="position"><?php _e('Jabatan', 'akdisi'); ?></label>
                        <input type="text" id="position" name="position">
                        <span class="field-error"></span>
                    </div>
                    <div class="form-field">
                        <label for="whatsapp"><?php _e('No WhatsApp *', 'akdisi'); ?></label>
                        <input type="tel" id="whatsapp" name="whatsapp" required placeholder="08xxxxxxxxxx">
                        <span class="field-error"></span>
                    </div>
                    <div class="form-field">
                        <label for="email"><?php _e('Email', 'akdisi'); ?></label>
                        <input type="email" id="email" name="email">
                        <span class="field-error"></span>
                    </div>
                    <div class="form-field">
                        <label for="org_type"><?php _e('Jenis Organisasi *', 'akdisi'); ?></label>
                        <select id="org_type" name="org_type" required>
                            <option value=""><?php _e('-- Pilih --', 'akdisi'); ?></option>
                            <option value="developer"><?php _e('Developer Perumahan', 'akdisi'); ?></option>
                            <option value="association"><?php _e('Organisasi / Asosiasi', 'akdisi'); ?></option>
                            <option value="property"><?php _e('Perusahaan Properti', 'akdisi'); ?></option>
                            <option value="kawasan"><?php _e('Pengelola Kawasan', 'akdisi'); ?></option>
                            <option value="general"><?php _e('Bisnis Lainnya', 'akdisi'); ?></option>
                        </select>
                        <span class="field-error"></span>
                    </div>
                    <div class="form-field">
                        <label for="need"><?php _e('Kebutuhan *', 'akdisi'); ?></label>
                        <input type="text" id="need" name="need" required placeholder="<?php esc_attr_e('Contoh: Sistem pengelolaan data atau aset bisnis', 'akdisi'); ?>">
                        <span class="field-error"></span>
                    </div>
                    <div class="form-field">
                        <label for="description"><?php _e('Deskripsi Kebutuhan *', 'akdisi'); ?></label>
                        <textarea id="description" name="description" required placeholder="<?php esc_attr_e('Ceritakan masalah yang ingin Anda selesaikan...', 'akdisi'); ?>"></textarea>
                        <span class="field-error"></span>
                    </div>

                    <button type="submit" class="btn btn-large btn-primary" style="width:100%;"><?php _e('Kirim Permintaan', 'akdisi'); ?></button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php get_footer();