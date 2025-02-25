<?php

/**
 * Template part page services
 *
 * @package BasherTheme
 */
//FAQs data
$faqs_data = get_faqs_section_data();
?>
<?php if (!empty($faqs_data['faqs'])) : ?>
    <!-- FAQs section-->
    <section class="sec-accordion">
        <div class="container">
            <?php if (!empty($faqs_data['title'])) : ?>
                <div class="row">
                    <div class="col-12">
                        <div class="content-description text-center">
                            <h2 class="header-3 text-white title-motion">
                                <?php echo esc_html($faqs_data['title']); ?>
                            </h2>
                            <?php if (!empty($faqs_data['description'])) : ?>
                                <p class="parraf text-white">
                                    <?php echo esc_html($faqs_data['description']); ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="row">
                <div class="col-12">
                    <div class="accordion mx-auto" id="accordionFaqs">
                        <?php foreach ($faqs_data['faqs'] as $key => $faq) : ?>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button <?php echo $key === 0 ? '' : 'collapsed'; ?>"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapse<?php echo $key; ?>"
                                        aria-expanded="<?php echo $key === 0 ? 'true' : 'false'; ?>"
                                        aria-controls="collapse<?php echo $key; ?>">
                                        <?php echo esc_html($faq['question']); ?>
                                    </button>
                                </h2>
                                <div id="collapse<?php echo $key; ?>"
                                    class="accordion-collapse collapse <?php echo $key === 0 ? 'show' : ''; ?>"
                                    data-bs-parent="#accordionFaqs">
                                    <div class="accordion-body text-white text-center">
                                        <p class="parraf"><?php echo esc_html($faq['answer']); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>