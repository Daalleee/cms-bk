import Cropper from 'cropperjs';

export function initImageCropper(inputId, previewId, modalId, confirmBtnId, cancelBtnId) {
    const input = document.getElementById(inputId);
    const preview = document.getElementById(previewId);
    const modal = document.getElementById(modalId);
    const confirmBtn = document.getElementById(confirmBtnId);
    const cancelBtn = document.getElementById(cancelBtnId);

    if (!input || !preview || !modal || !confirmBtn || !cancelBtn) return;

    let cropper = null;
    let isCropped = false;

    input.addEventListener('change', function () {
        if (isCropped) { isCropped = false; return; }
        const file = this.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = function (e) {
            preview.src = e.target.result;
            modal.classList.remove('hidden');
            modal.classList.add('flex');

            if (cropper) cropper.destroy();
            cropper = new Cropper(preview, {
                aspectRatio: 1,
                viewMode: 1,
                dragMode: 'move',
                autoCropArea: 1,
                cropBoxResizable: true,
                cropBoxMovable: true,
                background: false,
            });
        };
        reader.readAsDataURL(file);
    });

    confirmBtn.addEventListener('click', function () {
        if (!cropper) return;

        const canvas = cropper.getCroppedCanvas({
            width: 300,
            height: 300,
        });

        canvas.toBlob(function (blob) {
            const file = new File([blob], input.files[0].name.replace(/\.[^.]+$/, '.jpg'), {
                type: 'image/jpeg',
                lastModified: Date.now(),
            });

            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);
            isCropped = true;
            input.files = dataTransfer.files;

            modal.classList.add('hidden');
            modal.classList.remove('flex');
            if (cropper) { cropper.destroy(); cropper = null; }
        }, 'image/jpeg', 0.95);
    });

    cancelBtn.addEventListener('click', function () {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        if (cropper) { cropper.destroy(); cropper = null; }
        input.value = '';
    });

    modal.addEventListener('click', function (e) {
        if (e.target === modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            if (cropper) { cropper.destroy(); cropper = null; }
            input.value = '';
        }
    });
}
