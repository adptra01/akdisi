<?php
/**
 * Booth Landing Page Template
 * Conversion khusus untuk pengunjung booth (QR Code)
 * Mobile-first, minimal nav, fast
 *
 * @package AKDISI
 * @since 1.0.0
 *
 * Template Name: Booth Landing
 */
get_header();
?>

<!-- Minimal Navigation untuk booth -->
<style>
    .site-header { display: none; }
</style>

<section class="booth-hero">
    <div class="container">
        <?php
        $wa_number = get_theme_mod('akdisi_whatsapp', '628123456789');
        $wa_msg = get_theme_mod('akdisi_wa_message', 'Halo AKDISI, saya dari booth pameran. Saya ingin konsultasi kebutuhan sistem.');
        ?>
        <h1><?php _e('Solusi Aplikasi untuk Bisnis Anda', 'akdisi'); ?></h1>
        <p><?php _e('Kami membantu bisnis dan organisasi membangun sistem yang sesuai kebutuhan — termasuk properti, perumahan, dan sektor lainnya.', 'akdisi'); ?></p>

        <a href="https://wa.me/<?php echo esc_attr($wa_number); ?>?text=<?php echo rawurlencode($wa_msg); ?>"
           class="btn btn-large btn-accent"
           target="_blank"
           rel="noopener noreferrer"
           style="min-width:250px;margin-bottom:1rem;">
            <?php _e('Konsultasi via WhatsApp', 'akdisi'); ?>
        </a><br>
        <a href="#lead-form" class="btn btn-large btn-secondary" style="min-width:250px;"><?php _e('Ceritakan Kebutuhan Anda', 'akdisi'); ?></a>
    </div>
</section>

<section class="section section-alt">
    <div class="container" style="max-width:720px;">
        <div class="section-header">
            <h2><?php _e('Masalah yang Sering Kami Temui', 'akdisi'); ?></h2>
            <p><?php _e('Banyak bisnis menghadapi tantangan yang sama — dan semuanya bisa diselesaikan dengan sistem yang tepat.', 'akdisi'); ?></p>
        </div>
        <div class="booth-cards">
            <div class="booth-card">
                <h3><?php _e('Data tersebar di mana-mana', 'akdisi'); ?></h3>
                <p><?php _e('Catatan unit, pembeli, dan iuran tersimpan di buku atau spreadsheet yang mudah terlewat dan sulit dicari.', 'akdisi'); ?></p>
            </div>
            <div class="booth-card">
                <h3><?php _e('Laporan lambat dan tidak akurat', 'akdisi'); ?></h3>
                <p><?php _e('Tanpa sistem terpusat, laporan keuangan dan perkembangan usaha memakan waktu lama dan rawan salah hitung.', 'akdisi'); ?></p>
            </div>
            <div class="booth-card">
                <h3><?php _e('Pelayanan yang tidak konsisten', 'akdisi'); ?></h3>
                <p><?php _e('Pengaduan warga atau permintaan anggota tidak terdokumentasi, tindak lanjutnya lama dan berulang.', 'akdisi'); ?></p>
            </div>
            <div class="booth-card">
                <h3><?php _e('Kesulitan memantau kinerja', 'akdisi'); ?></h3>
                <p><?php _e('Manajemen tidak bisa melihat perkembangan bisnis secara cepat karena data tidak tersaji dalam satu dashboard.', 'akdisi'); ?></p>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-header">
            <h2><?php _e('Contoh Solusi', 'akdisi'); ?></h2>
            <p><?php _e('Beberapa sistem yang dapat kami bangun untuk Anda.', 'akdisi'); ?></p>
        </div>

        <?php
        $portfolios = new WP_Query([
            'post_type'      => 'akdisi_portfolio',
            'posts_per_page' => 4,
            'post_status'    => 'publish',
        ]);

        if ($portfolios->have_posts()) :
        ?>
        <div class="booth-cards">
            <?php while ($portfolios->have_posts()) : $portfolios->the_post(); ?>
            <div class="booth-card text-center">
                <h3><?php the_title(); ?></h3>
                <p><?php echo esc_html(wp_trim_words(get_the_excerpt(), 15)); ?></p>
            </div>
            <?php endwhile; ?>
        </div>
        <?php
        endif;
        wp_reset_postdata();
        ?>

        <div class="booth-cards">
            <div class="booth-card text-center">
                <h3><?php _e('Sistem Perumahan', 'akdisi'); ?></h3>
                <p><?php _e('Data unit, customer, dan administrasi dalam satu sistem terpadu.', 'akdisi'); ?></p>
            </div>
            <div class="booth-card text-center">
                <h3><?php _e('Manajemen Anggota', 'akdisi'); ?></h3>
                <p><?php _e('Database anggota, keanggotaan, dan komunikasi organisasi.', 'akdisi'); ?></p>
            </div>
            <div class="booth-card text-center">
                <h3><?php _e('Pengelolaan Kawasan', 'akdisi'); ?></h3>
                <p><?php _e('Data penghuni, pengaduan, dan layanan dalam satu platform.', 'akdisi'); ?></p>
            </div>
            <div class="booth-card text-center">
                <h3><?php _e('Dashboard Developer', 'akdisi'); ?></h3>
                <p><?php _e('Monitoring proyek dan sales dalam dashboard real-time.', 'akdisi'); ?></p>
            </div>
        </div>
    </div>
