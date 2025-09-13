import "@fortawesome/fontawesome-free/css/all.min.css";
import Toast from "./toast";

document.addEventListener("livewire:navigated", () => {
    Alpine.initTree(document.body);
});

Toast.init();
