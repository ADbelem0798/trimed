jQuery(function ($) {
    // Upload button
    $(document).on('click', '.trimed-upload-btn', function (e) {
        e.preventDefault();
        var target = $(this).data('target');
        var container = $(this).closest('.trimed-image-upload');

        var frame = wp.media({
            title: 'Selecionar imagem',
            button: { text: 'Usar esta imagem' },
            multiple: false,
            library: { type: 'image' }
        });

        frame.on('select', function () {
            var attachment = frame.state().get('selection').first().toJSON();
            var url = attachment.sizes && attachment.sizes.medium
                ? attachment.sizes.medium.url
                : attachment.url;

            $('#' + target).val(attachment.id);
            container.find('.trimed-upload-preview').html(
                '<img src="' + url + '" style="max-height:80px;max-width:240px;object-fit:contain;border:1px solid #e2e8f0;border-radius:4px;padding:4px;background:#f8f8f8">'
            );
            container.find('.trimed-upload-btn').text('Trocar imagem');

            if (!container.find('.trimed-remove-btn').length) {
                container.find('.trimed-upload-btn').after(
                    '<button type="button" class="button trimed-remove-btn" data-target="' + target + '" style="margin-left:4px;color:#dc2626;border-color:#dc2626">Remover</button>'
                );
            }
        });

        frame.open();
    });

    // Remove button
    $(document).on('click', '.trimed-remove-btn', function (e) {
        e.preventDefault();
        var target = $(this).data('target');
        var container = $(this).closest('.trimed-image-upload');

        $('#' + target).val('');
        container.find('.trimed-upload-preview').html(
            '<span style="display:inline-block;padding:12px 16px;background:#f8faff;border:1px dashed #d0d5dd;border-radius:4px;color:#94a3b8;font-size:13px">Nenhuma imagem selecionada</span>'
        );
        container.find('.trimed-upload-btn').text('Selecionar imagem');
        $(this).remove();
    });
});
