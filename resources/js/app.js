

import 'cropperjs/dist/cropper.min.css';
import Alpine from 'alpinejs';
import { initImageCropper } from './image-cropper';

window.Alpine = Alpine;
window.initImageCropper = initImageCropper;

Alpine.start();
