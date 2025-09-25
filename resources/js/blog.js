import "@fortawesome/fontawesome-free/css/all.min.css";

window.addEventListener("popstate", () => {
    console.log("Back/forward detected");
    window.location.reload();
});

document.addEventListener("livewire:navigated", () => {
    Alpine.initTree(document.body);
});
