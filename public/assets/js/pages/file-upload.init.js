const handleChange = function () {
        var e = document.querySelector("#input-file").files;
        0 !== e.length && ((e = e[0]), readFile(e));
    },
    readFile = function (e) {
        if (e) {
            const n = new FileReader();
            (n.onload = function () {
                document.querySelector(
                    ".preview-box"
                ).innerHTML = `<img class="preview-content" src=${n.result} />`;
            }),
                n.readAsDataURL(e);
        }
    };
var uppy = new Uppy.Uppy()
    .use(Uppy.Dashboard, { inline: !0, target: "#drag-drop-area" })
    .use(Uppy.Tus, { endpoint: "https://tusd.tusdemo.net/files/" });

// Khi tệp được chọn hoặc kéo vào dashboard
// Lắng nghe sự kiện khi tệp được thêm vào
uppy.on("file-added", (file) => {
    let fileInput = document.querySelector('input[name="galleries[]"]');
    let dataTransfer = new DataTransfer();

    // Lấy các tệp hiện tại đã có trong input
    if (fileInput.files.length > 0) {
        for (let i = 0; i < fileInput.files.length; i++) {
            dataTransfer.items.add(fileInput.files[i]);
        }
    }

    // Thêm tệp mới được chọn từ Uppy vào DataTransfer
    dataTransfer.items.add(file.data);

    // Cập nhật lại giá trị của input
    fileInput.files = dataTransfer.files;
});

// Lắng nghe sự kiện khi tệp bị xóa (khi bấm nút "x")
uppy.on("file-removed", (file) => {
    let fileInput = document.querySelector('input[name="galleries[]"]');
    let dataTransfer = new DataTransfer();

    // Lặp qua các tệp hiện tại trong input, trừ tệp bị xóa
    for (let i = 0; i < fileInput.files.length; i++) {
        if (fileInput.files[i].name !== file.name) {
            dataTransfer.items.add(fileInput.files[i]);
        }
    }

    // Cập nhật lại giá trị của input mà không có tệp bị xóa
    fileInput.files = dataTransfer.files;
});

uppy.on("complete", (e) => {});
