const defaultConfig = {
    position: "top-right",
    gap: 12,
    offset: 16,
    type: "info",
    title: "Info",
    message: "",
    duration: 0,
};

function createToast() {
    const Toast = {
        config: { ...defaultConfig },

        createStore() {
            const self = this;
            // create store
            if (!Alpine.store("toastStore")) {
                Alpine.store("toastStore", {
                    toasts: [],
                    add(toast) {
                        this.toasts.push(toast);
                        if (toast.duration > 0) {
                            setTimeout(
                                () => this.remove(toast.id),
                                toast.duration
                            );
                        }
                    },
                    remove(id) {
                        const toastEl = document.querySelector(
                            `#toast-stack > div[data-id='${id}']`
                        );
                        if (toastEl) {
                            toastEl.classList.add("toast-leave");
                            toastEl.classList.add("toast-leave-active");

                            // čekaj da animacija završi pre uklanjanja iz store
                            toastEl.addEventListener(
                                "transitionend",
                                () => {
                                    this.toasts = this.toasts.filter(
                                        (t) => t.id !== id
                                    );
                                    self.render();
                                },
                                { once: true }
                            );
                        } else {
                            this.toasts = this.toasts.filter(
                                (t) => t.id !== id
                            );
                            self.render();
                        }
                    },
                });
            }
        },

        init(config = {}) {
            this.config = { ...this.config, ...config };

            this.createStore();

            if (!document.getElementById("toast-stack")) {
                this.createToastContainer();
            }

            window.removeEventListener("toast", this.handleToastEvent);
            window.addEventListener("toast", this.handleToastEvent);
        },

        handleToastEvent(e) {
            Toast.add(e.detail);
        },

        createToastContainer() {
            const container = document.createElement("div");
            container.id = "toast-stack";
            container.className = `fixed z-50 ${this.getContainerPositionClasses()}`;
            container.style.pointerEvents = "none";

            document.body.appendChild(container);
        },

        add(config) {
            window.removeEventListener("toast", this.handleToastEvent);
            window.addEventListener("toast", this.handleToastEvent);

            const toast = {
                ...this.config,
                ...config,
                id: Date.now() + Math.random(),
            };

            if (!document.getElementById("toast-stack")) {
                this.createToastContainer();
            }

            this.createStore();

            Alpine.store("toastStore").add(toast);

            this.render();
        },

        render() {
            const container = document.getElementById("toast-stack");
            if (!container) return;

            container.innerHTML = "";

            Alpine.store("toastStore").toasts.forEach((toast, index) => {
                const el = document.createElement("div");
                el.dataset.id = toast.id;
                el.style.cssText = this.getStyle(index);
                el.className =
                    `flex justify-between items-start gap-2 px-4 py-3 rounded shadow-lg w-64 pointer-events-auto ` +
                    (toast.type === "success"
                        ? "bg-green-200 border-2 border-green-700 text-green-900"
                        : toast.type === "error"
                        ? "bg-red-200 border-2 border-red-700 text-red-900"
                        : toast.type === "warning"
                        ? "bg-yellow-200 border-2 border-yellow-700 text-yellow-900"
                        : toast.type === "info"
                        ? "bg-blue-200 border-2 border-blue-700 text-blue-900"
                        : "bg-gray-200 border-2 border-gray-700 text-gray-900");

                requestAnimationFrame(() => {
                    el.classList.add("toast-enter-active");
                    el.classList.remove("toast-enter");
                });

                const icon =
                    toast.type === "success"
                        ? `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-10">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>`
                        : toast.type === "error"
                        ? `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-10">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>`
                        : toast.type === "warning"
                        ? `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="size-10" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /> <path d="M12 8v4" /> <path d="M12 16h.01" />
                    </svg>`
                        : toast.type === "info"
                        ? `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-10">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                    </svg>`
                        : "";

                el.innerHTML = `
                    <div class="flex-1 flex items-start">
                        <div class="flex justify-center items-center mr-4">
                        ${icon}
                        </div>
                        <div>
                            ${
                                toast.title
                                    ? `<h2 class="font-semibold text-lg flex gap-1 justify-start items-center"> ${toast.title}</h2>`
                                    : ""
                            }
                            <p class="text-sm mt-1">${toast.message}</p>
                        </div>
                    </div>
                    <button class="focus:outline-none text-3xl">&times;</button>
                    `;

                el.querySelector("button").addEventListener("click", () =>
                    Alpine.store("toastStore").remove(toast.id)
                );

                container.appendChild(el);
            });
        },

        getStyle(index) {
            const posOffset = this.config.offset + index * this.config.gap;
            if (this.config.position.includes("bottom")) {
                return `position:absolute; bottom:${posOffset}px; ${
                    this.config.position.includes("right")
                        ? "right:0"
                        : "left:0"
                }; width:20rem;`;
            } else {
                return `position:absolute; top:${posOffset}px; ${
                    this.config.position.includes("right")
                        ? "right:0"
                        : "left:0"
                }; width:20rem;`;
            }
        },

        getContainerPositionClasses() {
            switch (this.config.position) {
                case "top-left":
                    return "top-4 left-4";
                case "top-right":
                    return "top-4 right-4";
                case "bottom-left":
                    return "bottom-4 left-4";
                case "bottom-right":
                    return "bottom-4 right-4";
                default:
                    return "top-4 right-4";
            }
        },

        success(title, message, duration) {
            this.add({
                type: "success",
                title: title,
                message: message,
                duration: duration || 0,
            });
        },

        error(title, message, duration) {
            this.add({
                type: "error",
                title: title,
                message: message,
                duration: duration || 0,
            });
        },

        warning(title, message, duration) {
            this.add({
                type: "warning",
                title: title,
                message: message,
                duration: duration || 0,
            });
        },

        info(title, message, duration) {
            this.add({
                type: "info",
                title: title,
                message: message,
                duration: duration || 0,
            });
        },
    };

    return {
        init: Toast.init.bind(Toast),
        success: Toast.success.bind(Toast),
        error: Toast.error.bind(Toast),
        warning: Toast.warning.bind(Toast),
        info: Toast.info.bind(Toast),
    };
}

export default createToast();