</section>

<section class="section section-alt">
    <div class="container" style="max-width:600px;">
        <div class="section-header">
            <h2><?php _e('Kenapa AKDISI?', 'akdisi'); ?></h2>
        </div>
        <ul style="display:flex;flex-direction:column;gap:1rem;margin-bottom:2rem;">
            <li style="display:flex;gap:0.75rem;"><span style="color:var(--color-success);font-weight:700;">✓</span> <?php _e('Memahami kebutuhan bisnis, bukan sekadar teknologi', 'akdisi'); ?></li>
            <li style="display:flex;gap:0.75rem;"><span style="color:var(--color-success);font-weight:700;">✓</span> <?php _e('Proses kerja terstruktur dan transparan', 'akdisi'); ?></li>
            <li style="display:flex;gap:0.75rem;"><span style="color:var(--color-success);font-weight:700;">✓</span> <?php _e('Solusi dapat dikembangkan seiring kebutuhan', 'akdisi'); ?></li>
            <li style="display:flex;gap:0.75rem;"><span style="color:var(--color-success);font-weight:700;">✓</span> <?php _e('Berbasis di Jambi, memahami konteks lokal', 'akdisi'); ?></li>
        </ul>
    </div>
</section>

<section class="section" id="lead-form">
    <div class="container" style="max-width:600px;">
        <div class="section-header">
            <h2><?php _e('Ceritakan Kebutuhan Anda', 'akdisi'); ?></h2>
            <p><?php _e('Isi form di bawah, tim kami akan menghubungi Anda.', 'akdisi'); ?></p>
        </div>

        <div id="form-success" class="form-success">
            <?php _e('Terima kasih. Kebutuhan Anda telah diterima. Tim AKDISI akan menghubungi Anda melalui kontak yang diberikan.', 'akdisi'); ?>
        </div>

        <div class="form-general-error" role="alert" style="display:none;"></div>

        <form id="contact-form" class="contact-form" novalidate>
            <?php wp_nonce_field('akdisi_contact_nonce'); ?>
            <input type="hidden" name="campaign" value="booth">
            <input type="hidden" name="need" value="booth-concern">

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
                <label for="whatsapp"><?php _e('No WhatsApp *', 'akdisi'); ?></label>
                <input type="tel" id="whatsapp" name="whatsapp" required placeholder="08xxxxxxxxxx">
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
                <label for="description"><?php _e('Deskripsi Kebutuhan *', 'akdisi'); ?></label>
                <textarea id="description" name="description" required placeholder="<?php esc_attr_e('Ceritakan masalah yang ingin Anda selesaikan...', 'akdisi'); ?>"></textarea>
                <span class="field-error"></span>
            </div>

            <button type="submit" class="btn btn-large btn-primary" style="width:100%;"><?php _e('Kirim Permintaan', 'akdisi'); ?></button>
        </form>
    </div>
</section>

<script>
(function () {
    'use strict';
    var params = new URLSearchParams(window.location.search);
    var utm = ['utm_source', 'utm_medium', 'utm_campaign', 'utm_content', 'utm_term']
        .filter(function (k) { return params.get(k); })
        .map(function (k) { return k.replace('utm_', '') + '=' + params.get(k); })
        .join(',');
    var campaignInput = document.querySelector('input[name="campaign"]');
    if (campaignInput && utm) {
        campaignInput.value = 'booth:' + utm;
    }
})();
</script>

<?php get_footer();