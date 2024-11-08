const quill = new Quill("#editor", {
    theme: "snow",
    placeholder: "Nhập mô tả ngắn...",
});
const quill2 = new Quill("#editor-2", {
    theme: "snow",
    placeholder: "Nhập mô tả chi tiết...",
});
// Đồng bộ nội dung Quill với textarea
quill.on("text-change", function () {
    document.querySelector('textarea[name="short-description"]').value =
        quill.root.innerHTML;
});
// Đồng bộ nội dung Quill với textarea
quill2.on("text-change", function () {
    document.querySelector('textarea[name="description"]').value =
        quill2.root.innerHTML;
});
