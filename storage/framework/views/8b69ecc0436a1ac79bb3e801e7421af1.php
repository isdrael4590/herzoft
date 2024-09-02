<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
<script src="https://unpkg.com/filepond/dist/filepond.js"></script>

<script>
    FilePond.registerPlugin(
        FilePondPluginImagePreview,
        FilePondPluginFileValidateSize,
        FilePondPluginFileValidateType
    );
    const fileElement = document.querySelector('input[id="image"]');
    const pond = FilePond.create(fileElement, {
        acceptedFileTypes: ['image/png', 'image/jpg', 'image/jpeg'],
    });
    FilePond.setOptions({
        server: {
            process: "<?php echo e(route('filepond.upload')); ?>",
            revert: "<?php echo e(route('filepond.delete')); ?>",
            headers: {
                "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>"
            }
        }
    });
</script>
<?php /**PATH /var/www/html/resources/views/includes/filepond-js.blade.php ENDPATH**/ ?>