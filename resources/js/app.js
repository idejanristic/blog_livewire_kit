import Toast from "./toast";

window.addEventListener("popstate", () => {
    console.log("Back/forward detected");
    window.location.reload();
});

document.addEventListener("livewire:navigated", () => {
    Alpine.initTree(document.body);
});

Toast.init();
