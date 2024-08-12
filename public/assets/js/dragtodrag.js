document.addEventListener("DOMContentLoaded", (event) => {
    const containers = document.querySelector("#containers");

    // Event listener untuk drag and drop
    function onDragStart(e) {
        console.log("Drag Start:", e.target.id);
        e.dataTransfer.setData("text", e.target.id);
        e.target.classList.add("dragging");
    }

    function onDragEnd(e) {
        console.log("Drag End:", e.target.id);
        e.target.classList.remove("dragging");
    }

    function onDragOver(e) {
        e.preventDefault();
        console.log("Drag Over:", e.target);
    }

    function onDrop(e) {
        e.preventDefault();
        const data = e.dataTransfer.getData("text");
        const droppedElement = document.getElementById(data);
        console.log("Drop:", data, "to", e.target);
        if (droppedElement) {
            if (e.target.classList.contains("card-body")) {
                e.target.appendChild(droppedElement.parentElement);
            }
        }
    }

    function onTaskClick(e) {
        const taskId = e.target.dataset.id;
        if (taskId) {
            const taskModal = new bootstrap.Modal(
                document.getElementById(`taskModal${taskId}`)
            );
            taskModal.show();
        }
    }

    document
        .querySelectorAll(".task-container .task-content")
        .forEach((taskContent) => {
            taskContent.addEventListener("dragstart", onDragStart);
            taskContent.addEventListener("dragend", onDragEnd);
            taskContent.addEventListener("click", onTaskClick);
        });

    document.querySelectorAll(".card-body").forEach((container) => {
        container.addEventListener("dragover", onDragOver);
        container.addEventListener("drop", onDrop);
    });
});