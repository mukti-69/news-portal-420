$(".select2").select2({
    language: "bn"
});
$(".select2.round").select2({
    language: "bn",
    containerCssClass: "round"
});
$(".select2.curve").select2({
    language: "bn",
    containerCssClass: "curve"
});

$(".allow-cancel").select2({
    language: "bn",
    allowClear: true,
    placeholder: {
        id: "",
        placeholder: "..."
    }
});
