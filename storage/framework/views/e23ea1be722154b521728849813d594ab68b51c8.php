<?php $__env->startPush('bottom'); ?>

    <?php if(App::getLocale() != 'en'): ?>
        <script src="<?php echo e(asset ('vendor/crudbooster/assets/adminlte/plugins/datepicker/locales/bootstrap-datepicker.'.App::getLocale().'.js')); ?>"
                charset="UTF-8"></script>
    <?php endif; ?>
    <script type="text/javascript">
        var lang = '<?php echo e(App::getLocale()); ?>';
        $(function () {
            $('.input_date').datepicker({
                format: 'yyyy-mm-dd',
                <?php if(in_array(App::getLocale(), ['ar', 'fa'])): ?>
                rtl: true,
                <?php endif; ?>
                language: lang
            });

            $('.open-datetimepicker').click(function () {
                $(this).next('.input_date').datepicker('show');
            });

        });

    </script>
<?php $__env->stopPush(); ?><?php /**PATH D:\New folder\htdocs\RUN\vendor\crocodicstudio\crudbooster\src/views/default/type_components/date/asset.blade.php ENDPATH**/ ?>