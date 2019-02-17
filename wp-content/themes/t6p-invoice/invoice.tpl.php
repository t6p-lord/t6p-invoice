<?php
/*
Template Name: Invoice template
Template Post Type: invoice
*/

get_header();

?>

<?php
    while(have_posts()) : the_post();
?>
        <div class="container bg-white">
            <div class="row py-3">
                <div class="col-6 d-flex align-items-center">
                    <img src="<?php the_field('logo', 'options') ?>" height="50" alt="company logo">
                    <span class="fz-small ml-3"><?php the_field('company_name', 'options') ?></span>
                </div>
                <div class="col-6 text-right">
                    <p class="m-0">Invoice #: <?php the_ID() ?></p>
                    <p class="m-0">Date: <?php the_time(get_option('date_format')); ?> </p>
                </div>
            </div>
            <hr>
            <div class="row py-3">
                <div class="col-6">
                    <div class="table-head">
                        <h5 class="mb-0">Service to</h5>                     
                    </div>
                    <table class="table table-sm">
                        <tr>
                            <td>Invoice #</td>
                            <td class="text-right"><?php the_ID() ?></td>
                        </tr>
                        <tr>
                            <td>Date</td>
                            <td class="text-right"><?php the_time(get_option('date_format')); ?></td>
                        </tr>
                        <tr>
                            <td>Customer name</td>
                            <td class="text-right"><?php the_field('customer_name') ?></td>
                        </tr>
                        <?php if(!empty(get_field('company_name'))) : ?>
                            <tr>
                                <td>Company name</td>
                                <td class="text-right"><?php the_field('company_name') ?></td>
                            </tr>
                        <?php endif; ?>
                        <?php if(!empty(get_field('customer_number'))) : ?>
                            <tr>
                                <td>Contact number</td>
                                <td class="text-right"><?php the_field('customer_number') ?></td>
                            </tr>
                        <?php endif; ?>
                    </table>
                </div>
            </div>
            <hr>
            <?php if(have_rows('section')) : ?>
                <?php $row_count = count(get_field('section')); ?>
                <?php $counter = 1; ?>
                
                <?php while(have_rows('section')) : the_row(); ?>
                    <?php $unit = get_sub_field('unit'); ?>
                    <div class="row py-3">
                        <div class="col-12">
                            <div class="table-head">
                                <h5 class="mb-0"><?php the_sub_field('section_title') ?></h5>
                            </div>
                            <table class="table table-bordered">
                                <thead class="bg-light">
                                    <tr>
                                        <td>Description</td>
                                        <td>Hours</td>
                                        <td>Hourly Rate</td>
                                        <td>Amount</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $isAutomaticCompute = get_sub_field('automatic_compute'); ?>
                                    <?php while(have_rows('section_table')) : the_row(); ?>
                                        <tr class="<?= $isAutomaticCompute === true ? 'js-compute' : '' ?>">
                                            <td class="table-data table-data--desc"><?php the_sub_field('description') ?></td>
                                            <td class="table-data table-data--hours js-hours"><?php the_sub_field('hours') ?></td>
                                            <td class="table-data table-data--hour-rate">
                                            <!-- <?= $unit === 'dollar' ? '$' : '₱' ?><span class="js-hourly-rate"><?php the_sub_field('hourly_rate') ?></span> -->
                                                <?php if(empty(get_sub_field('hourly_rate'))) : ?>
                                                    --
                                                <?php else: ?>
                                                    <?= $unit === 'dollar' ? '$' : '₱' ?><span class="js-hourly-rate"><?php the_sub_field('hourly_rate') ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="table-data table-data--amount js-amount"><?= $isAutomaticCompute === true ? '' : get_sub_field('amount') ?></td>
                                        </tr>
                                    <?php endwhile; ?>
                                    <tr class="<?= $counter < $row_count ? 'js-subtotal' : 'js-total' ?>">
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td><?= $counter < $row_count ? 'Subtotal' : 'Total' ?></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php $counter++; endwhile; ?>
                <hr>
            <?php endif; ?>
        </div>
<?php 
    endwhile; 
?>

<?php get_footer(); ?>