import './bootstrap';

// Impor AlpineJS dan mulai
import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

// Impor EasyMDE dan jadikan global agar bisa diakses dari Blade
import EasyMDE from 'easymde';
window.EasyMDE = EasyMDE;