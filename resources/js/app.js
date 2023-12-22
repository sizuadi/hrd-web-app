import "./bootstrap";
import "../css/app.css";
import flatpickr from "flatpickr";
window.flatpickr = flatpickr;

import {
    Livewire,
    Alpine,
} from "../../vendor/livewire/livewire/dist/livewire.esm";

Alpine.plugin();

Livewire.start();
