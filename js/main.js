function onPublish() {
    alert('Успешно записано в базу!');
}

function showModal() {
    
    if (document.querySelector(".modal-window").classList.contains("hidden")) {
        document.querySelector(".modal-window").classList.remove("hidden");
    }

}

document.querySelector(".close-modal").addEventListener("click", function() {
    document.querySelector(".modal-window").classList.add("hidden");
});
document.querySelector(".close-img").addEventListener("click", function() {
    document.querySelector(".modal-window").classList.add("hidden");
});