import './bootstrap';

import Alpine from 'alpinejs';

import "@lottiefiles/lottie-player";

import Typewriter from '@marcreichel/alpine-typewriter';

Alpine.plugin(Typewriter);

window.Alpine = Alpine;

Alpine.start();
